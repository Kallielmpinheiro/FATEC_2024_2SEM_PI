<?php 
include_once('PessoaModel.php');
class MedicamentoModel
{
    public $result;
    public $sintomas;
    public $parametro;
    public $rows;
    public $nomeMedicamento, $fabricante, $tipo, $uso;
    
    public function consulta()
    {
        include 'App/DAO/MedicamentoDAO.php';
        $dao = new MedicamentoDAO();

        // Chama o método para realizar ambas as consultas
        $resultados = $dao->Consultar_Paciente($this->parametro);

        // Verifica se o retorno é um array
        if (is_array($resultados)) {
            // Armazena os resultados nas propriedades do modelo
            $this->result = $resultados['medicacao'];
            $this->sintomas = $resultados['efeitoscolaterais'];
        } else {
            echo $resultados; // Imprime a mensagem de erro retornada
        }
    }


    


    public function getAllRows()
       {
        include 'App/DAO/MedicamentoDAO.php';
        $dao = new MedicamentoDAO();

        $this->rows = $dao->selectM();
   

       }


       public function getAllPMRows($id_paciente)
       {
        include 'App/DAO/MedicamentoDAO.php';
        $dao = new MedicamentoDAO();

        $this->rows = $dao->selectPM($id_paciente);

       }

       
}

?>