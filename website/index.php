<?php
    require_once("sys/user.php");
    $u = new \Nev\User();
    if(isset($_GET["a"])){
        $u->logOut();
    }
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
            <img class="mb-4" src="<?=$u->path?>/assets/img/lightbulb.svg" alt="" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal">Central do Usuário</h1>
            <p><a href="cadastro">Registre-se</a></p>
        </div>
        <?php if($u->isLoggedIn){ ?>
            <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-black rounded shadow-sm" style="
                background-color: black;
            ">
            <img class="mr-3" src="<?=$u->path?>/assets/img/lightbulb.svg" alt="" width="48" height="48">
            <div class="lh-100">
                <h6 class="mb-0 text-white lh-100">Olá <?=$u->udata->nome?>, é você?</h6>
                <small><a href="home">Clique aqui</a> para entrar</small>
            </div>
        </div>
        <?php } ?>
        <div class="form-label-group">
            <input type="email" id="email" class="form-control" placeholder="Email" required autofocus>
            <label for="email">Email</label>
        </div>

        <div class="form-label-group">
            <input type="password" id="senha" class="form-control" placeholder="Senha" required>
            <label for="senha">Senha</label>
        </div>

        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Lembrar-me
            </label>
        </div>
        <div id="msgbox">
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Logar</button>
        <p class="mt-5 mb-3 text-muted text-center">Christopher Neves - 20180042677 - IoT 2020.6<br>
        Ícones obtidos de <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> em <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></p>
    </form>
</body>
<script src="<?=$u->path?>/assets/js/jquery-3.5.1.min.js"></script>
<script src="<?=$u->path?>/assets/js/bootstrap.min.js"></script>
<script src="<?=$u->path?>/assets/js/login.js"></script>
</html>