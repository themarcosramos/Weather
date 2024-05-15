$("#cep").mask("00000-000");

$("#cep").on("change", function () {
    if (!$("#erro-cep").hasClass("d-none")) {
        $("#erro-cep").addClass("d-none");
    }

    let cep = $(this).val();
    buscaCep(cep)
        .then(function (dados) {
            if (!dados.erro) {
                console.log(dados);

                $("#cidade").val(dados.localidade);
            } else {
                $("#div-cep").append(
                    '<span class="error-message" id="erro-cep"></span>'
                );
                $("#erro-cep")
                    .html("Não foi possivel encontrar o CEP inserido")
                    .removeClass("d-none");
            }
        })
        .catch(function (error) {
            console.error(error);
        });
});

$("#pesquisaPrevisao").validate({
    rules: {
        cep: {
            minlength: 9,
        },
        cidade: {
            required: true,
            minlength: 3,
        },
    },
    messages: {
        cep: {
            minlength: "O CEP deve conter ao menos 8 caracteres.",
        },
        cidade: {
            required: "Por favor, insira a cidade.",
            minlength: "A cidade deve conter ao menos 3 caracteres.",
        },
    },
    errorElement: "span",
    errorClass: "error-message",
    highlight: function (element, errorClass, validClass) {
        $(element).addClass("error-field");
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass("error-field");
    },
    success: function (label, element) {
        $(element).addClass("success-field");

        label.remove();
    },
    submitHandler: function (form) {
        form.submit();
    },
    submitHandler: function (form) {
        form.submit();
    },
});

$("#formPesquisaHistorico").validate({
    rules: {
        query: {
            required: true,
            minlength: 3,
        },
    },
    messages: {
        query: {
            required: "Por favor, insira a pesquisa.",
            minlength: "A pesquisa deve ter pelo menos 3 caracteres.",
        },
    },
    errorElement: "span",
    errorClass: "error-message",
    highlight: function (element, errorClass, validClass) {
        jQuery(element).addClass("error-field");
    },
    unhighlight: function (element, errorClass, validClass) {
        jQuery(element).removeClass("error-field");
    },
    success: function (label, element) {
        jQuery(element).addClass("success-field");

        label.remove();
    },
    submitHandler: async function (form) {
        event.preventDefault();
        let dados = jQuery(form).serializeArray();

        $.ajax({
            url: `${base_url}/previsao/historicos/pesquisar`,
            method: "get",
            data: dados,
            success: function (res) {
                console.log(res);
                $("#listar-historicos").empty();
                if (res.length > 0) {
                    $.each(res, function (index, value) {
                        let item_pesquisa = ` <div id="item${value.id}"class="glass-item rounded p-2 d-flex flex-row justify-content-between">
                    <i>${value.query}</i> <a onclick="excluirPesquisa(${value.id})" role="button"
                        class="btn btn-sm btn-light"><i class="fa fa-xmark"></i></a>
                </div>`;
                        $("#listar-historicos").append(item_pesquisa);
                    });
                } else {
                    $("#listar-historicos").append(
                        "<p>Não há nenhuma pesquisa correspondente</p>"
                    );
                }
            },
            error: function (err) {},
        });
    },
});

function excluirPesquisa(id_pesquisa) {
    $.ajax({
        url: `${base_url}/previsao/historicos/delete/${id_pesquisa}`,
        method: "get",
        success: function (res) {
            if (res) {
                $(`#item${id_pesquisa}`).fadeOut(400, function() {
                    $(this).remove();
                });
               
            }
        },
    });
}
function abrirModalHistorico() {
    $("#HistoricoDePesquisasModal").modal("show");
}
