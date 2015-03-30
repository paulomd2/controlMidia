$(document).ready(function(){
   $("#btnLogin").click(function(){
      var login = $("#login").val().trim();
      var senha = $("#senha").val().trim();
      
      $("#spanLogin").html('');
      if(login == ''){
          $("#spanLogin").html('Você deve preencher o login');
          $("#login").focus();
      }else if(senha == ''){
          $("#spanLogin").html('Você deve preencher a Senha');
          $("#senha").focus();
      }else{
          $.post('control/usuarioControle.php',{opcao: 'verificaLogin', login:login, senha:senha},
          function(r){
              if(r == 0){
                  $("#spanLogin").html('Login e/ou Senha não conferem. Tente novamente !!!');
              }else{
                  window.location = 'principal.php';
              }
          })
      }
   });
});