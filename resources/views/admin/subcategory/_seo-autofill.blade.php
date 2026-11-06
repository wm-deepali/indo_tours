{{-- resources/views/admin/subcategory/_seo-autofill.blade.php --}}
<script>
(function () {
    const IS_EDIT = @json($isEdit ?? false);
    const SITE    = @json(config('app.name'));
    const BASE    = @json(url('/'));
    const SUFFIX  = ' Tour Packages';   // change/remove if you don't want this in the meta title

    const g   = id => document.getElementById(id);
    const val = id => ((g(id) && g(id).value) || '').trim();

    const clip = (s, n) => {
        s = (s || '').replace(/\s+/g, ' ').trim();
        return s.length <= n ? s : s.slice(0, n - 1).replace(/\s+\S*$/, '') + '…';
    };
    const slugify = s => s.toLowerCase().trim()
        .replace(/[^a-z0-9\s-]/g, '').replace(/\s+/g, '-').replace(/-+/g, '-');

    // Each SEO field -> function returning its auto value (order matters: later ones follow earlier ones)
    const rules = {
        h1: () => val('name'),
        meta_title: () => {
            const n = val('name');
            return n ? clip(n + SUFFIX + (SITE ? ' | ' + SITE : ''), 60) : '';
        },
        meta_description: () => {
            const n = val('name');
            const src = val('intro_text') || val('heading_intro');
            if (src) return clip(src, 160);
            if (!n) return '';
            return clip(`Explore ${n} tour packages. Compare itineraries, hotels, inclusions and best prices, and book online.`, 160);
        },
        og_title: () => val('meta_title'),
        og_description: () => val('meta_description'),
        canonical_url: () => {
            const slug = IS_EDIT ? val('slug') : slugify(val('name'));
            return slug ? BASE + '/' + slug : '';
        },
        robots: () => 'index, follow',
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
            manual[id] = el.value.trim() !== '';   // cleared -> goes back to auto
            refresh();
        });
    });

    ['name', 'intro_text', 'heading_intro'].forEach(id => {
        const el = g(id);
        if (el) el.addEventListener('input', refresh);
    });
})();
</script>