<?php
$sth = $pdo->prepare("select *from Tbl_usuario");
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
    if ($Email_usuario != $_SESSION['Login']['email']) {
        echo '<tr>';
        echo '<td><center>' . $Nome_usuario . '</center></td>';
        echo '<td><center>' . $Sobrenome_usuario . '</center></td>';
        echo '<td><center>' . $Email_usuario . '</center></td>';
        echo '<td><center>' . $Tipo_usuario . '</center></td>';
        echo '<td><center><a class="waves-effect btn modal-trigger grey darken-4" href="#alterar' . $Id_usuario . '">Alterar</a></center></td>';
        echo '<td><center><a class="waves-effect btn modal-trigger grey darken-4" href="#excluir' . $Id_usuario . '">excluir</a></center></td>';
        echo '</tr>';
        $texto = "{html: 'alterando'}";
        echo ' 
          <div id="alterar' . $Id_usuario . '" class="modal">
            <div class="modal-content">
              <h4>Deseja mesmo alterar o tipo de usuario de ' . $Nome_usuario . ' ' . $Sobrenome_usuario . '?</h4>
              <br><br>
              <a href="#!" class="modal-close waves-effect btn-flat">Cancelar</a>
              <a onclick="M.toast(' . $texto . ')" href="altera.php?id=' . $Id_usuario . '" class="modal-close waves-effect btn-flat">Comfirmar</a>
            </div>
          </div>';
        $texto = "{html: 'excluindo'}";
        echo ' 
          <div id="excluir' . $Id_usuario . '" class="modal">
            <div class="modal-content">
              <h4>Deseja mesmo excluir a conta e todos os arquivos de ' . $Nome_usuario . ' ' . $Sobrenome_usuario . '?<br>
              essa ação não pode ser desfeita!!</h4>
              <br><br>
              <a href="#!" class="modal-close waves-effect btn-flat">Cancelar</a>
              <a></a>
              <a onclick="M.toast(' . $texto . ')" href="apaga_usuario.php?id=' . $Id_usuario . '" class="modal-close waves-effect btn-flat"> Excluir </a>
            </div>
          </div>';
    }
endforeach;
echo '</table>';
?>