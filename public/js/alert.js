const alertElement = document.getElementById('alert-data');

if (alertElement) {
    const alert = JSON.parse(alertElement.textContent);

    Swal.fire({
        icon: alert.icon,
        title: alert.title,
        text: alert.text,
        timer: 5000,
        timerProgressBar: true,
        showConfirmButton: false
    });
}