<p id="show_filter" class="btn btn-default hidden-md hidden-lg">[+] Show Filter Form</p>
<form id="filter" action="<?php echo site_url(Backend_URL . 'trans'); ?>" class="form-inline hidden-xs" method="get">
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">Month</span>
            <select class="form-control" name="month">                
                <?php echo getMonthDropDown($month); ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">Head</span>
            <select class="form-control" name="head_id" id="head_id">
                <?php echo Helper::donationHeads( $head_id, '--All--' ); ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">Year</span>
            <select class="form-control" name="year">
                <option value="0">-- ALL--</option>
                <?php echo numericDropDown($min_year, $max_year, 1, $year); ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">Area</span>
            <select class="form-control" name="area_id">
                <?php echo Helper::getDropDownArea($area_id, '--All--'); ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">Collected By</span>
            <select class="form-control" name="collectBy">
                <?php echo Helper::getUserDropDown($collectBy, '--All--'); ?>
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
        <a href="<?php echo site_url(Backend_URL . 'trans'); ?>" class="btn btn-default">Reset</a>
    </div>                
</form>
<script>
    $('#show_filter').on('click', function(){
        $('#filter').removeClass('hidden-xs');
        $('#show_filter').addClass('hidden-xs');
    });    
</script>    