<script>
    window.__slotbuddy_vars = <?= json_encode(script_vars()) ?>;

    window.vars = function (key) {
        if (!key) {
            return window.__slotbuddy_vars;
        }

        return window.__slotbuddy_vars[key] ?? null;
    };
</script>
