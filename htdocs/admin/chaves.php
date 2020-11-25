<html>
<div class="col m12">
  <div class="card">
    <div class="card-tabs">
      <ul class="tabs tabs-fixed-width">
        <li class="tab"><a href="#usadas">já usadas</a></li>
        <li class="tab"><a class="active" href="#nusadas">não usadas</a></li>
        <li class="tab"><a href="#novas">novas chaves</a></li>
      </ul>
    </div>
    <div class="card-content" style="color: Black;">
      <div id="usadas"><?php usadas() ?></div>
      <div id="nusadas"><?php nusadas() ?></div>
      <div id="novas">
        <!--upload-->
        <form name="form" method="post" action="inserir_chaves.php" enctype="multipart/form-data" style="color: Black;">
          <h4>selecione o arquivo de chaves</h4>
          <div class="file-field input-field">
            <div class="btn grey darken-4">
              <span>Arquivo</span>
              <input type="file" name="fileUpload">
            </div>
            <div class="file-path-wrapper black-text">
              <input class="file-path validate" type="text">
            </div>
          </div>
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

</html>

<?php
function usadas()
{
  include '../php/conexao.php';
  $sth = $pdo->prepare("select *from Tbl_usuario");
  $sth->execute();
  echo 'Existem: ' . $sth->rowCount() . ' chaves usadas';
  echo '<table >';
  echo '<tr>';
  echo '<td style="color: Black;">Chave</td>';
  echo  '<td style="color: Black;">Usuario</td>';
  echo  '<td style="color: Black;">Status</td>';
  echo '</tr>';
  foreach ($sth as $res) :
    extract($res);
    echo '<tr>';
    echo '<td style="color: Black;"><center>' . $Chave_usuario . '</center></td>';
    echo '<td style="color: Black;"><center>' . $Email_usuario . '</center></td>';
    $sth = $pdo->prepare("select *from chaves where num_chave = '$Chave_usuario' and dono_chave = '$Email_usuario'");
    $sth->execute();
    if ($sth->rowCount() == 1){
        echo '<td style="color: Black;"><center>valido</center></td>';
    }
    else{
        echo '<td style="color: Black;"><center>invalido</center></td>';
    }
    
    
    
    echo '</tr>';
  endforeach;
  echo '</table>';
}
function nusadas()
{
  include '../php/conexao.php';
  $sth = $pdo->prepare("select *from chaves WHERE dono_chave IS NULL");
  $sth->execute();
  echo 'Existem: ' . $sth->rowCount() . ' chaves não usadas';
  echo '<table >';
  echo '<tr>';
  echo '<td style="color: Black;">Chave</td>';
  echo '</tr>';
  foreach ($sth as $res) :
    extract($res);
    echo '<tr>';
    echo '<td style="color: Black;"><center>' . $num_chave . '</center></td>';
    echo '</tr>';
  endforeach;
  echo '</table>';
}
?>











<?php
/*
$x=0;
$sth = $pdo->prepare("select *from chaves");
$sth->execute();
echo '<hr><p>Existem: ' . $sth->rowCount() . ' chaves</p>';
echo '<table>';
echo '<tr>';
echo '<td>Chave</td>';
echo '<td>Usada</td>';
echo '</tr>';
foreach ($sth as $res) :
    extract($res);
    $sth = $pdo->prepare("select *from Tbl_usuario where Chave_usuario Like $num_chave");
    $sth->execute();
    if ($sth->rowCount()==0){
        echo '<tr>';
        echo '<td><center>' . $num_chave . '</center></td>';
        echo '<td><center>Não utilizada</center></td>';
    }
    else if ($sth->rowCount()==1){
        $usada[$x]=$num_chave;
        $x++;
    }
    else{
        echo '<tr>';
        echo '<td><center>Chave inválida</center></td>';
    }
    echo '</tr>';
endforeach;
$y=0;
while ($y<$x){
    $num_chave = $usada[$y];
    echo '<tr>';
    echo '<td><center>' . $num_chave . '</center></td>';
    echo '<td><center>Já utilizada</center></td>';
    echo '</tr>';
    $y++;
}
echo '</table>';
*/
?>