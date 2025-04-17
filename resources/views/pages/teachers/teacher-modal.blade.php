@extends('layouts.modal', [
    'id'    => 'teacher-modal',
    'title'  => 'Informations enseignant',] )

@section('modal-content')
    <h3 class="card-title">
        Modifier un Enseignant
    </h3>
    <div id="responseMessage" class="mt-4 hidden"> Enseignant modifié avec succès</div>
    <div class="card-body flex flex-col gap-5">
        <form id="updateTeacherForm" data-update-route="{{ route('teacher.update') }}">
            @csrf
            <div id="responseMessage" class="text-sm mt-2 hidden"></div>
            <div>
                <label for="cohort_id" class="form-label"> Promotions </label>
                <select name="cohort_id" id="cohort_id" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary text-sm shadow-sm">
                    <option value="">{{ __('Lier à une promotion') }}</option>
                    @foreach($cohorts as $cohort)
                        <option value="{{ $cohort->id }}"> {{ $cohort->name }}</option>
                    @endforeach
                </select>
            </div>

            <br>

            <x-forms.input name="current_email" :label="__('Email de l\'utilisateur à modifier')" />
            <x-forms.input type="email" name="email" :label="__('Nouvel Email')" />
            <x-forms.input name="last_name" :label="__('Nom')" />
            <x-forms.input name="first_name" :label="__('Prénom')" />

            <br>
            <x-forms.primary-button>
                {{ __('Valider') }}
            </x-forms.primary-button>
        </form>
    </div>
@overwrite
