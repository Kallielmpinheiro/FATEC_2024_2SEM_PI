<?php


include 'App/Controller/PessoaController.php'; 
include 'App/Controller/MedicamentoController.php';
include 'App/Controller/PrescricaoController.php';
include 'App/Controller/LoginController.php';
include_once 'App/Service/Auth.php';



$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);



switch ($url) {
    // Rotas de Login
    case '/form/login':
        LoginController::form();
        break;

    case '/login':
        LoginController::Autenticar();
        break;

    case '/logout':
        LoginController::logout();
        break;

    // Rotas protegidas - CadastroPaciente

    case '/pessoa/form':

        Auth::verificarTipoUsuario('Funcionario');
  
        PessoaController::form();
    break;

    case '/pessoa/form/save':

        Auth::verificarTipoUsuario('Funcionario');

        PessoaController::save();
    break;

    // Telas
    case '/':
        PessoaController::telaIncial();
        break;

    case '/telaP':

        Auth::verificarTipoUsuario('Pessoa');
 
        PessoaController::HomePaciente();
    break;

    case '/paciente':

            Auth::verificarTipoUsuario('Pessoa');
     
            PessoaController::saveDescription();
    break;


    case '/medicamento/Sintomas':

        Auth::verificarTipoUsuario('Medico');
 
        MedicamentoController::Sintomas();
    break;

    case '/telaF':

            Auth::verificarTipoUsuario('Funcionario');
         
            PessoaController::HomeFuncionario();
    break;

    case '/ConsultarPaciente':

        Auth::verificarTipoUsuario('Funcionario');
     
        PessoaController::ConsultarUser();
    break;


    

    case '/telaM':

        Auth::verificarTipoUsuario('Medico');

        PessoaController::HomeMedico();
    break;

    case '/medicamento/formConsulta':

        Auth::verificarTipoUsuario('Medico');
      
        MedicamentoController::formConsulta();
        break;

    case '/medicamento/Consultar':

        Auth::verificarTipoUsuario('Medico');
      
        MedicamentoController::Consulta();
        break;

    case '/medicamento/form':

        Auth::verificarTipoUsuario('Medico');
    
        MedicamentoController::form();
        break;

    case '/medicamento/form/save':
   
        Auth::verificarTipoUsuario('Medico');
        MedicamentoController::save();
        break;

    // Rotas protegidas - Prescrição
    case '/prescricao/form':
       
        Auth::verificarTipoUsuario('Medico');
        PrescricaoController::form();
        break;

    case '/prescricao/form/save':
      
        Auth::verificarTipoUsuario('Medico');
        PrescricaoController::save();
        break;

    // Rota padrão (404)
    default:
        header("HTTP/1.0 404 Not Found");
        echo "Erro 404";
        break;
}
?>