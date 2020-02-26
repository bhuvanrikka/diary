<form id="insert_form" method="post" action="<?php echo base_url('index.php/journal/store');?>">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="form-group">
                <label class="col-md-3">Text</label>
                <div class="col-md-9">
                    <textarea type="text" name="text" class="form-control"></textarea>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-md-offset-2">
            <div class="form-group">
                <label class="col-md-3">Date</label>
                <div class="col-md-9">
                <input autocomplete="off" name="date" placeholder="Select Date" class="datepicker" data-provide="datepicker">
                </div>
            </div>
        </div>
        <div class="col-md-8 col-md-offset-2">
            <div class="col-md-9">
            <button type="submit" class="btn btn-success">Save</button>
            <a href="<?php echo base_url('index.php/journal/');?>">
                <button type="button" class="btn btn-danger">Cancel</button>
            </a>
            </div>
        </div>
    </div>
    
</form>
<script type="text/javascript" src="<?php echo base_url('public/js/validate.js')?>"></script>
<script type="text/javascript">
$("#insert_form").validate({
    rules: {
        text: "required",
        date: "required",
    },
    messages: {
        text: "Please enter text",
        date: "Please select date",
    }
});

</script>