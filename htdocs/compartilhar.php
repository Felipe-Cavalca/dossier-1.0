<?php
include 'php/conexao.php';
session_start();
if (!$_SESSION['Login']) :
    header('Location: index.php');
    die;
endif;
$nome = filter_input(INPUT_GET, 'nome', FILTER_DEFAULT);
$_SESSION['Login']['compartilhamento'] = $nome;
?>

<html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<!--Import Google Icon Font-->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<!--Import MATERIALIZE.CSS-->
<link type="text/css" rel="stylesheet" href="materialize/css/materialize.min.css" media="screen,projection" />

<style>
    nav {
        size: 50px, 65px;
    }

    img {
        max-width: 100%;
        height: auto;
    }

    body {
        background-color: #0277bd;
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

<body>
    <nav class="nav-extended grey darken-4">
        <div class="nav-wrapper grey darken-4">
            <a href="#" class="brand-logo"><img src="img/logo.png" class="img-responsive" style="margin-top: 5%; margin-left: 30px;"></a>
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a style="margin-top: 25%;" href="home.php"><i class="material-icons left">arrow_back</i>Voltar</a></li>
            </ul>
        </div>
        <div class="nav-content ">
            <span class="nav-title "></span>
        </div>
    </nav>
    <!--=====================================================================================-->
    <div id="comp" class="container">
        <div class="row">
            <div class="card-panel" style="margin-top: 20%;">
                <h6> Digite o email da conta à quem você deseja compartilhar o arquivo: <?php echo $nome; ?> </h6>
                <form name="form" method="post" action="php/compartilhar.php">
                    <div class="switch">
                    editavel:
                      <label>
                        não
                        <input name="editavel" type="checkbox">
                        <span class="lever" ></span>
                        sim
                      </label>
                    </div>
                    <div class="input-field">
                        <input class="autocomplete" id="autocomplete-input" type="text" name="e-mail">
                        <label for="autocomplete-input">email</label>
                    </div>
                    <div class="lista"></div>
                    <div class="center-align">
                        <button class="btn waves-effect blue-grey darken-4" type="submit" name="Enviar">Enviar
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </form>
                <button onclick="foi()" data-target="mobile-demo" class="sidenav-trigger">alterar listas</button>
            </div>
        </div>
    </div>
    
    <div id="ecomp" class="container">
        <div class="row">
            <div class="card-panel" style="margin-top: 20%;">
            <button onclick="cancela()" class="btn waves-effect blue-grey darken-4" type="submit" name="Enviar">voltar
                <i class="material-icons right">arrow_back</i>
            </button>
            <h6> Editar lista de compartilhamento </h6>        
            <button onclick="adcionar_lista()" class="btn waves-effect blue-grey darken-4" type="submit" name="Enviar">adcionar lista
                <i class="material-icons right">send</i>
            </button>
            <button onclick="remover_lista()" class="btn waves-effect blue-grey darken-4" type="submit" name="Enviar">remover lista
                <i class="material-icons right">send</i>
            </button>
            <button onclick="adcionar_usuario()" class="btn waves-effect blue-grey darken-4" type="submit" name="Enviar">adcionar usuarios em lista
                <i class="material-icons right">send</i>
            </button>
            <button onclick="remover_usuario()" class="btn waves-effect blue-grey darken-4" type="submit" name="Enviar">remover usuario da lista
                <i class="material-icons right">send</i>
            </button>

            </div>
        </div>
    </div>

    <div id="addl" class="container">
        <div class="row">
            <div class="card-panel" style="margin-top: 20%;">
                <button onclick="voltar()" class="btn waves-effect blue-grey darken-4" type="submit" name="Enviar">voltar
                    <i class="material-icons right">arrow_back</i>
                </button>
                <h6> digite o nome da lista: </h6>
                <form name="addlista" method="post" >
                    <div class="input-field">
                        <input class="autocomplete" id="autocomplete-input" type="text" name="nome">
                        <label for="autocomplete-input">nome</label>
                    </div>
                    <button class="btn waves-effect blue-grey darken-4" type="submit" name="Enviar">adcionar lista
                        <i class="material-icons right">send</i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <div id="dell" class="container">
        <div class="row">
            <div class="card-panel" style="margin-top: 20%;">
                <button onclick="voltar()" class="btn waves-effect blue-grey darken-4" type="submit" name="Enviar">voltar
                    <i class="material-icons right">arrow_back</i>
                </button>
                <h6> selecione a lista para excluir: </h6>
                <form name="dellista" method="post" >
                    <div class="lista"></div>
                    <button class="btn waves-effect blue-grey darken-4" type="submit" name="Enviar">remover lista
                        <i class="material-icons right">send</i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div id="addu" class="container">
        <div class="row">
            <div class="card-panel" style="margin-top: 20%;">
                <button onclick="voltar()" class="btn waves-effect blue-grey darken-4" type="submit" name="Enviar">voltar
                    <i class="material-icons right">arrow_back</i>
                </button>
                <h6>adcionar usuario em lista: </h6>
                <form name="addusuario" method="post" >
                    <div class="lista"></div>
                    <div class="input-field">
                        <input class="autocomplete" id="autocomplete-input" type="text" name="email">
                        <label for="autocomplete-input">e-mail</label>
                    </div>
                    <button class="btn waves-effect blue-grey darken-4" type="submit" name="Enviar">adcionar ususario
                        <i class="material-icons right">send</i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div id="delu" class="container">
        <div class="row">
            <div class="card-panel" style="margin-top: 20%;">
                <button onclick="voltar()" class="btn waves-effect blue-grey darken-4" type="submit" name="Enviar">voltar
                    <i class="material-icons right">arrow_back</i>
                </button>
                <h6> selecione a lista: </h6>
                <form name="listausuarois" method="post" >
                    <div class="lista"></div>
                    <button class="btn waves-effect blue-grey darken-4" type="submit" name="Enviar">listar usuarios
                        <i class="material-icons right">send</i>
                    </button>
                </form>
                <div class="usuarios"></div>
            </div>
        </div>
    </div>

    <!--Import MATERIALIZE.JS-->
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"> </script>
    <!--<script type="text/javascript" src="controller.js"></script>
    <!--Import MATERIALIZE.JS-->
    <script type="text/javascript" src="materialize/js/materialize.min.js"> </script>
    <script type="text/javascript" src="compartilhar.js"> </script>
    <script type="text/javascript">
        $(document).ready(function(){
          $('select').formSelect();
        });
    </script>


</body>

</html>