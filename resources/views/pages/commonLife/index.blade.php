{{--<x-app-layout>--}}
{{--    <x-slot name="header">--}}
{{--        <h1 class="flex items-center gap-1 text-sm font-normal">--}}
{{--            <span class="text-gray-700">--}}
{{--                {{ __('Vie Commune') }}--}}
{{--            </span>--}}
{{--        </h1>--}}
{{--        <!--begin::Menu-->--}}
{{--        <div class="menu menu-default" data-menu="true">--}}
{{--            <div class="menu-item" data-menu-item-placement="bottom-end" data-menu-item-toggle="dropdown" data-menu-item-trigger="click">--}}
{{--                <!--begin::Menu toggle-->--}}
{{--                <button class="menu-toggle btn btn-primary">--}}
{{--                    Current Mode:--}}
{{--                    <i class="ki-outline ki-night-day flex dark:hidden text-xl"></i>--}}
{{--                    <i class="ki-outline ki-moon hidden dark:flex text-xl"></i>--}}
{{--                </button>--}}
{{--                <!--end::Menu toggle-->--}}
{{--                <!--begin::Dropdown-->--}}
{{--                <div class="menu-dropdown py-2 w-[150px]">--}}
{{--                    <!--begin::Menu item-->--}}
{{--                    <div class="menu-item">--}}
{{--                        <button class="menu-link light-mode:bg-gray-100 light-mode:text-primary" data-theme-switch="light">--}}
{{--     <span class="menu-icon">--}}
{{--      <i class="ki-outline ki-night-day light-mode:text-primary">--}}
{{--      </i>--}}
{{--     </span>--}}
{{--                            <span class="menu-title">Light</span>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                    <!--end::Menu item-->--}}
{{--                    <!--begin::Menu item-->--}}
{{--                    <div class="menu-item">--}}
{{--                        <button class="menu-link dark-mode:bg-gray-100 dark-mode:text-primary" data-theme-switch="dark">--}}
{{--     <span class="menu-icon">--}}
{{--      <i class="ki-outline ki-moon dark-mode:text-primary">--}}
{{--      </i>--}}
{{--     </span>--}}
{{--                            <span class="menu-title">Dark</span>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                    <!--end::Menu item-->--}}
{{--                    <!--begin::Menu item-->--}}
{{--                    <div class="menu-item">--}}
{{--                        <button class="menu-link system-mode:bg-gray-100 system-mode:text-primary" data-theme-switch="system">--}}
{{--     <span class="menu-icon">--}}
{{--      <i class="ki-outline ki-screen system-mode:text-primary">--}}
{{--      </i>--}}
{{--     </span>--}}
{{--                            <span class="menu-title">System</span>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                    <!--end::Menu item-->--}}
{{--                </div>--}}
{{--                <!--end::Dropdown-->--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!--end::Menu-->--}}
{{--    </x-slot>--}}
{{--    <div class="card card-grid min-w-full">--}}
{{--        <div class="card-header py-5">--}}
{{--            <h3 class="card-title text-lg font-semibold">Quêtes quotidiennes</h3>--}}
{{--        </div>--}}
{{--        <div class="card-body">--}}
{{--            <div class="scrollable-x-auto">--}}
{{--                <table class="table table-auto table-border w-full">--}}
{{--                    <thead>--}}
{{--                    <tr>--}}
{{--                        <th class="text-left py-3 px-4">--}}
{{--                            <span class="badge badge-primary">Tâches </span>--}}
{{--                        </th>--}}
{{--                        <th class="text-center py-3 px-4">--}}
{{--                            <span class="badge badge-success">Fait</span>--}}
{{--                        </th>--}}
{{--                        <th class="text-center py-3 px-4">--}}
{{--                            <span class="badge badge-danger">Commentaire</span>--}}
{{--                        </th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                    <tr>--}}
{{--                        <td class="py-2 px-4">Nettoyer les tableaux</td>--}}
{{--                        <td class="text-center py-2 px-4">--}}
{{--                            <input type="checkbox" class="checkbox checkbox-sm">--}}
{{--                        </td>--}}
{{--                        <td class="text-center py-2 px-4">--}}
{{--                            <input class="input" placeholder="Text input" type="text" value=""/>--}}
{{--                        </td>--}}
{{--                        <td class="text-center py-2 px-4">--}}
{{--                            <button class="btn btn-dark">Enregistrer</button>--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <td class="py-2 px-4">Faire ses stories</td>--}}
{{--                        <td class="text-center py-2 px-4">--}}
{{--                            <input type="checkbox" class="checkbox checkbox-sm">--}}
{{--                        </td>--}}
{{--                        <td class="text-center py-2 px-4">--}}
{{--                            <input class="input" placeholder="Text input" type="text" value=""/>--}}
{{--                        </td>--}}
{{--                        <td class="text-center py-2 px-4">--}}
{{--                            <button class="btn btn-dark">Enregistrer</button>--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <td class="py-2 px-4">Faire une réunion d'équipe</td>--}}
{{--                        <td class="text-center py-2 px-4">--}}
{{--                            <input type="checkbox" class="checkbox checkbox-sm">--}}
{{--                        </td>--}}
{{--                        <td class="text-center py-2 px-4">--}}
{{--                            <input class="input" placeholder="Text input" type="text" value=""/>--}}
{{--                        </td>--}}
{{--                        <td class="text-center py-2 px-4">--}}
{{--                            <button class="btn btn-dark">Enregistrer</button>--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <td class="py-2 px-4">Mettre à jour le site web</td>--}}
{{--                        <td class="text-center py-2 px-4">--}}
{{--                            <input type="checkbox" class="checkbox checkbox-sm">--}}
{{--                        </td>--}}
{{--                        <td class="text-center py-2 px-4">--}}
{{--                            <input class="input" placeholder="Text input" type="text" value=""/>--}}
{{--                        </td>--}}
{{--                        <td class="text-center py-2 px-4">--}}
{{--                            <button class="btn btn-dark">Enregistrer</button>--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</x-app-layout>--}}










<x-app-layout>
    <x-slot name="header">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">
                {{ __('Vie Commune') }}
            </span>
        </h1>
        <!--begin::Menu-->
        <div class="menu menu-default" data-menu="true">
            <div class="menu-item" data-menu-item-placement="bottom-end" data-menu-item-toggle="dropdown" data-menu-item-trigger="click">
                <!--begin::Menu toggle-->
                <button class="menu-toggle btn btn-primary">
                    Current Mode:
                    <i class="ki-outline ki-night-day flex dark:hidden text-xl"></i>
                    <i class="ki-outline ki-moon hidden dark:flex text-xl"></i>
                </button>
                <!--end::Menu toggle-->
                <!--begin::Dropdown-->
                <div class="menu-dropdown py-2 w-[150px]">
                    <!--begin::Menu item-->
                    <div class="menu-item">
                        <button class="menu-link light-mode:bg-gray-100 light-mode:text-primary" data-theme-switch="light">
     <span class="menu-icon">
      <i class="ki-outline ki-night-day light-mode:text-primary">
      </i>
     </span>
                            <span class="menu-title">Light</span>
                        </button>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item">
                        <button class="menu-link dark-mode:bg-gray-100 dark-mode:text-primary" data-theme-switch="dark">
     <span class="menu-icon">
      <i class="ki-outline ki-moon dark-mode:text-primary">
      </i>
     </span>
                            <span class="menu-title">Dark</span>
                        </button>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item">
                        <button class="menu-link system-mode:bg-gray-100 system-mode:text-primary" data-theme-switch="system">
     <span class="menu-icon">
      <i class="ki-outline ki-screen system-mode:text-primary">
      </i>
     </span>
                            <span class="menu-title">System</span>
                        </button>
                    </div>
                    <!--end::Menu item-->
                </div>
                <!--end::Dropdown-->
            </div>
        </div>
        <!--end::Menu-->
    </x-slot>
    <div class="card card-grid min-w-full">
        <div class="card-header py-5">
            <h3 class="card-title text-lg font-semibold">Quêtes quotidiennes</h3>
        </div>
        <div class="card-body">
            <div class="scrollable-x-auto">
                @php
                    $taskList = ['Nettoyer les tableaux', 'Faire ses stories', 'Faire une réunion d\'équipe', 'Mettre à jour le site web'];
                @endphp
                <table class="table table-auto table-border w-full">
                    <thead>
                    <tr>
                        <th class="text-left py-3 px-4">
                            <span class="badge badge-primary">Tâches </span>
                        </th>
                        <th class="text-center py-3 px-4">
                            <span class="badge badge-success">Fait</span>
                        </th>
                        <th class="text-center py-3 px-4">
                            <span class="badge badge-danger">Commentaire</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($taskList as $taskName)
                        @php
                            $taskData = $tasks[$taskName] ?? null;
                        @endphp
                        <tr>
                            <td class="py-2 px-4">{{ $taskName }}</td>
                            <td class="text-center py-2 px-4">
                                <input type="checkbox" class="checkbox checkbox-sm" {{ $taskData && $taskData->Status ? 'checked' : '' }}>
                            </td>
                            <td class="text-center py-2 px-4">
                                <input class="input" placeholder="Text input" type="text" value="{{ $taskData->Commentary ?? '' }}">
                            </td>
                            <td class="text-center py-2 px-4">
                                <button class="btn btn-dark">Enregistrer</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.querySelectorAll('.btn.btn-dark').forEach(button => {
        button.addEventListener('click', function (event) {
            let row = event.target.closest('tr');

            let checkbox = row.querySelector('input[type="checkbox"]');
            let comment = row.querySelector('input[type="text"]').value;
            let task = row.querySelector('td:first-child').innerText.trim();

            let studentID = {{ auth()->id() }}; // ID étudiant connecté

            let data = {
                StudentID: studentID,
                Task: task,
                Status: checkbox.checked,
                Commentary: comment
            };

            fetch('{{ route('commonlife.save') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(data)
            })
                .then(response => response.json())
                .then(data => {
                    alert("Tâche enregistrée !");
                })
                .catch(error => {
                    alert("Erreur lors de l'enregistrement.");
                    console.error(error);
                });
        });
    });
</script>



