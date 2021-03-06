var table = $('.dt').DataTable({
    'language': {
        "sEmptyTable": "Nenhum registro encontrado.",
        "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
        "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
        "sInfoFiltered": "(Filtrados de _MAX_ registros)",
        "sInfoPostFix": "",
        "sInfoThousands": ".",
        "sLengthMenu": "Mostrando _MENU_ resultados por página",
        "sLoadingRecords": "Carregando...",
        "sProcessing": "Processando...",
        "sZeroRecords": "Nenhum registro encontrado.",
        "sSearch": "Pesquisar",
        "oPaginate": {
            "sNext": "Próximo",
            "sPrevious": "Anterior",
            "sFirst": "Primeiro",
            "sLast": "Último"
        },
        "oAria": {
            "sSortAscending": ": Ordenar colunas de forma ascendente",
            "sSortDescending": ": Ordenar colunas de forma descendente"
        }
    }
});

function applyMask() {
    $('.cpf').mask('000.000.000-00');
    $('.agencia').mask('0.000-0', {
        reverse: true
    });
    $('.conta').mask('#.##0-0', {
        reverse: true
    });
    $('.phone').mask('00000-0000', {
        reverse: true
    });
    $('.ddd').mask('00');
    $('.cep').mask('00.000-000');
    $('.date').mask('00/00/0000');
    $('.money').mask('#.##0,00', {
        reverse: true
    });
}
applyMask();

function applyIcons() {
    feather.replace({
        width: 18,
        heigth: 18
    });
}
applyIcons();

$('.container').on('click', '.confirm', function() {
    return confirm('Deseja completar esta ação?');
});

$('.logout').click(function() {
    return confirm('Deseja realmente sair do sistema?');
});

$(document).ajaxSuccess(function() {
    $('.date').datepicker({
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
        dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
        dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
        monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
        nextText: 'Próximo',
        prevText: 'Anterior',
        showButtonPanel: true,
        currentText: 'Hoje',
        closeText: 'Fechar',
        maxDate: 0,
        changeMonth: true,
        changeYear: true,
        yearRange: '1920:c'
    });
    applyMask();
    applyIcons();
});

$('.date').datepicker({
    dateFormat: 'dd/mm/yy',
    dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
    dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
    dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
    monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
    monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
    nextText: 'Próximo',
    prevText: 'Anterior',
    showButtonPanel: true,
    currentText: 'Hoje',
    closeText: 'Fechar',
    maxDate: 0,
    changeMonth: true,
    changeYear: true,
    yearRange: '1920:c'
});

$('.go-back').click(function() {
    history.back();
});

$('.print').click(function() {
    $('.container').print();
});

/*
 * Adiciona campos de telefone durante o cadastro do associado.
 */
$('#novo-telefone').click(function() {
    var content = $('.form-telefone').first().html();
    var container = $('<div class="form-telefone"></div>');
    var div = $('<div class="col"></div>');
    var btn = $('<button type="button" class="btn"><span class="close">&times;</span></button>');
    btn.click(function() {
        $(this).parent().parent().parent().remove();
    });
    div.html(btn);
    container.html(content);
    $('.form-telefone').last().after(container);
    $('input[name="telefone[]"]').last().parent().after(div);
    applyMask();
});

/*
 * Carrega a view telefones_por_associado.php
 */

function loadPhones(target, id) {
    $.get({
        url: base_url + 'telefones/porassociado/' + id,
        dataType: 'html',
        success: function(response) {
            target.html(response);
            applyIcons();
        }
    });
}
if ($('.phone-table').length > 0) {
    loadPhones($('.phone-table'), $('#adicionar-telefone').attr('data-associado'));
}

/*
 * Carrega a view enderecos_por_associado.php
 */

function loadAddresses(target, id) {
    $.get({
        url: base_url + 'enderecos/porassociado/' + id,
        dataType: 'html',
        success: function(response) {
            target.html(response);
            applyIcons();
        }
    });
}
if ($('.address-table').length > 0) {
    loadAddresses($('.address-table'), $('#adicionar-endereco').attr('data-associado'));
}

/*
 * Adiciona telefones de associados na view editar_associado
 */
$('#adicionar-telefone').click(function() {
    var id = $(this).attr('data-associado');
    var url = base_url + 'telefones/novo';
    var title = $('.modal-title');
    var body = $('.add-body');
    var footer = $('.modal-footer');
    $.get({
        url: url,
        dataType: 'html',
        success: function(response) {
            title.html('Adicionar telefone');
            body.removeClass('text-center');
            body.html(response);
            footer.css('display', 'none');
            $('.modal').modal();
        },
        error: function() {
            title.html('Oops!');
            body.html('Não foi possível concluir sua transação.');
            $('.modal').modal();
        }
    });
});

$('#adicionar-endereco').click(function() {
    var id = $(this).attr('data-associado');
    var url = base_url + 'enderecos/novo';
    var title = $('.modal-title');
    var body = $('.add-body');
    var footer = $('.modal-footer');
    $.get({
        url: url,
        dataType: 'html',
        success: function(response) {
            title.html('Adicionar endereço');
            body.removeClass('text-center');
            body.html(response);
            footer.css('display', 'none');
            $('.modal-dialog').addClass('modal-lg');
            $('.modal').modal();
            $('.modal').on('hidden.bs.modal', function() {
                $('.modal-dialog').removeClass('modal-lg');
            });
        },
        error: function() {
            title.html('Oops!');
            body.html('Não foi possível concluir sua transação.');
            $('.modal').modal();
        }
    });
});

$('button[data-dependente]').click(function() {
    var id = $(this).attr('data-dependente');
    var edit = $(this).attr('data-edit');
    var url = base_url + 'documentos/pordependente/' + id;
    if (edit === 'false') {
        url += '/?edit=false';
    }
    var title = $('#add-modal .modal-title');
    var body = $('#add-modal .add-body');
    var footer = $('#add-modal .modal-footer');
    $.get({
        url: url,
        dataType: 'html',
        success: function(response) {
            title.html('Documentos do dependente');
            body.removeClass('text-center');
            body.html(response);
            footer.css('display', 'none');
            $('#add-modal .modal-dialog').addClass('modal-lg');
            $('#add-modal').modal();
            $('#add-modal').on('hidden.bs.modal', function() {
                $('#add-modal .modal-dialog').removeClass('modal-lg');
            });
        },
        error: function() {
            title.html('Oops!');
            body.html('Não foi possível concluir sua transação.');
            $('#add-modal').modal();
        }
    });
});

$('.add-body').on('submit', '#form-telefone', function(e) {
    e.preventDefault();
    var id = $('#adicionar-telefone').attr('data-associado');
    var idTelefone = $('#form-telefone input[name="id"]').val();
    var form = $('.add-body > form');
    var body = $('.add-body');
    var footer = $('.modal-footer');
    var url = base_url + 'telefones/salvar/' + id;
    if (idTelefone) {
        url = url + '/' + idTelefone;
    }
    var img = $('<img>');
    var phones = $('.phone-table');
    $.post({
        url: url,
        dataType: 'json',
        data: form.serialize(),
        success: function(response) {
            if (!response.status) {
                img.attr('src', base_url + 'assets/images/error.gif');
            } else {
                img.attr('src', base_url + 'assets/images/ok.gif');
            }
            body.addClass('text-center');
            body.html(img);
            footer.css('display', 'flex');
        }
    }).done(function() {
        loadPhones(phones, id);
    });
});

$('.add-body').on('submit', '#form-endereco', function(e) {
    e.preventDefault();
    var id = $('#adicionar-endereco').attr('data-associado');
    var idEndereco = $('#form-endereco input[name="id"]').val();
    var form = $('.add-body > form');
    var body = $('.add-body');
    var footer = $('.modal-footer');
    var url = base_url + 'enderecos/salvar/' + id;
    if (idEndereco) {
        url = url + '/' + idEndereco;
    }
    var img = $('<img>');
    var address = $('.address-table');
    $.post({
        url: url,
        dataType: 'json',
        data: form.serialize(),
        success: function(response) {
            if (!response.status) {
                img.attr('src', base_url + 'assets/images/error.gif');
            } else {
                img.attr('src', base_url + 'assets/images/ok.gif');
            }
            body.addClass('text-center');
            body.html(img);
            footer.css('display', 'flex');
        },
        error: function(error) {
            img.attr('src', base_url + 'assets/images/error.gif');
            img.attr('alt', 'Ocorreu um erro!');
            $('.modal-title').html('Ocorreu um erro! :(');
            body.html(img);
            body.append('Ocorreu um erro: ' + error);
        }
    }).done(function() {
        loadAddresses(address, id);
    });
});

$('.phone-table').on('click', '.delete-phone', function() {
    var r = confirm('Deseja continuar?');
    if (r) {
        $.get({
            url: $(this).attr('data-target'),
            dataType: 'json',
            success: function(response) {
                loadPhones($('.phone-table'), $('#adicionar-telefone').attr('data-associado'));
            }
        });
    }
});

$('.address-table').on('click', '.delete-address', function() {
    var r = confirm('Deseja continuar?');
    if (r) {
        $.get({
            url: $(this).attr('data-target'),
            dataType: 'json',
            success: function(response) {
                loadAddresses($('.address-table'), $('#adicionar-endereco').attr('data-associado'));
            }
        });
    }
});

$('.phone-table').on('click', '.edit-phone', function() {
    var url = $(this).attr('data-target');
    var title = $('.modal-title');
    var body = $('.add-body');
    var footer = $('.modal-footer');
    $.get({
        url: url,
        dataType: 'html',
        success: function(response) {
            title.html('Editar telefone');
            body.removeClass('text-center');
            body.html(response);
            footer.css('display', 'none');
            $('.modal').modal();
        },
        error: function() {
            title.html('Oops!');
            body.html('Não foi possível concluir sua transação.');
            $('.modal').modal();
        }
    });
});

$('.address-table').on('click', '.edit-address', function() {
    var url = $(this).attr('data-target');
    var title = $('.modal-title');
    var body = $('.add-body');
    var footer = $('.modal-footer');
    $.get({
        url: url,
        dataType: 'html',
        success: function(response) {
            title.html('Editar endereço');
            body.removeClass('text-center');
            body.html(response);
            footer.css('display', 'none');
            $('.modal-dialog').addClass('modal-lg');
            $('.modal').modal();
            $('.modal').on('hidden.bs.modal', function() {
                $('.modal-dialog').removeClass('modal-lg');
            });
        },
        error: function() {
            title.html('Oops!');
            body.html('Não foi possível concluir sua transação.');
            $('.modal').modal();
        }
    });
});

/*
 * Desativar associado
 */
$('#desativar-associado').click(function() {
    var title = $('.modal-title');
    var body = $('.add-body');
    var footer = $('.modal-footer');
    var a = $('<a class="btn btn-danger">');
    var close = $('<button data-dismiss="modal" class="btn btn-secondary">');
    body.addClass('text-center');
    close.text('Fechar');
    a.attr('href', base_url + 'associados/desativar/' + $('#associado-id').val());
    a.text('Continuar');
    title.html('Desativar associado');
    body.html('Tem certeza que deseja continuar?');
    footer.css('display', 'flex');
    footer.html(close);
    footer.append(a);
    $('.modal').modal();
    $('.modal').on('hidden.bs.modal', function() {
        footer.html(close);
    });
});

/*
 * Excluir associado
 */
$('#excluir-associado').click(function() {
    var title = $('.modal-title');
    var body = $('.add-body');
    var footer = $('.modal-footer');
    var a = $('<a class="btn btn-danger">');
    var close = $('<button data-dismiss="modal" class="btn btn-secondary">');
    body.addClass('text-center');
    close.text('Fechar');
    a.attr('href', base_url + 'associados/excluir/' + $('#associado-id').val());
    a.text('Continuar');
    title.html('Excluir associado');
    body.html('Essa operação não poderá ser desfeita. Tem certeza que deseja continuar?');
    footer.css('display', 'flex');
    footer.html(close);
    footer.append(a);
    $('.modal').modal();
    $('.modal').on('hidden.bs.modal', function() {
        footer.html(close);
    });
});

/*
 * Excluir usuário do sistema
 */
$('.delete-user').click(function(e) {
    e.preventDefault();
    var title = $('.modal-title');
    var body = $('.add-body');
    var footer = $('.modal-footer');
    var a = $('<a class="btn btn-danger">');
    var close = $('<button data-dismiss="modal" class="btn btn-secondary">');
    body.addClass('text-center');
    close.text('Fechar');
    a.attr('href', $(this).attr('href'));
    a.text('Continuar');
    title.html('Excluir usuário');
    body.html('Essa operação não poderá ser desfeita. Tem certeza que deseja continuar?');
    footer.css('display', 'flex');
    footer.html(close);
    footer.append(a);
    $('.modal').modal();
    $('.modal').on('hidden.bs.modal', function() {
        footer.html(close);
    });
});

/*
 * Função responsável por ativar a câmera e tirar as fotos
 */

function camera() {
    var camera = $('.camera');

    if (navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({
                video: true
            })
            .then(function(stream) {
                camera[0].srcObject = stream;
            })
            .catch(function(error) {
                alert('Não foi possível iniciar a câmera.');
                $('.pause').addClass('disabled').attr('disabled', 'disabled');
                $('.camera').css('display', 'none');
            });
    }

    var tipo = $('input[name="tipo"]').val();
    var acao = $('input[name="acao"]').val();
    var usuario = $('input[name="usuario"]').val();
    var loadingLink = $('.loading-link');

    $('.pause').click(function() {
        camera[0].pause();
        $('.pause').css('display', 'none');
        $('.capture-new').css('display', 'inline');
        $('.capture').css('display', 'inline');
    });

    $('.capture-new').click(function() {
        camera[0].play();
        $('.pause').css('display', 'inline');
        $('.capture-new').css('display', 'none');
        $('.capture').css('display', 'none');
    });

    $('.capture').click(function() {
        var canvas = $('canvas');
        canvas[0].getContext('2d').drawImage(camera[0], 0, 0, 400, 300);
        var dataUrl = canvas[0].toDataURL();
        var formData = {
            'usuario': usuario,
            'photo': dataUrl,
            'tipo': tipo
        };
        $('#loading-modal').modal({
            backdrop: 'static',
            keyboard: false
        });
        var loadingImg = $('<img>');
        loadingImg.attr('src', base_url + 'assets/images/loading-1.gif');
        loadingImg.attr('alt', 'Carregando...');
        $('.loading').html(loadingImg);
        var img = $('<img>');
        var msg = $('<p>');
        $.post({
            url: $('form').attr('action'),
            dataType: 'json',
            data: formData,
            success: function(response) {
                if (!response.status) {
                    img.attr('src', base_url + 'assets/images/error.gif');
                    img.attr('alt', 'Ocorreu um erro!');
                    $('.modal-title').html('Ocorreu um erro! :(');
                    msg.html(response.error);
                } else {
                    switch (tipo) {
                        case 'associado':
                            if (acao == 'nova') {
                                loadingLink.attr('href', base_url + 'contatos/novo/' + usuario);
                            } else {
                                loadingLink.attr('href', base_url + 'associados/ver/' + usuario);
                            }
                            break;
                        case 'dependente':
                            loadingLink.attr('href', base_url + 'associados/ver/' + response.associadoId);
                            break;
                    }
                    img.attr('src', base_url + 'assets/images/ok.gif');
                    img.attr('alt', 'Tudo certo!');
                    $('.modal-title').html('Tudo certo! ;)');
                    loadingLink.removeClass('disabled');
                }
                $('.loading').html(img);
                $('.loading').append(msg);
            },
            error: function(obj, error) {
                img.attr('src', base_url + 'assets/images/error.gif');
                img.attr('alt', 'Ocorreu um erro!');
                $('.modal-title').html('Ocorreu um erro! :(');
                msg.html('Ocorreu um erro: ' + error);
                $('.loading').html(img);
                $('.loading').append(msg);
            }
        });
    });
}
if ($('.camera').length > 0) camera();

$('.load-photo').click(function() {
    var id = $(this).attr('data-dependente-id');
    var url = base_url + 'dependentes/buscarFoto/' + id;
    var loading = $('#loading-modal .loading');
    var img = $('<img>');
    var msg = $('<p>');
    var title = $('#loading-modal .modal-title');
    var link = $('<a>');
    link.text('Nova foto');
    link.attr('href', base_url + 'fotos/alterar/dependente/' + id);
    link.addClass('btn btn-primary');
    $('#loading-modal').modal();
    $.get({
        url: url,
        dataType: 'json',
        success: function(response) {
            if (!response.status) {
                img.attr('src', base_url + 'assets/images/error.gif');
                img.attr('alt', 'Ocorreu um erro!');
                title.html('Ocorreu um erro! :(');
                loading.html(img);
                msg.html('Ocorreu um erro: ' + response.error);
                loading.append(msg);
            } else {
                title.html('Visualizar foto');
                if (response.photo == null) {
                    loading.html('O dependente não possui foto.');
                } else {
                    img.attr('src', response.photo);
                    loading.html(img);
                }
                $('#nova-foto').html(link);
            }
        }
    });
});

function lancamentosPorAno(associadoId, ano) {
    var url = base_url + 'financeiro/lancamentosPorAno/' + associadoId + '/';
    var container = $('.chk-lancamento');
    if (ano) {
        url += ano;
    }
    $.get({
        url: url,
        dataType: 'html',
        success: function(response) {
            container.html(response);
        },
        error: function(obj) {
            container.html('Não foi possível concluir sua solicitação.');
        }
    });
}
if ($('.chk-lancamento').length > 0) {
    var id = $('#associado-id').val();
    lancamentosPorAno(id);
}
$('select[name="ano"]').change(function() {
    var id = $('#associado-id').val();
    lancamentosPorAno(id, $(this).val());
});

// Script da página do leitor do arquivo de retorno
$('#warning-modal').modal({
    'backdrop': 'static'
});

$(window).scroll(function() {
    var height = $(window).scrollTop();
    if (height > 100) {
        $('.top-btn').fadeIn();
    } else {
        $('.top-btn').fadeOut();
    }
});
$(document).ready(function() {
    $(".top-btn").click(function(event) {
        event.preventDefault();
        $("html, body").animate({ scrollTop: 0 }, "slow");
        return false;
    });
});