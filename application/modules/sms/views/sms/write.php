<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<section class="content-header">
    <h1> Sms  <small><?php echo $button ?></small> <a href="<?php echo site_url(Backend_URL . 'sms') ?>" class="btn btn-default">Back</a> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo Backend_URL ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="<?php echo Backend_URL ?>sms">Sms</a></li>
        <li class="active">Add New</li>
    </ol>
</section>

<section class="content">       
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Send New SMS</h3>
        </div>

        <div class="box-body">
            <div id="respond"></div>
            <div id="respond2"></div>
            <?php echo form_open($action, array('class' => 'form-horizontal', 'method' => 'post', 'id' => 'send')); ?>
            
            <div class="form-group">
                <label for="status"  class="col-sm-2 control-label">Phone Numbers:</label>
                <div class="col-sm-10"  style="padding-top:8px;">
                    <textarea class="form-control" readonly="readonly" name="phone" rows="5"><?php echo $phone; ?></textarea>
                    <p class="help-block text-red text-bold">SMS Qty: <?php echo $sms_qty; ?></p>
                </div>
            </div>
            
            
            <div class="form-group">
                <label for="body" class="col-sm-2 control-label">SMS Body :</label>
                <div class="col-sm-5">                    
                    <textarea rows="5" class="form-control" name="body" id="body"><?php echo $body; ?></textarea>
                    <p class="help-block text-red"><em>English Letter Limit <b>160</b>. Write: <b id="write_en">0</b> Left: <b id="limit_en">0</b>.</em></p>
                    <p class="help-block text-red"><em>Bangla Letter Limit <b>70</b>. Write: <b id="write_bn">0</b> Left: <b id="limit_bn">0</b>.</em></p>
                    <?php echo form_error('body') ?>
                </div>
            </div>
           
            <div class="col-md-10 col-md-offset-2" style="padding-left:5px;">
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <button type="submit" class="btn btn-primary">Send Now</button> 
                <a href="<?php echo site_url(Backend_URL . 'sms') ?>" class="btn btn-default">Cancel</a>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</section>
<?php load_module_asset('sms','js');?>
<script>
    $('#donor_id').on('change', function(){
         // find phone number 
         var id = $(this).val();
         $.ajax({
            url: '<?php echo Backend_URL; ?>donor/get_phone_no',
            type: "POST",
            dataType: 'html',
            data: { id : id},
            beforeSend: function () {
                $('#phone').val('Searching phone no').attr('readonly','readonly');
            },
            success: function (Respond) {                
                $('#phone').val( Respond ).attr('readonly','readonly');                         
            }
        });        
    });
    
//    $('#send').on('submit', function(){
//        var data = $(this).serialize();
//        $.ajax({
//            url: '<?php // echo site_url('sms/send'); ?>',
//            type: 'POST',
//            dataType: "json",
//            data: data,
//            beforeSend: function(){
//                $('#respond2').html('<p class="ajax_processing">Loading...</p>').css('display','block');
//            },
//            success: function ( jsonRespond ) {
//                $('#respond2').html(jsonRespond.Msg);
//                if( jsonRespond.Status === 'OK'){
//                    setTimeout(function() { 
//                        $('#respond2').slideUp(); 
//                        $('#respond').slideUp(); 
//                    }, 2000);
//                }
//            }
//        });
//        return false;
//    });
</script>