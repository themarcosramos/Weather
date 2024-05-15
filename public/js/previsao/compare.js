$(".cep").mask("00000-000");

$(".cep").on("change", function () {
    if (!$("#erro-" + $(this).attr("id")).hasClass("d-none")) {
        $("#erro-" + $(this).attr("id")).addClass("d-none");
    }
    let num_campo = $(this).attr("data-num-campo");
    let id_campo = $(this).attr("id");
    let cep = $(this).val();
    buscaCep(cep)
        .then(function (dados) {
            if (!dados.erro) {
               

                $("#cidade" + num_campo).val(dados.localidade);
            } else {
                $("#div-" + id_campo).append(
                    `<span class="error-message" id="erro-cep${num_campo}"></span>`
                );
                $("#erro-" + id_campo)
                    .html("Não foi possivel encontrar o CEP inserido")
                    .removeClass("d-none");
            }
        })
        .catch(function (error) {
            console.error(error);
        });
});
