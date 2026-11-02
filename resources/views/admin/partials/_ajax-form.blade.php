<script>
    (function () {
        const form = document.getElementById(@json($formId));
        const tabsSel = '#' + @json($tabsId) + ' .cat-tab';
        const alertBox = document.getElementById('form-alert');
        const saveBtn = document.getElementById('save-btn');
        if (!form || !alertBox || !saveBtn) return;

        function activateTab(name) {
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

        // Laravel "duropt_labels.0" -> input name "duropt_labels[0]"; falls back to "amenity_ids[]" style names
        function fieldFor(key) {
            const parts = key.split('.');
            const name = parts[0] + parts.slice(1).map(p => '[' + p + ']').join('');
            return form.querySelector('[name="' + CSS.escape(name) + '"]')
                || form.querySelector('[name="' + CSS.escape(parts[0] + '[]') + '"]');
        }

        // Select2 hides the real <select>; use its visible container for styling and message placement
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

            Object.entries(perTab).forEach(([tab, count]) => {
                const btn = form.querySelector('.cat-tab[data-tab="' + tab + '"]');
                if (!btn) return;
                const badge = document.createElement('span');
                badge.className = 'tab-badge';
                badge.textContent = count;
                btn.appendChild(badge);
            });

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