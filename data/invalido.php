<?php
session_start();

require_once("../vendor/autoload.php");

use App\DbMysql\DbMysql;
use App\Upload\Upload;

date_default_timezone_set("America/Sao_Paulo");

$matricula = filter_var($_POST['mat'], FILTER_SANITIZE_ADD_SLASHES);

$file = $_FILES['file'];

$vall = (new DbMysql('alunos'))->select("RA = '$matricula'");

$linha = $vall->fetch(PDO::FETCH_ASSOC);


if ($linha['VERIFICA'] === 'invalido') {

    $img = $linha['IMG'];
    $registro = $linha['REGISTRO'];

    $dirUpload = "uploadAluno/$img";
    $dirInvalido = "invalidos/$img";

    unlink($dirUpload);
    unlink($dirInvalido);

    $arquivo = Upload::uploadAluno($file, $matricula);

    (new DbMysql('alunos'))->update(
        "REGISTRO = $registro",
        [
            'IMG' => $arquivo,
            'DATAHORA' => date('Y-m-d H:i:s'),
            'VERIFICA' => 'analise',
            'ENVIAEMAIL' => 'NAOENVIADO'

        ]
    );

    $parametro = base64_encode($matricula);
    $_SESSION['envio_certo_invalido'] = true;
    header("Location: ../invalido/index.php?vall=$parametro");
} else {
    $parametro = base64_encode($matricula);
    $_SESSION['error_invalido'] = true;
    header("Location: ../invalido/index.php?vall=$parametro");
}
