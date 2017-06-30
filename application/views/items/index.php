<?php
	$this->lang->load('ps', 'english');
?>
<div class="col-md-12">
	<div class="grid" style="text-align: left;">
		<div class="ibox float-e-margins">

			<div class="ibox-title">
				<h4><strong><?php echo $item->name; ?></strong></h4>
			</div>

			<div class="top-border">
				<div class="col-md-4 ibox-content no-padding border-left-right">
					<a href="<?php echo site_url('items/index/'. $item->id);?>">
					<?php
						echo "<img alt='image' class='img-responsive' src='http://bespokenlifestyle.co.za/uploads/".$item->image."'/>";
					?>
					</a>
				</div>
				<div class="col-md-8 ibox-content profile-content">
					<h5><strong>Address</strong></h5>
					<p><i class="fa fa-map-marker" style="padding-right: 5px;"></i><?php echo $item->address;?></p>

					<h5><strong>Phone</strong></h5>
					<p><a href="tel:<?php echo $item->phone;?>"><?php echo $item->phone;?></a></p>
					<h5><strong>Email</strong></h5>
					<p><a href="mailto:<?php echo $item->email;?>"><?php echo $item->email;?></a></p>
					<h5><strong>Website</strong></h5>
					<p><a href="<?php echo $item->website;?>"><?php echo $item->website;?></a></p>
					<h5>
						<?php if (!$this->favourite->exists(array('item_id'=>$item->id, 'appuser_id'=>$this->user->get_logged_in_user_info()->id))) { ?>
						<a href="javascript:favThis('<?php echo $item->id;?>');" id="fav_count">Favorite</a>
						&nbsp;&nbsp;&nbsp;
						<?php } ?>
						<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo current_url();?>" id="shareFB">Share</a>
						&nbsp;&nbsp;&nbsp;
						<a href="javascript:likeThis('<?php echo $item->id;?>');" id="likes_count">Like <?php echo $item->likes_count;?></a>
						&nbsp;&nbsp;&nbsp;
						<a href="#reviews">Review <?php echo $item->reviews_count;?></a>
					</h5>
				</div>
			</div>

			<div class="top-border">
				<div class="col-md-12">
				</div>
				<div class="col-md-12">
					<h5><strong>About City</strong></h5>
					<p>
					<?php
						$description = strip_tags($item->description);
						$description = str_replace("\n", "<br>", $description);
						echo $description;
					?>
					</p>
				</div>
				<div class="cls"></div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="grid" style="text-align: left;">
			<div class="ibox float-e-margins">
				<div id="location" style="width: 100%; height: 300px; position: relative; overflow: hidden;"></div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="grid" style="text-align: left;">
			<div class="ibox float-e-margins">
				<legend>INQUIRY</legend>
				<?php
				$attributes = array('id' => 'inquiry-form');
				echo form_open(site_url('items/addinquiry'), $attributes);
				?>
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
						<input class="form-control" type="text" required placeholder="Name" name="name"/>
					</div>
					<div class="form-group">
						<input class="form-control" type="text" required placeholder="Email" name="email"/>
					</div>
					<div class="form-group">
						<textarea class="form-control" type="text" required placeholder="Inquiry Message" name="message"></textarea>
					</div>
					<input type="hidden" name="cur_url" value="<?php echo current_url();?>"/>
					<input type="hidden" name="item_id" value="<?php echo $item->id;?>"/>
					<button type="submit" class="btn btn-primary"><?php echo $this->lang->line('submit_button')?></button>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="row" id="reviews">
	<div class="col-md-12">
		<div class="grid" style="text-align: left;">
			<div class="ibox float-e-margins">
				<legend>REVIEWS</legend>
				<?php foreach ($item->reviews as $review) { ?>
				<p>
				<?php
					echo $review->review;
				?>
				</p>
				<?php } ?>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="grid" style="text-align: left;">
			<div class="ibox float-e-margins">
				<legend>ADD REVIEW</legend>
				<?php
				$attributes = array('id' => 'review-form');
				echo form_open(site_url('items/addreview'), $attributes);
				?>
					<div class="form-group">
						<textarea class="form-control" type="text" placeholder="REVIEW" name='review'></textarea>
					</div>
					<input type="hidden" name="cur_url" value="<?php echo current_url();?>"/>
					<input type="hidden" name="item_id" value="<?php echo $item->id;?>"/>
					<button type="submit" class="btn btn-primary"><?php echo $this->lang->line('submit_button')?></button>
				</form>
			</div>
		</div>
	</div>
</div>


<!-- For Location Picker -->
<script src="<?php echo base_url('js/location/locationpicker.jquery.min.js');?>"></script>
<script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=false&key=AIzaSyDNmw9uMvgn9d62hbUgMXlfYqtbeIuTnEE&libraries=places'></script>
<script>

	function likeThis(item_id) {
		var url = '<?php echo site_url('items/like/');?>/' + item_id
		$.ajax({
			url: url,
			success: function(res) {
				res = res * 1;
				if (res > 0) {
					$("#likes_count").html('Like ' + res);
				}
			}
		})
	}

	function favThis(item_id) {
		var url = '<?php echo site_url('items/favorite/');?>/' + item_id
		$.ajax({
			url: url,
			success: function(res) {
				alert(res);
			}
		})
	}

	$(function() {
		$('#location').locationpicker({
			location: {
				latitude: <?php echo $item->lat;?>,
				longitude: <?php echo $item->lng;?>
			},
			radius: 300,
			enableAutocomplete: true
		});

		$('#inquiry-form').validate({
			rules:{
				name:{
					required: true
				},
				email:{
					required: true,
					email: true
				},
				message:{
					required: true
				}
			},
			messages:{
				name:{
					required: "Please fill Name."
				},
				email:{
					required: "Please fill Email address",
					email: "Please provide valid email address"
				},
				message:{
					required: "Please fill Inquiry Message."
				}
			}
		});

		$('#review-form').validate({
			rules:{
				review:{
					required: true
				}
			},
			messages:{
				review:{
					required: "Please fill REVIEW."
				}
			}
		});
	})
</script>
