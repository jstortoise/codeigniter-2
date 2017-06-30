<?php $this->lang->load('ps', 'english'); ?>
<div class="wrapper wrapper-content animated fadeInRight">
	<?php
	$attributes = array('id' => 'user-form');
	echo form_open(site_url('signup'), $attributes);
	?>
		<legend><?php echo $this->lang->line('user_info_label')?></legend>

		<!-- Message -->
		<?php if($status == 'success'): ?>
			<div class="alert alert-success fade in">
				<?php echo $message;?>
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			</div>
		<?php elseif($status == 'error'):?>
			<div class="alert alert-danger fade in">
				<?php echo $message;?>
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			</div>
		<?php endif;?>

		<div class="row">
			<div class="col-sm-6">
					<div class="form-group">
						<label><?php echo $this->lang->line('username_label')?></label>
						<input class="form-control" type="text" placeholder="Username" name='user_name' id='user_name'>
					</div>

					<div class="form-group">
						<label><?php echo $this->lang->line('email_label')?></label>
						<input class="form-control" type="text" placeholder="Email" name='user_email' id='user_email'>
					</div>

					<div class="form-group">
						<label><?php echo $this->lang->line('password_label')?></label>
						<input class="form-control" type="password" placeholder="Password" name='user_password' id='user_password'>
					</div>

					<div class="form-group">
						<label><?php echo $this->lang->line('confirm_password_label')?></label>
						<input class="form-control" type="password" placeholder="Confirm Password" name='conf_password' id='conf_password'>
					</div>

					<div class="form-group">
						<label><?php echo $this->lang->line('aboutme_label')?></label>
						<textarea class="form-control" placeholder="About Me" name='about_me' id='about_me'></textarea>
					</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6">
				<button type="submit" class="btn btn-primary"><?php echo $this->lang->line('signup')?></button>
			</div>
		</div>
		<div class="cls"></div>
	</form>
</div>
<script>
$(document).ready(function(){
	$('#user-form').validate({
		rules:{
			user_name:{
				required: true,
				minlength: 4,
				remote: '<?php echo site_url("home/exists/");?>'
			},
			user_email:{
				required: true,
				email: true
			},
			user_password:{
				required: true,
				minlength: 4
			},
			conf_password:{
				required: true,
				equalTo: '#user_password'
			}
		},
		messages:{
			user_name:{
				required: "Please fill user name.",
				minlength: "The length of username must be greater than 4",
				remote: "Username is already existed in the system"
			},
			user_email:{
				required: "Please fill email address",
				email: "Please provide valid email address"
			},
			user_password:{
				required: "Please fill user password.",
				minlength: "The length of password must be greater than 4"
			},
			conf_password:{
				required: "Please fill confirm password",
				equalTo: "Password and confirm password do not match."
			}
		}
	});
});
</script>
