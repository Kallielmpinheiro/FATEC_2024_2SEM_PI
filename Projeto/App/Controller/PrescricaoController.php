<?php

    class PrescricaoController
    {

        

        public static function save()
        {
            include 'App/Model/PrescricaoModel.php';
            if(!empty($_POST))
            {
                $model = new PrescricaoModel();
                $model->cpf = $_POST['cpf'];
                $model->id_medicamentosconsulta = $_POST['id_medicamentosconsulta'];
                $model->duracao = $_POST['duracao'];
                $model->dosagem = $_POST['dosagem'];
                $model->instrucao = $_POST['instrucao'];
                $model->CRM = $_POST['CRM'];
                

    

                $model->save();

                
           


            }
        }
    }