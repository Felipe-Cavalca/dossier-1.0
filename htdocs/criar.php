<?php

include 'php/conexao.php';

session_start();

if (!$_SESSION['Login']):

    header('Location: index.php');
    die;
endif;
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<!--Import Google Icon Font-->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<!--Import MATERIALIZE.CSS-->
<link type="text/css" rel="stylesheet" href="materialize/css/materialize.min.css"  media="screen,projection"/>

 <style>
        nav{
            size: 50px , 65px;
        }
        img{
            max-width: 100%;
            height: auto;
        }
        body{
            background-color: #0277bd; 
        display: flex;
        min-height: 100vh;
        flex-direction: column;
        }

        main {
            flex: 1 0 auto;
        }
            
        h4{
            text-align: center;
        }
        p{
            text-align: justify;
            
        }
        button{
            border-radius: 10px;
        }
        footer{
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
        <div class="container">
            <div class="row">
                <div class="card-panel" style="margin-top: 20%;">
                    <h6> Digite o nome da nova pasta </h6>
                    <form name="form" method="post" action="php/pasta.php">
                        <div class="input-field">
                            <input class="glyphicon-th" type="text" name="pasta_nome">
                        </div>
                         <p class="center-align">
                        <button class="btn waves-effect blue-grey darken-4" type="submit" name="Enviar">Criar
                            <i class="material-icons right">send</i>
                        </button>
                        </p>
                    </form>
                 </div>
            </div>
        </div>

 </body>
</html>
