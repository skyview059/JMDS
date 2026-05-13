<script>
    $('#body').keyup(updateCount);
    $('#body').keydown(updateCount);    
    $(function(){ updateCount(); });
    function updateCount() {
        var limit_en = 160;
        var limit_bn = 70;
        var write = $('#body').val().length;
        $('#write_en').text( write );
        $('#write_bn').text( write );
        $('#limit_en').text( limit_en - write );                        
        $('#limit_bn').text( limit_bn - write );                        
    }
</script>