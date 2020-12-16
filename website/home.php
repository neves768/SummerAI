<?php
    require_once("sys/user.php");
    $u = new \Nev\User();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="SummerAI">
    <meta name="author" content="A base VISUAL do sistema foi construida por Mark Otto, Jacob Thornton e contribuidores do Bootstrap">
    <title>Summer AI</title>

    <link href="<?=$u->path?>/assets/css/bootstrap.min.css" rel="stylesheet">
    <meta name="theme-color" content="#563d7c">

    <link href="<?=$u->path?>/assets/css/offcanvas.css" rel="stylesheet">
</head>

<body class="bg-light">

    <main role="main" class="container">
        <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-black rounded shadow-sm">
            <a href="./"><img class="mr-3" src="<?=$u->path?>/assets/img/lightbulb.svg" alt="" width="48" height="48"></a>
            <div class="lh-100">
                <h6 class="mb-0 text-white lh-100">SummerAI Simplificada</h6>
                <small>Olá <?=$u->udata->nome?>, seja bem-vindo.</small>
            </div>
            <div class="lh-100 ml-auto">
                <a href="<?=$u->path?>/?a=1">Sair &times;</a>
            </div>
        </div>

        <div class="my-3 p-3 bg-white rounded shadow-sm">
            <h6 class="border-bottom border-gray pb-2 mb-0">Suas lâmpadas</h6>
            <div id="lampadas" style="overflow: hidden scroll; max-height: 400px;">
                
            </div>
            <small class="d-block text-right mt-3">
                <a href="#" data-toggle="modal" data-target="#deviceAdd">Adicionar Dispositivo</a>
            </small>
        </div>

        <div class="my-3 p-3 bg-white rounded shadow-sm">
            <h6 class="border-bottom border-gray pb-2 mb-0">Funcionalidades</h6>
            <div class="media text-muted pt-3">
                <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg"
                    preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
                    <title>Placeholder</title>
                    <rect width="100%" height="100%" fill="#007bff" /><text x="50%" y="50%" fill="#007bff"
                        dy=".3em">32x32</text>
                </svg>
                <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <strong class="text-gray-dark">Tempo</strong>
                        <a href="#">Natal, RN</a>
                    </div>
                    <span class="d-block">Experimente dizer "Summer, qual é o tempo de hoje?"</span>
                </div>
            </div>
            <div class="media text-muted pt-3">
                <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg"
                    preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
                    <title>Placeholder</title>
                    <rect width="100%" height="100%" fill="#007bff" /><text x="50%" y="50%" fill="#007bff"
                        dy=".3em">32x32</text>
                </svg>
                <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <strong class="text-gray-dark">Dispositivos</strong>
                        <a href="#">-</a>
                    </div>
                    <span class="d-block">Experimente dizer "Summer, ligue a Lâmpada da Sala"</span>
                </div>
            </div>
            <small class="d-block text-right mt-3">
                <a href="#">Mais funcionalidades em breve</a>
            </small>
        </div>
    </main>
    <p class="mt-5 mb-3 text-muted text-center">Christopher Neves - 20180042677 - IoT 2020.6<br>
        Ícones obtidos de <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> em <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a>
    </p>
    <div class="modal fade" id="deviceAdd" tabindex="-1" role="dialog" aria-labelledby="deviceAddt" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Adicionar Dispositivo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="devicename">Defina o nome do dispositivo</label>
                            <input type="text" class="form-control" id="devicename" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="deviceID">Escolha o tipo de dispositivo</label>
                            <select class="form-control" id="deviceID">
                            <option value="1">Lâmpada</option>
                            <option value="2">Televisão</option>
                            <option value="3">Computador</option>
                            </select>
                        </div>
                    </form>
                    <div id="daddmsgbox">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" id="addDevicebtn">Adicionar</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="<?=$u->path?>/assets/js/jquery-3.5.1.min.js"></script>
<script src="<?=$u->path?>/assets/js/bootstrap.min.js"></script>
<script src="/docs/4.5/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
    crossorigin="anonymous"></script>
<script src="<?=$u->path?>/assets/js/offcanvas.js"></script>
<script src="<?=$u->path?>/assets/js/lamps.js"></script>

</html>