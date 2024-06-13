<?php 

    class PessoaModel
    {
       public $idPaciente, $nome, $sobrenome, $cpf, $cep, $estado, $cidade, $rua, $numero, $PlanoSaude, $tipoPessoa, $senha;


       public $senhaGerada;


       public $descricao;

       public $medico_CRM;

       public $medico_id;


       

       public $rows;
       
       public function gerarSenha($tamanho = 8)
    {
        // Se a senha já foi definida, retorna ela mesma
        if (!is_null($this->senha)) {
            return $this->senha;
        }

        // Gera uma nova senha aleatória
        $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $senha = '';
        for ($i = 0; $i < $tamanho; $i++) {
            $senha .= $caracteres[rand(0, strlen($caracteres) - 1)];
        }
        // Define a senha gerada

        return $senha;
    }

    public function save()
    {
        include 'App/DAO/PessoaDAO.php';
        $dao = new PessoaDAO();



        if (empty($this->idPaciente)) {
            
            // Hash da senha antes de salvar no banco de dados
            $this->senha = password_hash($this->senhaGerada, PASSWORD_DEFAULT);
            $dao->insert($this);

        } elseif (!empty($this->idPaciente) && $_SESSION["tipo_usuario"] == 'Pessoa') {
            $dao->updateUserPaciente($this);
        } else {
            $dao->update($this);
        }
   
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
            include_once 'App/DAO/PessoaDAO.php';
            $dao = new PessoaDAO();
            $obj = $dao->selectById($idPaciente);
        
            if ($obj) {
                $this->idPaciente = $obj->idPaciente;
                $this->nome = $obj->nome;
                $this->sobrenome = $obj->sobrenome;
                $this->cpf = $obj->cpf;
                $this->cep = $obj->cep;
                $this->estado = $obj->estado;
                $this->cidade = $obj->cidade;
                $this->rua = $obj->rua;
                $this->numero = $obj->numero;
                $this->PlanoSaude = $obj->PlanoSaude;
                $this->tipoPessoa = $obj->tipoPessoa;
                $this->senha = $obj->senha;
                $this->descricao = $obj->descricao;
                $this->medico_CRM = $obj->medico_CRM;
                $this->medico_id = $obj->medico_id;
                $this->rows = $obj->rows;


                return $this;
            }
        }


  
        public function saveDescription()
        {
            include 'App/DAO/PessoaDAO.php';
            $dao = new PessoaDAO();
            $dao->insertDescription($this);


        }

    }
      
    
?>