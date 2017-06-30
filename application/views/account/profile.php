<?php $this->lang->load('ps', 'english'); ?>
<div class="wrapper wrapper-content animated fadeInRight">
	<?php
	$attributes = array('id' => 'user-form');
	echo form_open(site_url('account/profile'), $attributes);
	?>
		<div class="row">
			<div class="col-sm-6">
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

				<div class="form-group">
					<label><?php echo $this->lang->line('username_label')?></label>
					<input class="form-control" type="text" placeholder="username" name='user_name' id='user_name' value='<?php echo $user->username;?>'>
				</div>

				<div class="form-group">
					<label><?php echo $this->lang->line('email_label')?></label>
					<input class="form-control" type="text" placeholder="email" name='user_email' id='user_email' value='<?php echo $user->email;?>'>
				</div>

				<div class="form-group">
					<label><?php echo $this->lang->line('password_label')?></label>
					<input class="form-control" type="password" placeholder="password" name='user_password' id='user_password'>
				</div>

				<div class="form-group">
					<label><?php echo $this->lang->line('confirm_password_label')?></label>
					<input class="form-control" type="password" placeholder="confirm password" name='conf_password' id='conf_password'>
				</div>

				<div class="form-group">
					<label><?php echo $this->lang->line('aboutme_label')?></label>
					<textarea class="form-control" placeholder="About Me" name='about_me' id='about_me'><?php echo $user->about_me;?></textarea>
				</div>
			</div>

			<div class="col-sm-6">

			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6">
				<button type="submit" class="btn btn-primary"><?php echo $this->lang->line('save_button')?></button>
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
					remote: '<?php echo site_url('home/exists/'.$user->id);?>'
				},
				user_password:{
					minlength: 4
				},
				conf_password:{
					equalTo: '#user_password'
				}
			},
			messages:{
				user_name:{
					required: "Please fill user name.",
					minlength: "The length of username must be greater than 4",
					remote: "Username is already existed in the system"
				},
				user_password:{
					minlength: "The length of password must be greater than 4"
				},
				conf_password:{
					equalTo: "Password and confirm password do not match."
				}
			}
		});
	});
</script>
