<?php
session_start();
?>
<form name="delusuario" method="post">
<div class="input-field col s12">
  <select name='usuario'>
    <option value="" disabled selected>seleciona usuario</option>
<?php
include '../conexao.php';
$post= filter_input_array(INPUT_POST, FILTER_DEFAULT);
$sth = $pdo->prepare("select *from id_usuario_lista where lista_usu_lista = :lista");
$sth->bindValue(":lista", $post['lista']);
$sth->execute();
foreach ($sth as $res) :
extract($res);
    echo '<option value="'.$id_usu_lista.'">'.$usuario_usu_lista.'</option>';
endforeach;
?>
  </select>
  <label>usuarios da lista</label>
  <button class="btn waves-effect blue-grey darken-4" type="submit" name="Enviar">remover usuario da lista
    <i class="material-icons right">send</i>
  </button>
</div>
</form>
<br><br>
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
    //alert("foi");
    $('form[name="delusuario"]').submit(function() {
      var forma = $(this);
      var dados = forma.serialize();
      $.ajax({
        url: 'php/comp/deletausuario.php',
        data: dados,
        type: 'POST',
        beforeSent: function() {
        },
        success: function(resposta) {
            listausuario();
            alert("usuario excluido com sucesso");
        },
        complete: function() {
        }
      });
      return false;
    });
    function listausuario(){
            $(".usuarios").text("");
    }
</script>