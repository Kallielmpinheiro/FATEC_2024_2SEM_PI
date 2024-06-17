<?php
    include 'App/DAO/PessoaDAO.php';
    class PrescricaoDAO extends PessoaDAO
    {
        public function __construct()
        {
            parent ::__construct();
        }

        public function PrescricaoMedica(PrescricaoModel $model)
        {
            try
            {
                $sql = "CALL prescrever_medicacao(?, ?, ?, ?, ?, ?)";
                $stmt = $this->conexao->prepare($sql);
                $stmt->bindParam(1, $model->cpf);
                $stmt->bindParam(2, $model->id_medicamentosconsulta);
                $stmt->bindParam(3, $model->dosagem);
                $stmt->bindParam(4, $model->instrucao);
                $stmt->bindParam(5, $model->duracao);
                $stmt->bindParam(6, $model->CRM);
                $stmt->execute();
        

                header("Location: /telaM");
                exit();
            } catch(PDOException $e)
            {
           
                echo "<script>alert('Erro ao chamar a procedure: " . $e->getMessage() . "');</script>";
                echo "<script>window.location.href='/prescricao/form';</script>";
                exit();
            }
        }
    }
?>