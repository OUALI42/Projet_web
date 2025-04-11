<x-app-layout>
    <x-slot name="header">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">
                {{ __('Retrospectives') }}
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
            <h3 class="card-title text-lg font-semibold">Retrospectives</h3>
        </div>
        <div class="card-body">
            <div class="scrollable-x-auto">
                <table class="table table-auto table-border w-full">
                    <thead>
                    <tr>
                        <th class="text-left py-3 px-4">
                            <span class="badge badge-primary" style="font-size: 1.2rem;">Promo</span>
                        </th>
                        <th class="text-center py-3 px-4">
                            <span class="badge badge-success" style="font-size: 1.2rem;">Retro</span>
                        </th>
                        <th class="text-center py-3 px-4">
                            <span class="badge badge-dark" style="font-size: 1.2rem;">Action</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $promotions = ['Promotion B1', 'Promotion B2', 'Promotion B3', 'Promotion B4'];
                    @endphp

                    @foreach($promotions as $promo)
                        <tr>
                            <td class="py-2 px-4">{{ $promo }}</td>
                            <td class="py-2 px-4">
                                <textarea class="textarea" rows="4" placeholder="Écrire une rétro...">
                                    {{ $retros[$promo]->Retro ?? '' }}
                                </textarea>
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
            let promoName = row.querySelector('td:first-child').innerText.trim();
            let retroText = row.querySelector('textarea').value.trim();
            let teacherID = {{ auth()->id() }};

            let data = {
                Teacher_id: teacherID,
                Name_of_Promotion: promoName,
                Retro: retroText
            };

            fetch('{{ route('retro.save') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(data)
            })
                .then(response => response.json())
                .then(data => {
                    alert("Rétro enregistrée !");
                })
                .catch(error => {
                    alert("Erreur lors de l'enregistrement.");
                    console.error(error);
                });
        });
    });
</script>



