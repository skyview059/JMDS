<script>

    $('#load_report').on('click', function(){
        var report_date = $('.js_datepicker').val();
        
        $.ajax({
            url: 'dashboard/get_report/' + report_date,
            type: "POST",
            dataType: "json",                       
            beforeSend: function(){                
                jQuery('#collection_report').html( '<p class="ajax_processing">Please Wait. Building Report....</p>' );
            },
            success: function( htmlRespond ){ 
                console.log( htmlRespond);                            
                jQuery('#collection_report').html( htmlRespond.Collector );                               
            }       
        });
        
    });
</script>    
