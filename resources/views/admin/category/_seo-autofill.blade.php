{{-- resources/views/admin/category/_seo-autofill.blade.php --}}
<script>
(function () {
    const IS_EDIT = @json($isEdit ?? false);
    const SITE    = @json(config('app.name'));
    const BASE    = @json(url('/category'));   // change to your category URL prefix

    const g   = id => document.getElementById(id);
    const val = id => ((g(id) && g(id).value) || '').trim();

    const editor = () => (window.CKEDITOR && CKEDITOR.instances.detail_content) || null;
    const plain = html => {
        const t = document.createElement('div');
        t.innerHTML = html || '';
        return (t.textContent || '').replace(/\s+/g, ' ').trim();
    };
    const clip = (s, n) => {
        s = (s || '').replace(/\s+/g, ' ').trim();
        return s.length <= n ? s : s.slice(0, n - 1).replace(/\s+\S*$/, '') + '…';
    };
    const slugify = s => s.toLowerCase().trim()
        .replace(/[^a-z0-9\s-]/g, '').replace(/\s+/g, '-').replace(/-+/g, '-');
    const detail = () => plain(editor() ? editor().getData() : val('detail_content'));

    // Each SEO field -> function returning its auto value (order matters: later ones follow earlier ones)
    const rules = {
        h1: () => val('name'),
        meta_title: () => {
            const n = val('name');
            return n ? clip(SITE ? n + ' | ' + SITE : n, 60) : '';
        },
        meta_description: () => {
            const n = val('name');
            const src = plain(val('short_description')) || plain(val('listing_intro')) || detail();
            if (src) return clip(src, 160);
            return n ? clip(`Explore ${n} tour packages. Compare itineraries, hotels, inclusions and best prices, and book online.`, 160) : '';
        },
        og_title: () => val('meta_title'),
        og_description: () => val('meta_description'),
        canonical_url: () => {
            const slug = IS_EDIT ? val('slug') : slugify(val('name'));
            return slug ? BASE + '/' + slug : '';
        },
        twitter_title: () => val('og_title'),
        twitter_description: () => val('og_description'),
    };
    const order  = Object.keys(rules);
    const manual = {};

    function refresh() {
        if (!IS_EDIT) g('slug').value = slugify(val('name'));
        order.forEach(id => {
            if (manual[id]) return;
            const el = g(id);
            if (el) el.value = rules[id]();
        });
    }

    // Init: empty -> fill. Non-empty and different from auto value -> user's own text, keep it.
    if (!IS_EDIT) g('slug').value = slugify(val('name'));
    order.forEach(id => {
        const el = g(id);
        if (!el) return;
        const auto = rules[id]();
        if (!el.value.trim()) { el.value = auto; manual[id] = false; }
        else { manual[id] = el.value.trim() !== auto; }

        el.addEventListener('input', () => {
            manual[id] = el.value.trim() !== '';   // cleared -> back to auto
            refresh();
        });
    });

    ['name', 'short_description', 'listing_intro'].forEach(id => {
        const el = g(id);
        if (el) el.addEventListener('input', refresh);
    });
    if (editor()) editor().on('change', refresh);

    // CKEditor content must be synced before the AJAX form reads values
    g('name').closest('form').addEventListener('submit', function () {
        if (window.CKEDITOR) Object.keys(CKEDITOR.instances).forEach(k => CKEDITOR.instances[k].updateElement());
        refresh();
    }, true);
})();
</script>