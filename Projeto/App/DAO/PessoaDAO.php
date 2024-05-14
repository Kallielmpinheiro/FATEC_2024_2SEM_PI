<?php 

    class PessoaDAO
    {

        protected $conexao;
        public function __construct()
        {
            $dsn = "mysql:host=localhost:3306;dbname=bdclinicapi";

            $this->conexao = new PDO($dsn, 'root','');

        }
        public function insert(PessoaModel $model)
        {
            #essa string sql vai ser processada, um preparo pra ser executada, evitando injeção de sql
            $sql = "INSERT INTO paciente(nome, sobrenome, cpf, cep, estado, cidade, rua, numero, plano_saude, tipo_Usuario, senha) Values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(1, $model->nome);
            $stmt->bindValue(2, $model->sobrenome);
            $stmt->bindValue(3, $model->cpf);
            $stmt->bindValue(4, $model->cep);
            $stmt->bindValue(5, $model->estado);
            $stmt->bindValue(6, $model->cidade);
            $stmt->bindValue(7, $model->rua);
            $stmt->bindValue(8, $model->numero);
            $stmt->bindValue(9, $model->plano_saude);
            $stmt->bindValue(10, $model->tipo_usuario);
            $stmt->bindValue(11, $model->senha);

            $stmt->execute();
            
        }

        public function update(PessoaModel $model)
        {
            

            $sql = "UPDATE paciente SET nome = ?, sobrenome = ?, cpf =?, cep = ?, estado = ?, cidade = ?, rua = ?, numero = ?, plano_saude = ?, tipo_Usuario = ?, senha = ? where id = ? ";

            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(1, $model->nome);
            $stmt->bindValue(2, $model->sobrenome);
            $stmt->bindValue(3, $model->cpf);
            $stmt->bindValue(4, $model->cep);
            $stmt->bindValue(5, $model->estado);
            $stmt->bindValue(6, $model->cidade);
            $stmt->bindValue(7, $model->rua);
            $stmt->bindValue(8, $model->numero);
            $stmt->bindValue(9, $model->plano_saude);
            $stmt->bindValue(10, $model->tipo_usuario);
            $stmt->bindValue(11, $model->senha);
            $stmt->bindValue(12, $model->id);

            $stmt->execute();
        }

        public function select()
        {
            $sql = "SELECT * FROM paciente";

            $stmt = $this->conexao->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_CLASS);
        }

        public function delete(int $id)
        {
            $sql = "DELETE  FROM paciente where id = ?";

            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(1, $id);

            $stmt->execute();

        }

        public function selectById(int $id)
        {
            include_once 'App/Model/PessoaModel.php';
            $sql = "SELECT * FROM paciente where id = ?";

            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(1, $id);

            $stmt->execute();

            return $stmt->fetchObject("PessoaModel");
        }
    }
?>