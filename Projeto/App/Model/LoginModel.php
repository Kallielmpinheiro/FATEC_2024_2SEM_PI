<?php 

    class LoginModel
    {
        public $cpf;
        public $senha;
        public $tipo;


        public function __construct()
        {
            include 'App/DAO/LoginDAO.php';

        }

        public function consultarAcesso()
        {
            $dao = new LoginDAO();
          
            $dao->validacao($this);

            
            
        }
    }



?>