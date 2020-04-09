/* Formata Campos Editaveis*/
$(document).ready(function () {		
    $('#txtcep').mask('00000-000');
    $('#txtcelular').mask('(00)00000-0000');
});

$('#txtcep').blur(function(){
    var txtcep = $('#txtcep').val();

     //Se não está vazio 
     if(txtcep != '')
     {
        $.ajax({      
            type : 'GET',
            url : 'https://cep.awesomeapi.com.br/json/'+txtcep,
    
            success: function (resposta) {   // success callback function  
                $('#divtxtceperror').html('');                 
                $('#txtcidade').val(resposta.city); 
                $('#txtbairro').val(resposta.district);                             
                $('#txtestado option[value="' + resposta.state + '"]').prop('selected', true); //Setando o option estado de acordo com busca cep
            },
            error: function (errorMessage) { // error callback 
                //console.log("Erro : ", errorMessage);
                $('#divtxtceperror').html('* Ocorreu um erro cep não encontrado !'); //ou $('#divtxtceperror').text('Ocorreu um erro cep não encontrado');    
            }
           
        });

     }
  });
