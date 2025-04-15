
// This scritp get the information for update Cohorts in to the list of Cohorts
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('updateCohortsForm');
    const editRoute = form.dataset.editRoute;
    const responseMessage = document.getElementById('responseMessage');

    form.addEventListener('submit', async function(event) {
        event.preventDefault();

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

            // Afficher un message de succès
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

