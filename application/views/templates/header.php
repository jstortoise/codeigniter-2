<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>
    	<?php
    		$this->lang->load('ps', 'english');
    		echo $this->lang->line('site_title');
    	?>
    </title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url('css/bootstrap.min.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('fonts/ptsan/stylesheet.css');?>" rel="stylesheet">
<!--     <link href="<?php echo base_url('css/animate.css');?>" rel="stylesheet"> -->
    <link href="<?php echo base_url('css/dashboard.css');?>" rel="stylesheet">
    <!-- Font CSS -->
    <link href="<?php echo base_url('css/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet">

    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url('js/jquery.js');?>"></script>
    <script src="<?php echo base_url('js/bootstrap.min.js');?>"></script>
    <script src="<?php echo base_url('js/jquery.validate.js');?>"></script>

    <script src="<?php echo base_url('js/peity/jquery.peity.min.js');?>"></script>
    <script src="<?php echo base_url('js/peity/peity-demo.js');?>"></script>

	</head>
	<body>
