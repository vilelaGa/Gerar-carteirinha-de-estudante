<?php

require_once("../vendor/autoload.php");

use App\DbMysql\DbMysql;
use App\Funcoes\Funcoes;

include('../gestor/verify.php');

header('Content-Type: text/csv; charset=utf-8');

date_default_timezone_set("America/Sao_Paulo");

$cabecalho = ['MATRICULA', 'NOME', 'CURSO', 'VALIDADE', 'FOTO'];

$var = (new DbMysql('alunos'))->select("VERIFICA = 'valido' AND MIGRA = 'NAOMIGRADO'");

if ($var->rowCount() != 0) {

    // =======================================================================

    $apagaArquivos = (new DbMysql('alunos'))->select("MIGRA = 'MIGRADO'");

    $linhaApagaArquivos = $apagaArquivos->fetchAll(PDO::FETCH_ASSOC);

    foreach ($linhaApagaArquivos as $dados) {
        $imgDel = $dados['IMG'];
        if (file_exists("validos/$imgDel")) {
            unlink("validos/$imgDel");
        }
    }

    @unlink('validos.zip');

    // =======================================================================

    $res = $var->fetchAll(PDO::FETCH_ASSOC);

    $arquivo = fopen('file.csv', 'w');
    fputcsv($arquivo, $cabecalho, ';');

    foreach ($res as $row) {

        $nomeIMG = $row['IMG'];

        $caminho = "uploadAluno/$nomeIMG";

        $arrayAlunos = [
            'RA' => $row['RA'],
            'NOME' => Funcoes::sanitizeString($row['NOME']),
            'CURSO' => Funcoes::sanitizeString($row['CURSO']),
            'VALIDADE' => $row['VALIDADE'],
            'IMG' => $nomeIMG
        ];

        fputcsv($arquivo, $arrayAlunos, ';');

        copy($caminho, 'validos/' . $nomeIMG);

        // unlink($caminho);

        $REGISTRO = $row['REGISTRO'];

        (new DbMysql('alunos'))->update(
            "REGISTRO = $REGISTRO",
            [
                'MIGRA' => 'MIGRADO',
                'DATAEXPORTE' => date('Y-m-d H:i:s'),
            ]
        );
    }
    copy('file.csv', 'validos/file.csv');

    unlink('file.csv');

    fclose($arquivo);

    $zip = new ZipArchive();
    $zip->open('validos.zip', ZipArchive::CREATE);
    $zip->addGlob('validos/*', GLOB_BRACE);

    $zip->close();

    echo "Arquivo ZIP criado com sucesso!";

    // ===============================================
    // Define o nome do arquivo a ser baixado
    $fileDownload = 'validos.zip';

    // Define o tipo de arquivo
    header('Content-Type: application/zip');

    // Define o tamanho do arquivo
    // header('Content-Length: ' . filesize($fileDownload));

    // Define o nome do arquivo como um anexo
    header('Content-Disposition: attachment; filename="' . $fileDownload . '"');

    // Lê o arquivo e o envia para o navegador
    readfile($fileDownload);
    // ===============================================
} else {
    echo 'Não existe dados';
}
