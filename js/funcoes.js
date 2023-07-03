$(document).ready(function(){


$("#botaoPesquisaItem").click(function(){
            jQuery.ajax({
            url: "verificaPesquisa.php",
            data:{nome:$("#search").val(), tipoLanche:$("#filtroTipo").val()},
            context: jQuery(".pesquisar"),
            type: "POST",
            success: function(data,response){
      $(this).html(data);
    }
  });
});

$("#filtroTurno").change(function(){
            jQuery.ajax({
            url: "verificaTurno.php",
            data:{turno:$("#filtroTurno").val()},
            context: jQuery(".carousel"),
            type: "POST",
            success: function(data,response){
      $(this).html(data);
    }
  });
});

$("#botaoPesquisaItemAdm").click(function(){

jQuery.ajax({
url: "verificaPesquisaItemAdm.php",
data:{nome:$("#searchAdm").val(), quem:$("#filtroAdm").val(), tipoLanche:$("#tipoAdm").val(), statusLanche:$("#statusAdm").val()},
context: jQuery(".lista-clientes"),
type: "POST",
success: function(data,response){
$(this).html(data);
}
});
});



$("#itemImg").change(function(){
$.post("verificaImg.php",{itemImg:$("#itemImg").val()},function(data){

    if(!data){
      $("#botaoCad").prop("disabled", true)
      alert("A extensão do arquivo deve ser .png, .jpg ou .jpeg");
    }

    else{
      $("#botaoCad").prop("disabled", false)
    }
  });
});


$("#filtroAdm").change(function(){

  opcao=$('#filtroAdm').val();

    if(opcao=="Item"){
    $("#filtroTipoAdm").show(500);
    $("#filtroStatusAdm").show(500);
    }

    if(opcao=="Fornecedor"){
    $("#filtroTipoAdm").hide(500);
    $("#filtroStatusAdm").hide(500);
    }


});
$("#itemImg").change(function(){
$.post("verificaImg.php",{itemImg:$("#itemImg").val()},function(data){

    if(!data){
      $("#botaoCad").prop("disabled", true)
      alert("A extensão do arquivo deve ser .png, .jpg ou .jpeg");
    }

    else{
      $("#botaoCad").prop("disabled", false)
    }
  });
});


$("#filtroItem").change(function(){
 //alert ("aaaa");
  jQuery.ajax({
  url: "verificaPesquisaCardapio.php",
  data:{nome:$("#filtroItem").val()},
  context: jQuery(".pesquisar"), // ver esse
  type: "POST",
  success: function(data,response){
  $(this).html(data);
  }

});
});

$("#dataCardapio1").change(function(){

  jQuery.ajax({
  url: "verificaPesquisaCardapio.php",
  data:{dia1:$("#dataCardapio1").val(),dia2:$("#dataCardapio2").val()}, // ver os paramentros
  context: jQuery(".pesquisar"), // ver esse
  type: "POST",
  success: function(data,response){
  $(this).html(data);
  }

});

});

$("#dataCardapio2").change(function(){

  jQuery.ajax({
  url: "verificaPesquisaCardapio.php",
  data:{dia1:$("#dataCardapio1").val(),dia2:$("#dataCardapio2").val()},
  context: jQuery(".pesquisar"),
  type: "POST",
  success: function(data,response){
  $(this).html(data);
  }

});

});

/*$("#botaoReplica").click(function(){
alert("alo");
  jQuery.ajax({
  url: "replicandoCardapio.php",
  data:{copia:$("#dataCopia").val(),dia:$("#dataCardapio").val(), turno:$("#turnoCardapio").val()},
  type: "POST",
  success: function(data,response){
  $(this).html(data);
  }

});

});
*/

});
