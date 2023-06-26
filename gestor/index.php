<?php

require_once('../vendor/autoload.php');

include('verify.php');

use App\DbMysql\DbMysql;

$exporte = (new DbMysql('alunos'))->select("VERIFICA = 'valido' AND MIGRA = 'NAOMIGRADO'");

?>

<!DOCTYPE html>
<html lang="pt-br">

<?php include('includes/_head.php') ?>

<body>

    <?php include('includes/_nav.php') ?>


    <?php //include("../data/selectAluno.php");
    ?>

    <div id="resposta"></div>

    <script src="../assets/js/jquery.min.js"></script>

    <script>
        function att() {
            $(document).ready(function() {
                $.ajax({
                    url: "../data/selectAluno.php",
                    method: "POST",
                    success: function(data) {
                        $('#resposta').html(data);
                    }
                })
            })
        }

        setInterval("att()", 1000)
    </script>

    <script>
        function verNum() {
            $(document).ready(function() {
                $.ajax({
                    url: "../data/verNum.php",
                    method: "POST",
                    success: function(data) {
                        $('#verNum').html(data);
                    }
                })
            })
        }

        setInterval("verNum()", 1000)
    </script>

    <script>
        function valido(registro) {

            var vall = document.getElementById('vall').value;
            var res = registro;

            $.ajax({
                type: 'POST',
                dataType: 'html',
                url: '../data/validaFoto.php',

                //Dados para envio
                data: {
                    vall,
                    res
                },

                //função que será executada quando a solicitação for finalizada.
                success: function(msg) {
                    // $("#resposta").html(msg);
                    console.log(msg)
                }
            });

        }

        function invalido(registro) {

            var invall = document.getElementById('invall').value;
            var res = registro;

            $.ajax({
                type: 'POST',
                dataType: 'html',
                url: '../data/validaFoto.php',

                //Dados para envio
                data: {
                    invall,
                    res
                },

                //função que será executada quando a solicitação for finalizada.
                success: function(msg) {
                    // $("#resposta").html(msg);
                    console.log(msg)
                }
            });

        }
    </script>
</body>

</html>