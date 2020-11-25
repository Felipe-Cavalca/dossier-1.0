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
        .box {
         width: 300px;
         height: 100px;
        background: #fff;
        margin-top: 15%;
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
        <!--============================================================================================-->
        <div class="carregando">
            <div class="row">
                <center>
                    <div class="box">
                <div class="card">
                  <div class="card-content">
                    <div class="preloader-wrapper big active">
                      <div class="spinner-layer spinner-blue">
                        <div class="circle-clipper left">
                          <div class="circle"></div>
                        </div><div class="gap-patch">
                          <div class="circle"></div>
                        </div><div class="circle-clipper right">
                          <div class="circle"></div>
                        </div>
                      </div>
                      <div class="spinner-layer spinner-red">
                        <div class="circle-clipper left">
                          <div class="circle"></div>
                        </div><div class="gap-patch">
                          <div class="circle"></div>
                        </div><div class="circle-clipper right">
                          <div class="circle"></div>
                        </div>
                      </div>
                      <div class="spinner-layer spinner-yellow">
                        <div class="circle-clipper left">
                          <div class="circle"></div>
                        </div><div class="gap-patch">
                          <div class="circle"></div>
                        </div><div class="circle-clipper right">
                          <div class="circle"></div>
                        </div>
                      </div>
                      <div class="spinner-layer spinner-green">
                        <div class="circle-clipper left">
                          <div class="circle"></div>
                        </div><div class="gap-patch">
                          <div class="circle"></div>
                        </div><div class="circle-clipper right">
                          <div class="circle"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  </div>
                </div>
              </center>
            </div>
        </div>
        <!--upload-->
        <div class="upload">
            <div class="container">
                <div class="row">
                    <div class="card-panel" style="margin-top: 15%;">
                        <h6> Selecione o arquivo para realizar o upload </h6>
                        <form name="form" method="post" action="php/upload.php" enctype="multipart/form-data" style="color: Black;">
                            <p>
                                <div class="file-field input-field">
                                    <div class="btn grey darken-4">
                                        <span>Arquivo</span>
                                        <input type="file" name="fileUpload">
                                    </div>
                                    <div class="file-path-wrapper black-text">
                                        <input class="file-path validate" type="text">
                                    </div>
                                </div>
                            </p>
                            <p class="center-align">
                                <button onclick="vai()" class="btn waves-effect grey darken-4" type="submit" name="Enviar">Enviar
                                    <i class="material-icons right">send</i>
                                </button>
                            </p>
                        </form>  
                    </div>
                </div>
            </div>
        </div>
    
    <script type="text/javascript" src="materialize/js/materialize.min.js"></script>
    <script type="text/javascript" src="materialize/jquery/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="jquery/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
     
    <script type="text/javascript">
        $(function () {
            $(".carregando").hide();
        })
        function vai(){
            $(".carregando").show();
            $(".upload").hide();
        }
    </script>


 </body>
</html>
