const BASE_URL = 'http://127.0.0.1:8000/api/';

function makeRequest(url, data, requestType) {
    return $.ajax({
        url: url,
        dataType: 'json',
        data: data,
        type: requestType,
        beforeSend: function () {
        },
        complete: function (data) {
        },
        success: function (data, textStatus) {
        },
        error: function (xhr, er) {
        }
    });
}

function inativarProduto(idProduto) {
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
                    Swal.fire({
                        title: 'Inativado!',
                        text: 'Produto foi inativado com sucesso.',
                        type: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok!'
                    }).then(() => {
                        location.reload();
                    });
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

function cancelarPedido(idPedido) {
    Swal.fire({
        title: 'Deseja continuar?',
        text: "Sua reserva será cancelada!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim!'
    }).then((result) => {
        if (result.value) {
            makeRequest(BASE_URL + 'pedido/cancelar/' + idPedido, null, 'PUT').then(function (data, httpRequest) {
                if (httpRequest === 'success') {
                    Swal.fire({
                        title: 'Inativado!',
                        text: 'Produto foi inativado com sucesso.',
                        type: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok!'
                    }).then(() => {
                        location.reload();
                    });
                    return;
                }
                Swal.fire(
                    'Atenção',
                    'Seu produto já foi cancelado ou confirmado. Entre em contato com o fornecedor para mais informações.',
                    'warning'
                );
            });
        }
    })
}

function confirmarPedido(idPedido) {
    Swal.fire({
        title: 'Deseja confirmar esse pedido?',
        text: "",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim!',
        cancelButtonText: 'Não'
    }).then((result) => {
        if (result.value) {
            makeRequest(BASE_URL + 'pedido/confirmar/' + idPedido, null, 'PUT').then(function (data, httpRequest) {
                if (httpRequest === 'success') {
                    Swal.fire({
                        title: 'Sucesso!',
                        text: 'Pedido confirmado com sucesso. Entre em contato com o cliente para finalização do processo',
                        type: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok!'
                    }).then(() => {
                        location.reload();
                    });
                    return;
                }
                Swal.fire(
                    'Atenção',
                    'Pedido já confirmado.',
                    'warning'
                );
            });
        }
    })
}


function inativarAnuncio(idAnuncio) {
    Swal.fire({
        title: 'Deseja continuar?',
        text: "Este anúncio será inativado!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim!'
    }).then((result) => {
        if (result.value) {
            makeRequest(BASE_URL + 'anuncio/' + idAnuncio, null, 'DELETE').then(function (data, httpRequest) {
                if (httpRequest === 'success') {
                    if (data.id) {
                        Swal.fire({
                            title: 'Inativado!',
                            text: 'Anúncio foi inativado com sucesso.',
                            type: 'success',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok!'
                        }).then(() => {
                            location.reload();
                        });
                        return;
                    }

                    if (!data.data) {
                        Swal.fire(
                            'Que pena :(',
                            data.message,
                            'warning'
                        );
                    }
                }

            });
        }
    })
}

