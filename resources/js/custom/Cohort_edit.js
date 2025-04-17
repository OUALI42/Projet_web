
// This scritp get the information for update Cohorts in to the list of Cohorts
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('updateCohortsForm');

    const responseMessage = document.getElementById('responseMessage');

    form.addEventListener('submit', async function(event) {
        event.preventDefault();

        const editRoute = form.dataset.editRoute;
        responseMessage.classList.add('hidden');
        responseMessage.innerHTML = '';

        const formData = new FormData(form);
        const cohortId = form.querySelector('input[name="id"]').value;

        try {
            const response = await fetch(editRoute, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                },
            });

            const data = await response.json();

            if (!response.ok) {
                if (data.errors) {
                    const errorMessages = Object.values(data.errors).flat().join('<br>');
                    throw new Error(errorMessages);
                } else {
                    throw new Error(data.message || 'Erreur inconnue');
                }
            }

            responseMessage.classList.remove('hidden');
            responseMessage.innerHTML = `<p class="text-green-600">${data.message}</p>`;


            setTimeout(() => { location.reload(); }, 2000);

        } catch (error) {
            responseMessage.classList.remove('hidden');
            responseMessage.innerHTML = `<p class="text-red-600">${error.message}</p>`;
            console.error('Erreur AJAX :', error);
        }
    });
});


// this script get the information of the line in the board
document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll('.open-edit-modal');
    const form = document.getElementById('updateCohortsForm');

    buttons.forEach(button => {
        button.addEventListener('click', () => {
            // Fill in the form with button data
            form.querySelector('input[name="id"]').value = button.dataset.id;
            form.querySelector('input[name="name"]').value = button.dataset.name;
            form.querySelector('input[name="description"]').value = button.dataset.description;
            form.querySelector('input[name="number_of_students"]').value = button.dataset.number;
            form.querySelector('input[name="start_date"]').value = button.dataset.start;
            form.querySelector('input[name="end_date"]').value = button.dataset.end;

            // Dynamically update the editRoute attribute of the form
            form.dataset.editRoute = button.dataset.editRoute;
        });
    });
});
