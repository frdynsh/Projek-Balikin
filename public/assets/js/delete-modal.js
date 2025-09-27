document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('deleteModal');
    const confirmButton = document.getElementById('confirmDeleteButton');
    const cancelButton = document.getElementById('cancelDeleteButton');
    const itemNamePlaceholder = document.getElementById('item-name-placeholder');
    let currentFormId = null;

    // Function to display the modal
    function openModal(itemId, itemName) {
        currentFormId = `delete-form-${itemId}`;
        itemNamePlaceholder.textContent = itemName;
        modal.classList.remove('hidden');
    }

    // Function to hide the modal
    function closeModal() {
        modal.classList.add('hidden');
        currentFormId = null;
    }

    // Listener for all "Hapus Permanen" buttons
    document.querySelectorAll('.open-delete-modal').forEach(button => {
        button.addEventListener('click', function() {
            const itemId = this.dataset.id;
            const itemName = this.dataset.nama;
            openModal(itemId, itemName);
        });
    });

    // Listener for the confirm button inside the modal
    confirmButton.addEventListener('click', function() {
        if (currentFormId) {
            const form = document.getElementById(currentFormId);
            if (form) {
                form.submit(); // Submit the hidden DELETE form
            }
        }
        closeModal();
    });

    // Listener for the cancel button
    cancelButton.addEventListener('click', closeModal);

    // Listener to close the modal when clicking the overlay
    modal.addEventListener('click', function(e) {
        if (e.target.id === 'deleteModal') {
            closeModal();
        }
    });

    // Listener for the Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeModal();
        }
    });
});
