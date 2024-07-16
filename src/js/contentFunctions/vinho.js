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

  function openVendaModal($idVinha){
    $("#vendasModal").modal("toggle")
  }


  $(function () {
    listaVinho()
  });