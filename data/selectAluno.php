<?php

require_once("../vendor/autoload.php");

use App\DbMysql\DbMysql;

$var = (new DbMysql('alunos'))->select("VERIFICA = 'analise'");


if ($var->rowCount() != 0) {
  $res = $var->fetchAll(PDO::FETCH_ASSOC);
  $total = $var->rowCount();
  echo "
<div class='container mt-4'>
<div class='row m-0 p-0'>
<p>Total para validar: <b>$total</b></p>
";
  foreach ($res as $linha) {

    extract($linha);

    $nomeLower = mb_strtolower($NOME);
    $NOME = ucfirst($nomeLower);

    $cursoLower = mb_strtolower($CURSO);
    $CURSO = ucfirst($cursoLower);

    echo "

    <div class='card mb-3' style='max-width: 355px; padding: 12px; margin: 8px;'>
  <div class='row g-0'>
    <div class='col-md-3'>
      <img src='../data/uploadAluno/$IMG' class='img-fluid rounded-start' alt='...'>
    </div>
    <div class='col-md-9'>
      <div class='card-body'>
        <span class='card-title'><b>$NOME</b></span><br>
        <span class='card-title'>$CURSO - $RA</span><br>
        <span class='card-title'>Validade: <b>$VALIDADE</b></span><br><br>
        <button type='button' title='Aluno valido' class='btn btn-success' id='vall' value='valido' onclick='valido($REGISTRO)'><i class='bi bi-check-lg'></i></button>
        <button type='button' title='Aluno inválido' class='btn btn-danger' id='invall' value='invalido' onclick='invalido($REGISTRO)'><i class='bi bi-exclamation-triangle'></i></button><br>
      </div>
    </div>
  </div>
</div>


    
    ";
  }
  echo "</div>
</div>";
} else {
  echo "
  <div class='container mt-5'>
  <div class='row'>
  <h4>Nenhuma solicitação no momento</h4>
  </div>
  </div>
  ";
}
