<?php

class Auth
{
    // Inicia uma sessão para o usuário com os dados fornecidos
    public static function iniciarSessao($result, $tipo)
    {
        self::startSession();

        if (!empty($result)) {
            $_SESSION["logged_in"] = true;
            $_SESSION["user_id"] = $result['id'];
            $_SESSION["user_nome"] = $result['nome'];
            $_SESSION["user_data"] = $result;
            $_SESSION["tipo_usuario"] = $tipo;
            return true;
        } else {
            self::setErrorMessage("Usuário ou senha incorretos.");
            self::redirect("/form/login");
            return false;
        }
    }

    // Retorna o ID do usuário logado, se estiver logado
    public static function getLoggedInUserId()
    {
        self::startSession();

        return isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true ? $_SESSION["user_id"] : null;
    }

    // Retorna o tipo de usuário logado, se estiver logado
    public static function getTipoUsuario()
    {
        self::startSession();

        return isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true ? $_SESSION["tipo_usuario"] : null;
    }

    // Encerra a sessão do usuário e redireciona para a página de login
    public static function logout()
    {
        self::startSession();
        session_destroy();
        self::redirect("/form/login");
    }

    // Verifica se o usuário tem o tipo esperado, caso contrário, faz logout
    public static function verificarTipoUsuario($tipoEsperado)
    {
        self::startSession();
        self::validador();

        if ($_SESSION["tipo_usuario"] !== $tipoEsperado) {
            self::logout();
            exit();
        }
    }

    // Valida se o usuário está logado, caso contrário, redireciona para a página de login
    public static function validador()
    {
        if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
            self::setErrorMessage("Por favor, faça login para acessar esta página.");
            self::redirect("/form/login");
        }
    }

    // Define uma mensagem de erro na sessão
    private static function setErrorMessage($message)
    {
        $_SESSION['error_message'] = $message;
    }

    // Redireciona o navegador para a URL especificada
    private static function redirect($location)
    {
        header("Location: $location");
        exit();
    }

    // Inicia uma sessão se ainda não estiver iniciada
    private static function startSession()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }



}

?>