<form action="<?php echo site_url(Backend_URL . 'sms'); ?>" class="form-inline" method="get">
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">Month</span>
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
            <span class="input-group-addon">SMS Type</span>
            <select class="form-control" name="sms_type">                
                <?php echo selectOptions( $sms_type, [
                    'All' => '--All--',
                    'UNICODE' => 'UNICODE',
                    'TEXT' => 'TEXT',
                ] ); ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">Order By</span>
            <select class="form-control" name="order_by">                
                <?php echo selectOptions( $order_by, [
                    'Default' => 'Latest',
                    'QtyASC' => 'Qty 0-9',
                    'QtyDSC' => 'Qty 9-0',
                ] ); ?>
            </select>
        </div>
    </div>

    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">Limit</span>
            <select class="form-control" name="limit">                
                <?php echo selectOptions( $limit, [
                    100 => 100, 
                    250 => 250, 
                    500 => 500, 
                    1000 => 1000, 
                    2500 => 2500, 
                ] ); ?>
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
        <a href="<?php echo site_url(Backend_URL . 'sms'); ?>" class="btn btn-default">Reset</a>
    </div>                
</form>