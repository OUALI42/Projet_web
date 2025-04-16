
// This script delete cohort in the cohort list and Data-base
document.addEventListener('DOMContentLoaded', () => {
    const deleteForm = document.getElementById('deleteCohortForm');
    const deleteButtons = document.querySelectorAll('.open-delete-modal');

    deleteButtons.forEach(button => {
        button.addEventListener('click', () => {
            const cohortId = button.dataset.id;
            const action = button.dataset.action;

            // Updates the delete form
            deleteForm.action = action;
            deleteForm.querySelector('input[name="cohortId"]').value = cohortId;
        });
    });
});
