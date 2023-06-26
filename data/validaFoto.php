<?php

require_once("../vendor/autoload.php");

use App\DbMysql\DbMysql;

@$vall = $_POST['vall'];
@$invall = $_POST['invall'];
$registro = $_POST['res'];

date_default_timezone_set("America/Sao_Paulo");

$dado = (new DbMysql('alunos'))->select("REGISTRO = $registro");
$linha = $dado->fetch(PDO::FETCH_ASSOC);

$img = $linha['IMG'];

if (isset($vall)) {
    (new DbMysql('alunos'))->update(
        "REGISTRO = $registro",
        [
            'DATAHORA' => date('Y-m-d H:i:s'),
            'VERIFICA' => 'valido',
        ]
    );

    echo 'Usuario valido';
} else if (isset($invall)) {
    (new DbMysql('alunos'))->update(
        "REGISTRO = $registro",
        [
            'DATAHORA' => date('Y-m-d H:i:s'),
            'VERIFICA' => 'invalido',
        ]
    );

    copy("uploadAluno/$img", 'invalidos/' . $img);

    echo 'Usuario invalido';
}
