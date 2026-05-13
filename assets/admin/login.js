  
  $(function () {
         
         
    $('#forgotPwd, #view_login').click(function(e){
        e.preventDefault();                
        $('#recoveryPart, #loginPart').slideToggle();
    });
    
    $('#recovery').on('click', function(e){       
        e.preventDefault();    
        
        var forgot_mail = $('#recovery_email').val();

        $.ajax({
            url: 'auth/forgot_pass',
            type: "POST",
            dataType: "json",
            cache: false,
            data: { forgot_mail: forgot_mail },
            beforeSend: function(){
                $('#respond_pwd').html('<p class="ajax_processing">Please Wait... Checking....</p>');
            },
            success: function( jsonData ){
                                 
                if(jsonData.Status === 'OK'){
                    $('#respond_pwd').html( jsonData.Msg );                    
                } else {
                    $('#respond_pwd').html( jsonData.Msg );    
                }                                    
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                $('#respond_pwd').html( '<p> XML: '+ XMLHttpRequest + '</p>' );
                $('#respond_pwd').append( '<p>  Status: '+textStatus + '</p>' );
                $('#respond_pwd').append( '<p> Error: '+ errorThrown + '</p>' );            
            }  
        });        
        
    });
    

    $('#signin').on('click', function(e){       
        e.preventDefault();    
        var credential = $('#credential').serialize();    
        var error = 0;
        
        var username = jQuery('#username').val();
        if(!username){
            jQuery('#username').addClass('required');        
            error = 1;
        } else{
            jQuery('#username').removeClass('required');        
        }
        
        
        
        if(!error){
            $.ajax({
                url: 'auth/login_action',
                type: "POST",
                dataType: "json",
                cache: false,
                data: credential,
                beforeSend: function(){
                    $('#respond').html('<p class="ajax_processing">Please Wait... Checking....</p>');
                },
                success: function( jsonData ){
                    $('#respond').html( jsonData.Msg );
                    if(jsonData.Status === 'OK'){                        
                        window.location.href = jsonData.Link;
                    }                                   
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    $('#respond').html( '<p> XML: '+ XMLHttpRequest + '</p>' );
                    $('#respond').append( '<p>  Status: '+textStatus + '</p>' );
                    $('#respond').append( '<p> Error: '+ errorThrown + '</p>' );            
                }  
            });        
        }  
    });
    
    
    $('#username').on('keyup', function( e){
        e.preventDefault();
        $("#username_error").empty();
        $("#respond").empty();
        var mail = jQuery(this).val();

        var isValide = validateEmail(mail);
        if(!isValide){
            $("#username").addClass('required');
            //jQuery("#username").after( "<span id='username_error'><p class='ajax_error'>Invalid email address.</p></span>" );
        } else {
            $("#username").removeClass('required').addClass('required_pass');
        }            
    });
    
    
    
  });
  
  
function validateEmail(sEmail) {
    var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
    if (filter.test(sEmail)) {
        return true;
    } else {
        return false;
    }
}  