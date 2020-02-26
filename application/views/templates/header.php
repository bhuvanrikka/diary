<!DOCTYPE html>
<html>
<head>
    <title>Diary</title>
    <link rel="stylesheet" href="<?php echo base_url('public/css/bootstrap.css')?>" />
    <link rel="stylesheet" href="<?php echo base_url('public/css/diary.css')?>" />
    <link rel="stylesheet" href="<?php echo base_url('public/css/datepicker.css')?>" />
    <link rel="stylesheet" href="<?php echo base_url('public/css/notify.css')?>" />
    <link rel="stylesheet" href="<?php echo base_url('public/css/fontawesome.css')?>" />

    <script type="text/javascript" src="<?php echo base_url('public/js/jquery.min.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/js/bootstrap.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/js/datepicker.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/js/notify.js')?>"></script>
    <script type="text/javascript">
        var get_url = "<?php echo base_url('index.php/journal/get');?>";
    </script>
    <script type="text/javascript" src="<?php echo base_url('public/js/diary.js')?>"></script>
</head>
<body>
<div class="container">
<a href="<?php echo base_url('index.php/journal')?>"><h2 class="mid">Diary</h2></a>