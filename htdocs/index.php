<?php
session_start();
if (isset($_SESSION['Login']['email'])) {
    header('Location: home.php');
}

$msg = filter_input(INPUT_GET, 'msg', FILTER_DEFAULT);
if ($msg == "invalido"){
    echo '<script> alert("e-mail ou senha invalidos"); </script>';
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dossier</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>


    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!--Import MATERIALIZE.CSS-->
    <link type="text/css" rel="stylesheet" href="materialize/css/materialize.min.css" media="screen,projection">
    <style>
        nav {
            size: 50px, 65px;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        body {
            background-color:#0277bd;
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }

        main {
            flex: 1 0 auto;
        }

        h4 {
            text-align: center;
        }

        p {
            text-align: justify;

        }

        button {
            border-radius: 10px;
        }

        footer {
            background-color: #212121;
        }
    </style>
</head>

<body>
    <nav class="nav-extended grey darken-4">
                <div class="nav-wrapper grey darken-4">
                  <a href="#" class="brand-logo"><img src="img/logo.png" class="img-responsive" style="margin-top: 5%; margin-left: 30px;"></a>
                  <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                  <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><H2><a style="margin-top: 5%;" href="index.php">Home</a></H2></li>
                    <li><H2><a style="margin-top: 5%;" href="chave.php">Cadastrar</a></H2></li>
                    <li><H2><a style="margin-top: 5%;" href="entrar.html">Entrar</a></H2></li>
                  </ul>
                </div>
        <div class="nav-content ">
          <span class="nav-title "></span>
        </div>
      </nav>
       <ul class="sidenav" id="mobile-demo">
        <li><a style="margin-top: 5%;" href="index.php">Home</a></li>
        <li><a style="margin-top: 5%;" href="chave.php">Cadastrar</a></li>
        <li><a style="margin-top: 5%;" href="entrar.html">Entrar</a></li>
      </ul>
    <!--========================================================================================-->
    <div class="container" style="margin-top: 4%;">
        <div class="row">
            <div class="row">
                <div class="col s12 m13">
                    <div class="card-panel white center">
                        <span class="black-text">
                            <h4> Olá! Entre com seu e-mail e senha para acessar seus arquivos!</h4>
                            <form name="login" method="post" action="php/login.php"> <br>
                                <div class="input-field">
                                    <label for="email"> Email </label>
                                    <input class="glyphicon-th" type="email" name="email">
                                </div>

                                <div class="input-field">
                                    <label for="password"> Senha </label>
                                    <input class="campo" type="password" name="senha">
                                </div>
                                <!--btn Enviar-->
                                <button class="btn waves-effect grey darken-4" type="submit" name="Enviar">Entrar
                                    <i class="material-icons right">send</i>
                                </button>
                            </form>
                            <p>Não possui cadastro?<a href="chave.php"> Cadastre-se</a></p>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--=================================================-->
    <div class="container" style="margin-top: 2%;">
        <div class="col s12 m13">
            <div class="card center-align">
                <div class="card-content">
                    <i class="medium material-icons">lock</i>
                    <h6>Mais segurança para seus arquivos</h6>
                </div>
                <div class="card-action">
                    <a href="#" class="blue-text">Apenas você pode deletar, renomear ou mover seus arquivos</a>
                </div>
            </div>
        </div>
    </div>
    <!--=================================================-->
    <div class="container" style="margin-top: 2%;">
        <div class="col s12 m13">
            <div class="card center-align">
                <div class="card-content">
                    <i class="medium material-icons">signal_wifi_off</i>
                    <h6>Ficou sem internet?</h6>
                </div>
                <div class="card-action">
                    <a href="#" class="blue-text">Sem problemas, você ainda pode acessar seus arquivos dentro da rede</a>
                </div>
            </div>
        </div>
    </div>
    <!--=================================================-->
    <div class="container" style="margin-top: 2%;">
        <div class="col s12 m6">
            <div class="card center-align">
                <div class="card-content center-align">
                    <h5>Ainda não possui cadastro no Dossier?</h5>
                    <br>
                    <div class="card-action">
                        <!--<a href="#" class="blue-text">Sem problemas, você ainda pode acessar seus arquivos dentro da rede</a>-->
                    
                    <br>
                    <button class="btn-large waves-effect grey darken-4 "><center><a class="white-text" href="chave.php">Experimente!</a></center>
                    </button></div>
                    <br>
                </div>
            </div>
        </div>
    </div>
    <!--=================================================-->
    <footer class="page-footer " style="background-color:#212121; margin-top: 4%;">
        <div class="row">
            <div class="container">
                <div class="col l6 s12">
                    <h5 class="white-text">Sobre</h5>
                    <p class="grey-text text-lighten-4">Visando uma melhoria na segurança no compartilhamento de arquivos foi criado o Dossier onde é possível compartilhar e armazenar arquivos
                        através de dispositivos que estejam conectados na mesma rede, sendo
                        possível que o usuário tenha privacidade em relação a seus arquivos armazenados.
                    </p>
                </div>
                <div class="col l4 offset-l2 s12">
                    <h5 class="white-text">Desenvolvedores</h5>
                    <ul>
                        <li><a class="grey-text text-lighten-3" href="#!">Darla Torres</a></li>
                        <li><a class="grey-text text-lighten-3" href="#!">Felipe Cavalca</a></li>
                        <li><a class="grey-text text-lighten-3" href="#!">Kaylan Bruno</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container center">
                © 2019 Dossier
                <a class="grey-text text-lighten-4 right" href="#!"></a>
            </div>
        </div>
    </footer>
    <!--Import MATERIALIZE.JS-->
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"> </script>

    <!--Import MATERIALIZE.JS-->
    <script type="text/javascript" src="materialize/js/materialize.min.js"> </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.sidenav').sidenav();
        });
    </script>
</body>

</html>