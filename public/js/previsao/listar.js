

document.addEventListener("DOMContentLoaded", function () {

    var dataTable = new DataTable(document.getElementById("previsoes"), {
      responsive: true,
      order: [[0, "asc"]],
      iDisplayLength: 100,
      ordering: true,
      searching: true,
      buttons: [],
      language: {
        url: `${base_url}/DataTables/pt-BR.json`,
      },
      dom: "Bfrtip",
    });
  
 
   
  });