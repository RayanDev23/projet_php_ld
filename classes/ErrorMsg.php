<?php

class ErrorMsg
{
    public const SUBSCRIBE_ERROR = "Une erreur est survenue lors de l'inscription. Veuillez réessayer plus tard.";
    public const SUBSCRIBE_SUCCESS = "Inscription réussie. Vous pouvez maintenant vous connecter.";

    public const LOGIN_ERROR = "Identifiants invalides. Veuillez réessayer.";
    public const LOGIN_SUCCESS = "Vous êtes connecté avec succès.";

    public const USER_NOT_FOUND = "Utilisateur non trouvé.";

    public static function getMessage($errorCode)
    {
        switch ($errorCode) {
            case self::SUBSCRIBE_ERROR:
                return self::SUBSCRIBE_ERROR;
            case self::SUBSCRIBE_SUCCESS:
                return self::SUBSCRIBE_SUCCESS;
            case self::LOGIN_ERROR:
                return self::LOGIN_ERROR;
            case self::LOGIN_SUCCESS:
                return self::LOGIN_SUCCESS;
            case self::USER_NOT_FOUND:
                return self::USER_NOT_FOUND;
            default:
                return "Code d'erreur non valide.";
        }
    }
}
