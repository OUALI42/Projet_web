@extends('layouts.modal', [
    'id'    => 'student-modal',
    'title'  => 'Informations étudiant',] )
@section('modal-content')
    <h3 class="card-title">
        Modifier un étudiant
    </h3>
    <div id="responseMessage" class="mt-4 hidden"> Etudiant modifié avec succès</div>
    <div class="card-body flex flex-col gap-5">
        <form id="updateUserForm" data-update-route="{{ route('student.update') }}">
            @csrf

            <div id="responseMessage" class="text-sm mt-2 hidden"></div>

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
@overwrite
