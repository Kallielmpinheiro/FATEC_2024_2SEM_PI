<?php 
include_once 'App/DAO/PessoaDAO.php';
class MedicamentoDAO extends PessoaDAO
{
    public function __construct()
    {
        parent ::__construct();

    }

    public function InsertMedication(MedicamentoModel $model)
    {   
        $sql = "INSERT INTO medicamentosconsulta (nomeMedicamento, fabricante, tipo, uso) VALUES(?, ?, ?, ?)"; 

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $model->nomeMedicamento);
        $stmt->bindValue(2, $model->fabricante);
        $stmt->bindValue(3, $model->tipo);
        $stmt->bindValue(4, $model->uso);


        $stmt->execute();
    }

    public function select()
    {
        $sql = "SELECT * FROM medicamentosconsulta;";

        $stmt = $this->conexao->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO:: FETCH_CLASS);


    }

    public function Consultar_Medicamento($parametro)
    {   

        try
        {
        $sql = "CALL consultar_medicacao($parametro)";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();

        } catch(PDOException $e)
        {
            return "Erro ao chamar a procedure: ". $e->getMessage();
        }

        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    
}


?>