<script type="text/javascript">
(function($){
    if (!window.jQuery) { return; }

    var transitionBase = <?php echo json_encode(site_url(Backend_URL . 'driving/transition/')); ?>;
    var resetBase      = <?php echo json_encode(site_url(Backend_URL . 'driving/reset_action/')); ?>;

    function showDvMessage(html) {
        var $box = $('.dv-ajax-message');
        if (!$box.length) {
            $('.box-body').first().prepend('<div class="dv-ajax-message"></div>');
            $box = $('.dv-ajax-message');
        }
        $box.html(html || '');
        if (html) {
            $('html, body').animate({ scrollTop: $box.offset().top - 80 }, 200);
        }
    }

    function setCellLoading($cell, on) {
        $cell.toggleClass('dv-cell-loading', !!on);
        $cell.find('button').prop('disabled', !!on);
    }

    function postDriving(url, data, $cell, done) {
        setCellLoading($cell, true);
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: $.extend({ ajax: 1 }, data || {})
        }).done(function(res){
            if (res && res.message) {
                showDvMessage(res.message);
            }
            if (res && res.success) {
                if (typeof done === 'function') {
                    done(res);
                }
            }
        }).fail(function(xhr){
            var msg = '<p class="ajax_error">Request failed. Please try again.</p>';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                msg = xhr.responseJSON.message;
            }
            showDvMessage(msg);
        }).always(function(){
            setCellLoading($cell, false);
        });
    }

    $(document).on('click', '.dv-stage-btn', function(e){
        e.preventDefault();
        var $btn  = $(this);
        var $cell = $btn.closest('td.dv-cell');
        var id    = $btn.data('driving-id');
        var stage = $btn.data('stage');
        if (!id || !stage) { return; }

        postDriving(transitionBase + id, { stage: stage }, $cell, function(res){
            if (res.html) {
                $cell.removeClass('dv-empty').html(res.html);
            } else {
                location.reload();
            }
        });
    });

    $(document).on('click', '.dv-reset-btn', function(e){
        e.preventDefault();
        if (!confirm('Remove this driving entry?')) { return; }
        var $btn  = $(this);
        var $cell = $btn.closest('td.dv-cell');
        var id    = $btn.data('driving-id');
        if (!id) { return; }

        postDriving(resetBase + id, {}, $cell, function(res){
            if (res.html) {
                $cell.addClass('dv-empty').html(res.html);
            } else {
                location.reload();
            }
        });
    });

    $(document).on('click', '[data-prefill-learner]', function(){
        var learnerId = $(this).data('prefill-learner');
        var vehicleId = $(this).data('prefill-vehicle');
        $('#dvAssignLearner').val(learnerId);
        $('#dvAssignVehicleRadios input[name="vehicle_id"][value="' + vehicleId + '"]').prop('checked', true);
    });

    $(document).on('click', '.dv-view-log', function(){
        var learnerId = $(this).data('learner-id');
        var learnerName = $(this).data('learner-name') || 'Driving Log';
        var html = $('#dvLogData-' + learnerId).html();
        $('#dvLogModalTitle').text(learnerName);
        $('#dvLogModalBody').html(html || '<p class="text-muted">No driving logs for this day.</p>');
        $('#dvLogModal').modal('show');
    });
})(jQuery);
</script>
