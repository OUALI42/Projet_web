
// This Script take the information of form for add in to the list of cohort
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('cohort-form');
    const saveCohortRoute = form.dataset.cohortRoute;
    const messageDiv = document.getElementById('form-message');

    form.addEventListener('submit', async function (e) {
        e.preventDefault();

        messageDiv.innerHTML = '';
        messageDiv.className = 'text-sm mt-2';

        const formData = new FormData(form);

        try {
            const saveResponse = await fetch(saveCohortRoute, {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json',
                },
                body: formData
            });

            const result = await saveResponse.json();

            if (!saveResponse.ok) {
                let errorHtml = '';
                for (let field in result.errors) {
                    errorHtml += `<p class="text-red-500">${result.errors[field][0]}</p>`;
                }
                messageDiv.innerHTML = errorHtml;
                return;
            }

            messageDiv.innerHTML = `<p class="text-green-600">${result.message}</p>`;
            form.reset();

            // Update the table dynamically
            const tbody = document.querySelector('table[data-datatable-table="true"] tbody');
            const newRow = document.createElement('tr');

            const startDate = new Date(formData.get('start_date'));
            const endDate = new Date(formData.get('end_date'));
            const yearRange = `${startDate.getFullYear()}-${endDate.getFullYear()}`;

            newRow.innerHTML = `
                <td>
                    <div class="flex flex-col gap-2">
                        <a class="leading-none font-medium text-sm text-gray-900 hover:text-primary" href="#">
                            ${formData.get('name')}
                        </a>
                        <span class="text-2sm text-gray-700 font-normal leading-3">
                            ${formData.get('description')}
                        </span>
                    </div>
                </td>
                <td>${yearRange}</td>
                <td>${formData.get('number_of_students')}</td>
                <td>
                    <div class="flex items-center justify-between">
                        <a class="hover:text-primary cursor-pointer" href="#" data-modal-toggle="#editCohorts-modal">
                            <button class="btn btn-xs btn-primary">Modifier</button>
                        </a>
                        <a class="hover:text-primary cursor-pointer" href="#" data-modal-toggle="#Alert-modal">
                            <button class="btn btn-xs btn-danger">Supprimer</button>
                        </a>
                    </div>
                </td>
            `;

            tbody.appendChild(newRow);

        } catch (error) {
            messageDiv.innerHTML = `<p class="text-red-500">Une erreur est survenue. Veuillez réessayer.</p>`;
            console.error(error);
        }
    });
});
