<script type="text/javascript">
    var flash_msg = "<?php echo $msg; ?>";
    var flash_msg_type = "<?php echo $msg_type;?>";
    $(document).ready(function(){
        if(flash_msg != ""){
            $.notify(
                flash_msg, flash_msg_type,
                {
                    // whether to hide the notification on click
                    clickToHide: true,
                    // whether to auto-hide the notification
                    autoHide: true,
                    // if autoHide, hide after milliseconds
                    autoHideDelay: 5000,
                    
                    globalPosition: 'top right',
                    
                }
            );
        }
    });
</script>

<div class="row">
    <div class="col-lg-12">           
        
        <div class="mid">
            <a class="btn btn-primary" href="<?php echo base_url('index.php/journal/create') ?>"> Create New Entry</a>
        </div>
        <br/>
        <div class="mid">
            <form method="post" id="get_form" action="javascript:void(0);">
                <input autocomplete="off" name="date" placeholder="Select Date" class="datepicker" data-provide="datepicker">
                <button type="button" id="get_button" class="btn btn-primary">Get</button>
            </form>
        </div>
        
     </div>
</div>
<br>
<div class="table-responsive" id="journal_div">

</div>