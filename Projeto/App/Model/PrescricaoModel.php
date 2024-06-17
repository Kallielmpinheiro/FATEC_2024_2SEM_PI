<?php

    class PrescricaoModel
    {
        public $cpf;
        public $id_medicamentosconsulta;
        public $duracao;
        public $dosagem;
        public $instrucao;
        public $CRM;



        
    public function save()
    {
        include_once 'App/DAO/PrescricaoDAO.php';

        $dao = new PrescricaoDAO();

        

            $dao->PrescricaoMedica($this);

           

    }


    }



?>