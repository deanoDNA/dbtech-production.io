function showPopup(message) {
    const popup = document.getElementById('popup');
    const popupMessage = document.getElementById('popup-message');
    popupMessage.textContent = message;
    popup.classList.add('show');
    setTimeout(function() {
        popup.classList.remove('show');
    }, 3000); // Hide popup after 3 seconds
}

document.addEventListener('DOMContentLoaded', (event) => {
    const message = document.getElementById('popup-message').dataset.message;
    if (message) {
        showPopup(message);
    }
});
