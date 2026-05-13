<form action="<?php echo site_url(Backend_URL . 'expense/report'); ?>" class="form-inline" method="get">
    
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">Year</span>
            <select class="form-control" name="year">
                <option value="0">--ALL--</option>
                <?php echo numericDropDown($min_year, $max_year, 1, $year); ?>
            </select>
        </div>
    </div>
    
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">Collected By</span>
            <select class="form-control" name="user_id">
                <?php echo Helper::getUserDropDown($user_id, '--All--'); ?>                
            </select>
        </div>
    </div>                                            
    <div class="form-group">
        <button class="btn btn-primary" type="submit">Search</button>
        <a href="<?php echo site_url(Backend_URL . 'expense/report'); ?>" class="btn btn-default">Reset</a>
    </div>                
</form>