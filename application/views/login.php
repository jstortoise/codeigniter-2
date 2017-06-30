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

    <!-- Custom styles for this template -->
	 <link href="<?php echo base_url('fonts/ptsan/stylesheet.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('css/dashboard.css');?>" rel="stylesheet">
    
    
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url('js/jquery.js');?>"></script>
    <script src="<?php echo base_url('js/bootstrap.min.js');?>"></script>
    <script src="<?php echo base_url('js/dashboard.js');?>"></script>
    <script src="<?php echo base_url('js/jquery.validate.js');?>"></script>
	</head>

  	<body style="background: none repeat scroll 0% 0% rgb(250, 191, 43);">
		<div class='fluid-container'>
			<div class='row'>
				<div class='col-sm-4 col-sm-offset-4'>

	        		<?php
	        		$attributes = array('id' => 'login-form','method' => 'POST');
	        		echo form_open(site_url('login'), $attributes);
	        		?>

						<h2>
						<label class="login-title">
						<?php echo $this->lang->line('site_title'); ?>
						</label>
						</h2>
						<hr/>
						<?php if($this->session->flashdata('success')):?>
							<div class='alert alert-success fade in'>
								<?php echo $this->session->flashdata('success');?>
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							</div>
						<?php elseif($this->session->flashdata('error')):?>
							<div class='alert alert-danger fade in'>
								<?php echo $this->session->flashdata('error');?>
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							</div>							
						<?php endif;?>
						
						<div class="form-group">
							<label><font color="#0A0C0C">Username</font></label>
							<?php 
								echo form_input( array(
									'type' => 'text',
									'name' => 'user_name',
									'id' => 'inputEmail',
									'class' => 'form-control',
									'placeholder' => 'Username',
									'value' => ''
								));
							?>
						</div>
						
						<div class="form-group">
							<label><font color="#0A0C0C">Password</font></label>
							<input class="form-control" type="password" id="inputPassword" placeholder="Password" name='user_pass'>
						</div>
						
						<button class="btn btn-primary" type="submit">Sign In</button>
						<a href="<?php echo site_url('signup');?>" class="btn btn-success" type="submit">Sign Up</a> <br><br>
						<div class="cls"></div>
					<?php echo form_close();  ?>
			</div>
			 
		</div>
	</div>
	<script>
		$(document).ready(function(){
			$('#login-form').validate({
				rules:{
					user_name: "required",
					user_pass: "required"
				},
				messages:{
					user_name: "Please fill username.",
					user_pass: "Please fill password"
				}
			});
		});
	</script>
  </body>
</html>