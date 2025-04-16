document.addEventListener('DOMContentLoaded', () => {
    const deleteForm = document.getElementById('deleteUserForm');
    const deleteButtons = document.querySelectorAll('.open-delete-modal');

    deleteButtons.forEach(button => {
        button.addEventListener('click', () => {
            const studentId = button.dataset.id;
            const action = button.dataset.action;

            // Met à jour le formulaire de suppression
            deleteForm.action = action;
            deleteForm.querySelector('input[name="studentId"]').value = studentId;
        });
    });
});
