<?php 
include_once 'App/DAO/PessoaDAO.php';
class MedicamentoDAO extends PessoaDAO
{
    public function __construct()
    {
        parent ::__construct();

    }


    public function selectM()
    {
        $sql = "SELECT * FROM medicamentosconsulta;";

        $stmt = $this->conexao->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO:: FETCH_CLASS);


    }

    public function selectPM($id_paciente)
    {
        $sql = "SELECT m.nomeMedicamento, m.tipo, m.uso, p.dosagem, p.instrucao,  p.data_prescricao , p.id_paciente FROM medicamentosconsulta m  JOIN prescricao p ON m.idMedicamento = p.id_medicamentosconsulta INNER JOIN paciente pa ON  p.id_paciente = pa.idPaciente WHERE p.id_paciente = ? ;";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id_paciente, PDO::PARAM_STR);
        $stmt->execute();


        return $stmt->fetchAll(PDO:: FETCH_CLASS);


    }




    public function Consultar_Paciente($parametro)
    {   
        try {
            // Primeira consulta utilizando uma stored procedure
            $sql1 = "CALL consultar_medicacao(?)";
            $stmt1 = $this->conexao->prepare($sql1);
            $stmt1->bindParam(1, $parametro, PDO::PARAM_STR);
            $stmt1->execute();
            $result1 = $stmt1->fetchAll(PDO::FETCH_CLASS);
            $stmt1->closeCursor(); // Libera os resultados da primeira consulta

            // Segunda consulta utilizando uma query direta
            $sql2 = "
                SELECT s.id_paciente, p.nome, s.descricao, s.data_descricao
                FROM paciente p
                JOIN efeitoscolaterais s ON p.idPaciente = s.id_paciente
                WHERE p.cpf = ?";
            $stmt2 = $this->conexao->prepare($sql2);
            $stmt2->bindParam(1, $parametro, PDO::PARAM_STR);
            $stmt2->execute();
            $result2 = $stmt2->fetchAll(PDO::FETCH_CLASS);

            // Retorna ambos os conjuntos de resultados como um array associativo
            return [
                'medicacao' => $result1,
                'efeitoscolaterais' => $result2
            ];
        } catch(PDOException $e) {
            return "Erro ao chamar as consultas: ". $e->getMessage();
        }
    }
}


?>