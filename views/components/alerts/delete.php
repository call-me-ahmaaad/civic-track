<script>
    document.querySelector(".form__button--delete").addEventListener('click', function (e) {
        e.preventDefault();

        Swal.fire({
            icon: 'warning',
            title: 'Are you sure?',
            text: 'This action cannot be undone!',
            showCancelButton: true,
            confirmButtonColor: '#E53E3E',
            cancelButtonColor: '#4A90D9',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteForm').submit();
            } else if (result.dismiss) {
                Swal.fire({
                    title: "Cancelled",
                    text: "Data deletion cancelled",
                    icon: "error",
                    timer: 5000,
                    timerProgressBar: true,
                    showConfirmButton: false
                });
            }
        });
    });
</script>