<?php

require_once('../vendor/autoload.php');

include('verify.php');

use App\DbMysql\DbMysql;

$exporte = (new DbMysql('alunos'))->select("VERIFICA = 'valido' AND MIGRA = 'NAOMIGRADO'");

?>

<!DOCTYPE html>
<html lang="pt-br">

<?php include('../gestor/includes/_head.php') ?>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><img src='../assets/imgs/logo-responsivo.png' width="130"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">


                    <li><span><a href="sair.php" class="nav-link btnDaNav">Sair <i class="bi bi-box-arrow-right"></i> </a></span></li>
                    <li>
                        <span><a href="index.php" class="nav-link btnDaNav"> Voltar </a></span>
                    </li>
                </ul>
                <span>
                    <b>
                        <?= $nome . ' | (Matrícula: ' . $ra . ') ' ?>
                    </b>
                </span>
            </div>
        </div>
    </nav>


    <div class="container">
        <div class="row">

            <div class="mb-3 mt-4">
                <input type="text" id='nome' placeholder="Nome, RA ou Curso" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>


            <div id='resposta'>

            </div>

        </div>
    </div>



    <script src="../assets/js/jquery.min.js"></script>

    <script>
        $('#nome').keyup(function(e) {
            var nome = $(this).val();
            $.post('../data/nomeAluno.php', {
                'nome': nome
            }, function(data) {
                $('#resposta').html(data);
            })
        })
    </script>


</body>

</html>