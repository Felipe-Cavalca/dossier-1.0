$(function () {
    $("#ecomp").hide();
    $("#addl").hide();
    $("#dell").hide();
    $("#addu").hide();
    $("#delu").hide();
    lista();

    $('form[name="addlista"]').submit(function() {
      var forma = $(this);
      var dados = forma.serialize();
      $.ajax({
        url: 'php/comp/crialista.php',
        data: dados,
        type: 'POST',
        beforeSent: function() {
        },
        success: function(resposta) {
            lista();
        },
        complete: function() {
            alert("lista criada com sucesso");
        }
      });
      return false;
    });
    
    $('form[name="dellista"]').submit(function() {
      var forma = $(this);
      var dados = forma.serialize();
      $.ajax({
        url: 'php/comp/deletalista.php',
        data: dados,
        type: 'POST',
        beforeSent: function() {
        },
        success: function(resposta) {
            lista();
        },
        complete: function() {
            alert("lista deletada com sucesso");
        }
      });
      return false;
    });
    
    $('form[name="addusuario"]').submit(function() {
      var forma = $(this);
      var dados = forma.serialize();
      $.ajax({
        url: 'php/comp/adcionausuario.php',
        data: dados,
        type: 'POST',
        beforeSent: function() {
        },
        success: function(resposta) {
            //lista();
            if (resposta == 'inexistente'){
                alert("usuario invalido ou inexistente");
            }else if(resposta == 'foi'){
                alert("usuario adcionado com sucesso");
            }else if(resposta == 'cadastrado'){
                alert("usuario ja cadastrado nessa lista");
            }else{
                alert("preencha todos os campos");
            }
        },
        complete: function() {
        }
      });
      return false;
    });
    
    $('form[name="listausuarois"]').submit(function() {
      var forma = $(this);
      var dados = forma.serialize();
      $.ajax({
        url: 'php/comp/listausuario.php',
        data: dados,
        type: 'POST',
        beforeSent: function() {
        },
        success: function(resposta) {
            $(".usuarios").text("");
            $(".usuarios").prepend(resposta);
        },
        complete: function() {
        }
      });
      return false;
    });
    
    
})
function foi(){
    $("#ecomp").show();
    $("#comp").hide();
}
function adcionar_lista(){
    $("#ecomp").hide();
    $("#addl").show();
}
function remover_lista(){
    $("#ecomp").hide();
    $("#dell").show();
}
function adcionar_usuario(){
    $("#ecomp").hide();
    $("#addu").show();
}
function remover_usuario(){
    $("#ecomp").hide();
    $("#delu").show();
}
function voltar(){
    $("#addl").hide();
    $("#dell").hide();
    $("#addu").hide();
    $("#delu").hide();
    $("#ecomp").show();
    $("#comp").hide();
}
function cancela(){
    $("#addl").hide();
    $("#dell").hide();
    $("#addu").hide();
    $("#delu").hide();
    $("#ecomp").hide();
    $("#comp").show();
}

function lista(){
  $.ajax({
    url: 'php/comp/lista.php',
    beforeSent: function() {
    },
    success: function(resposta) {
        $(".lista").text("");
        $(".lista").prepend(resposta);
    },
    complete: function() {}
  });
  return false;
}





/*
    $('form[name="ofiltro"]').submit(function() {
      var forma = $(this);
      var dados = forma.serialize();
      $.ajax({
        url: 'filtrar.php',
        data: dados,
        type: 'POST',
        beforeSent: function() {
        },
        success: function(resposta) {
            $(".todos").hide();
            $(".mostrar_filtro").text("");
            $(".mostrar_filtro").prepend(resposta);
        },
        complete: function() {}
      });
      return false;
    });
    */