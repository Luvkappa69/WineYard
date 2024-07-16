let controllerPath = "src/controller/vindimaController.php"


function regista() {
  if (
    $('#id_vinha').val() =="" ||
    $('#id_funcionario').val() =="" ||
    $('#kg').val() =="" ||
    $('#data').val() =="" ||
    $('#tempo').val() =="" ||
    $('#id_ano').val() =="" 
  ){
    return alerta("error", "Por favor preencha os campos ...");
  }

  let dados = new FormData();
  dados.append('id_vinha', $('#id_vinha').val());
  dados.append('id_funcionario', $('#id_funcionario').val());
  dados.append('kg', $('#kg').val());
  dados.append('data', $('#data').val());
  dados.append('time', $('#tempo').val());
  dados.append('id_ano', $('#id_ano').val());

  
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
        
function registaAno() {
  if ($('#novoAno').val() ==""){
    return alerta("error", "Por favor preencha os campos ...");
  }

  let dados = new FormData();
  dados.append('novoAno', $('#novoAno').val());
  dados.append('op', 20);

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
    getSelect_ano()

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

      if ($.fn.DataTable.isDataTable('#tableVindimas')) {
          $('#tableVindimas').DataTable().destroy();
      }
      $('#tableVindimasContainer').html(msg);
      $('#tableVindimas').DataTable({
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
        



function getSelect_vinhas() {
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
      $('#id_vinha').html(msg);
    })

    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });
}

function getSelect_funcionarios() {
  let dados = new FormData();
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
      $('#id_funcionario').html(msg);
    })
    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });
}
function getSelect_ano() {
  let dados = new FormData();
  dados.append('op', 12);
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
      $('#id_ano').html(msg);
    })
    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });
}


        
$(function () {
  listagem();
  getSelect_vinhas()
  getSelect_funcionarios()
  getSelect_ano()
});



