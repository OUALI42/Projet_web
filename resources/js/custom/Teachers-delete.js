
// This script delete teacher in the teacher list and Data-base
document.addEventListener('DOMContentLoaded', () => {
    const deleteForm = document.getElementById('deleteTeacherForm');
    const deleteButtons = document.querySelectorAll('.open-delete-modal');

    deleteButtons.forEach(button => {
        button.addEventListener('click', () => {
            const TeacherId = button.dataset.id;
            const action = button.dataset.action;

            // Updates the delete form
            deleteForm.action = action;
            deleteForm.querySelector('input[name="TeacherId"]').value = TeacherId;

        });
    });
});
