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

    <!-- Bootstrap core CSS -->
    <link href="<?=$u->path?>/assets/css/bootstrap.min.css" rel="stylesheet">
    <meta name="theme-color" content="#563d7c">
    <link href="<?=$u->path?>/assets/css/forms.css" rel="stylesheet">
</head>


<body>
    <form class="form-signin">
        <div class="text-center mb-4">
            <a href="./"><img class="mb-4" src="<?=$u->path?>/assets/img/lightbulb.svg" alt="" width="72" height="72"></a>
            <h1 class="h3 mb-3 font-weight-normal">Cadastro do Usuário</h1>
        </div>

        <div class="input-group">
            <div class="form-label-group col-md-6 p0-l">
                <input type="text" id="nome" class="form-control" placeholder="Nome" required autofocus minlength="4">
                <label for="nome">Nome</label>
            </div>
            <div class="form-label-group col-md-6 p0-r p0-l">
                <input type="text" id="sobrenome" class="form-control" placeholder="Nome" required autofocus minlength="4">
                <label for="sobrenome">Sobrenome</label>
            </div>
        </div>

        <div class="form-label-group">
            <input type="email" id="email" class="form-control" placeholder="Email" required autofocus>
            <label for="email">Email</label>
        </div>

        <div class="form-label-group">
            <input type="password" id="senha" class="form-control" placeholder="Senha" required minlength="4">
            <label for="senha">Senha</label>
        </div>

        <div class="form-label-group">
            <input type="password" id="senhacf" class="form-control" placeholder="Confirme a senha" required minlength="4" oninput="check(this)">
            <label for="senha" id="lblcf">Confirme a senha</label>
        </div>
        <div id="msgbox">
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Registrar</button>
        <p class="mt-5 mb-3 text-muted text-center">Christopher Neves - 20180042677 - IoT 2020.6<br>
        Ícones obtidos de <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> em <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></p>
    </form>
</body>
<script src="<?=$u->path?>/assets/js/jquery-3.5.1.min.js"></script>
<script src="<?=$u->path?>/assets/js/bootstrap.min.js"></script>
<script src="<?=$u->path?>/assets/js/reg.js"></script>
</html>