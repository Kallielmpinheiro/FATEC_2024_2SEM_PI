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
            $model->medico_CRM = $_POST['CRM'];
            $model->getByCRM($model->medico_CRM);


            include 'App/view/modules/Pessoa/DadosPaciente.php';

           
        }




        public static function form()
        {
            include 'App/Model/PessoaModel.php';
            $model = new PessoaModel();
          
            // Verifica se foi passado um ID válido na query string
            if(isset($_GET['id']) && is_numeric($_GET['id'])) {
                $id = (int) $_GET['id'];

             

                $model = $model->getById($id);
               
            }
           
            // Inclui a view de formulário (cadastro.php)
            include 'App/View/modules/Pessoa/cadastro.php';
        }

        
        public static function formPaciente()
        {
            include_once 'App/Model/PessoaModel.php';
            $modelP = new PessoaModel();
            $loggedInUserId = Auth::getLoggedInUserId();
        
        
            $modelP->getById($loggedInUserId);
        
            // Debug: Verifique se os dados do modelo foram carregados
        
            include 'App/View/modules/Pessoa/AtualizarDados.php';
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
            $model->senhaGerada = $_POST['senhaGerada'];
            $model->status = $_POST['status'];
 

            
         
          
            
          
            $model->save();
           


            header("Location: /telaF");
        }




        public static function AtualizarPuser()
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
            $model->PlanoSaude = $_POST['planoSaude'];
            $model->senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);


         
          

          
           $model->save();

           header("location: /telaP");

           
           


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