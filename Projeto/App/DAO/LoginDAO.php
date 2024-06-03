<?php
include 'App/DAO/PessoaDAO.php';
include_once 'App/Service/Auth.php';

class LoginDAO extends PessoaDAO
{
    private $result;

    public function __construct()
    {
        parent::__construct();
    }
    public function validacao(LoginModel $model)
    {
        $tipo = $model->tipo;
        $sql = "";
        $redirect = "";
    
        if ($tipo == 'Pessoa') {
            $sql = "SELECT p.idPaciente as id, p.nome, p.cpf, p.senha FROM paciente p WHERE p.cpf = ? AND p.senha = ?";
            $_SESSION["tipo_usuario"] = 'Pessoa';
            $redirect = "/telaP";
        } elseif ($tipo == 'Medico') {
            $sql = "SELECT m.id as id, m.nome, m.cpf, m.senha FROM medico m WHERE m.cpf = ? AND m.senha = ?";
            $_SESSION["tipo_usuario"] = 'Medico';
            $redirect = "/telaM";
            
        } elseif($tipo == 'Funcionario'){
            $sql = "SELECT f.idFuncionario,f.nome,f.cpf,f.senha from funcionarios f where f.cpf = ? and f.senha = ?";
            $_SESSION["tipo_usuario"] = 'Funcionario';
            $redirect = "/telaF";
        }
    
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $model->cpf);
        $stmt->bindValue(2, $model->senha);
        $stmt->execute();
        $this->result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if(Auth::iniciarSessao($this->result, $tipo)) {
            header("location: $redirect");
        } else {
        
            header("location: /form/login");
        }
    }


}