<x-app-layout>
    <x-slot name="header">
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">
                {{ __('Promotions') }}
            </span>
        </h1>
    </x-slot>

    <!-- begin: grid -->
    <div class="grid lg:grid-cols-3 gap-5 lg:gap-7.5 items-stretch">
        <div class="lg:col-span-2">
            <div class="grid">
                <div class="card card-grid h-full min-w-full">
                    <div class="card-header">
                        <h3 class="card-title">Mes promotions</h3>
                    </div>
                    <div class="card-body">
                        <div data-datatable="true" data-datatable-page-size="5">
                            <div class="scrollable-x-auto">
                                <table class="table table-border" data-datatable-table="true">
                                    <thead>
                                    <tr>
                                        <th class="min-w-[280px]">
                                            <span class="sort asc">
                                                 <span class="sort-label">Promotion</span>
                                                 <span class="sort-icon"></span>
                                            </span>
                                        </th>
                                        <th class="min-w-[135px]">
                                            <span class="sort">
                                                <span class="sort-label">Année</span>
                                                <span class="sort-icon"></span>
                                            </span>
                                        </th>
                                        <th class="min-w-[135px]">
                                            <span class="sort">
                                                <span class="sort-label">Etudiants</span>
                                                <span class="sort-icon"></span>
                                            </span>
                                        </th>
                                        <th class="min-w-[135px]">
                                            <span class="sort">
                                                <span class="sort-label">Action</span>
                                                <span class="sort-icon"></span>
                                            </span>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($cohorts as $cohort)
                                        <tr>
                                            <td>
                                                <div class="flex flex-col gap-2">
                                                    <a class="leading-none font-medium text-sm text-gray-900 hover:text-primary"
                                                       href="{{ route('cohort.show', $cohort->id) }}">
                                                        {{ $cohort->name }}
                                                    </a>
                                                    <span class="text-2sm text-gray-700 font-normal leading-3">{{ $cohort->description }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($cohort->start_date)->format('Y') }} -
                                                {{ \Carbon\Carbon::parse($cohort->end_date)->format('Y') }}
                                            </td>
                                            <td>{{ $cohort->number_of_students ?? 0 }}</td>
                                            <td>
                                                <div class="flex items-center justify-between">
                                                    <a class="hover:text-primary cursor-pointer" href="#" data-modal-toggle="#editCohorts-modal">
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
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center text-gray-500 py-4">Aucune promotion trouvée.</td>
                                        </tr>
                                    @endforelse
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
                        Ajouter une promotion
                    </h3>
                </div>
                <form id="cohort-form">
                    @csrf
                    <div class="card-body flex flex-col gap-5">
                        <x-forms.input name="name" :label="__('Nom')" />
                        <x-forms.input name="description" :label="__('Localisation')" />
                        <x-forms.input name="number_of_students" :label="__('Nombre d étudiant')" />
                        <x-forms.input type="date" name="start_date" :label="__('Début de l\'année')" />
                        <x-forms.input type="date" name="end_date" :label="__('Fin de l\'année')" />
                        <div id="form-message"></div>
                        <x-forms.primary-button>
                            {{ __('Valider') }}
                        </x-forms.primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end: grid -->
</x-app-layout>

<!-- This Script take the information of form for add in to the list of cohort -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('cohort-form');
        const messageDiv = document.getElementById('form-message');

        form.addEventListener('submit', async function (e) {
            e.preventDefault();

            messageDiv.innerHTML = '';
            messageDiv.className = 'text-sm mt-2';

            const formData = new FormData(form);

            try {
                const saveResponse = await fetch("{{ route('cohort.Add_Cohort') }}", {
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

                // Dynamically updates the promotions table
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
                            Cergy
                        </span>
                    </div>
                </td>
                <td>${yearRange}</td>
                <td>${formData.get('number_of_students')}</td>
                <td>
                <div class="flex items-center justify-between">
                    <a class="hover:text-primary cursor-pointer" href="#" data-modal-toggle="#editCohorts-modal">
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
            `;

                tbody.appendChild(newRow);

            } catch (error) {
                messageDiv.innerHTML = `<p class="text-red-500">Une erreur est survenue. Veuillez réessayer.</p>`;
            }
        });
    });
</script>
@include('pages.cohorts.editCohorts-modal')
