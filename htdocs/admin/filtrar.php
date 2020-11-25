<?php
session_start();
include '../php/conexao.php';
$post= filter_input_array(INPUT_POST, FILTER_DEFAULT);
/*
echo $post['filtro'].'<br>';
echo $post['pesquisar'].'<br>';
*/
$parametro =$post['pesquisar'];

if ($post['filtro'] == 'email'){
    $sth = $pdo->prepare("SELECT * FROM `Tbl_usuario` WHERE `Email_usuario` LIKE '%$parametro%'");
}
else if ($post['filtro'] == 'nome'){
    $sth = $pdo->prepare("SELECT * FROM `Tbl_usuario` WHERE `Nome_usuario` LIKE '%$parametro%' OR `Sobrenome_usuario` LIKE '%$parametro%'");
}
else {
    
}


//$sth = $pdo->prepare("select *from Tbl_usuario");
$sth->execute();
echo '<hr><p>Existem: ' . $sth->rowCount() . ' usuarios</p>';
echo '<table>';
echo '<tr>';
echo '<td>Nome</td>';
echo '<td>Sobrenome</td>';
echo '<td>E-Mail</td>';
echo '<td>Tipo</td>';
echo '<td>Alterar</td>';
echo '<td>Excluir</td>';
echo '</tr>';
foreach ($sth as $res) :
    extract($res);
        echo '<tr>';
        echo '<td><center>' . $Nome_usuario . '</center></td>';
        echo '<td><center>' . $Sobrenome_usuario . '</center></td>';
        echo '<td><center>' . $Email_usuario . '</center></td>';
        echo '<td><center>' . $Tipo_usuario . '</center></td>';
         echo '<td><center><a class="waves-effect btn modal-trigger grey darken-4" href="#filtroalterar' . $Id_usuario . '">Alterar</a></center></td>';
        echo '<td><center><a class="waves-effect btn modal-trigger grey darken-4" href="#filtroexcluir' . $Id_usuario . '">Excluir</a></center></td>';
        echo '</tr>';
        $texto = "{html: 'alterando'}";
        echo ' <div id="filtroalterar' . $Id_usuario . '" class="modal">
            <div class="modal-content">
              <h4>Deseja mesmo alterar o tipo de usuario de ' . $Nome_usuario . ' ' . $Sobrenome_usuario . '?</h4>
              <br><br>
              <a href="#!" class="modal-close waves-effect btn-flat">Cancelar</a>
              <a></a>
              <a onclick="M.toast(' . $texto . ')" href="altera.php?id=' . $Id_usuario . '" class="modal-close waves-effect btn-flat">Comfirmar</a>
            </div>
          </div>';
        $texto = "{html: 'excluindo'}";
        echo ' <div id="filtroexcluir' . $Id_usuario . '" class="modal">
            <div class="modal-content">
              <h4>Deseja mesmo excluir a conta e todos os arquivos de ' . $Nome_usuario . ' ' . $Sobrenome_usuario . '?<br>
              essa ação não pode ser desfeita!!</h4>
              <br><br>
              <a href="#!" class="modal-close waves-effect btn-flat">Cancelar</a>
              <a></a>
              <a onclick="M.toast(' . $texto . ')" href="apaga_usuario.php?id=' . $Id_usuario . '" class="modal-close waves-effect btn-flat"> Excluir </a>
            </div>
          </div>';
endforeach;
echo '</table>';


echo'
        <!--Import MATERIALIZE.JS-->
        <script type="text/javascript" src="js/jquery-3.2.1.min.js"> </script>
        <!--<script type="text/javascript" src="controller.js"></script>
                <!--Import MATERIALIZE.JS-->
        <script type="text/javascript" src="materialize/js/materialize.min.js"> </script>
        <script type="text/javascript">
';
echo"
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
";
?>