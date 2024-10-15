document.addEventListener("DOMContentLoaded", function(event) {
    const deleteButtons = document.querySelectorAll('[id^="deleteButton"]');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const modalId = button.getAttribute('data-modal-target');
            document.getElementById(modalId).classList.remove('hidden'); // Show the modal
        });
    });
});
