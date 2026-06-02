const form = document.getElementById("createForm");

const identityNumber = document.getElementById("identityNumber");
const identityNumberStatus = document.getElementById("identityNumber-status");
const familyCardNumber = document.getElementById("familyCardNumber");
const familyCardNumberStatus = document.getElementById("familyCardNumber-status");
const fullname = document.getElementById("fullname");
const fullnameStatus = document.getElementById("fullname-status");

[identityNumber, familyCardNumber, fullname].forEach(field => {
    field.addEventListener('input', () => {
        document.getElementById(`${field.id}-status`).textContent = '';
    });
});

form.addEventListener('submit', function (e) {
    e.preventDefault();

    let isValid = true;

    if (identityNumber.value.trim() === '') {
        identityNumberStatus.textContent = 'Identity Number cannot be empty';
        isValid = false;
    } else if (!/^\d{16}$/.test(identityNumber.value.trim())) {
        identityNumberStatus.textContent = 'Identity Number must consist of 16 digits';
        isValid = false;
    }

    if (familyCardNumber.value.trim() === '') {
        familyCardNumberStatus.textContent = 'Family Card Number cannot be empty';
        isValid = false;
    } else if (!/^\d{16}$/.test(familyCardNumber.value.trim())) {
        familyCardNumberStatus.textContent = 'Family Card Number must consist of 16 digits';
        isValid = false;
    }

    if (fullname.value.trim() === '') {
        fullnameStatus.textContent = 'Fullname cannot be empty';
        isValid = false;
    } else if (!/^[a-zA-Z\s'\-.]+$/.test(fullname.value.trim())) {
        fullnameStatus.textContent = 'Fullname must contain only letters';
        isValid = false;
    }

    if (isValid) {
        Swal.fire({
            icon: 'question',
            title: 'Create New Resident Record?',
            text: 'Please review the information carefully before creating this resident record.',
            showCancelButton: true,
            confirmButtonColor: '#5C73DF',
            cancelButtonColor: '#9CA3AF',
            confirmButtonText: 'Create Record',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            } else {
                Swal.fire({
                    title: "Creation Cancelled",
                    text: "The resident record was not created.",
                    icon: "info",
                    timer: 5000,
                    timerProgressBar: true,
                    showConfirmButton: false
                });
            }
        });
    }
});