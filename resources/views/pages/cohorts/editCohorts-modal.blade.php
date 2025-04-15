@extends('layouts.modal', [
    'id'    => 'editCohorts-modal',
    'title'  => 'Informations Promotion',] )

@section('modal-content')
    <h3 class="card-title">
        Modifier une Promotion
    </h3>
    <div id="responseMessage" class="mt-4 hidden"> Promotion modifié avec succès</div>
    <div class="card-body flex flex-col gap-5">
        <form id="updateCohortsForm"  data-edit-route="{{ route('Cohort.update', ['id' => $cohort->id]) }}">
            @csrf
            <input type="hidden" name="id" value="{{ $cohort->id }}">

            <x-forms.input name="name" :label="__('Nom')" :value="$cohort->name" />
            <x-forms.input name="description" :label="__('Localisation')" />
            <x-forms.input name="number_of_students" :label="__('Nombre d étudiant')" />
            <x-forms.input type="date" name="start_date" :label="__('Début de l\'année')" />
            <x-forms.input type="date" name="end_date" :label="__('Fin de l\'année')" />

            <x-forms.primary-button>
                {{ __('Valider') }}
            </x-forms.primary-button>
        </form>

        <div id="responseMessage" class="hidden"></div>

    </div>
@overwrite
