<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="content-header">
    <h1> Site Setting  <small>Control panel</small></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo Backend_URL; ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li class="active">Settings</li>
    </ol>
</section>

<section class="content">                   
    <div class="box">
        <div class="box-body">
            
            <div id="ajaxRespond"></div>
                 
            <form method="post" id="settings" action="<?php echo Backend_URL; ?>settings/update" name="settings">
                <table class="table table-hover table-striped" style="margin-bottom: 10px">
                    <?php foreach ($settings_data as $setting){ ?>
                        <tr>
                            <td width="220"><?php echo Setting_helper::splitSettings($setting->label); ?></td>
                            <td><?php Setting_helper::switchFormFiled($setting->label, $setting->value); ?></td>
                        </tr>
                    <?php } ?>
                        <tr>
                            <td></td>
                            <td><button class="btn btn-primary" id="submit" type="button" name="save"><i class="fa fa-save"></i> Update Setting </button></td>
                        </tr>
                </table> 
            </form>
            <script type="text/javascript">
                $('#submit').on('click', function(e){
                    e.preventDefault();
                    var settings = $('#settings').serialize();
                    
                    //alert( settings );
                    
                    $.ajax({
                        url: '<?php echo Backend_URL; ?>settings/update',
                        type: 'POST',
                        dataType: "json",
                        data: settings,
                        beforeSend: function(){
                            $('#ajaxRespond')
                                    .html('<p class="ajax_processing">Loading...</p>')
                                    .css('display','block');
                        },
                        success: function ( jsonRespond ) {
                            $('#ajaxRespond').html(jsonRespond.Msg);
                            if( jsonRespond.Status === 'OK'){
                                setTimeout(function() { $('#ajaxRespond').slideUp(); }, 2000);
                            }
                        }
                    });   
                    
                    
                });
            </script>                        
        </div>
    </div>              
</section>