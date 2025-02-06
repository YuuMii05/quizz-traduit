<?php


function translate($key) {
    $translations = [
        'en' => [
            'Quiz Generator' => 'Quiz Generator',
            'Log in' => 'Log in',
            'Sign up' => 'Sign up',
            'register' => 'Register',
            'Connection' => 'Connection',
            'Back' => 'Back',
            'Username' => 'Username',
            'Email' => 'Email',
            'Password' => 'Password',
            'Confirm Password' => 'Confirm Password',
        ],
        'fr' => [
            'Quiz Generator' => 'Générateur de Quiz',
            'Log in' => 'Se connecter',
            'Sign up' => 'S\'inscrire',
            'register' => "Registré",
            'Connection' => 'Connexion',
            'Back' => 'Retour',
            'Username' => 'Nom d\'utilisateur',
            'Email' => 'Email',
            'Password' => 'Mot de passe',
            'Confirm Password' => 'Confirmez le mot de passe',
        ],
        'es' => [
            'Quiz Generator' => 'Generador de Cuestionarios',
            'Log in' => 'Iniciar sesión',
            'Sign up' => 'Registrarse',
            'register' => 'Registro',
            'Connection' => 'Conexión',
            'Back' => 'Atrás',
            'Username' => 'Nombre de usuario',
            'Email' => 'Email',
            'Password' => 'Contraseña',
            'Confirm Password' => 'Confirmar contraseña',
        ],
        'de' => [
            'Quiz Generator' => 'Quiz-Generator',
            'Log in' => 'Anmeldung',
            'Sign up' => 'Registrieren',
            'register' => 'Registrierung',
            'Connection' => 'Verbindung',
            'Back' => 'Zurück',
            'Username' => 'Benutzername',
            'Email' => 'Email',
            'Password' => 'Passwort',
            'Confirm Password' => 'Passwort bestätigen',
        ],
        'it' => [
            'Quiz Generator' => 'Generatore di Quiz',
            'Log in' => 'Accesso',
            'Sign up' => 'Iscriviti',
            'register' => 'Registrazione',
            'Connection' => 'Connessione',
            'Back' => 'Indietro',
            'Username' => 'Nome utente',
            'Email' => 'Email',
            'Password' => 'Password',
            'Confirm Password' => 'Conferma password',
        ],
        'pt' => [
            'Quiz Generator' => 'Gerador de questionários',
            'Log in' => 'Entrar',
            'Sign up' => 'Inscrever-se',
            'register' => 'Registrar-se',
            'Connection' => 'Conexão',
            'Back' => 'Voltar',
            'Username' => 'Nome de usuário',
            'Email' => 'Email',
            'Password' => 'Senha',
            'Confirm Password' => 'Confirme a senha',
        ]
    ];
    $lang = $_GET['lang'] ?? 'en';
    return $translations[$lang][$key] ?? $key;}
?>

