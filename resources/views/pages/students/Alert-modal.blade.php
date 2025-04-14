@extends('layouts.modal', [
    'id'    => 'Alert-modal',
    'title'  => 'Message de prévention',
])

@section('modal-content')
    <h3 class="card-title">
        Supprimer cet étudiant ?
    </h3>
    <div class="card-body flex flex-col gap-5">
{{--        <form id="deleteUserForm" method="POST" action="{{ route('student.delete', $student->id) }}">--}}
            @csrf
            @method('DELETE')

            <input type="hidden" id="studentId" name="studentId" value="{{ $student->id }}">

            <p style="color: red;">Êtes-vous sûr de vouloir supprimer cet étudiant ? <br>
                (Cette action est irréversible)</p>
            <br>
            <x-forms.primary-button>
                {{ __('Supprimer') }}
            </x-forms.primary-button>
        </form>
    </div>
@endsection

@section('scripts')
{{--    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>--}}

{{--    <script>--}}
{{--        $(document).ready(function() {--}}
{{--            // Quand le formulaire est soumis--}}
{{--            $('#deleteUserForm').submit(function(e) {--}}
{{--                e.preventDefault();  // Empêche la soumission classique du formulaire--}}

{{--                // Récupère l'ID de l'étudiant--}}
{{--                var studentId = $('#studentId').val();--}}

{{--                // Envoi de la requête AJAX pour supprimer l'étudiant--}}
{{--                $.ajax({--}}
{{--                    url: '/student/' + studentId,  // L'URL de la route--}}
{{--                    type: 'DELETE',--}}
{{--                    data: {--}}
{{--                        _token: '{{ csrf_token() }}',  // Le token CSRF pour la sécurité--}}
{{--                        studentId: studentId--}}
{{--                    },--}}
{{--                    success: function(response) {--}}
{{--                        if (response.success) {--}}
{{--                            // Affiche un message de succès et ferme le modal--}}
{{--                            alert(response.message);--}}
{{--                            $('#Alert-modal').modal('hide');  // Si tu utilises Bootstrap Modal--}}
{{--                            location.reload();  // Recharger la page pour mettre à jour la liste des étudiants--}}
{{--                        } else {--}}
{{--                            // Affiche un message d'erreur--}}
{{--                            alert(response.message);--}}
{{--                        }--}}
{{--                    },--}}
{{--                    error: function(xhr, status, error) {--}}
{{--                        alert('Une erreur est survenue lors de la suppression.');--}}
{{--                    }--}}
{{--                });--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
@endsection
