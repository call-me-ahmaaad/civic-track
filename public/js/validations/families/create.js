const form = document.getElementById("createForm");

const familyCardNumber = document.getElementById("familyCardNumber");
const familyCardNumberStatus = document.getElementById("familyCardNumber-status");
const address = document.getElementById("address");
const addressStatus = document.getElementById("address-status");
const neighborhoodUnit = document.getElementById("neighborhoodUnit");
const neighborhoodUnitStatus = document.getElementById("neighborhoodUnit-status");
const communityUnit = document.getElementById("communityUnit");
const communityUnitStatus = document.getElementById("communityUnit-status");

[familyCardNumber, address, neighborhoodUnit, communityUnit].forEach(field => {
    field.addEventListener('input', () => {
        document.getElementById(`${field.id}-status`).textContent = '';
    });
});

form.addEventListener('submit', function (e) {
    e.preventDefault();

    let isValid = true;

    if (familyCardNumber.value.trim() === '') {
        familyCardNumberStatus.textContent = 'Family Card Number cannot be empty';
        isValid = false;
    } else if (!/^\d{16}$/.test(familyCardNumber.value.trim())) {
        familyCardNumberStatus.textContent = 'Family Card Number must consist of 16 digits';
        isValid = false;
    }

    if (address.value.trim() === '') {
        addressStatus.textContent = 'Address cannot be empty';
        isValid = false;
    }

    if (neighborhoodUnit.value.trim() === '') {
        neighborhoodUnitStatus.textContent = 'Neighborhood Unit cannot be empty';
        isValid = false;
    } else if (!/^\d{3,10}$/.test(neighborhoodUnit.value.trim())) {
        neighborhoodUnitStatus.textContent = 'Neighborhood Unit must consist of 3 to 10 digits';
        isValid = false;
    }

    if (communityUnit.value.trim() === '') {
        communityUnitStatus.textContent = 'Community Unit cannot be empty';
        isValid = false;
    } else if (!/^\d{3,10}$/.test(communityUnit.value.trim())) {
        communityUnitStatus.textContent = 'Community Unit must consist of 3 to 10 digits';
        isValid = false;
    }

    if (isValid) {
        Swal.fire({
            icon: 'question',
            title: 'Create New Family Record?',
            text: 'Please review the information carefully before creating this family record.',
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
                    text: "The family record was not created.",
                    icon: "info",
                    timer: 5000,
                    timerProgressBar: true,
                    showConfirmButton: false
                });
            }
        });
    }
});