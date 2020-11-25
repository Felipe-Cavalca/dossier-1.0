<?php
session_start();
if (isset($_SESSION['Login']['email'])) {
    include 'php/conexao.php';
} else {
    header('Location: index.php');
    die;
}
$msg = filter_input(INPUT_GET, 'msg', FILTER_DEFAULT);
if ($msg == "comp") {
    echo '<script> alert("não é possiver deletar o arquivo pois ele está sendo compartilhado"); </script>';
}
if ($msg == "p_comp") {
    echo '<script> alert("não é possiver deletar a pasta pois ha arquivos sendo compartilhados"); </script>';
}
if ($msg == "volta") {
    echo '<script> alert("não é possiver voltar,você já esta na pasta principal"); </script>';
}
if ($msg == "errocomp") {
    echo '<script> alert("não é possiver compartilhar com este e-mail, e-mail invalido ou inexistente"); </script>';
}
if ($msg == "espaco") {
    echo '<script> alert("espaço insuficiente para upload de arquivo"); </script>';
}
if ($msg == "dono") {
    echo '<script> alert("você é o dono do arquivo"); </script>';
}

?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <title>dossier</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!--Import MATERIALIZE.CSS-->
    <link type="text/css" rel="stylesheet" href="materialize/css/materialize.min.css" media="screen,projection" />

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

        tr:hover {
            background-color: lightblue;
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
            <a href="#" class="brand-logo"><img src="img/logo.png" class="img-responsive"></a>
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <?php
                if ($_SESSION['Login']['tipo'] == 'admin') {
                    echo '
                    <li>
                        <a href="admin/">
                            <p class="btn waves-effect blue-grey darken-4">Painel administrativo</p>
                            <i class="material-icons right">assignment_ind</i>
                        </a>
                    </li>';
                }
                ?>
                <li>
                    <a href="arquivo.php">
                        <p class="btn waves-effect blue-grey darken-4">Upload</p>
                        <i class="material-icons right">file_upload</i>
                    </a>
                </li>
                <li>
                    <a href="sair.php">
                        <p class="btn waves-effect blue-grey darken-4">Sair</p>
                        <i class="material-icons right">forward</i>
                    </a>
                </li>
            </ul>
        </div>
        <div class="nav-content">
            <br>
            <ul class="tabs tabs-transparent">
                <li class="tab"><a class="active" href="#arquivos">Arquivos</a></li>
                <li class="tab"><a href="#pastas">Pastas</a></li>
                <li class="tab"><a href="#comp">Recebidos</a></li>
                <li class="tab"><a href="#compf">enviados</a></li>
                <li class="tab"><a href="#dssr">dssr</a></li>
            </ul>
        </div>
    </nav>

    <ul class="sidenav" id="mobile-demo">
        <li>
            <div class="divider"></div>
        </li>
        <br>
        <div class="background">
            <img src="img/navbar.png">
        </div>
        <?php
        if ($_SESSION['Login']['tipo'] == 'admin') {
            echo '
        <li><div class="divider"></div></li>
        <li><a href="admin/">painel administrativo</a></li>
        <li><div class="divider"></div></li>';
        }
        ?>
        <li>
            <div class="divider"></div>
        </li>
        <li>
            <a href="arquivo.php">Upload</a>
        </li>
        <li>
            <div class="divider"></div>
        </li>
        <li>
            <a href="sair.php">Sair</a>
        </li>
        <li>
            <div class="divider"></div>
        </li>
    </ul>

    <div class="row">
        <div class="center">
            <h2><strong>Caminho</strong></h2>
            <div class="col-lg-8">
                <div class="responsive-table">
                    <?php
                    $caminho = $_SESSION['Login']['caminho'];
                    echo '<h5><div class="white-text">' . $caminho . '</div></h5>';
                    ?>

                    <div id="arquivos">
                        <!--arquivos-->
                        <div class="center">
                            <h2>Arquivos</h2>
                            <div class="col-lg-8">
                                <div class="responsive-table">
                                    <?php
                                    $sth = $pdo->prepare("select *from arquivos where arq_dono = :dono and arq_caminho = :caminho");
                                    $sth->bindValue(":dono", $_SESSION['Login']['email']);
                                    $sth->bindValue(":caminho", $_SESSION['Login']['caminho']);

                                    $sth->execute();
                                    echo '<hr><p>Existem: ' . $sth->rowCount() . ' arquivos</p>';
                                    echo '<table>';
                                    echo '<tr>';
                                    echo '<td>Nome</td>';
                                    echo '<td><i class="material-icons right">open_in_new</i></td>';
                                    echo '<td><i class="material-icons right">cloud_download</i></td>';
                                    echo '<td><i class="material-icons right">group</i></td>';
                                    echo '<td><i class="material-icons right">cancel</i></td>';
                                    echo '</tr>';
                                    foreach ($sth as $res) :
                                        extract($res);
                                        echo '<tr>';
                                        echo '<td><center>' . $arq_nome . ' </td></center>';
                                        echo '<td>';
                                        $pag = 'a';
                                        $editavel = 's';
                                        verifica($arq_nome, $arq_arquivo, $arq_caminho, $pag, $editavel);
                                        echo '</td>';
                                        $texto = "{html: 'Baixando'}";
                                        echo '<td> <a onclick="M.toast(' . $texto . ')" href="php/' . $_SESSION['Login']['caminho'] . $arq_arquivo . '" download><i class="material-icons right">cloud_download</i></a>';
                                        echo '<td> <a href="compartilhar.php?nome=' . $arq_arquivo . '"><i class="material-icons right">group</i></a> </td>';
                                        $texto = "{html: 'excluindo'}";
                                        echo '<td> <a onclick="M.toast(' . $texto . ')" href="php/delete.php?id=' . $arq_id . '"><i class="material-icons right">cancel</i></a> </td>';
                                        echo '</tr>';
                                    endforeach;
                                    echo '</table>';
                                    ?>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="pastas">
                        <!--PASTAS-->
                        <div class="center">
                            <h2>Pastas</h2>
                            <a href="php/volta_inicio.php">
                                <button>
                                    <p class="btn waves-effect blue-grey darken-4">Pasta inicial
                                        <i class="material-icons right">home</i>
                                    </p>
                                </button>
                            </a>
                            <a href="php/volta.php">
                                <button>
                                    <p class="btn waves-effect blue-grey darken-4">Pasta anterior
                                        <i class="material-icons right">arrow_back</i>
                                    </p>
                                </button>
                            </a>
                            <a href="criar.php">
                                <button>
                                    <p class="btn waves-effect blue-grey darken-4">Criar pasta
                                        <i class="material-icons right">create_new_folder</i>
                                    </p>
                                </button>
                            </a>
                            <div class="col-lg-8">
                                <div class="responsive-table">
                                    <?php
                                    $sth = $pdo->prepare("select *from Tbl_pastas where dono_pasta = :dono and local_pasta = :local");
                                    $sth->bindValue(":dono", $_SESSION['Login']['email']);
                                    $sth->bindValue(":local", $_SESSION['Login']['caminho']);

                                    $sth->execute();
                                    echo '<hr><p>Existem: ' . $sth->rowCount() . ' pastas</p>';
                                    echo '<table>';
                                    echo '<tr>';
                                    echo '<td>Nome</td>';
                                    echo '<td>Entrar</td>';
                                    echo '<td><i class="material-icons right">cancel</i></td>';
                                    echo '</tr>';
                                    foreach ($sth as $res) :
                                        extract($res);
                                        echo '<tr>';
                                        echo '<td>' . $nome_pasta . ' </td>';
                                        echo '<td> <a href="php/entrar.php?nome=' . $nome_pasta . '" ><i class="material-icons right">input</i></a>';
                                        echo '<td> <a href="php/delete_pasta.php?id=' . $id_pasta . '"><i class="material-icons right">cancel</i></a> </td>';
                                        echo '</tr>';
                                    endforeach;
                                    echo '</table>';
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="comp">
                        <!--compartilhados-->
                        <div class="center">
                            <h2>Compartilhados Com você</h2>
                            <div class="col-lg-8">
                                <div class="responsive-table">
                                    <?php
                                    $sth = $pdo->prepare("select *from compartilhados where usu_comp = :dono order by id_comp desc");
                                    $sth->bindValue(":dono", $_SESSION['Login']['email']);

                                    $sth->execute();
                                    echo '<hr><p>Existem: ' . $sth->rowCount() . ' arquivos</p>';
                                    echo '<table>';
                                    echo '<tr>';
                                    echo '<td>Arquivo</td>';
                                    echo '<td>Remetente</td>';
                                    echo '<td><i class="material-icons right">archive</i></td>';
                                    echo '<td><i class="material-icons right">cloud_download</i></td>';
                                    //echo '<td>Excluir compartilhamento</td>';
                                    echo '</tr>';
                                    foreach ($sth as $res) :
                                        extract($res);
                                        echo '<tr>';
                                        echo '<td>';
                                        $arq_nome = "" . $arq_comp;
                                        $pag = 'c';
                                        verifica($arq_nome, $arq_comp, $arq_caminho, $pag, $editavel);
                                        echo '</td>';
                                        echo '<td><center>
                                        ' . $arq_dono . '</center></td>';
                                        echo '<td> <a href="php/mover.php?id=' . $id_comp . '""><i class="material-icons right">archive</i></a>';
                                        echo '<td> <a href="php/' . $arq_caminho . $arq_comp . '" download><i class="material-icons right">cloud_download</i></a>';
                                        //echo '<td> <a href="php/delete.php?id=' . $arq_id . '"> Excluir </a> </td>';
                                        echo '</tr>';
                                    endforeach;
                                    echo '</table>';
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="compf">
                        <!--compartilhei-->
                        <div class="center">
                            <h2>Arquivos que você compartilhou</h2>
                            <div class="col-lg-8">
                                <div class="responsive-table">
                                    <?php
                                    $sth = $pdo->prepare("select *from compartilhados where arq_dono = :dono order by id_comp desc");
                                    $sth->bindValue(":dono", $_SESSION['Login']['email']);

                                    $sth->execute();
                                    echo '<hr><p>Existem: ' . $sth->rowCount() . ' arquivos</p>';
                                    echo '<table>';
                                    echo '<tr>';
                                    echo '<td>Arquivo</td>';
                                    echo '<td>Enviado para</td>';
                                    echo '<td><i class="material-icons right">cloud_download</i></td>';
                                    echo '<td>Editavel</td>';
                                    echo '<td><i class="material-icons right">cancel</i></td>';
                                    echo '</tr>';
                                    foreach ($sth as $res) :
                                        extract($res);
                                        echo '<tr>';
                                        echo '<td>';
                                        $pag = 'e' . $id_comp;
                                        $editar = 's';
                                        verifica($arq_nome, $arq_comp, $arq_caminho, $pag, $editar);
                                        echo '</td>';
                                        echo '<td>' . $usu_comp . ' </td>';
                                        echo '<td> <a href="php/' . $arq_caminho . $arq_comp . '" download><i class="material-icons right">cloud_download</i></a>';
                                        if ($editavel == 'n') {
                                            echo '<td> <a href="php/editavel.php?id=' . $id_comp . '"><i class="material-icons right">block</i></a> </td>';
                                        } else {
                                            echo '<td> <a href="php/editavel.php?id=' . $id_comp . '"><i class="material-icons right">check</i></a> </td>';
                                        }

                                        echo '<td> <a href="php/delete-comp.php?id=' . $id_comp . '"><i class="material-icons right">cancel</i></a> </td>';
                                        echo '</tr>';
                                    endforeach;
                                    echo '</table>';
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="dssr">
                        <center>
                            <?php
                            $extensao = "dssr";
                            $div = 'example';
                            $texto = 'insira o texto aqui';
                            include 'editores/texto/index.php';
                            ?>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
        function verifica($arq_nome, $arq_arquivo, $arq_caminho, $pag, $editavel)
        {
            //abrir img 
            $extensao = substr($arq_arquivo, -4);
            if (($extensao == ".jpg") || ($extensao == ".png") || ($extensao == ".gif") || ($extensao == "jpeg")) {
                echo '
                    <center>
                    <img class="responsive-img materialboxed" width="50" src="php/' . $arq_caminho . $arq_arquivo . '">
                    </center>
                ';
            } else if ($extensao == ".mp4") {
                echo '
                    <center>
                        <a class="waves-effect waves-light btn modal-trigger grey darken-4" href="#id' . $arq_arquivo . $pag . '">abrir</a>
                    </center>
                    <div id="id' . $arq_arquivo . $pag . '" class="modal">
                        <div class="modal-content" style="color: Black;">
                            <h4>' . $arq_nome . '</h4>
                            <center>
                                <video class="responsive-video" controls>
                                    <source src="php/' . $arq_caminho . $arq_arquivo . '" type="video/mp4">
                                    <source src="php/' . $arq_caminho . $arq_arquivo . '" type="video/ogg">
                                    Seu navegador não suporta tags de vídeo.
                                </video>
                            </center>
                        </div>
                    </div>
                ';
            } else if ($extensao == ".pdf") {
                echo '
                    <center>
                        <a class="waves-effect waves-light btn modal-trigger grey darken-4" href="php/' . $arq_caminho . $arq_arquivo . '">abrir</a>
                    </center>
                ';
            } else if (($extensao == ".mp3") || ($extensao == ".ogg")) {
                echo '
                    <center>
                        <a class="waves-effect waves-light btn modal-trigger grey darken-4" href="#id' . $arq_arquivo . $pag . '">abrir</a>
                    </center>
                    <div id="id' . $arq_arquivo . $pag . '" class="modal">
                        <div class="modal-content" style="color: Black;">
                            <h4>' . $arq_nome . '</h4>
                            <center>
                                <audio controls>
                                    <source src="php/' . $arq_caminho . $arq_arquivo . '" type="audio/mpeg">
                                    <source src="php/' . $arq_caminho . $arq_arquivo . '" type="audio/ogg">     
                                    Seu navegador não suporta áudio tag.
                                </audio>
                            </center>
                        </div>
                    </div>
                ';
            } else if (($extensao == "dssr") || ($extensao == ".txt") || ($extensao == ".php") || ($extensao == "html")) {
                echo '
                    <center>
                        <a class="waves-effect waves-light btn modal-trigger grey darken-4" href="#id' . $arq_arquivo . $pag . '">abrir</a>
                    </center>
                    <div id="id' . $arq_arquivo . $pag . '" class="modal">
                        <div class="modal-content" style="color: Black;">
                            <h4>' . $arq_nome . '</h4>
                            <center>
                ';
                                $id = $arq_arquivo;
                                $texto = "";
                                if ($pag == 'e') {
                                    $div = 'diva' . $arq_arquivo;
                                } else if ($pag == 'c') {
                                    $div = 'divb' . $arq_arquivo;
                                } else {
                                    $div = 'divc' . $arq_arquivo . $pag;
                                }

                                // Abre o Arquvio no Modo r (para leitura)
                                $arquivo = fopen('php/' . $arq_caminho . $arq_arquivo, 'r');
                                // Lê o conteúdo do arquivo 
                                while (!feof($arquivo)) {
                                    //Mostra uma linha do arquivo
                                    $linha = fgets($arquivo, 1024);
                                    $texto = $texto . $linha;
                                }
                                // Fecha arquivo aberto
                                fclose($arquivo);
                                if ($extensao == "dssr") {
                                    $texto = mudar($texto);
                                }

                                include 'editores/texto/index.php';
                echo '
                            </center>
                        </div>
                    </div>
                ';
            } else {
                echo '<center>visualização de arquivos ' . $extensao . ' não suportado atualmente</center>';
            }
        }

        function mudar($texto)
        {
            $alfabeto = 'MmKkSsDdTtIiPpJjYyWwOoXxVvGgLlFfHhRrBbZzCcUuQqEeAaNn1234567890';
            $chave =    'AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz0123456789';
            $codificado = $texto;
            $tamanho = strlen($texto);
            $tamalfabeto = strlen($alfabeto);
            for ($x = 0; $x != $tamanho; $x++) {
                for ($y = 0; $y != $tamalfabeto; $y++) {
                    if ($texto[$x] == $alfabeto[$y]) {
                        $codificado[$x] = str_replace($alfabeto[$y], $chave[$y], $codificado[$x]);
                        $y = $tamalfabeto - 1;
                    }
                }
            }
            return $codificado;
        }
    ?>

    <script type="text/javascript" src="js/jquery-3.2.1.min.js"> </script>
    <script type="text/javascript" src="materialize/js/materialize.min.js"> </script>
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
</body>
</html>