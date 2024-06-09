<?php 
class MedicamentoController{




public static function form()
{
    include 'App/View/modules/Medicação/CadastrarMedicacao.php';
}



public static function Sintomas()
{
    include_once 'App/Model/MedicamentoModel.php';

  

    
    $modelM = new MedicamentoModel();
    $modelM->getAllSintomas();
    include 'App/view/modules/Pessoa/Sintomas.php';
}



public static function save()
{
    include 'App/Model/MedicamentoModel.php';
    $model = new MedicamentoModel();
    $model->nomeMedicamento = $_POST['nomeMedicamento'];
    $model->fabricante = $_POST['fabricante'];
    $model->tipo = $_POST['tipo'];
    $model->uso = $_POST['uso'];


    $model->save();

    header("Location: /telaM");

   
}

public static function formConsulta()
{
    include 'App/View/modules/Pessoa/consultar.php';
}



public static function Consulta()
{
    include 'App/Model/MedicamentoModel.php';
    $model = new MedicamentoModel();
    if (isset($_POST['cpf'])) {
        // Atribui o valor do campo 'cpf' à propriedade 'parametro' do modelo
        $model->parametro = $_POST['cpf'];

        // Realiza a consulta utilizando o método 'consulta' do modelo
        $model->consulta();

        // Inclui a view ConsultarP.php, passando os resultados das consultas
        $results = [
            'result' => $model->result,
            'sintomas' => $model->sintomas
        ];

        include 'App/View/modules/Pessoa/consultap.php';
    } else {
        // Se o campo 'cpf' não foi enviado através do método POST, exibe uma mensagem de erro
        echo "O campo 'cpf' não foi enviado através do formulário.";
    }
}
}

?>