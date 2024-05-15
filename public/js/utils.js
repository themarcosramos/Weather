
const base_url = "http://127.0.0.1:8000";
function pegarCoordenadasIp() {
    var lat_padrao = -22.981361;
    var long_padrao = -43.223176;
    $.ajax({
        url: "http://www.geoplugin.net/json.gp?",
        type: "GET",
        dataType: "json",
        success: function (data) {
            if (data.geoplugin_latitude && data.geoplugin_longitude) {
                pegarLocalUsuario(
                    data.geoplugin_latitude,
                    data.geoplugin_longitude
                );
            } else {
                pegarLocalUsuario(lat_padrao, long_padrao);
            }
        },
        error: function () {
            console.log("erro na requisição");
            pegarLocalUsuario(lat_padrao, long_padrao);
        },
    });
}
function buscaCep(cep) {
    cep = cep.replace(/[^0-9]/g, "");
    console.log(cep);
  
    return new Promise(function (resolve, reject) {
      $.ajax({
        headers: {
          "Content-Type": "application/json",
        },
        url: `https://viacep.com.br/ws/${cep}/json/`,
        method: "get",
        success: function (data) {
          resolve(data);
        },
        error: function (data) {
          console.log(data);
          reject(data);
        },
      });
    });
  }
  