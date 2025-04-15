<x-app-layout>
    <x-slot name="header">
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">
                {{ __('Etudiants') }}
            </span>
        </h1>
    </x-slot>

    <!-- begin: grid -->
    <div class="grid lg:grid-cols-3 gap-5 lg:gap-7.5 items-stretch">
        <div class="lg:col-span-2">
            <div class="grid">
                <div class="card card-grid h-full min-w-full">
                    <div class="card-header">
                        <h3 class="card-title">Liste des étudiants</h3>
                        <div class="input input-sm max-w-48">
                            <i class="ki-filled ki-magnifier"></i>
                            <input placeholder="Rechercher un étudiant" type="text"/>
                        </div>
                    </div>
                    <div class="card-body">
                        <div data-datatable="true" data-datatable-page-size="5">
                            <div class="scrollable-x-auto">
                                <table class="table table-border" data-datatable-table="true">
                                    <thead>
                                    <tr>
                                        <th class="min-w-[135px]">
                                            <span class="sort asc">
                                                 <span class="sort-label">Nom</span>
                                                 <span class="sort-icon"></span>
                                            </span>
                                        </th>
                                        <th class="min-w-[135px]">
                                            <span class="sort">
                                                <span class="sort-label">Prénom</span>
                                                <span class="sort-icon"></span>
                                            </span>
                                        </th>
                                        <th class="min-w-[135px]">
                                            <span class="sort">
                                                <span class="sort-label">Date de naissance</span>
                                                <span class="sort-icon"></span>
                                            </span>
                                        </th>
                                        <th class="w-[70px]"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($students as $student)
                                        @if ($User_schools && $User_schools->contains ('user_id',$student->id))
                                        <tr>
                                            <td>{{ $student->last_name }}</td>
                                            <td>{{ $student->first_name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($student->birth_date)->format('d/m/Y') }}</td>
                                            <td>
                                                <div class="flex items-center justify-between">
                                                    <a class="hover:text-primary cursor-pointer" href="#" data-modal-toggle="#student-modal">
                                                        <button class="btn btn-xs btn-primary">
                                                            Modifier
                                                        </button>
                                                    </a>
                                                    <a class="hover:text-primary cursor-pointer" href="#" data-modal-toggle="#Alert-modal">
                                                        <button class="btn btn-xs btn-danger">
                                                            Supprimer
                                                        </button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer justify-center md:justify-between flex-col md:flex-row gap-5 text-gray-600 text-2sm font-medium">
                                <div class="flex items-center gap-2 order-2 md:order-1">
                                    Show
                                    <select class="select select-sm w-16" data-datatable-size="true" name="perpage"></select>
                                    per page
                                </div>
                                <div class="flex items-center gap-4 order-1 md:order-2">
                                    <span data-datatable-info="true"></span>
                                    <div class="pagination" data-datatable-pagination="true"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="lg:col-span-1">
            <div class="card h-full">
                <div class="card-header">
                    <h3 class="card-title">
                        Ajouter un étudiant
                    </h3>
                </div>
                <div class="card-body flex flex-col gap-5">
                    <form id="student-form">
                        @csrf

                        <x-forms.input name="last_name"  :label="__('Nom')" />
                        <x-forms.input name="first_name"  id="nom" :label="__('Prénom')" />
                        <x-forms.input type="email" name="email" id="email" :label="__('Email')" />
                        <x-forms.input type="date" name="birth_date" :label="__('Date de naissance')" />

                        <x-forms.primary-button>
                            {{ __('Valider') }}
                        </x-forms.primary-button>
                    </form>
                    <div id="form-message" class="text-sm mt-2"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- end: grid -->
</x-app-layout>



{{-- This scritp get the information for add student in to the list of student and get email for send email   --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('student-form');
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
                const saveResponse = await fetch("{{ route('student.save') }}", {
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

                const mailResponse = await fetch("{{ route('sendmail') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ name, email })
                });

                if (!mailResponse.ok) {
                    messageDiv.innerHTML = `<p class="text-yellow-500">Étudiant enregistré, mais l'email n'a pas pu être envoyé.</p>`;
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
                <td>${new Date(formData.get('birth_date')).toLocaleDateString('fr-FR')}</td>
                <td>
                    <div class="flex items-center justify-between">
                        <a class="hover:text-primary cursor-pointer" href="#" data-modal-toggle="#student-modal">
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
                messageDiv.innerHTML = `<p class="text-red-500">Erreur inattendue. Veuillez réessayer.</p>`;
            }
        });
    });
</script>

@include('pages.students.Alert-modal', ['student' => $student])
@include('pages.students.student-modal')

