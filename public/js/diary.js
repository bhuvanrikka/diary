$(window).load(function(){
    $('.datepicker').datepicker({
        autoclose: true,
        format: "dd-mm-yyyy",
        todayHighlight: true,
        orientation: "bottom auto",
        todayBtn: true,
        todayHighlight: true,  
    });
    
    $('#get_button').on('click',function(){
        if(!$('.datepicker').val()){
            alert('Select Date');
            return false;
        }
        $.ajax({
            url : get_url,
            type: "POST",
            data: $('#get_form').serialize(),
            dataType: "JSON",
            success: function(data){
                $('#journal_div').html(data);
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('No data for selected data');
                location.reload();
            }
        });
    });

    
});