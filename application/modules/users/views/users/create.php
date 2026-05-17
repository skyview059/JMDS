<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<section class="content-header">
    <h1>Register New User</h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo Backend_URL; ?>"><i class="fa fa-dashboard"></i> Admin </a></li>
        <li class="active">User list</li>
    </ol>
</section>

<section class="content">
    <div class="box box-primary">
        <form action="<?php echo Backend_URL; ?>users/create_action" method="post" id="user_form" class="form-horizontal">
            <div class="box-body">
                <div id="success_report"></div>

                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="role_id" class="col-sm-3 control-label">Role<sup>*</sup>: </label>
                            <div class="col-sm-9">
                                <select name="role_id" class="form-control" id="role_id">
                                    <?php echo Users_helper::getDropDownRoleName(2); ?>
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="full_name" class="col-sm-3 control-label">Full Name<sup>*</sup>: </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Full Name" />

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label">Email<sup>*</sup>:</label>
                            <div class="col-sm-9">
                                <input autocomplete="off" type="text" class="form-control" name="email" id="email" placeholder="Email or Mobile No" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-3 control-label">Password<sup>*</sup>:</label>
                            <div class="col-sm-9">
                                <input type="password" autocomplete="off" class="form-control" name="password" id="password" placeholder="Password" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="contact" class="col-sm-3 control-label">Contact :</label>
                            <div class="col-sm-9"><input type="text" class="form-control" name="contact" id="contact" placeholder="Contact" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="status" class="col-sm-3 control-label">Status :<?php echo form_error('status') ?></label>
                            <div class="col-sm-5"><select name="status" class="form-control" id="status">
                                    <?=  userStatus('Active'); ?>
                                    <?php // echo selectOptions($status, ['Active' => 'Active', 'Inactive' => 'Inactive']); ?>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <div class="box-footer" style="padding-left: 120px;">
                <a href="<?php echo site_url(Backend_URL . 'users') ?>" class="btn btn-default"><i class="fa fa-long-arrow-left"></i> Cancel & Back to List</a>
                <button type="submit" class="btn btn-primary">Register & Continue Update <i class="fa fa-long-arrow-right"></i> </button>
            </div>
        </form>
    </div>
</section>


<script type="text/javascript">
    $(document).ready(function(e) {
        $("#user_form").on('submit', (function(e) {
            e.preventDefault();
            var formData = $('#user_form').serialize();

            var error = 0;

            var full_name = $('[name=full_name]').val();
            if (!full_name) {
                $('[name=full_name]').addClass('required');
                error = 1;
            } else {
                $('[name=full_name]').addClass('required_pass');
            }

            var your_email = $('[name=email]').val();
            if (!your_email) {
                $('[name=email]').addClass('required');
                error = 1;
            } else {
                $('[name=email]').addClass('required_pass');
            }

            var password = $('[name=password]').val();
            if (!password) {
                $('[name=password]').addClass('required');
                error = 1;
            } else {
                $('[name=password]').addClass('required_pass');
            }



            if (!error) {
                $.ajax({
                    url: "<?php echo Backend_URL; ?>users/create_action",
                    type: "POST",
                    dataType: "json",
                    data: formData,
                    cache: false,
                    beforeSend: function() {
                        $('#success_report').html('<p class="ajax_processing"> Loading...</p>').css('display', 'block');
                    },
                    success: function(jsonRespond) {
                        if (jsonRespond.Status === 'OK') {

                            $('#success_report').html(jsonRespond.Msg);
                            document.getElementById("user_form").reset();
                            setTimeout(function() {
                                $('#success_report').slideUp('slow');
                            }, 4000);
                        } else {
                            $('#success_report').html(jsonRespond.Msg);
                        }
                    }
                });
            }
        }));
    });
</script>