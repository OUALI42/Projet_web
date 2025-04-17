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
                                                <span class="sort-label">Email</span>
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
                                            <td>{{ $student->email }}</td>
                                        <td>{{ \Carbon\Carbon::parse($student->birth_date)->format('d/m/Y') }}</td>
                                            <td>
                                                <div class="flex flex-col items-start space-y-2">
                                                    <a class="hover:text-primary cursor-pointer" href="#" data-modal-toggle="#student-modal">
                                                        <button class="btn btn-xs btn-primary w-20">
                                                            Modifier
                                                        </button>
                                                    </a>
                                                    <a href="#" class="open-delete-modal hover:text-primary cursor-pointer"
                                                       data-id="{{ $student->id }}"
                                                       data-action="{{ route('student.delete', $student->id) }}"
                                                       data-modal-toggle="#Alert-modal">
                                                        <button class="btn btn-xs btn-danger w-20">
                                                            Supprimer
                                                        </button>
                                                    </a>
                                                </div>
                                            </td>
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
                    <form id="student-form"  data-save-route="{{ route('student.save') }}" data-sendmail-route="{{ route('sendmail') }}">
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


@include('pages.students.Alert-modal', ['student' => $student])
@include('pages.students.student-modal')

