<?php 
include_once('PessoaModel.php');
class MedicamentoModel
{
    public $result;
    public $parametro;
    public $rows;
    public $nomeMedicamento, $fabricante, $tipo, $uso;
    
    public function save()
    {
        include 'App/DAO/MedicamentoDAO.php';
        $dao = new MedicamentoDao();
        $dao->InsertMedication($this);

    }

    public function consulta()
    {
        include 'App/DAO/MedicamentoDAO.php';
        $dao = new MedicamentoDAO();
        $this->result = $dao->Consultar_Medicamento($this->parametro);

    }



    public function getAllRows()
       {
        include 'App/DAO/MedicamentoDAO.php';
        $dao = new MedicamentoDAO();

        $this->rows = $dao->select();

       }
}

?>