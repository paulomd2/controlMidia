function rolar_para(elemento) {
    $('html, body').animate({
        scrollTop: $(elemento).offset().top
    }, 1000);
}

function cadComentario(idPost) {
    var elemento = "#texto" + idPost;
    var comentario = $(elemento).val();

    if (comentario == '') {
        $("#spanComentario").html('É necessário preencher o comentário');
        $(elemento).focus();
    } else {
        $.post('control/postControle.php', {opcao: 'cadComentario', comentario: comentario, idPost: idPost},
        function (r) {
            console.log(r);
        });

        $("#comentariosAjax" + idPost).load('listaComentariosAjax.php?idPost=' + idPost);
        $(elemento).val('');
    }
}

function validaPost(form) {
    var data = $("#data").val();
    var texto = $("#texto").val().trim();
    var imagem = $("#foto").val();

    $(".erro").html("");
    if (data == '') {
        $("#data").focus();
        $("#spanData").html("Você deve preencher a data");
    } else if (texto == '' && imagem == '') {
        $("#spanImagem").html("Você deve preencher o texto ou a imagem, por favor preencha pelo menos um dos dois!");
    } else {
        $("#"+form).submit();
    }
}

function delPost(id){
    if(confirm("Você tem certeza que deseja excluir esse post?") === true){
        $.post('control/postControle.php',{opcao:'excluirPost', idPost:id});
        $("#posts").load("posts.php");
    }
}

function alteraImagem(id){
    var imagem = $("#imagem"+id).val();
    
    $(".erro").html('');
    if(imagem == ''){
        $("#spanImagem"+id).html('Você precisa selecionar uma imagem');
    }else{
        $("#frmAltImagem").submit();
    }
}

function aprovaPost(id){
    if(confirm("Você tem certeza que deseja aprovar esse post?") === true){
        $.post('control/postControle.php',{opcao:'aprovaPost',idPost:id},
        function(r){
            console.log(r);
        });
        $("#posts").load('posts.php');
    }
}

$(document).ready(function () {
    var nav = $('#backtop span');
    nav.css('display', 'none');
    $(window).scroll(function () {
        if ($(this).scrollTop() > 1000) {
            nav.addClass("fixo");
            nav.css('display', 'block');
        } else {
            nav.removeClass("fixo");
            nav.css('display', 'none');
        }
    });

    $("#btnCadPost").click(function () {
        validaPost('frmCadPost');
    });
    
    $("#btnAltPost").click(function () {
        validaPost('frmAltPost');
    });
});