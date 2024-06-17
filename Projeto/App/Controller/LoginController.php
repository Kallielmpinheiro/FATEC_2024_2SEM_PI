<?php
    include 'App/Model/LoginModel.php';

    class LoginController
    {

        public static function form()
        {
           include('App/View/modules/Pessoa/login.php');
        }
        public static function Autenticar()
        {
            $model = new LoginModel();
            $model->cpf = $_POST['cpf'];
            $model->senha = $_POST['senha'];
            $model->tipo = $_POST['tipo'];
            $model->consultarAcesso();
        }

        public static function logout()
        {
            Auth::logout();
        }
    }

      
          

    


?>