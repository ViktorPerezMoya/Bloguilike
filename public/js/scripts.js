/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){
    $('#login_mn').click(function (){
        $("#modal_login").modal('show');
    });
    
    $("#registrarse_btn").click(function(){
        $("#modal_register").modal('show');
        $("#modal_login").modal('hide');
    });
    
    $("#btn_registrar").click(function(event){
        event.preventDefault();
        
        var request = $.ajax({
            url: "http://localhost/blog/user/registrar",
            method: "POST",
            data: { 
                name_register : $("#name_register").val(),
                email_register: $("#email_register").val(),
                clave_register: $("#clave_register").val(),
                clave_register_repeat: $("#clave_register_repeat").val()
            },
            dataType: "html"
          });
          
          
        request.done(function( json ) {
           //console.log(json);
           var obj = jQuery.parseJSON(json);
           if(obj.success != null){
               $("#success_register").html('<div class="alert alert-success" role="alert">'+obj.success+'</div>');
               $("#register_form").trigger('reset');
               $("#name_register").prop('disabled',true);
               $("#email_register").prop('disabled',true);
               $("#name_register").prop('disabled',true);
               $("#clave_register").prop('disabled',true);
               $("#clave_register_repeat").prop('disabled',true);
               $('#modal_register').on('hidden.bs.modal', function (e) {
                    location.reload();//recargo la pagina al ocultar el modal
                 });
           }else{
               $("#error_register").html('<div class="alert alert-danger" role="alert">'+obj.error+'</div>');
           }
        });

        request.fail(function( jqXHR, textStatus ) {
          alert( "Request failed: " + textStatus );
        });
        
    });
    
    $("#btn_loguear").click(function (event){
        event.preventDefault();
        var request = $.ajax({
            url: "http://localhost/blog/auth/login",
            method: "POST",
            data: { 
                email: $("#email_login").val(),
                clave: $("#clave_login").val()
            },
            dataType: "html"
        });
        
        request.done(function (json){
            //console.log(json);
            var obj = jQuery.parseJSON(json);
            if(obj.error != null){
                $("#error_register").html('<div class="alert alert-danger" role="alert">'+obj.error+'</div>');
            }else{
                location.reload();
            }
        });
    });
    
    /* Likes y dislikes */
    $("#liked").click(function(event){
        event.preventDefault();
        var num_likes = $(this).find('span').html();
        var request = $.ajax({
            url: "http://localhost/blog/posts/like",
            method: "post",
            data: {
                post_id: v_postid,
                accion: 'liked'
            },
            dataType: "html"
        });
        
        request.done(function(json){
            //console.log(json);
            if(json == ''){
                return;
            }
            var obj = jQuery.parseJSON(json);
            $("#liked").find('span').html(obj.cant_like);
            $("#disliked").find('span').html(obj.cant_dislike);
        });
        request.fail(function( jqXHR, textStatus ) {
          alert( "Request failed: " + textStatus );
        });
    });
    
    $("#disliked").click(function(event){
        event.preventDefault();
        var num_likes = $(this).find('span').html();
        var request = $.ajax({
            url: "http://localhost/blog/posts/like",
            method: "post",
            data: {
                post_id: v_postid,
                accion: 'disliked'
            },
            dataType: "html"
        });
        
        request.done(function(json){
            //console.log(json);
            if(json == ''){
                return;
            }
            var obj = jQuery.parseJSON(json);
            $("#disliked").find('span').html(obj.cant_dislike);
            $("#liked").find('span').html(obj.cant_like);
        });
        request.fail(function( jqXHR, textStatus ) {
          alert( "Request failed: " + textStatus );
        });
    });
});
