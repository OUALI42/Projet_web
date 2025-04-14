@extends('layouts.modal', [
    'id'    => 'student-modal',
    'title'  => 'Informations étudiant',] )

@section('modal-content')
    <h3 class="card-title">
        Modifier un étudiant
    </h3>
    <div class="card-body flex flex-col gap-5">
        <form id="updateUserForm" method="POST">
            @csrf

            <x-forms.input name="current_email" :label="__('Email de l\'utilisateur à modifier')" />
            <x-forms.input type="email" name="email" :label="__('Nouvel Email')" />
            <x-forms.input name="last_name" :label="__('Nom')" />
            <x-forms.input name="first_name" :label="__('Prénom')" />
            <x-forms.input type="date" name="birth_date" :label="__('Date de naissance')" />

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
