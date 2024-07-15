let controllerPath = "src/controller/vinhasController.php"


function regista() {
  if (
    $('#descricaoVinha').val() =="" ||
    $('#haVinha').val() =="" ||
    $('#dataPlantacaoVinha').val() =="" ||
    $('#pColheitaVinha').val() =="" 
  ){
    return alerta("error", "Por favor preencha os campos ...");
  }

  let dados = new FormData();
  dados.append('descricao', $('#descricaoVinha').val());
  dados.append('ha', $('#haVinha').val());
  dados.append('data_plantacao', $('#dataPlantacaoVinha').val());
  dados.append('ano_p_colheita', $('#pColheitaVinha').val());
  dados.append('foto', $('#fotoVinha').prop('files')[0]); //image 🖼️
  
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

      if ($.fn.DataTable.isDataTable('#tableVinhas')) {
          $('#tableVinhas').DataTable().destroy();
      }
      $('#tableVinhasContainer').html(msg);
      $('#tableVinhas').DataTable({
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
        









        
function edita(key) {
  let dados = new FormData();
  dados.append('id', key);
  dados.append('op', 4);

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

    let obj = JSON.parse(msg);

    $('#descricaoVinhaEdit').val(obj.descricao);
    $('#haVinhaEdit').val(obj.ha);
    $('#dataPlantacaoVinhaEdit').val(obj.data_plantacao);
    $('#pColheitaVinhaEdit').val(obj.ano_p_colheita);
    $('#oldVinhaFoto').attr('src', obj.foto)

    $('#vinhasEditModal').modal('toggle');
    $('#guardaEditVinhas').attr('onclick', 'guardaEdit(' + obj.id + ')')

  })
  .fail(function (jqXHR, textStatus) {
    alert("Request failed: " + textStatus);
  });
}
        









        
function guardaEdit(key) {
  let dados = new FormData();
  dados.append('descricao', $('#descricaoVinhaEdit').val());
  dados.append('ha', $('#haVinhaEdit').val());
  dados.append('data_plantacao', $('#dataPlantacaoVinhaEdit').val());
  dados.append('ano_p_colheita', $('#pColheitaVinhaEdit').val());
  dados.append('foto', $('#fotoVinhaEdit').prop('files')[0]); //image 🖼️

  dados.append('old_key', key);
  dados.append('op', 5);

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
        


  
function openCastaModal(id_vinho){

  $('#addCastaVinha').val(id_vinho);


  $('#addCastaModal').modal('toggle');
  $('#guardaCasta').attr('onclick', 'addCasta(' + id_vinho + ')')
}


function addCasta(idVinho){
  if($('#addCastaCasta').val() == ""){
    return alerta("error", "Por favor escolha uma casta");
  }
  let dados = new FormData();
  console.log($('#addCastaCasta').val())
  dados.append('addCastaVinha', idVinho);
  dados.append('addCastaCasta', $('#addCastaCasta').val());
  dados.append('op', 6);

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
      $('#addCastaVinha').html(msg);
    })

    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });
}

function getSelect_castas() {
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
      $('#addCastaCasta').html(msg);
    })
    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });
}


        
$(function () {
  listagem();
  getSelect_castas()
  getSelect_vinhas()
});



