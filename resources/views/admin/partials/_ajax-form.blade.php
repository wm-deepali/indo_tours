{{-- resources/views/admin/partials/_ajax-form.blade.php --}}
{{-- Usage: @include('admin.partials._ajax-form', ['formId' => 'my-form', 'tabsId' => 'my-tabs']) (tabsId optional) --}}
{{-- Form needs: <div id="form-alert" class="form-alert" style="display:none"></div> and a submit button id="save-btn" --}}
<style>
    .form-alert { margin: 16px 24px 0; padding: 14px 16px; border: 1px solid #f1b5b5; background: #fff4f4; color: #8a1f1f; border-radius: 8px; font-size: 13px; }
    .form-alert strong { display: block; margin-bottom: 6px; }
    .form-alert ul { margin: 0; padding-left: 18px; }
    .form-alert a { color: inherit; text-decoration: underline; cursor: pointer; }
    .form-control-styled.is-invalid { border-color: #b22222; }
    .select2-container.is-invalid .select2-selection--single { border-color: #b22222; }
    .btn-primary-dash[disabled] { opacity: .6; cursor: not-allowed; }
    .cat-tab .tab-badge { display: inline-block; margin-left: 6px; background: #b22222; color: #fff; border-radius: 999px; font-size: 10px; font-weight: 700; padding: 1px 6px; vertical-align: middle; }
</style>
<script>
    (function () {
        const form = document.getElementById(@json($formId));
        const tabsSel = '#' + @json($tabsId ?? '') + ' .cat-tab';
        const hasTabs = @json(!empty($tabsId));
        const alertBox = document.getElementById('form-alert');
        const saveBtn = document.getElementById('save-btn');
        if (!form || !alertBox || !saveBtn) return;

        function activateTab(name) {
            if (!hasTabs) return;
            document.querySelectorAll(tabsSel).forEach(b => b.classList.toggle('active', b.dataset.tab === name));
            document.querySelectorAll('.cat-tab-panel').forEach(p => p.classList.toggle('active', p.dataset.panel === name));
        }

        function clearErrors() {
            alertBox.style.display = 'none';
            alertBox.innerHTML = '';
            form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
            form.querySelectorAll('.js-error').forEach(el => el.remove());
            form.querySelectorAll('.tab-badge').forEach(el => el.remove());
        }

        // Laravel key "package_includes.0.1" -> try name[0][1], name[0][], name[]
        function fieldFor(key) {
            const parts = key.split('.');
            const candidates = [];
            for (let end = parts.length; end >= 1; end--) {
                const base = parts[0] + parts.slice(1, end).map(p => '[' + p + ']').join('');
                candidates.push(base + '[]'.repeat(end < parts.length ? 1 : 0));
                if (end === parts.length) candidates.unshift(base);
            }
            candidates.push(parts[0], parts[0] + '[]');
            for (const name of candidates) {
                const el = form.querySelector('[name="' + CSS.escape(name) + '"]');
                if (el) return el;
            }
            return null;
        }

        // Select2 hides the real <select>; use its visible container
        function visibleFor(field) {
            const next = field.nextElementSibling;
            return field.classList.contains('select2-hidden-accessible') && next && next.classList.contains('select2-container')
                ? next : field;
        }

        function showBanner(title, items) {
            alertBox.innerHTML = '';
            const strong = document.createElement('strong');
            strong.textContent = title;
            alertBox.appendChild(strong);

            if (items && items.length) {
                const ul = document.createElement('ul');
                items.forEach(item => {
                    const li = document.createElement('li');
                    const a = document.createElement('a');
                    a.textContent = item.msg;
                    a.addEventListener('click', () => {
                        if (item.tab) activateTab(item.tab);
                        if (item.field) {
                            visibleFor(item.field).scrollIntoView({ behavior: 'smooth', block: 'center' });
                            item.field.focus?.();
                        }
                    });
                    li.appendChild(a);
                    ul.appendChild(li);
                });
                alertBox.appendChild(ul);
            }
            alertBox.style.display = 'block';
            alertBox.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

        function showErrors(errors) {
            clearErrors();
            const perTab = {};
            const items = [];

            Object.entries(errors).forEach(([key, msgs]) => {
                const field = fieldFor(key);
                const panel = field ? field.closest('.cat-tab-panel') : null;
                const tab = panel ? panel.dataset.panel : null;

                if (field) {
                    const target = visibleFor(field);
                    target.classList.add('is-invalid');
                    const div = document.createElement('div');
                    div.className = 'form-error js-error';
                    div.textContent = msgs[0];
                    target.insertAdjacentElement('afterend', div);
                }
                if (tab) perTab[tab] = (perTab[tab] || 0) + 1;
                items.push({ msg: msgs[0], tab, field });
            });

            if (hasTabs) {
                Object.entries(perTab).forEach(([tab, count]) => {
                    const btn = form.querySelector('.cat-tab[data-tab="' + tab + '"]');
                    if (!btn) return;
                    const badge = document.createElement('span');
                    badge.className = 'tab-badge';
                    badge.textContent = count;
                    btn.appendChild(badge);
                });
            }

            showBanner('Nothing was saved. Please fix the following (everything you entered is still here):', items);
            const firstTab = items.find(i => i.tab)?.tab;
            if (firstTab) activateTab(firstTab);
        }

        form.addEventListener('submit', async function (e) {
            e.preventDefault();
            clearErrors();

            const original = saveBtn.innerHTML;
            saveBtn.disabled = true;
            saveBtn.textContent = 'Saving…';

            // CKEditor keeps its own copy of the text; push it back into the <textarea> before FormData reads it
            if (window.CKEDITOR) {
                Object.values(CKEDITOR.instances).forEach(inst => inst.updateElement());
            }

            try {
                const res = await fetch(form.action, {
                    method: 'POST', // @method('PUT') is already inside the FormData
                    body: new FormData(form),
                    headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
                });
                const data = await res.json().catch(() => ({}));

                if (res.ok && data.redirect) { window.location.href = data.redirect; return; }
                if (res.status === 422) { showErrors(data.errors || {}); return; }

                showBanner(res.status === 413
                    ? 'The upload is too large. Nothing was saved. Please use smaller images.'
                    : (data.message || 'Something went wrong. Nothing was saved, and your entries are still on this page.'));
            } catch (err) {
                showBanner('Network error. Nothing was saved, and your entries are still on this page.');
            } finally {
                saveBtn.disabled = false;
                saveBtn.innerHTML = original;
            }
        });
    })();
</script>