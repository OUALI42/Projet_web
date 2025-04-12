<x-app-layout>
    <x-slot name="header">
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">
                {{ __('Dashboard') }}
            </span>
        </h1>
    </x-slot>

    <!-- begin: grid -->
    <div class="card min-w-full">
        <div class="card-header">
            <h3 class="card-title">
                ORGANISATION
            </h3>
        </div>
        <div class="card-table">
            <table class="table align-middle text-gray-700 font-medium text-sm">
                <thead>
                <tr>
                    <th>
                        <button class="btn btn-clear btn-primary">
                            Promotions
                        </button>
                    </th>
                    <th>
                        <button class="btn btn-clear btn-success">
                            Groupes
                        </button>
                    </th>
                    <th>
                        <button class="btn btn-clear btn-light">
                            Enseignants
                        </button>
                    </th>
                    <th>
                        Etudiants
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        {{ $promotionsCount }}
                    </td>
                    <td>
                        5
                    </td>
                    <td>
                        {{ $teachersCount }}
                    </td>
                    <td>
                        {{ $studentsCount }}
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="{{url('/cohorts')}}">
                            <button class="btn btn-primary">
                                <i class="ki-outline ki-plus-squared"></i>
                                Promotions
                            </button>
                        </a>
                    </td>
                    <td>
                        <a href="{{url('/groups')}}">
                            <button class="btn btn-success">
                                <i class="ki-outline ki-plus-squared"></i>
                                Groupes
                            </button>
                        </a>
                    </td>
                    <td>
                        <a href="{{url('/teachers')}}">
                            <button class="btn btn-dark">
                                <i class="ki-outline ki-plus-squared"></i>
                                Enseignants
                            </button>
                        </a>
                    </td>
                    <td>
                        <a href="{{url('/students')}}">
                            <button class="btn btn-light">
                                <i class="ki-outline ki-plus-squared"></i>
                                Etudiants
                            </button>
                        </a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- end: grid -->
</x-app-layout>
