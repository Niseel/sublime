/*
 *
 * login-register modal
 * Autor: Creative Tim
 * Web-autor: creative.tim
 * Web script: http://creative-tim.com
 * 
 */
function showRegisterForm(){
    $('.loginBox').fadeOut('fast',function(){
        $('.registerBox').fadeIn('fast');
        $('.login-footer').fadeOut('fast',function(){
            $('.register-footer').fadeIn('fast');
        });
        $('.modal-title').html('Register with');
    }); 
    $('.error').removeClass('alert alert-danger').html('');
       
}
function showLoginForm(){
    $('#loginModal .registerBox').fadeOut('fast',function(){
        $('.loginBox').fadeIn('fast');
        $('.register-footer').fadeOut('fast',function(){
            $('.login-footer').fadeIn('fast');    
        });
        
        $('.modal-title').html('Login with');
    });       
     $('.error').removeClass('alert alert-danger').html(''); 
}

function openLoginModal(){
    showLoginForm();
    setTimeout(function(){
        $('#loginModal').modal('show');    
    }, 230);
    
}
function openRegisterModal(){
    showRegisterForm();
    setTimeout(function(){
        $('#loginModal').modal('show');    
    }, 230);
    
}

function loginAjax(){
    /*   Remove this comments when moving to server
    $.post( "/login", function( data ) {
            if(data == 1){
                window.location.replace("/home");            
            } else {
                 shakeModal(); 
            }
        });
    */

/*   Simulate error message from the server   */
     shakeModal();
}

function shakeModal(){
    $('#loginModal .modal-dialog').addClass('shake');
             $('.error').addClass('alert alert-danger').html("Invalid email/password combination");
             $('input[type="password"]').val('');
             setTimeout( function(){
                $('#loginModal .modal-dialog').removeClass('shake');
    }, 1000 );
}
function isEmail(inputEmail){
    var regex = /^([a-z][\w_\-]+\.)*[\w]+@([\w+-]+\.)*[\w]+\.[a-zA-Z]{2,4}$/;
    return regex.test(inputEmail);
}
function validatePassword(inputPassword){
    return inputPassword.length > 5;
}
$(document).ready(function(){
    //check login
    $('#formDN #email').keyup(function(){
        var mail = $(this).val().trim();
        if (!isEmail(mail)){
            //Error
            $('.formError_DN_user').html('Invalid email combination');
        } else{
            $('.formError_DN_user').html('');
        }
    });
    $('#formDN #password').keyup(function(){
        var pass = $(this).val();
        if (!validatePassword(pass)){
            $('.formError_DN_pass').html('Invalid password combination');
        } else{
            $('.formError_DN_pass').html('');
        }
    });
    //check register
    $('#formDK #username').keyup(function(){
        var username = $(this).val().trim();
        if (username.length == 0){
            //Error
            $('.formError_DK_user').html('Invalid user name combination');
        } else{
            $('.formError_DK_user').html('');
        }
    });
    $('#formDK #email').keyup(function(){
        var mail = $(this).val().trim();
        if (!isEmail(mail)){
            $('.formError_DK_mail').html('Invalid mail combination');
        } else{
            $('.formError_DK_mail').html('');
        }
    });
    $('#formDK #password').keyup(function(){
        var pass = $(this).val();
        if (!validatePassword(pass)){
            $('.formError_DK_pass').html('Invalid password combination');
        } else{
            $('.formError_DK_pass').html('');
        }
    });
    $('#formDK #password_confirmation').keyup(function(){
        var repass = $(this).val();
        var passs = $('#formDK #password').val();
        if (passs != repass){
            $('.formError_DK_repass').html('Invalid password confirmation');
        } else{
            $('.formError_DK_repass').html('');
        }
    });

});


$(document).ready(function(){
    $('#formDK #submit').click(function(e){
        //if(e.preventDefault()) e.preventDefault();
        var user = $('#formDK #username').val().trim();
        var mail = $('#formDK #email').val().trim();
        var pass = $('#formDK #password').val();
        var repass = $('#formDK #password_confirmation').val();

        if(user.length == 0){
            alert('Invalid user name combination');
            $('#formDK #username').focus();
            return false;
        }
        else if(!isEmail(mail)){
            alert('Invalid mail combination');
            $('#formDK #email').focus();
            return false;
        }
        else if(!validatePassword(pass)){
            alert('Invalid password combination');
            $('#formDK #password').focus();
            return false;
        }
        else if(pass != repass){
            alert('Invalid password confirmation');
            $('#formDK #password_confirmation').focus();
            return false;
        }
        $(this).attr('value', 'Loading..........');
        //var datas = $('#formDK').serialize();
        //console.log(datas);
        /*$.ajax({
            url : '/sublime/action/xulidangki.php',
            type : 'post',
            data : datas,
            success : function(data) {
                $(this).attr('value', data);
                alert(data);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // When AJAX call has failed
                alert('AJAX call failed.');
                alert(textStatus + ': ' + errorThrown);
                console.log(errorThrown)
            }
        });*/
        //return false;
    });
});

$(document).ready(function(){
    $('#formDN #submit').click(function(e){
        //if(e.preventDefault()) e.preventDefault();
        var mail = $('#formDN #email').val().trim();
        var password = $('#formDN #password').val().trim();

        if(!isEmail(mail)){
            alert('Invalid mail combination');
            $('#formDN #email').focus();
            return false;
        }
        else if(!validatePassword(password)){
            alert('Invalid password combination');
            $('#formDN #password').focus();
            return false;
        }
        $(this).attr('value', 'Loading..........');
        //var datas = $('#formDK').serialize();
        //console.log(datas);
        /*$.ajax({
            url : '/sublime/action/xulidangki.php',
            type : 'post',
            data : datas,
            success : function(data) {
                $(this).attr('value', data);
                alert(data);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // When AJAX call has failed
                alert('AJAX call failed.');
                alert(textStatus + ': ' + errorThrown);
                console.log(errorThrown)
            }
        });*/
        //return false;
    });
});