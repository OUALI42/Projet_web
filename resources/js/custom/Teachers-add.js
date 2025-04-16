
// This script get the information of the teacher and get email for send email to the teacher
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('teacher-form');
    const saveRoute = form.dataset.saveRoute;
    const sendMailRoute = form.dataset.sendmailRoute;
    const messageDiv = document.getElementById('form-message');

    form.addEventListener('submit', async function (e) {
        e.preventDefault();

        messageDiv.innerHTML = '';
        messageDiv.className = 'text-sm mt-2';

        // information variable
        const formData = new FormData(form);
        const firstName = formData.get('first_name');
        const lastName = formData.get('last_name');
        const name = `${firstName} ${lastName}`;

        const email = formData.get('email');

        // Route consultation for the method
        try {
            const saveResponse = await fetch(saveRoute, {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json',
                },
                body: formData
            });

            if (!saveResponse.ok) {
                const errorData = await saveResponse.json();
                let errorHtml = '';
                for (let field in errorData.errors) {
                    errorHtml += `<p class="text-red-500">${errorData.errors[field][0]}</p>`;
                }
                messageDiv.innerHTML = errorHtml;
                return;
            }

            // If the registration is successful, we send the email
            const mailRoute = "{{ route('sendmail', ['name' => ':name', 'email' => ':email']) }}"
                .replace(':name', encodeURIComponent(name))
                .replace(':email', encodeURIComponent(email));

            const mailResponse = await fetch(sendMailRoute, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ name, email })
            });

            if (!mailResponse.ok) {
                messageDiv.innerHTML = `<p class="text-yellow-500">Ensaignant enregistré, mais l'email n'a pas pu être envoyé.</p>`;
                return;
            }

            const result = await saveResponse.json(); // Reutilisation possible
            messageDiv.innerHTML = `<p class="text-green-600">${result.message} Un email a été envoyé à l'utilisateur.</p>`;
            form.reset();

            // Reset the table with new student
            const tbody = document.querySelector('table[data-datatable-table="true"] tbody');
            const newRow = document.createElement('tr');

            newRow.innerHTML = `
                <td>${lastName}</td>
                <td>${firstName}</td>
                <td>${email}</td>
                <td>
                    <div class="flex flex-col items-start space-y-2">
                        <a class="hover:text-primary cursor-pointer" href="#" data-modal-toggle="#student-modal">
                            <button class="btn btn-xs btn-primary w-20">
                                Modifier
                            </button>
                        </a>
                        <a class="hover:text-primary cursor-pointer" href="#" data-modal-toggle="#Alert-modal">
                            <button class="btn btn-xs btn-danger w-20">
                                Supprimer
                            </button>
                        </a>
                    </div>
                </td>
            `;

            tbody.appendChild(newRow);
        } catch (error) {
            messageDiv.innerHTML = `<p class="text-red-500">Erreur inattendue. Veuillez réessayer.</p>`;
        }
    });
});
