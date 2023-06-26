<?php
session_start();

require_once "vendor/autoload.php";

@$session = $_SESSION['usertoken'];

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="assets/styles/app.css">

    <title>UBM | Carteirinha</title>
</head>

<body>

    <!-- <script src="assets/js/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $('#cpf').keyup(function(e) {
            var cpf = $(this).val();
            $.post('data/validaCpf.php', {
                'cpf': cpf
            }, function(data) {
                $('#resposta').html(data);
            })
        })

        $(document).ready(function() {
            $('#cpf').mask('000.000.000-00')
        });
    </script> -->

    <div>
        <nav class="navbar navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="https://ubm.br" target="_blank"><img src="assets/imgs/logo-responsivo.png" width="130"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Suporte UBM</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="mailto:suporte@ubm.br">Email: suporte@ubm.br</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <div class="container navGeral">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">

                <?php
                //retorno 
                if (isset($_SESSION['envio_certo'])) :
                ?>
                    <div class="form-floating">
                        <div class="alert alert-success" role="alert">
                            Solicitação realizada com sucesso, favor buscar sua carteirinha após 10 dias úteis
                        </div>
                    </div>
                <?php endif;
                unset($_SESSION['envio_certo'])

                ?>
                <div class="tudo">
                    <h6>Digite seu CPF para realizar o cadastro:</h6>
                    <div class="mb-3">
                        <input class="form-control" id="cpf" placeholder="CPF" value="<?= isset($session) ? $session : '' ?>">
                    </div>

                    <div id="resposta">

                    </div>
                </div>

            </div>
            <div class="col-md-1"></div>
        </div>
    </div>

    <script src="assets/js/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $('#cpf').keyup(function(e) {
            var cpf = $(this).val();
            $.post('data/validaCpf.php', {
                'cpf': cpf
            }, function(data) {
                $('#resposta').html(data);
            })
        })

        $(document).ready(function() {
            $('#cpf').mask('000.000.000-00')
        });
    </script>

    <script>
        function validaType() {
            var upload = document.getElementById('file');

            const type = upload.files[0].type;

            if ((type != 'image/png') && (type != 'image/jpeg')) {
                document.getElementById('btnEnviar').disabled = true;
                alert('Tipo do arquivo inválido'); //Acima do limite
            } else {
                document.getElementById('btnEnviar').disabled = false;
            }

        }

        function validaSize() {
            var upload = document.getElementById('file');
            var size = upload.files[0].size;
            if (size < 1048576) { //1MB      
                document.getElementById('btnEnviar').disabled = false;
            } else {
                document.getElementById('btnEnviar').disabled = true;
                alert('Arquivo excedeu o limite de 1MB'); //Acima do limite
                upload.value = ''; //Limpa o campo          
            }
        }

        function subForm() {
            document.getElementById('btnEnviar').disabled = true;
        }
    </script>
</body>

</html>