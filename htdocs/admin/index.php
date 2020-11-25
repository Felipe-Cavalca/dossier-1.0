<?php
session_start();
if (isset($_SESSION['Login']['tipo'])) {
  if ($_SESSION['Login']['tipo'] == 'admin') {
    include '../php/conexao.php';
  } else {
    header('Location: ../');
    die;
  }
} else {
  header('Location: ../');
  die;
}

$msg = filter_input(INPUT_GET, 'msg', FILTER_DEFAULT);
?>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<title>dossier-admin</title>
<!--Import Google Icon Font-->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<!--Import MATERIALIZE.CSS-->
<link type="text/css" rel="stylesheet" href="../materialize/css/materialize.min.css" media="screen,projection" />

<style>
  table {
    width: 100%;
  }

  table tr {
    color: white;
  }

  table tr td {
    border-bottom: 1px solid #444;
    border-left: 1px solid #444;
    padding: 6px;
    color: white;
  }

  h2 {
    color: white;
    background-color: #0277bd;
  }

  body {
    background-color: #0277bd;
  }

  p {
    color: white;
  }

  td a {
    color: #b0bec5;
  }
</style>

<nav class="nav-extended grey darken-4">
  <div class="nav-wrapper">
    <a href="#" class="brand-logo"><img src="../img/logo.png" class="img-responsive"></a>
    <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    <ul id="nav-mobile" class="right hide-on-med-and-down">
      <li>
        <a href="../home.php">
          <p class="btn waves-effect blue-grey darken-4">Arquivos
            <i class="material-icons right">home</i>
          </p>
        </a>
      </li>
      <li>
        <a href="../sair.php">
          <p class="btn waves-effect blue-grey darken-4">Sair</p>
          <i class="material-icons right">forward</i>
        </a>
      </li>
    </ul>
  </div>
  <div class="nav-content">
    <br>
    <ul class="tabs tabs-transparent">
      <li class="tab"><a class="active" href="#usuarios">Usuários</a></li>
      <li class="tab"><a href="#armazenamento">Armazenamento</a></li>
      <li class="tab"><a href="#backup">Backup</a></li>
      <li class="tab"><a href="#chaves">Chaves</a></li>
    </ul>
  </div>
</nav>

<ul class="sidenav" id="mobile-demo">
  <li>
    <div class="divider"></div>
  </li>
  <br>
  <div class="background">
    <img src="../img/navbar.png">
  </div>
  <li>
    <div class="divider"></div>
  </li>
  <li><a href="../home.php">Arquivos</a></li>
  <li>
    <div class="divider"></div>
  </li>
  <li>
    <div class="divider"></div>
  </li>
  <li><a href="../sair.php">Sair</a></li>
  <li>
    <div class="divider"></div>
  </li>
</ul>

<div class="row">
  <div class="center">
    <h2><strong>Área do Administrador</strong></h2>
    <div class="col-lg-8">
      <div class="responsive-table">

        <div id="usuarios">
          <!--arquivos-->
          <div class="center">
            <h2>Usuários</h2>
            <div id='pesquisa'>

              <div class="row">
                <div class="col m12">
                  <div class="card">
                    <div class="card-content">
                      <form name="ofiltro" method="post">
                        <strong>Pesquisar usuário:</strong>
                        <br>
                        <label>
                          <input name="filtro" value="email" type="radio" checked />
                          <span>E-mail</span>
                        </label>
                        <br>
                        <label>
                          <input name="filtro" value="nome" type="radio" />
                          <span>Nome ou sobrenome</span>
                        </label>
                        <div class="input-field">
                          <label for="text"> Pesquisar </label>
                          <input class="campo" type="text" name="pesquisar">
                        </div>
                        <!--btn Enviar-->
                        <button class="btn waves-effect grey darken-4" type="submit" name="Enviar">Procurar
                          <i class="material-icons right">search</i>
                        </button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-8">
              <div class="responsive-table">
                <div class="mostrar_filtro"></div>
                <div class="todos">
                  <?php include 'tabela_usuarios.php'; ?>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div id="armazenamento">
          <h4>
            <p>Armazenamento por usuário:</p>
          </h4>
          <?php include 'armazenamento.php'; ?>
        </div>

        <div id="chaves">
          <center>
            <h2>Chaves</h2>
          </center>
          <?php include 'chaves.php'; ?>
        </div>

        <div id="backup">
          <div class="col m12">
            <div class="card">
              <div class="card-content">
                <h3><strong>DADOS DE BACKUPS</strong></h3>
              </div>
              <div class="card-tabs">
                <ul class="tabs tabs-fixed-width">
                  <li class="tab"><a href="#executar">Rodar backup</a></li>
                  <li class="tab"><a href="#fazer">Criar backup manual</a></li>
                  <li class="tab"><a class="active" href="#listar">Listar backup</a></li>
                </ul>
              </div>
              <div class="card-content">
                <div id="executar">Executa backup</div>
                <div id="fazer">
                  <h4><strong>Os backpus são gerados automaticamente todos os dias</strong></h4><br>
                  Caso queira gerar um backup manual basta clicar no botão abaixo<br>
                  <button><a href="gerar_backup.php">Gerar Backup</a></button>
                </div>
                <div id="listar">
                  <?php
                  $path = "backup/";
                  $diretorio = dir($path);

                  echo "Os backups são gerados de acordo com o horário do servidor<br/>
                    <h3><strong>Listando backups:</strong></h3><br>";
                  while ($arquivo = $diretorio->read()) {
                    if (($arquivo == '.') || ($arquivo != '..')) {
                      if (($arquivo != '.') || ($arquivo == '..')) {
                        echo '
                            <div>
                                <a href="' . $path . $arquivo . '">' . $arquivo . '</a>
                            </div>
                            <div> 
                                <a href="apagar_backup.php?arq=' . $arquivo . '">Excluir</a>
                            </div>
                            <br>
                            ';
                      }
                    }
                  }
                  $diretorio->close();
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>




<!--Import MATERIALIZE.JS-->
<script type="text/javascript" src="../js/jquery-3.2.1.min.js"> </script>
<!--<script type="text/javascript" src="controller.js"></script>
                <!--Import MATERIALIZE.JS-->
<script type="text/javascript" src="../materialize/js/materialize.min.js"> </script>
<script type="text/javascript">
  $(document).ready(function() {
    $('.sidenav').sidenav();
  });
  $(document).ready(function() {
    $('.tabs').tabs();
  });
  $(document).ready(function() {
    $('.materialboxed').materialbox();
  });
  $(document).ready(function() {
    $('.modal').modal();
  });
</script>


<script type="text/javascript">
  $(function() {
    $('form[name="ofiltro"]').submit(function() {
      var forma = $(this);
      var dados = forma.serialize();
      $.ajax({
        url: 'filtrar.php',
        data: dados,
        type: 'POST',
        beforeSent: function() {},
        success: function(resposta) {
          $(".todos").hide();
          $(".mostrar_filtro").text("");
          $(".mostrar_filtro").prepend(resposta);
        },
        complete: function() {}
      });
      return false;
    });
  });
</script>
</html>