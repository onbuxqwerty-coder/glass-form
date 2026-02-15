document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contactForm');
    const formMessage = document.getElementById('formMessage');

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(form);

        fetch('save_message.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            formMessage.textContent = data.message;
            if (data.success) {
                formMessage.className = 'form-message success';
                form.reset();
            } else {
                formMessage.className = 'form-message error';
            }
        })
        .catch(error => {
            formMessage.textContent = 'Connection error. Please try again.';
            formMessage.className = 'form-message error';
        });
    });
});
