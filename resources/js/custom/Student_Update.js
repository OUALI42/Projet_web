// This script updates student information in the student list
document.addEventListener('DOMContentLoaded', () => {
    const updateForm = document.getElementById('updateUserForm');
    const updateRoute = updateForm.dataset.updateRoute;
    const messageDiv = document.getElementById('responseMessage');

    updateForm.addEventListener('submit', async function (e) {
        e.preventDefault();

        messageDiv.innerHTML = '';
        messageDiv.className = 'text-sm mt-2 hidden';

        const formData = new FormData(updateForm);

        try {
            const updateResponse = await fetch(updateRoute, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: formData
            });

            const responseData = await updateResponse.json();

            if (!updateResponse.ok) {
                let errorHtml = '';
                if (responseData.errors) {
                    for (let field in responseData.errors) {
                        errorHtml += `<p class="text-red-500">${responseData.errors[field][0]}</p>`;
                    }
                } else {
                    errorHtml = `<p class="text-red-500">${responseData.message || 'Erreur inconnue.'}</p>`;
                }
                messageDiv.innerHTML = errorHtml;
                messageDiv.classList.remove('hidden');
                return;
            }

            messageDiv.innerHTML = `<p class="text-green-600">${responseData.message}</p>`;
            messageDiv.classList.remove('hidden');

            // Optional: refresh page or reload table data
            setTimeout(() => {
                location.reload();
            }, 2000);

        } catch (error) {
            messageDiv.innerHTML = `<p class="text-red-500">Erreur inattendue. Veuillez réessayer.</p>`;
            messageDiv.classList.remove('hidden');
            console.error('Erreur AJAX :', error);
        }
    });
});
