<x-app-layout>
    <x-slot name="header">
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
                    <tr>
                        <td class="py-2 px-4">Nettoyer les tableaux</td>
                        <td class="text-center py-2 px-4">
                            <input type="checkbox" class="checkbox checkbox-sm">
                        </td>
                        <td class="text-center py-2 px-4">
                            <input class="input" placeholder="Text input" type="text" value=""/>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4">Faire ses stories</td>
                        <td class="text-center py-2 px-4">
                            <input type="checkbox" class="checkbox checkbox-sm">
                        </td>
                        <td class="text-center py-2 px-4">
                            <input class="input" placeholder="Text input" type="text" value=""/>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4">Faire une réunion d'équipe</td>
                        <td class="text-center py-2 px-4">
                            <input type="checkbox" class="checkbox checkbox-sm">
                        </td>
                        <td class="text-center py-2 px-4">
                            <input class="input" placeholder="Text input" type="text" value=""/>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4">Mettre à jour le site web</td>
                        <td class="text-center py-2 px-4">
                            <input type="checkbox" class="checkbox checkbox-sm">
                        </td>
                        <td class="text-center py-2 px-4">
                            <input class="input" placeholder="Text input" type="text" value=""/>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
