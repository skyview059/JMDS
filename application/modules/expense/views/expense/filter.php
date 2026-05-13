<form action="<?php echo site_url(Backend_URL . 'expense'); ?>" class="form-inline" method="get">
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">Month of Donation</span>
            <select class="form-control" name="month">                
                <?php echo getMonthDropDown( $month ); ?>
            </select>
        </div>
    </div>
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
            <select class="form-control" name="collectBy">
                <?php echo Helper::getUserDropDown($collectBy, '--All--'); ?>
                <?php // echo GetOptions('users',['first_name','last_name'],'',$collectBy); ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
            <span class="input-group-btn">
                <button class="btn btn-primary" type="submit">Search</button>
            </span>
        </div>
    </div>                                        
    <div class="form-group">
        <a href="<?php echo site_url(Backend_URL . 'expense'); ?>" class="btn btn-default">Reset</a>
    </div>                
</form>