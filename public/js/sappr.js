const BASE_URL = 'http://127.0.0.1:8000/api/';
$(document).ready(function () {
    console.log('deu boa');
    // $('#deleteButton').click(function (teste) {
    //     console.log(teste);
    //     console.log($('#deleteButton'));
    // })
});

function makeRequest(url, data, requestType) {
    return $.ajax({
        url: url,
        dataType: 'json',
        data: data,
        type: requestType,
        beforeSend: function () {
            console.log('beforeSend');
        },
        complete: function (data) {
            console.log('request completa')
        },
        success: function (data, textStatus) {
            console.log('successo')
        },
        error: function (xhr, er) {
            console.log('erro');
        }
    });
}

function inativarProduto(idProduto) {
    console.log('idProduto', idProduto);
    return;
    Swal.fire({
        title: 'Deseja continuar?',
        text: "Este registro será inativado!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim!'
    }).then((result) => {
        if (result.value) {
            makeRequest(BASE_URL + 'produto/' + idProduto, null, 'DELETE').then(function (data, httpRequest) {
                if (httpRequest === 'success') {
                    Swal.fire(
                        'Inativado!',
                        'Produto foi inativado com sucesso.',
                        'success'
                    );
                    return;
                }
                Swal.fire(
                    'Que pena :(',
                    'Este produto não foi encontrado ou já está inativo.',
                    'warning'
                );
            });
        }
    })

}
