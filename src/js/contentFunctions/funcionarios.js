let controllerPath = "src/controller/funcionariosController.php"


function regista() {
  if (
    $('#bi').val() =="" ||
    $('#nome').val() =="" ||
    $('#morada').val() =="" ||
    $('#telefone').val() =="" ||
    $('#email').val() =="" ||
    $('#salario').val() =="" ||
    $('#id_estado').val() ==-1 
  ){
    return alerta("error", "Por favor preencha os campos ...");
  }

  let dados = new FormData();
  dados.append('bi', $('#bi').val());
  dados.append('nome', $('#nome').val());
  dados.append('morada', $('#morada').val());
  dados.append('telefone', $('#telefone').val());
  dados.append('email', $('#email').val());
  dados.append('salario', $('#salario').val());
  dados.append('id_estado', $('#id_estado').val());

  
  dados.append('op', 1);

  $.ajax({
    url: controllerPath,
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false,
  })
  .done(function (msg) {

    alerta("success", msg);
    listagem();

  })

  .fail(function (jqXHR, textStatus) {
    alert("Request failed: " + textStatus);
  });

}
        






function estadoModify(pkey){
  let dados = new FormData();
  dados.append('bi', pkey);
  dados.append('op', 11);

  $.ajax({
    url: controllerPath,
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false,
  })
  .done(function (msg) {
    alerta("info", msg);
    listagem();

  })
  .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
  });
}


        
function listagem() {
  let dados = new FormData();
  dados.append('op', 2);

  $.ajax({
      url: controllerPath,
      method: "POST",
      data: dados,
      dataType: "html",
      cache: false,
      contentType: false,
      processData: false,
  })
  .done(function (msg) {

      if ($.fn.DataTable.isDataTable('#tableFuncionarios')) {
          $('#tableFuncionarios').DataTable().destroy();
      }
      $('#tableFuncionariosContainer').html(msg);
      $('#tableFuncionarios').DataTable({
          "columnDefs": [{
              "targets": '_all',
              "defaultContent": ""
          }]
      });

  })
  .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
  });
}
        









        
function remover(key) {
  let dados = new FormData();
  dados.append('id', key);
  dados.append('op', 3);

  $.ajax({
    url: controllerPath,
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false,
  })
  .done(function (msg) {

    alerta("success", msg);
    listagem();

  })
  .fail(function (jqXHR, textStatus) {
    alert("Request failed: " + textStatus);
  });
}
        









        

        









        

        









        
function alerta(icon, msg) {

  Swal.fire({
    title: "<strong>Feedback</strong>",
    icon: icon,
    text: msg,
    showCloseButton: true,
    focusConfirm: false,
  });
}
        



function getSelect_estado() {
  let dados = new FormData();
  dados.append('op', 10);
  $.ajax({
    url: controllerPath,
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false,
  })
    .done(function (msg) {
      $('#id_estado').html(msg);
    })

    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });
}



        
$(function () {
  listagem();
  getSelect_estado()

});



