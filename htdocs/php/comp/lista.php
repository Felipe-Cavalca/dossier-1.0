<?php
session_start();
?>
<div class="input-field col s12">
  <select name='lista' method="post">
    <option value="vazio">seleciona a lista</option>
<?php
include '../conexao.php';
$dono = $_SESSION['Login']['email'];
$sth = $pdo->prepare("select *from lista where dono_lista = '$dono'");
$sth->execute();
foreach ($sth as $res) :
extract($res);
    echo '<option value="'.$id_lista.'">'.$nome_lista.'</option>';
endforeach;
?>
  </select>
  <label>opcional</label>
</div>
<br><br>

                    
<!--Import MATERIALIZE.JS-->
<script type="text/javascript" src="../../js/jquery-3.2.1.min.js"> </script>
<!--<script type="text/javascript" src="controller.js"></script>
<!--Import MATERIALIZE.JS-->
<script type="text/javascript" src="../../materialize/js/materialize.min.js"> </script>
<script type="text/javascript">
    $(document).ready(function(){
      $('select').formSelect();
    });
</script>