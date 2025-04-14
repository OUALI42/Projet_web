<x-app-layout>
    <x-slot name="header">
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">
                {{ __('Bilans de connaissances') }}
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
            <h3 class="card-title text-lg font-semibold">Bilan de compétences</h3>
        </div>
        <div class="card-body">
            <div class="scrollable-x-auto">
                <table class="table table-auto table-border w-full">
                    <thead>
                    <tr>
                        <th class="text-left py-3 px-4">
                            <span class="badge badge-primary">Bilan </span>
                        </th>
                        <th class="text-center py-3 px-4">
                            <span class="badge badge-success">Description</span>
                        </th>
                        <th class="text-center py-3 px-4">
                            <span class="badge badge-danger">Status</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="py-2 px-4">Compétence en gestion du temps</td>
                        <td class="py-2 px-4">- Organiser et planifier efficacement son emploi du temps.</td>
                        <td class="text-center">
                            <select class="select select-sm" id="status-1">
                                <option value="a_faire">À faire</option>
                                <option value="en_cours">En cours</option>
                                <option value="termine">Terminé</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4">Compétence en travail d’équipe</td>
                        <td class="py-2 px-4">- Collaborer harmonieusement avec d’autres membres d’un groupe, partager des idées.</td>
                        <td class="text-center">
                            <select class="select select-sm" id="status-2">
                                <option value="a_faire">À faire</option>
                                <option value="en_cours">En cours</option>
                                <option value="termine" selected>Terminé</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4">Compétence en résolution de problèmes</td>
                        <td class="py-2 px-4">- Identifier et analyser un problème de manière structurée, proposer des solutions.</td>
                        <td class="text-center">
                            <select class="select select-sm" id="status-3">
                                <option value="a_faire">À faire</option>
                                <option value="en_cours">En cours</option>
                                <option value="termine" selected>Terminé</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4">Compétence en leadership</td>
                        <td class="py-2 px-4">- Diriger une équipe en inspirant confiance, en motivant les membres.</td>
                        <td class="text-center">
                            <select class="select select-sm" id="status-4">
                                <option value="a_faire">À faire</option>
                                <option value="en_cours">En cours</option>
                                <option value="termine" selected>Terminé</option>
                            </select>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Function to save the selection status
        function saveStatus(bilanId, status) {
            localStorage.setItem(bilanId, status);
        }

        //  Function to load the saved state
        function loadStatus() {
            const selects = document.querySelectorAll('select');
            selects.forEach(select => {
                const bilanId = select.id;
                const savedStatus = localStorage.getItem(bilanId);
                if (savedStatus) {
                    select.value = savedStatus;
                }
                select.addEventListener('change', function() {
                    saveStatus(bilanId, this.value);
                });
            });
        }

        // Load the saved statuses when loading the page
        window.onload = loadStatus;
    </script>
</x-app-layout>
