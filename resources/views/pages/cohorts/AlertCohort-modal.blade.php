@extends('layouts.modal', [
    'id'    => 'AlertCohort-modal',
    'title'  => 'Message de prévention',
])

@section('modal-content')
    <h3 class="card-title">Supprimer cette Promotion ?</h3>
    <div class="card-body flex flex-col gap-5">
        <form id="deleteCohortForm" method="POST">
            @csrf
            @method('DELETE')

            <input type="hidden" id="cohortId" name="cohortId">

            <p style="color: red;">
                Êtes-vous sûr de vouloir supprimer cette Promotion ?<br>
                (Cette action est irréversible)
            </p>

            <x-forms.primary-button>
                {{ __('Supprimer') }}
            </x-forms.primary-button>
        </form>
    </div>
@endsection
