const form = document.getElementById("deleteForm")

form.addEventListener('submit', function (e) {
    e.preventDefault();

    Swal.fire({
        icon: 'warning',
        title: 'Delete Resident Record?',
        text: 'This action will permanently delete the resident record and cannot be undone.',
        showCancelButton: true,
        confirmButtonColor: '#E53E3E',
        cancelButtonColor: '#9CA3AF',
        confirmButtonText: 'Delete Record',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        } else {
            Swal.fire({
                title: "Deletion Cancelled",
                text: "The resident record was not deleted.",
                icon: "info",
                timer: 5000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        }
    });
});