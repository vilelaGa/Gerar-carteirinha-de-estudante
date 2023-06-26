<?php
session_start();

require_once("../vendor/autoload.php");

@$vall = base64_decode($_GET['vall']);

$matricula = empty($vall) ? die('error') : $vall;

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reenvio</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../assets/styles/app.css">
</head>

<body>

    <div>
        <nav class="navbar navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="https://ubm.br" target="_blank"><img src="../assets/imgs/logo-responsivo.png" width="130"></a>
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
                if (isset($_SESSION['envio_certo_invalido'])) :
                ?>
                    <div class="form-floating">
                        <div class="alert alert-success" role="alert">
                            Solicitação realizada com sucesso.
                        </div>
                    </div>
                <?php endif;
                unset($_SESSION['envio_certo_invalido'])

                ?>

                <?php
                //retorno 
                if (isset($_SESSION['error_invalido'])) :
                ?>
                    <div class="form-floating">
                        <div class="alert alert-danger" role="alert">
                            Solicitação em análise.
                        </div>
                    </div>
                <?php endif;
                unset($_SESSION['error_invalido'])

                ?>
                <div class="tudo">
                    <form onsubmit='subForm()' action='../data/invalido.php' method='POST' enctype='multipart/form-data'>
                        <input type="hidden" value='<?= $matricula ?>' name='mat'>
                        <div class='mb-3 inputUpload'>
                            <label class='form-label text-start'><b>Insira a nova foto 4x3: </b><span class='text-danger'>*</span> <span>(jpeg ou png) | Máx: 1MB </span></label>
                            <input class='form-control' onchange='validaSize(), validaType()' type='file' name='file' id='file' accept='image/png, image/jpeg' required>
                            <div id='resposta-upload-invalido'></div>
                        </div>

                        <center>
                            <button type='submit' id='btn_enviar_invalido' disabled class='mt-4 btn btn-primary btnEnviar'>Enviar</button>
                        </center>
                    </form>

                </div>
                <div class="col-md-1"></div>
            </div>
        </div>

        <script src="../assets/js/jquery.min.js"></script>


        <script>
            function validaType() {
                var upload = document.getElementById('file');

                const type = upload.files[0].type;

                if ((type != 'image/png') && (type != 'image/jpeg')) {
                    document.getElementById('btn_enviar_invalido').disabled = true;
                    alert('Tipo do arquivo inválido'); //Acima do limite
                } else {
                    document.getElementById('btn_enviar_invalido').disabled = false;
                }

            }

            function validaSize() {
                var upload = document.getElementById('file');
                var size = upload.files[0].size;
                if (size < 1048576) { //1MB      
                    document.getElementById('btn_enviar_invalido').disabled = false;
                } else {
                    document.getElementById('btn_enviar_invalido').disabled = true;
                    alert('Arquivo excedeu o limite de 1MB'); //Acima do limite
                    upload.value = ''; //Limpa o campo          
                }
            }

            function subForm() {
                document.getElementById('btn_enviar_invalido').disabled = true;
            }
        </script>

</body>

</html>