const form = document.getElementById("deleteForm")

form.addEventListener('submit', function (e) {
    e.preventDefault();

    Swal.fire({
        icon: 'warning',
        title: 'Delete Family Record?',
        html: `
                <strong>This action cannot be undone.</strong>
                <p>Family records with associated residents cannot be deleted. Please remove all related resident records before proceeding.</p>
            `,
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
                text: "The family record was not deleted.",
                icon: "info",
                timer: 5000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        }
    });
});