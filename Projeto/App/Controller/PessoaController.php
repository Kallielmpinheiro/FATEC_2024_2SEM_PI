<?php 
    class PessoaController
    {
        #cada um dos metodos vai ser responsável por processar uma rota e serão  staticos

        #vai me devolver a lista de dados do usuario
        
        
        public static function telaIncial()
        {
           include 'App/View/modules/Pessoa/index.php';
        }
        

        
        public static function HomePaciente()
        {
          
            include_once 'App/Model/MedicamentoModel.php';
            include_once 'App/Model/PessoaModel.php';
          
            $model = new MedicamentoModel();
            $id_paciente = Auth::getLoggedInUserId();
            $model->getAllPMRows($id_paciente);


            include 'App/view/modules/Pessoa/paciente.php';
        }
        public static function HomeMedico()
        {
            include_once 'App/Model/MedicamentoModel.php';
            include_once 'App/Model/PessoaModel.php';
            $medico_id = Auth::getLoggedInUserId();
            $model = new PessoaModel();
            $model->getAllRows($medico_id);

            
            $modelM = new MedicamentoModel();
            $modelM->getAllRows();
            include 'App/view/modules/Pessoa/HomeMedico.php';
        }


        public static function HomeFuncionario()
        {
            include 'App/view/modules/Pessoa/indexf.php';
        }

        public static function ConsultarUser()
        {
            include_once 'App/Model/PessoaModel.php';

            



            $model = new PessoaModel();
            $model->cpf = $_POST['cpf'];
            $model->getByCPF($model->cpf);


            include 'App/view/modules/Pessoa/DadosPaciente.php';

           
        }





        public static function form()
        {
            include 'App/Model/PessoaModel.php';
            $model = new PessoaModel();
          
            if(isset($_GET['id']))
                $model = $model->getById((int) $_GET['id']);//me ajuda a evitar ainda mais sql injection 
           
            
           
            
            
            include 'App/View/modules/Pessoa/cadastro.php';
        }


          
        public static function save()
        {





            include 'App/Model/PessoaModel.php';

            

            $model = new PessoaModel();
            $model->idPaciente =$_POST['idPaciente'];
            $model->nome = $_POST['nome'];
            $model->sobrenome = $_POST['sobrenome'];
            $model->cpf = $_POST['cpf'];
            $model->cep = $_POST['cep'];
            $model->estado = $_POST['estado'];
            $model->cidade = $_POST['cidade'];
            $model->rua = $_POST['rua'];
            $model->numero = $_POST['numero'];
            $model->tipoPessoa = $_POST['tipoPessoa'];
            $model->PlanoSaude = $_POST['planoSaude'];
            $model->medico_CRM = $_POST['CRM'];
         
          
            
          
            $model->save();
           


            header("Location: /telaF");
        }


        public static function delete()
        {
            include 'App/Model/PessoaModel.php';
            $model = new PessoaModel();
            $model->delete((int) $_GET['id']);

            header("location: /telaM");
        }





      public static function saveDescription()
        {
            include 'App/Model/PessoaModel.php';
            $model = new PessoaModel();
            $model->descricao = $_POST['descricao'];
            $model->idPaciente = Auth::getLoggedInUserId();
            $model->saveDescription();

         

            header("Location: /telaP");
            
         
           
        }

    }
?>