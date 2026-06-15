<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<section class="content-header">
    <h1> Learner <small><?php echo $button ?></small> <a href="<?php echo site_url(Backend_URL . 'learner') ?>" class="btn btn-default">Back</a> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo Backend_URL ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="<?php echo Backend_URL ?>learner">Learner</a></li>
        <li class="active">Add New</li>
    </ol>
</section>

<section class="content">
    <style>
        .tx-card{background:#fff;border:1px solid #e8eaed;border-radius:8px;box-shadow:0 2px 12px rgba(0,0,0,.06);max-width:1080px;margin:0 auto;overflow:hidden;}
        .tx-card .tx-head{display:flex;justify-content:space-between;align-items:center;padding:16px 24px;background:#f8f9fa;border-bottom:1px solid #eef0f3;}
        .tx-card .tx-head h3{margin:0;font-size:18px;font-weight:600;color:#2c3e50;}
        .tx-card .tx-head .tx-x{color:#8a8f99;font-size:22px;text-decoration:none;line-height:1;}
        .tx-card .tx-head .tx-x:hover{color:#333;}
        .tx-card .tx-body{padding:26px 28px;}
        .tx-card .tx-foot{display:flex;justify-content:space-between;align-items:center;padding:14px 24px;border-top:1px solid #eef0f3;background:#fff;}
        .tx-row{display:flex;align-items:flex-start;margin-bottom:18px;}
        .tx-row .tx-label{width:140px;text-align:right;padding-right:18px;padding-top:10px;color:#525c6b;font-weight:500;font-size:14px;flex-shrink:0;}
        .tx-row .tx-label .req{color:#f4506c;margin-right:2px;font-weight:700;}
        .tx-row .tx-ctrl{flex:1;min-width:0;}
        .tx-input,.tx-select{display:block;width:100%;height:42px;padding:8px 14px;font-size:14px;color:#333;background-color:#fff;border:1px solid #dfe3e8;border-radius:6px;box-shadow:none;transition:border-color .15s ease-in-out;}
        .tx-select{appearance:none;-webkit-appearance:none;-moz-appearance:none;background-image:url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='%23888' d='M4 6l4 4 4-4'/%3e%3c/svg%3e");background-repeat:no-repeat;background-position:right 12px center;background-size:14px;padding-right:34px;}
        .tx-input:focus,.tx-select:focus,.tx-textarea:focus{border-color:#4d8af0;outline:0;box-shadow:0 0 0 3px rgba(77,138,240,.12);}
        .tx-textarea{display:block;width:100%;min-height:92px;padding:10px 14px;font-size:14px;color:#333;background-color:#fff;border:1px solid #dfe3e8;border-radius:6px;resize:vertical;font-family:inherit;}
        .tx-btn-save{background:#28a745;color:#fff;border:0;padding:9px 18px;border-radius:6px;font-weight:500;font-size:14px;display:inline-flex;align-items:center;gap:7px;cursor:pointer;}
        .tx-btn-save:hover,.tx-btn-save:focus{background:#23913d;color:#fff;}
        .tx-btn-close{background:#fff;color:#525c6b;border:1px solid #dfe3e8;padding:8px 16px;border-radius:6px;font-weight:500;font-size:14px;display:inline-flex;align-items:center;gap:7px;text-decoration:none;}
        .tx-btn-close:hover{background:#f8f9fa;color:#333;text-decoration:none;}
        .tx-card .text-danger{display:block;margin-top:4px;font-size:12px;}
        .tx-dropzone{border:2px dashed #c5cdd6;border-radius:8px;padding:22px 18px;text-align:center;background:#fafbfc;cursor:pointer;max-width:240px;transition:border-color .15s,background .15s;position:relative;}
        .tx-dropzone:hover{border-color:#4d8af0;background:#f5f9ff;}
        .tx-dropzone input[type="file"]{position:absolute;top:0;left:0;width:100%;height:100%;opacity:0;cursor:pointer;}
        .tx-dropzone .tx-up-ico{display:inline-flex;align-items:center;justify-content:center;width:44px;height:44px;border-radius:6px;background:#e7f7ee;color:#2ecc71;font-size:22px;margin-bottom:8px;}
        .tx-dropzone .tx-dz-txt{color:#6c757d;font-size:13px;margin:2px 0;}
        .tx-dropzone img{max-width:100%;max-height:150px;margin-top:10px;display:none;border-radius:4px;}
        .tx-inline-radios{display:flex;flex-wrap:wrap;align-items:center;gap:10px 18px;padding:10px 14px;border:1px solid #dfe3e8;border-radius:6px;background:#fff;min-height:42px;}
        .tx-inline-radios label{font-weight:400;margin-bottom:0;}
        .tx-address-grid{display:grid;grid-template-columns:1fr 1fr;gap:24px;}
        .tx-address-panel{background:#fff;border:1px solid #e8eaed;border-radius:12px;padding:22px;box-shadow:0 3px 12px rgba(17,35,58,.08);}
        .tx-address-panel h4{margin:0 0 18px;font-size:16px;font-weight:700;color:#212f3d;border-bottom:1px solid #eef0f3;padding-bottom:10px;}
        .tx-address-field{margin-bottom:16px;}
        .tx-address-field label{display:block;margin-bottom:8px;font-weight:600;color:#4d5b6d;}
        .tx-address-panel .tx-select,
        .tx-address-panel .tx-input{width:100%;}
        @media (max-width:992px){
            .tx-address-grid{grid-template-columns:1fr;}
        }
        @media (max-width:768px){
            .tx-row{flex-direction:column;}
            .tx-row .tx-label{width:100%;text-align:left;padding:0 0 6px;}
        }
    </style>

    <?php echo form_open_multipart($action, array('class' => 'tx-form', 'method' => 'post')); ?>
    <div class="tx-card">
        <div class="tx-head">
            <h3>Add New Learner</h3>
            <a href="<?php echo site_url(Backend_URL . 'learner') ?>" class="tx-x" aria-label="Close">&times;</a>
        </div>

        <div class="tx-body">
            <?php echo $this->session->flashdata('message'); ?>
            
            <div class="tx-row">
                <label class="tx-label" for="batch_id"><span class="req">*</span> Batch :</label>
                <div class="tx-ctrl">
                    <select class="tx-select" name="batch_id" id="batch_id">
                        <?php foreach($batch_list as $id => $name) { ?>
                            <option value="<?php echo $id; ?>" <?php echo ($batch_id == $id) ? 'selected' : ''; ?>><?php echo $name; ?></option>
                        <?php } ?>
                    </select>
                    <?php echo form_error('batch_id') ?>
                </div>
            </div>

            <div class="tx-row">
                <label class="tx-label" for="name"><span class="req">*</span> Name :</label>
                <div class="tx-ctrl">
                    <input type="text" class="tx-input" name="name" id="name" placeholder="Full Name" value="<?php echo $name; ?>" />
                    <?php echo form_error('name') ?>
                </div>
            </div>

            <div class="tx-row">
                <label class="tx-label" for="gender">Gender :</label>
                <div class="tx-ctrl">
                    <div class="tx-inline-radios">
                        <?php echo htmlRadio('gender', $gender, array('Male' => 'Male', 'Female' => 'Female', 'Other' => 'Other'));  ?>
                    </div>
                </div>
            </div>

            <div class="tx-row">
                <label class="tx-label" for="dob">Date of Birth :</label>
                <div class="tx-ctrl">
                    <input type="text" class="tx-input js_datepicker" autocomplete="off" name="dob" id="dob" placeholder="YYYY-MM-DD" value="<?php echo $dob; ?>" />
                    <?php echo form_error('dob') ?>
                </div>
            </div>

            <div class="tx-row">
                <label class="tx-label" for="nid">NID/BID :</label>
                <div class="tx-ctrl">
                    <input type="text" class="tx-input" name="nid" id="nid" placeholder="eg: 545456789" value="<?php echo $nid; ?>" />
                    <?php echo form_error('nid') ?>
                </div>
            </div>

            <div class="tx-row">
                <label class="tx-label" for="father">Father :</label>
                <div class="tx-ctrl">
                    <input type="text" class="tx-input" name="father" id="father" placeholder="Father's Name" value="<?php echo $father; ?>" />
                    <?php echo form_error('father') ?>
                </div>
            </div>

            <div class="tx-row">
                <label class="tx-label" for="mother">Mother :</label>
                <div class="tx-ctrl">
                    <input type="text" class="tx-input" name="mother" id="mother" placeholder="Mother's Name" value="<?php echo $mother; ?>" />
                    <?php echo form_error('mother') ?>
                </div>
            </div>

            <div class="tx-row">
                <label class="tx-label">Address :</label>
                <div class="tx-ctrl">
                    <div class="tx-address-grid">
                        <div class="tx-address-panel">
                            <h4>Current Address</h4>
                            <div class="tx-address-field">
                                <label for="cu_dist_id"><span class="req">*</span> District</label>
                                <select class="tx-select" name="cu_dist_id" id="cu_dist_id">
                                    <?php foreach($district_list as $id => $dname) { ?>
                                        <option value="<?php echo $id; ?>" <?php echo ($cu_dist_id == $id) ? 'selected' : ''; ?>><?php echo $dname; ?></option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('cu_dist_id') ?>
                            </div>
                            <div class="tx-address-field">
                                <label for="cu_village"><span class="req">*</span> Village / House</label>
                                <input type="text" class="tx-input" name="cu_village" id="cu_village" value="<?php echo $cu_village; ?>" />
                                <?php echo form_error('cu_village') ?>
                            </div>
                            <div class="tx-address-field">
                                <label for="cu_postoffice">Post Office</label>
                                <input type="text" class="tx-input" name="cu_postoffice" id="cu_postoffice" value="<?php echo $cu_postoffice; ?>" />
                                <?php echo form_error('cu_postoffice') ?>
                            </div>
                            <div class="tx-address-field">
                                <label for="cu_postcode">Post Code</label>
                                <input type="text" class="tx-input" name="cu_postcode" id="cu_postcode" value="<?php echo $cu_postcode; ?>" />
                                <?php echo form_error('cu_postcode') ?>
                            </div>
                            <div class="tx-address-field">
                                <label for="cu_ps">Police Station</label>
                                <input type="text" class="tx-input" name="cu_ps" id="cu_ps" value="<?php echo $cu_ps; ?>" />
                                <?php echo form_error('cu_ps') ?>
                            </div>
                        </div>
                        <div class="tx-address-panel">
                            <h4>Permanent Address</h4>
                            <div class="tx-address-field">
                                <label for="pa_dist_id">District</label>
                                <select class="tx-select" name="pa_dist_id" id="pa_dist_id">
                                    <?php foreach($district_list as $id => $dname) { ?>
                                        <option value="<?php echo $id; ?>" <?php echo ($pa_dist_id == $id) ? 'selected' : ''; ?>><?php echo $dname; ?></option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('pa_dist_id') ?>
                            </div>
                            <div class="tx-address-field">
                                <label for="pa_village">Village / House</label>
                                <input type="text" class="tx-input" name="pa_village" id="pa_village" value="<?php echo $pa_village; ?>" />
                                <?php echo form_error('pa_village') ?>
                            </div>
                            <div class="tx-address-field">
                                <label for="pa_postoffice">Post Office</label>
                                <input type="text" class="tx-input" name="pa_postoffice" id="pa_postoffice" value="<?php echo $pa_postoffice; ?>" />
                                <?php echo form_error('pa_postoffice') ?>
                            </div>
                            <div class="tx-address-field">
                                <label for="pa_postcode">Post Code</label>
                                <input type="text" class="tx-input" name="pa_postcode" id="pa_postcode" value="<?php echo $pa_postcode; ?>" />
                                <?php echo form_error('pa_postcode') ?>
                            </div>
                            <div class="tx-address-field">
                                <label for="pa_ps">Police Station</label>
                                <input type="text" class="tx-input" name="pa_ps" id="pa_ps" value="<?php echo $pa_ps; ?>" />
                                <?php echo form_error('pa_ps') ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tx-row">
                <label class="tx-label" for="primary_mobile"><span class="req">*</span> Primary Mobile :</label>
                <div class="tx-ctrl">
                    <input type="text" class="tx-input" name="primary_mobile" id="primary_mobile" placeholder="e.g: 01XXXXXXXXX" value="<?php echo $primary_mobile; ?>" />
                    <?php echo form_error('primary_mobile') ?>
                </div>
            </div>

            <div class="tx-row">
                <label class="tx-label" for="blood_group">Blood Group :</label>
                <div class="tx-ctrl">
                    <select class="tx-select" name="blood_group" id="blood_group">
                        <?php echo getBloodGroupOptions($blood_group); ?>
                    </select>
                    <?php echo form_error('blood_group') ?>
                </div>
            </div>

            <div class="tx-row">
                <label class="tx-label" for="has_driving_license"><span class="req">*</span> Driving License :</label>
                <div class="tx-ctrl">
                    <select class="tx-select" name="has_driving_license" id="has_driving_license">
                        <?php foreach (array('No' => 'No', 'Yes' => 'Yes', 'Learner/Permit' => 'Learner/Permit') as $value => $label) { ?>
                            <option value="<?php echo $value; ?>" <?php echo ($has_driving_license == $value) ? 'selected' : ''; ?>><?php echo $label; ?></option>
                        <?php } ?>
                    </select>
                    <?php echo form_error('has_driving_license') ?>
                </div>
            </div>

            <div class="tx-row">
                <label class="tx-label" for="shirt_size">Shirt Size :</label>
                <div class="tx-ctrl">
                    <select class="tx-select" name="shirt_size" id="shirt_size">
                        <option value="">-- Select Shirt Size --</option>
                        <?php foreach (array('S', 'M', 'L', 'XL', 'XXL') as $size) { ?>
                            <option value="<?php echo $size; ?>" <?php echo ($shirt_size == $size) ? 'selected' : ''; ?>><?php echo $size; ?></option>
                        <?php } ?>
                    </select>
                    <?php echo form_error('shirt_size') ?>
                </div>
            </div>

            <div class="tx-row">
                <label class="tx-label" for="second_contact_person">Second Contact :</label>
                <div class="tx-ctrl">
                    <input type="text" class="tx-input" name="second_contact_person" id="second_contact_person" placeholder="e.g John Doe" value="<?php echo $second_contact_person; ?>" />
                    <?php echo form_error('second_contact_person') ?>
                </div>
            </div>

            <div class="tx-row">
                <label class="tx-label" for="second_contact_mobile">Second Mobile :</label>
                <div class="tx-ctrl">
                    <input type="text" class="tx-input" name="second_contact_mobile" id="second_contact_mobile" placeholder="e.g 01XXXXXXXXX" value="<?php echo $second_contact_mobile; ?>" />
                    <?php echo form_error('second_contact_mobile') ?>
                </div>
            </div>

            <div class="tx-row">
                <label class="tx-label" for="is_resident">Is Resident :</label>
                <div class="tx-ctrl">
                    <div class="tx-inline-radios">
                        <?php echo htmlRadio('is_resident', $is_resident, array('Yes' => 'Yes', 'No' => 'No'));  ?>
                    </div>
                </div>
            </div>

            <div class="tx-row">
                <label class="tx-label">Photo :</label>
                <div class="tx-ctrl">
                    <div class="tx-dropzone" id="photo_dropzone">
                        <div class="tx-up-ico"><i class="fa fa-cloud-upload"></i></div>
                        <div class="tx-dz-txt">Click to upload photo</div>
                        <input type="file" name="photo" id="photo_input" accept="image/*" onchange="previewImage(this)">
                        <img id="photo_preview" src="<?php echo getPhoto(''); ?>" alt="Preview" style="display:none;">
                    </div>
                    <?php echo form_error('photo') ?>
                </div>
            </div>

            <div class="tx-row">
                <label class="tx-label" for="remarks">Remarks :</label>
                <div class="tx-ctrl">
                    <textarea class="tx-textarea" name="remarks" id="remarks" placeholder="Enter remarks"><?php echo $remarks; ?></textarea>
                    <?php echo form_error('remarks') ?>
                </div>
            </div>
        </div>

        <div class="tx-foot">
            <a href="<?php echo site_url(Backend_URL . 'learner') ?>" class="tx-btn-close">Cancel</a>
            <button type="submit" class="tx-btn-save"><i class="fa fa-save"></i> <?php echo $button ?></button>
        </div>
    </div>
    <?php echo form_close(); ?>
</section>

<script>
function previewImage(input) {
    var preview = document.getElementById('photo_preview');
    var dzTxt = document.querySelector('.tx-dz-txt');
    var dzIco = document.querySelector('.tx-up-ico');
    
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
            dzTxt.style.display = 'none';
            dzIco.style.display = 'none';
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.src = "#";
        preview.style.display = 'none';
        dzTxt.style.display = 'block';
        dzIco.style.display = 'block';
    }
}
</script>
