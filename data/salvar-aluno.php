<?php

session_start();

require_once('../vendor/autoload.php');

date_default_timezone_set("America/Sao_Paulo");

use App\DbMysql\DbMysql;
use App\Upload\Upload;
use App\DbSqlServer\DbSqlServer;

$cpf = filter_var($_POST['cpf-two'], FILTER_SANITIZE_ADD_SLASHES);
$nome = filter_var($_POST['nome'], FILTER_SANITIZE_ADD_SLASHES);
$curso = filter_var($_POST['curso'], FILTER_SANITIZE_ADD_SLASHES);
$ra = filter_var($_POST['ra'], FILTER_SANITIZE_ADD_SLASHES);

$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ? $_POST['email'] : '';

$res = (new DbSqlServer())->selectValidaCpf($cpf);
$linha = $res->fetch(PDO::FETCH_ASSOC);

$email = empty($email) ? $linha['EMAIL'] : $email;

$filePost = $_FILES['file'];

$arquivo = Upload::uploadAluno($filePost, $ra);

// ===============================

$validade = (new DbSqlServer())->ValidadeCarteirinha($ra);

$linhaValidade = $validade->fetch(PDO::FETCH_ASSOC);;

// ================================

$InsertAluno = new DbMysql("alunos");

$InsertAluno->insert([
    'NOME' => $nome,
    'EMAIL' => $email,
    'CURSO' => $curso,
    'CPF' => $cpf,
    'IMG' => $arquivo,
    'RA' => $ra,
    'DATAHORA' => date('Y-m-d H:i:s'),
    'VERIFICA' => 'analise',
    'MIGRA' => 'NAOMIGRADO',
    'VALIDADE' => $linhaValidade['Final'],
]);

$_SESSION['envio_certo'] = true;
header('Location: ../index.php');
