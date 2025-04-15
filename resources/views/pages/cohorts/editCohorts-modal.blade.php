@extends('layouts.modal', [
    'id'    => 'editCohorts-modal',
    'title'  => 'Informations Promotion',] )

@section('modal-content')
    <h3 class="card-title">
        Modifier une Promotion
    </h3>
    <div class="card-body flex flex-col gap-5">
        <form id="updateUserForm" method="POST">
            @csrf
            <x-forms.input name="Name" :label="__('Nom')" />
            <x-forms.input name="localisation" :label="__('Localisation')" />
            <x-forms.input name="number_of_students" :label="__('Nombre d étudiant')" />
            <x-forms.input type="date" name="start_date" :label="__('Début de l\'année')" />
            <x-forms.input type="date" name="end_date" :label="__('Fin de l\'année')" />

            <x-forms.primary-button>
                {{ __('Valider') }}
            </x-forms.primary-button>
        </form>
    </div>

    {{-- This scritp get the information for update student in to the list of student --}}
    <script>
        document.getElementById('updateUserForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);

            // Route consultation for the method
            fetch("{{ route('student.update') }}", {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.message) {
                        document.getElementById('responseMessage').innerHTML = `<p style="color: green;">${data.message}</p>`;
                    }
                })
                .catch(error => {
                    document.getElementById('responseMessage').innerHTML = `<p style="color: red;">Une erreur est survenue. Veuillez réessayer.</p>`;
                });
        });
    </script>
@overwrite
