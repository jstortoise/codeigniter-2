<?php
	$method = $this->uri->segment(1);
	$sub_method = $this->uri->segment(2);
?>
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">
				<label class="login-title"><?php echo $this->lang->line('site_title'); ?></label>
			</a>
		</div>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav navbar-right">
				<li class="<?php if ($method == '') echo 'active';?>">
					<a href="<?php echo site_url('/');?>">
						<?php echo $this->lang->line('home'); ?>
					</a>
				</li>
				<li class="<?php if ($method == 'items') echo 'active';?>">
					<a href="<?php echo site_url('items/search');?>">
						<?php echo $this->lang->line('search_by_keyword'); ?>
					</a>
				</li>
				<li class="<?php if ($method == 'favourites') echo 'active';?>">
					<a href="<?php echo site_url('favourites');?>">
						<?php echo $this->lang->line('my_favorite_items'); ?>
					</a>
				</li>
				<!-- <li class="<?php if ($sub_method == 'setting') echo 'active';?>">
					<a href="<?php echo site_url('account/setting');?>">
						<?php echo $this->lang->line('push_notificiation_setting'); ?>
					</a>
				</li> -->
				<?php if ($this->user->is_logged_in()) {?>
				<li class="<?php if ($sub_method == 'profile') echo 'active';?>">
					<a href="<?php echo site_url('account/profile');?>">
						<?php echo $this->lang->line('profile'); ?>
					</a>
				</li>
				<li>
					<a href="<?php echo site_url('logout');?>">
						<?php echo $this->lang->line('logout'); ?>
					</a>
				</li>
				<?php } else { ?>
				<li class="<?php if ($sub_method == 'signup') echo 'active';?>">
					<a href="<?php echo site_url('signup');?>">
						<?php echo $this->lang->line('signup'); ?>
					</a>
				</li>
				<li>
					<a href="<?php echo site_url('login');?>">
						<?php echo $this->lang->line('login'); ?>
					</a>
				</li>
				<?php } ?>
			</ul>
		</div>
	</div>
</nav>
