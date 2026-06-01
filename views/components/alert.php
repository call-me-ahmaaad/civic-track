<?php if (isset($_SESSION['alert'])): ?>
    <script id="alert-data" type="application/json">
        <?= json_encode($_SESSION['alert']) ?>
    </script>
<?php endif; ?>

<?php unset($_SESSION['alert']); ?>