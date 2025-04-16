@extends('layouts.modal', [
    'id'    => 'AlertTeacher-modal',
    'title'  => 'Message de prévention',
])

@section('modal-content')
    <h3 class="card-title">Supprimer cet Enseignant ?</h3>
    <div class="card-body flex flex-col gap-5">
        <form id="deleteTeacherForm" method="POST">
            @csrf
            @method('DELETE')

            <input type="hidden" id="TeacherId" name="TeacherId">

            <p style="color: red;">
                Êtes-vous sûr de vouloir supprimer cet étudiant ?<br>
                (Cette action est irréversible)
            </p>

            <x-forms.primary-button>
                {{ __('Supprimer') }}
            </x-forms.primary-button>
        </form>
    </div>
@endsection
