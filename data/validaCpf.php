<?php
session_start();

require_once "../vendor/autoload.php";

use App\DbSqlServer\DbSqlServer;
use App\DbMysql\DbMysql;
use App\DbCarteirinha\DbCarteirinha;
use App\Funcoes\Funcoes;

$danger = '<div class="alert alert-danger" role="alert">
CPF inválido
</div>';

$notMatriculado = '<div class="alert alert-danger" role="alert">
Não matriculado, favor procurar a Central de Atendimento ao Aluno
</div>';

$jaCadastrado = '<div class="alert alert-success" role="alert">
Solicitação da carteirinha realizada com sucesso
</div>';

$JaTemCarteira = '<div class="alert alert-danger" role="alert">
Você já possui carteirinha, caso isso seja um engano favor entrar contato com e-mail <b>arthur.correa@ubm.br</b>
</div>';

$cpf = filter_var($_POST['cpf'], FILTER_SANITIZE_ADD_SLASHES);

$replace = str_replace(array('.', '-'), '', $cpf);

$replace = !is_numeric($replace) ? die($danger) : $replace;

if (Funcoes::validCPF($replace) === true) {
    // echo "<strong class='valido'>CPF Valido</strong>";
} else {
    die($danger);
}

// die($replace);

$selectMysql = (new DbMysql('alunos'))->select("CPF = '$replace'");

if ($selectMysql->rowCount() == 0) {

    $res = (new DbSqlServer())->selectValidaCpf($replace);

    if ($res->rowCount() != 0) {

        $_SESSION['usertoken'] = $replace;

        $fetchCPF = $res->fetch(PDO::FETCH_ASSOC);

        extract($fetchCPF);

        $validaCateira = (new DbCarteirinha())->selectValidaCarteirinha($replace, $RA);

        $linhaCarteira = $validaCateira->fetch(PDO::FETCH_ASSOC);

        if (@$linhaCarteira['IDENTIFICADOR'] === NULL) {
            echo "
            
            <script>
            document.getElementById('btnEnviar').disabled = true;
             </script>
        <form onsubmit='subForm()' action='data/salvar-aluno.php' method='POST' enctype='multipart/form-data'>
        <div class='row'>
        <div class='col-md-6'>
            <input type='hidden' name='cpf-two' value='$replace'>
            <div class='mb-3'>
                <label>Nome:<span class='text-danger'>*</span></label>
                <input class='form-control' name='nome' value='$NOME' readonly='readonly'>
            </div>
            <div class='mb-3'>
                <label>Curso:<span class='text-danger'>*</span></label>
                <input class='form-control' name='curso' value='$CURSO' readonly='readonly'>
            </div>
        </div>
        <div class='col-md-6'>
            <div class='mb-3'>
                <label>Ra:<span class='text-danger'>*</span></label>
                <input class='form-control' name='ra' value='$RA' readonly='readonly'>
            </div>
            <div class='mb-3'>
                <label>Email: <span class='text-danger'>*</span></label>
                <input type='email' class='form-control' name='email' required placeholder='Insira seu email'>
            </div>
        </div>
        </div>
        
        <div class='mb-3 inputUpload'>
        <label class='form-label text-start'><b>Insira uma foto 4x3:</b><span class='text-danger'>*</span> <span>(jpeg ou png) | Máx: 1MB </span></label>
        <input class='form-control' onchange='validaSize(), validaType()' type='file' name='file' id='file' accept='image/png, image/jpeg' required>
        <div id='resposta-upload'></div>
        
        </div>
        <center>
        <button type='submit' id='btnEnviar' disable class='mt-4 btn btn-primary btnEnviar'>Enviar</button>
        </center>
        </form>
        ";
        } else if ($linhaCarteira['IDENTIFICADOR'] !== NULL) {
            echo $JaTemCarteira;
        }
    } else {

        echo $notMatriculado;
    }
} else {
    echo $jaCadastrado;
}
