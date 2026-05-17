<?php load_module_asset('users', 'css' );?>
<section class="content-header">
    <h1> Role  <small>Permission Management</small> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo Backend_URL; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">        
        <div class="col-md-8 col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">
                        <i class="fa fa-users" aria-hidden="true"></i> Role / Label
                    </h3>
                </div>
                <div class="box-body">

                    <div id="ajaxRespond"></div>

                    <!-- /.box-header -->                    
                        <table class="table table-hover table-striped table-border">
                            <tbody>
                                <tr>
                                    <th width="20">#</th>
                                    <th>Role/Label</th>                                    
                                    <th width="100" class="text-center">Users</th>
                                    <th width="300" class="text-center">Action</th>
                                </tr>
                                <?php foreach ($roles as $role) { ?>
                                    <tr class="role_id_<?php echo $role->id; ?>">
                                        <td><?php echo $role->id; ?></td>                                        
                                        <td class="edit_id_<?= $role->id; ?>">
                                            <?php echo $role->role_name; ?>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-light-blue">
                                                <?php echo $role->qty; ?>
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <span onClick="manage_acl(<?php echo $role->id; ?>)" class="btn btn-primary btn-sm">
                                                <i class="fa fa fa-cogs"></i> 
                                                Set ACL
                                            </span>
                                            <span onClick="edit_role(<?php echo $role->id; ?>)" class="btn btn-default btn-sm">
                                                <i class="fa fa-edit"></i> 
                                                Rename
                                            </span>
                                            <?php echo Users_helper::Delete($role->id, $role->status); ?>
                                        </td>                                            
                                    </tr> 

                                <?php } ?>
                            </tbody>
                        </table>                    
                    <!-- /.box-body -->                   
                </div>
            </div>
        </div>

        <div class="col-md-4 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fa fa-user-plus" aria-hidden="true"></i> Add New Role
                    </h3>
                </div>

                <div class="panel-body">
                    <div id="ajaxRespondID" style="display:none;">Ajax Message Will Display Here</div>
                    <form id="new_role" method="post" role="form">                  
                        <div class="form-group">
                            <label for="roleName">Role Name <sup>*</sup></label>
                            <input type="text" name="name" class="form-control" required="required" data-error="Please enter role name" />
                            <div class="help-block with-errors"></div>
                        </div>
                        <button type="submit" onClick="new_role(event);" class="btn btn-success">Create New Role</button>
                    </form>
                </div>                
            </div>
        </div>        
    </div>

    <!-- Modal -->
    <div class="modal fade" id="manageAcl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" id="access_permission">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Grand Access with this Role</h4>
                    </div>

                    <div class="modal-body" >
                        <div class="js_update_respond"></div>
                        <div class="acl_respond" style="min-height:200px; max-height:450px; overflow-y:scroll; padding-right: 10px;"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><span aria-hidden="true">&times;</span> Close</button>
                        <button type="button" class="btn btn-primary " onclick="module_manage();"><i class="fa fa-save"></i> Grand Access</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php load_module_asset('users', 'js' );?>