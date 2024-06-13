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

        // Define a consulta SQL com base no tipo de usuário
        if ($tipo == 'Pessoa') {
            $sql = "SELECT p.idPaciente as id, p.nome, p.cpf, p.senha FROM paciente p WHERE p.cpf = ?";
            $_SESSION["tipo_usuario"] = 'Pessoa';
            $redirect = "/telaP";
        } elseif ($tipo == 'Medico') {
            $sql = "SELECT m.id as id, m.nome, m.cpf, m.senha FROM medico m WHERE m.cpf = ?";
            $_SESSION["tipo_usuario"] = 'Medico';
            $redirect = "/telaM";
        } elseif ($tipo == 'Funcionario') {
            $sql = "SELECT f.idFuncionario, f.nome, f.cpf, f.senha FROM funcionarios f WHERE f.cpf = ?";
            $_SESSION["tipo_usuario"] = 'Funcionario';
            $redirect = "/telaF";
        }

        // Prepara a consulta SQL
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $model->cpf);
        $stmt->execute();
        $this->result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica a autenticação
        $this->handleAuthentication($model->senha, $redirect);
    }




    private function handleAuthentication($senhaDigitada, $redirect)
    {
        // Verifica se encontrou um usuário com o CPF fornecido
        if ($this->result) {
            // Verifica se a senha fornecida corresponde ao hash armazenado no banco de dados
            if (password_verify($senhaDigitada, $this->result['senha'])) {

                
                if (Auth::iniciarSessao($this->result, $_SESSION["tipo_usuario"])) {
                    // Redireciona para a página correspondente ao tipo de usuário
                    header("Location: $redirect");
                    exit();
                } else {
                    // Se não conseguir iniciar a sessão, redireciona para o formulário de login
                    header("Location: /form/login");
                    exit();
                }
            } else {
                // Se a senha não corresponder, redireciona para o formulário de login com erro de senha incorreta
                header("Location: /form/login?error=senha_incorreta");
                exit();
            }
        } else {
            // Se não encontrar nenhum usuário com o CPF fornecido, redireciona para o formulário de login com erro de usuário não encontrado
            header("Location: /form/login?error=usuario_nao_encontrado");
            exit();
        }
    }
}
?>