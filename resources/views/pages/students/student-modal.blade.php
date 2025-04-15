@extends('layouts.modal', [
    'id'    => 'student-modal',
    'title'  => 'Informations étudiant',] )
@section('modal-content')
    <h3 class="card-title">
        Modifier un étudiant
    </h3>
    <div id="responseMessage" class="mt-4 hidden"> Etudiant modifié avec succès</div>
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

            const form = this;
            const formData = new FormData(form);
            const responseMessage = document.getElementById('responseMessage');

            responseMessage.classList.add('hidden');
            responseMessage.innerHTML = '';

            fetch("{{ route('student.update') }}", {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            })
                .then(async response => {
                    const data = await response.json();

                    if (!response.ok) {
                        if (data.errors) {
                            const errorMessages = Object.values(data.errors).flat().join('<br>');
                            throw new Error(errorMessages);
                        } else {
                            throw new Error(data.message || 'Erreur inconnue');
                        }
                    }

                    responseMessage.classList.remove('hidden');
                    responseMessage.innerHTML = `<p class="text-green-600">${data.message}</p>`;

                    // Reload the page after 2 sec
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                })
                .catch(error => {
                    responseMessage.classList.remove('hidden');
                    responseMessage.innerHTML = `<p class="text-red-600">${error.message}</p>`;
                    console.error('Erreur AJAX :', error);
                });
        });
    </script>

@overwrite
