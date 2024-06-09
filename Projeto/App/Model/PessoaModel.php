<?php 

    class PessoaModel
    {
       public $idPaciente, $nome, $sobrenome, $cpf, $cep, $estado, $cidade, $rua, $numero, $PlanoSaude, $tipoPessoa, $senha;
       public $descricao;

       public $medico_CRM;

       public $medico_id;

       



       public $rows;
       
       public function __construct()
       {
               $this->senha = $this->gerarSenha($tamanho = 8);
           
       }
       protected function gerarSenha($tamanho = 8)
       {
           // Se a senha já foi definida, retorna ela mesma
           if (!is_null($this->senha)) {
               return $this->senha;
           }
       
           // Se a senha for null, gera uma nova senha
           $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
           $senha = '';
           for ($i = 0; $i < $tamanho; $i++) {
               $senha .= $caracteres[rand(0, strlen($caracteres) - 1)];
           }
           // Retorna a nova senha gerada
           return $senha;
       }

       public function save()
        {

        
            include 'App/DAO/PessoaDAO.php';
            $dao = new PessoaDAO();


            if(empty($this->idPaciente))
            {
                $dao->insert($this);

               
             
             
            } else
            {
                $dao->update($this);
               
        
            }

        }

        public function delete(int $idPaciente)
        {
            include 'App/DAO/PessoaDAO.php';

            $dao = new PessoaDAO();
            $dao->delete($idPaciente);
        }


        public function getAllRows($medico_id)
        {
            include 'App/DAO/PessoaDAO.php';
            $dao = new PessoaDAO();
        
            $this->rows = $dao->select($medico_id);
        }




        public function getByCPF($cpf)
        {
            include 'App/DAO/PessoaDAO.php';
            $dao = new PessoaDAO();
        
            $this->rows = $dao->selectUser($cpf);
        }
        


       public function getById(int $idPaciente)
       {
        include 'App/DAO/PessoaDAO.php';
        $dao = new PessoaDAO(); 
        $obj =  $dao->selectById($idPaciente);

        return ($obj) ? $obj : new PessoaModel;

        }


  
        public function saveDescription()
        {
            include 'App/DAO/PessoaDAO.php';
            $dao = new PessoaDAO();
            $dao->insertDescription($this);


        }

    }
      
    
?>