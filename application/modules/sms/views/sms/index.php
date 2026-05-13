<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="content-header">
    <h1> SMS  <small>Sent Log</small> 
        <?php echo anchor(
                site_url(Backend_URL . 'sms/write'), 
                ' + Send New', 
                'class="btn btn-default"'
            ); 
        ?>
        <span class="btn btn-success refresh"><i class="fa fa-refresh"></i> Refresh Qty </span>        
        
        <span class="btn btn-success code"><i class="fa fa-refresh"></i> Update Code </span>

        <span class="btn btn-success code2StatusSync"><i class="fa fa-refresh"></i> Sync Status </span>
    </h1>
    <div id="respond"></div>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(Backend_URL) ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li class="active">SMS</li>
    </ol>
</section>

<section class="content">       
    <div class="box">            
        <div class="box-header with-border"> 
            <h3 class="box-title text-bold">
                Total SMS Sent: <span class="text-red"><?php echo $total_sent; ?></span>
            </h3>
            <?php echo $this->load->view('filter'); ?>   
            
            <?php pp($last_query); ?>
        </div>

        <div class="box-body">
            <?php echo $this->session->flashdata('message'); ?>
            <div class="table-responsive">
                <table class="table table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th width="40">S/L</th>
                            <th width="120">Donor</th>
                            <th width="150">Phone</th>
                            <th>Body</th>
                            <th>Type</th>
                            <th class="text-center" width="40">Qty</th>
                            <th class="text-center" width="40">Chr</th>
                            <th class="text-center" width="150">Sent</th>
                            <th class="text-center" width="90">Status</th>
                            <th class="text-center" width="60">Code</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($smss as $sms) { ?>
                            <tr id="sms_<?php echo $sms->id; ?>">
                                <td><?php echo ++$start ?></td>
                                <td><?php echo $sms->donor_name; ?></td>
                                <td><?php echo $sms->phone; ?></td>
                                <td><?php echo nl2br($sms->body); ?></td>
                                <td><?php echo $sms->type; ?></td>
                                <td class="text-center"><?php echo $sms->qty; ?></td>
                                <td class="text-center"><?php echo smsCharsCount($sms->body ); ?></td>
                                <td class="text-center"><?php echo bdDateTimeFormat($sms->timestamp); ?></td>
                                <td class="text-center"><?php echo $sms->status; ?></td>
                                <td class="text-center"><?php echo $sms->code; ?></td>
                            </tr>
                            
                            <?php /* if($role_id==1){?>
                            <tr id="log_<?= $sms->id; ?>" class="hidden">
                                <td>Log: </td>
                                <td colspan="7">
                                    <span class="text-red"><?php echo ($sms->respond); ?></span> 
                                    <span class="btn btn-xs btn-danger remove" id="<?php echo $sms->id; ?>">
                                        <i class="fa fa-times"></i> 
                                        Remove
                                    </span>
                                </td>
                            </tr>
                            

                            <?php  } */ ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>            
        </div>

        <div class="box-footer">
            <div class="row">                
                <div class="col-md-6">
                    <span class="btn btn-primary">Total Sent SMS: <?= $total_rows; ?></span>
                </div>
                <div class="col-md-6 text-right">
                    <?php echo $pagination; ?>
                </div>                
            </div>
        </div>
    </div>
</section>
<script>
    $('.remove').on('click', function(){
        var id = $(this).attr('id');
        var yes = confirm('Confirm Delete');
        if(yes){
            $.ajax({
                url: 'sms/delete',
                type: "POST",
                dataType: "json",
                data: { id: id },
                beforeSend: function(){
                    $(`#sms_${id}`).css('background-color','red');
                    $(`#log_${id}`).css('background-color','red');
                },
                success: function( jsonData ){
                    if(jsonData.Status === 'OK'){
                        $(`#sms_${id}`).fadeOut('Slow');                    
                        $(`#log_${id}`).fadeOut('Slow');                    
                    } else {
                        $(`#sms_${id}`).css('background-color','none');
                        $(`#log_${id}`).css('background-color','none');
                    }                                    
                }
            }); 
        }
    });
    
    $('.refresh').on('click', function(){       
        $.ajax({
            url: 'sms/refresh_qty',
            type: "POST",
            dataType: "HTML",
            beforeSend: function(){
                $('.refresh i').addClass('fa-spin fa-refresh').removeClass('fa-check-square-o');
                $('#respond').css('display','block').html('<p class="ajax_processing">Loading...</p>');
            },
            success: function( respond ){                    
                $('#respond').html( respond );
                $('.refresh i').removeClass('fa-spin fa-refresh').addClass('fa-check-square-o');
                setTimeout(function(){ location.reload(); }, 2000);                
            }
        });
    });
    
    $('.code').on('click', function(){       
        $.ajax({
            url: 'sms/report/set_code',
            type: "POST",
            dataType: "JSON",
            beforeSend: function(){
                $('.code i').addClass('fa-spin fa-refresh').removeClass('fa-check-square-o');
                $('#respond').css('display','block').html('<p class="ajax_processing">Loading...</p>');
            },
            success: function( respond ){  
                console.log( respond );                  
                $('#respond').html( respond.Msg );
                $('.code i').removeClass('fa-spin fa-refresh').addClass('fa-check-square-o');
                //setTimeout(function(){ location.reload(); }, 2000);                
            }
        });
    });


    $('.code2StatusSync').on('click', function(){       
        $.ajax({
            url: 'sms/report/code2StatusSync',
            type: "POST",
            dataType: "JSON",
            beforeSend: function(){
                $('.code2StatusSync i').addClass('fa-spin fa-refresh').removeClass('fa-check-square-o');
                $('#respond').css('display','block').html('<p class="ajax_processing">Loading...</p>');
            },
            success: function( respond ){
                $('#respond').html( respond.Msg );
                $('.code2StatusSync i').removeClass('fa-spin fa-refresh').addClass('fa-check-square-o');                
            }
        });
    });
</script>