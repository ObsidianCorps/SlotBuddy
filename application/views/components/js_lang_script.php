<script>
    window.__slotbuddy_lang = <?= json_encode(html_vars('language')) ?>;

    window.lang = function (key) {
        if (!key) {
            return window.__slotbuddy_lang;
        }

        if (!window.__slotbuddy_lang[key]) {
            console.error(`Cannot find translation for requested key: "${key}"`);
            return key;
        }

        return window.__slotbuddy_lang[key];
    };
</script>
