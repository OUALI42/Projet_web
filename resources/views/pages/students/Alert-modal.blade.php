@extends('layouts.modal', [
    'id'    => 'Alert-modal',
    'title'  => 'Message de prévention',
])

@section('modal-content')
    <h3 class="card-title">
        Supprimer cet étudiant ?
    </h3>
    <div class="card-body flex flex-col gap-5">
        <form id="deleteUserForm" method="POST" action="{{ route('student.delete', $student) }}">
            @csrf
            @method('DELETE')

            <input type="hidden" id="studentId" name="studentId" value="{{ $student}}">

            <p style="color: red;">Êtes-vous sûr de vouloir supprimer cet étudiant ? <br>
                (Cette action est irréversible)</p>
            <br>
            <x-forms.primary-button>
                {{ __('Supprimer') }}
            </x-forms.primary-button>
        </form>
    </div>
@endsection


