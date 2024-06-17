<?php 
class MedicamentoController{




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