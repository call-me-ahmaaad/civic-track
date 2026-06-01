const form = document.getElementById("editForm");

const familyCardNumber = document.getElementById("familyCardNumber");
const familyCardNumberStatus = document.getElementById("familyCardNumber-status");
const address = document.getElementById("address");
const addressStatus = document.getElementById("address-status");
const neighborhoodUnit = document.getElementById("neighborhoodUnit");
const neighborhoodUnitStatus = document.getElementById("neighborhoodUnit-status");
const communityUnit = document.getElementById("communityUnit");
const communityUnitStatus = document.getElementById("communityUnit-status");

const createBtn = document.getElementById("edit-btn");

createBtn.addEventListener('click', function (e) {
    e.preventDefault();

    let error = 0;

    familyCardNumberStatus.textContent = '';
    addressStatus.textContent = '';
    neighborhoodUnitStatus.textContent = '';
    communityUnitStatus.textContent = '';

    if (familyCardNumber.value.trim() === '') {
        familyCardNumberStatus.textContent = 'Family Card Number cannot be empty';
        error++;
    } else if (!/^\d{16}$/.test(familyCardNumber.value.trim())) {
        familyCardNumberStatus.textContent = 'Family Card Number must consist of 16 digits';
        error++;
    }

    if (address.value.trim() === '') {
        addressStatus.textContent = 'Address cannot be empty';
        error++;
    }

    if (neighborhoodUnit.value.trim() === '') {
        neighborhoodUnitStatus.textContent = 'Neighborhood Unit cannot be empty';
        error++;
    } else if (!/^\d{3,10}$/.test(neighborhoodUnit.value.trim())) {
        neighborhoodUnitStatus.textContent = 'Neighborhood Unit must consist of 3 to 10 digits';
        error++;
    }

    if (communityUnit.value.trim() === '') {
        communityUnitStatus.textContent = 'Community Unit cannot be empty';
        error++;
    } else if (!/^\d{3,10}$/.test(communityUnit.value.trim())) {
        communityUnitStatus.textContent = 'Community Unit must consist of 3 to 10 digits';
        error++;
    }

    if (error === 0) {
        Swal.fire({
            icon: 'question',
            title: 'Update Family Record?',
            text: 'Please review the changes carefully before updating this family record.',
            showCancelButton: true,
            confirmButtonColor: '#5C73DF',
            cancelButtonColor: '#9CA3AF',
            confirmButtonText: 'Update Record',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            } else if (result.dismiss) {
                Swal.fire({
                    title: "Update Cancelled",
                    text: "No changes have been saved.",
                    icon: "info",
                    timer: 5000,
                    timerProgressBar: true,
                    showConfirmButton: false
                });
            }
        });
    }
});