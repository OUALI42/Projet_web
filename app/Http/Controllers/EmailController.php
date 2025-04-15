<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{

    /**
     * This function send  email for password of user
     */
    public function sendWelcomeEmail(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');

        $message = "**Objet : Vos identifiants de connexion Coding factory**\n\n
                Bonjour ".$name.",\n\n
                Voici vos identifiants pour accéder à votre espace personnel :\n\n
                 **Email** : ".$email."\n\n
                 **Mot de passe** : ".'123456'."\n\n
                Nous vous recommandons de le modifier dès votre première connexion.\n
                En cas de problème ou si vous n’êtes pas à l’origine de cette demande, merci de nous contacter immédiatement au 06.05.62.88.30 ou par retour de mail.\n\n
                À bientôt,\n\n
                **Coding Factory**\n";

        $subject = "Votre Mot de passe étudiant";

        Mail::to($email)->send(new WelcomeEmail($message, $subject));
        return response()->json(['message' => 'Email envoyé.']);
    }

}
