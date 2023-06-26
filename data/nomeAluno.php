<?php

require_once('../vendor/autoload.php');

use App\DbMysql\DbMysql;


$nome = $_POST['nome'];

$user = (new DbMysql('alunos'))->select("NOME LIKE '%$nome%' OR RA LIKE '%$nome%' OR CURSO LIKE '%$nome%'");


$linha = $user->fetchAll(PDO::FETCH_ASSOC);


// echo "<pre>";
// print_r($linha);
echo "
<div class='container mt-4'>
<div class='row'>";

foreach ($linha as $row) {

  extract($row);

  $nomeLower = mb_strtolower($NOME);
  $NOME = ucfirst($nomeLower);

  $cursoLower = mb_strtolower($CURSO);
  $CURSO = ucfirst($cursoLower);

  switch ($MIGRA) {
    case 'MIGRADO':
      $MIGRA = '<b class="text-success">MIGRADO</b>';
      break;
    case 'NAOMIGRADO':
      $MIGRA = '<b class="text-secondary">NÃO MIGRADO</b>';
      break;
  }

  switch ($VERIFICA) {
    case 'analise':
      $VERIFICA = '<b class="text-secondary">ANÁLISE</b>';
      break;
    case 'valido':
      $VERIFICA = '<b class="text-success">VALIDO</b>';
      break;
    case 'invalido':
      $VERIFICA = '<b class="text-danger">INVÁLIDO</b>';
      break;
  }

  switch ($ENVIAEMAIL) {
    case 'ENVIADO':
      $ENVIAEMAIL = '<b class="text-success">ENVIADO</b>';
      break;
    case 'NAOENVIADO':
      $ENVIAEMAIL = '<b class="text-secondary">NÃO ENVIADO</b>';
      break;
  }

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
        <span class='card-title'>Verificação: $VERIFICA</span><br>
        <span class='card-title'>Migração: $MIGRA</span><br>
        <span class='card-title'>E-mail: $ENVIAEMAIL</span>

      </div>
    </div>
  </div>
</div>


    ";
}

echo "</div>
</div>";
