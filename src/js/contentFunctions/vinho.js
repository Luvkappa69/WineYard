let controllerPath = "src/controller/vinhoController.php"

function listaVinho() {
    
  
  let dados = new FormData();
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
      if ($.fn.DataTable.isDataTable('#tableVinho')) {
          $('#tableVinho').DataTable().destroy();
      }
      $('#tableVinhosContainer').html(msg);
      $('#tableVinho').DataTable({
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




function openVendaModal(idVindima){
  $('#btnVendasModal').attr('onclick', 'executaVenda(' + idVindima + ')')
  $("#vendasModal").modal("toggle")
}



function executaVenda(idVindima){
  let dados = new FormData();
  dados.append('id_vindima', idVindima);
  dados.append('quantidade', $("#quantidadeVenda").val());
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
    alerta("info", msg)
    listaVinho()

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








$(function () {
  listaVinho()
});