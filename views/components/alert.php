<script>
    <?php if (isset($_SESSION['success'])): ?>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: "<?= $_SESSION['success'] ?>",
            timer: 5000,
            timerProgressBar: true,
            showConfirmButton: false
        })

        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: "<?= $_SESSION['error'] ?>",
            timer: 5000,
            timerProgressBar: true,
            showConfirmButton: false
        })

        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
</script>