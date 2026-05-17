<script type="text/javascript">

    // Manage ACL 
    function manage_acl(id) {
        jQuery.noConflict();
        jQuery('.js_update_respond').empty();
        jQuery('#manageAcl').modal({
            show: 'false'
        });


        jQuery.ajax({
            url: "users/roles/getAcl",
            type: "POST",
            dataType: "text",
            data: {id: id},
            beforeSend: function () {
                jQuery('.acl_respond').html('<i class="fa fa-2x fa-spinner" aria-hidden="true"></i>');
            },
            success: function (msg) {
                jQuery('.acl_respond').html(msg);
            }
        });
    }

    function new_role(e) {
        e.preventDefault();
        let formData = $('#new_role').serialize();
        $.ajax({
            url: 'users/roles/create',
            type: "POST",
            dataType: "json",
            data: formData,
            beforeSend: function () {
                $('#ajaxRespondID').css('display', 'block').html('<p class="ajax_processing">Loading...</p>');
            },
            success: function (jsonRespond) {                
                $('#ajaxRespondID').html(jsonRespond.Msg);
                $('.ajax_error').fadeOut('slow');
                location.reload();
            }
        });        
    }

    // Delete Role ID
    function delete_role(id) {
        var yes = confirm('Really Want to Delete?');
        if (yes) {
            jQuery.ajax({
                url: "users/roles/delete",
                type: "POST",
                dataType: "json",
                data: {id: id},
                beforeSend: function () {
                    jQuery('.role_id_' + id).css('background-color', '#FF0000');
                },
                success: function (respond) {
                    jQuery('.role_id_' + id).fadeOut('slow');
                    jQuery('#ajaxRespond').html('<p class="alert alert-success">' + respond.Msg + '</p>');
                    setTimeout(function () {
                        jQuery('#ajaxRespond').slideUp('slow');
                    }, 1500);
                }
            });
        }
    }

    // Rename Role 
    function edit_role(id) {
        jQuery.ajax({
            url: 'users/roles/rename',
            type: 'POST',
            dataType: "text",
            data: {id: id},
            beforeSend: function () {
                jQuery('.edit_id_' + id).html('Loading...');
            },
            success: function (msg) {
                jQuery('.edit_id_' + id).html(msg);
            }
        });
    }

    // Update Role Value
    function update_role(id) {
        var update_form = jQuery('#update_form').serialize();
        jQuery.ajax({
            url: "users/roles/update",
            type: "POST",
            dataType: "json",
            data: update_form,
            cache: false,
            beforeSend: function () {
                jQuery('.edit_id_' + id).html('Loading...');
            },
            success: function (jsonData) {
                jQuery('.edit_id_' + id).html(jsonData.Msg);
            }
        });

    }


    // Module Access 
    function module_manage() {
        var FormData = jQuery('#access_permission').serialize();

        jQuery.ajax({
            url: "users/roles/update_acl",
            type: "POST",
            dataType: "json",
            data: FormData,
            beforeSend: function () {
                jQuery('.js_update_respond').html('<i class="fa fa-2x fa-spinner" aria-hidden="true"></i>');
            },
            success: function (jsonRespond) {                
                jQuery('.js_update_respond').html(jsonRespond.Msg);               
            }
        });
    }

    var checked = false;
    function checkedAll() {
        if (checked === false) {
            checked = true;
        } else {
            checked = false;
        }
        for (var i = 0; i < document.getElementById('access_permission').elements.length; i++) {
            document.getElementById('access_permission').elements[i].checked = checked;
        }
    }
    function checkUncheck( module ) {        
        var len = jQuery("#"+module+" input[name='acl_id[]']:checked").length;        
        if(len){
            jQuery('.' + module).prop('checked', '');
        } else {
            jQuery('.' + module).prop('checked', 'checked');
        }        
    }
    
    
    // random password generator
    function make_password() {
        var text = "";
        var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        for (var i = 0; i < 12; i++) {
            text += possible.charAt(Math.floor(Math.random() * possible.length));
        }
        $('#new_pass').val(text);
    }


    var $ = jQuery;
    $(document).ready(function (e) {
        $("#update_user_aliza").on('submit', (function (e) {                                                
            e.preventDefault();            
            var formData = new FormData(document.getElementById("update_user_aliza"));                                                          
             
            jQuery.ajax({
                url: "<?php echo Backend_URL; ?>users/update_action",  
                type: "POST", 
                data: formData,
                enctype: 'multipart/form-data',
                beforeSend: function () {
                    jQuery('#success_report')
                            .html('<p class="ajax_processing"> Updating...')
                            .css('display','block');
                },
                success: function (msg) {
                    jQuery('#success_report').html(msg);                     
                    setTimeout(function () { jQuery('#success_report').slideUp('slow');  }, 4000);                       
                },
                processData: false, 
                contentType: false, 
                cache: false                    
            });            
        }));        
    });


    function date_range(range){
        var range = range;
        if( range == 'Custom'){       
            $('#custom').css('display','block');
        } else {      
            $('#custom').css('display','none');
        }
    }    
</script>