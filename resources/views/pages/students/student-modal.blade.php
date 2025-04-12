@extends('layouts.modal', [
    'id'    => 'student-modal',
    'title'  => 'Informations étudiant',] )

@section('modal-content')
    <h3 class="card-title">
        Ajouter un étudiant
    </h3>
    </div>
    <div class="card-body flex flex-col gap-5">
        <form id="updateUserForm">
            @csrf

            <x-forms.input name="last_name" :label="__('Nom')" />
            <x-forms.input name="first_name" :label="__('Prénom')" />
            <x-forms.input type="email" name="email" :label="__('Email')" />
            <x-forms.input type="date" name="birth_date" :label="__('Date de naissance')" />
            <x-forms.primary-button>
                {{ __('Valider') }}
            </x-forms.primary-button>
        </form>

        <div id="responseMessage"></div>  <!-- Zone pour afficher la réponse de l'API -->

    </div>
    </div>
    </div>
    </div>

<script>
document.getElementById('updateUserForm').addEventListener('submit', function(event) {
    event.preventDefault();  // Empêche l'envoi classique du formulaire

    const formData = new FormData(this);

    fetch("{{ route('student.update') }}", {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',  // Indique que c'est une requête AJAX
            'Accept': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.message) {
            // Affiche un message de succès
            document.getElementById('responseMessage').innerHTML = `<p style="color: green;">${data.message}</p>`;
        }
    })
    .catch(error => {
        // Gère les erreurs
        document.getElementById('responseMessage').innerHTML = `<p style="color: red;">Une erreur est survenue. Veuillez réessayer.</p>`;
    });
});
</script>
@overwrite
