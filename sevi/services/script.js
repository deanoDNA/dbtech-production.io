document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('service-modal');
    const closeBtn = document.querySelector('.close-btn');
    const requestButtons = document.querySelectorAll('.request-service-btn');
    const serviceForm = document.getElementById('service-request-form');
    const serviceNameElement = document.getElementById('modal-service-name');
    const serviceIdInput = document.getElementById('service_id');

    requestButtons.forEach(button => {
        button.addEventListener('click', function() {
            const serviceCard = this.closest('.service-card');
            const serviceName = serviceCard.getAttribute('data-service-name');
            const serviceId = serviceCard.getAttribute('data-service-id');

            serviceNameElement.textContent = `Request Service: ${serviceName}`;
            serviceIdInput.value = serviceId;

            modal.style.display = 'block';
        });
    });

    closeBtn.onclick = () => {
        modal.style.display = 'none';
    };

    window.onclick = (event) => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    };
});
