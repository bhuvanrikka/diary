<form id="login_form" method="post" action="<?php echo base_url('index.php/journal/login');?>">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="form-group">
                <label class="col-md-3">Username</label>
                <div class="col-md-9">
                    <input type="text" name="username" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-md-8 col-md-offset-2">
            <div class="form-group">
                <label class="col-md-3">Password</label>
                <div class="col-md-9">
                <input type="password" name="password" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-md-8 col-md-offset-2">
            <div class="col-md-9">
            <button type="submit" class="btn btn-success">Login</button>
            
            </div>
        </div>
    </div>
    
</form>
<script type="text/javascript" src="<?php echo base_url('public/js/validate.js')?>"></script>
<script type="text/javascript">
$("#login_form").validate({
    rules: {
        username: "required",
        password: "required",
    },
    messages: {
        username: "Please enter username",
        password: "Please enter password",
    }
});

</script>