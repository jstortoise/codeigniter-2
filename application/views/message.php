<?php $this->lang->load('ps', 'english'); ?>

<?php $this->load->view('templates/citiesdirectory/header');?>

<div class="navbar navbar-fixed-top" role="navigation">
	<div class="container-fluid">
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li>
					<a class="navbar-brand" href="<?php echo site_url(); ?>"><?php echo $this->lang->line('site_title')?></a>
				</li>
			</ul>
		</div>
	</div>
</div>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 main teamps-sidebar-push">

			<!-- Message -->
			<?php if($this->session->flashdata('success')): ?>
				<div class="alert alert-success fade in">
					<?php echo $this->session->flashdata('success');?>
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				</div>
			<?php elseif($this->session->flashdata('error')):?>
				<div class="alert alert-danger fade in">
					<?php echo $this->session->flashdata('error');?>
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				</div>
			<?php endif;?>
			
			<div class="row">
	            <div class="col-lg-12">
	                <div class="wrapper wrapper-content">
	                    <div class="middle-box text-center animated fadeInRightBig">
	                        <h3 class="font-bold"><?php echo $this->lang->line('after_registered_title')?></h3>
							<br>
	                        <div class="error-desc">
	                            <?php echo $this->lang->line('after_registered_message')?>
	                            <br/> <br/> <br/>
	                            <a href="<?php echo site_url() . "/login"; ?>" class="btn btn-primary m-t">
	                            <?php echo $this->lang->line('btn_goto_login')?></a>
	                            
	                            <a href="<?php echo site_url() . "/citiesdirectory/create_city"; ?>" class="btn btn-primary m-t">
	                            <?php echo $this->lang->line('btn_register_another_city')?></a>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
		
		</div>
	</div>
</div>



<?php $this->load->view('templates/citiesdirectory/footer');?>