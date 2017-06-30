
<?php
	foreach ($cities as $city) {
		echo '<div class="row">';
?>

<div class="col-md-12">
  <div class="grid" style="text-align: left;">
    <div class="ibox float-e-margins">

      <div class="ibox-title">
        <h4><strong><?php echo $city->name; ?></strong></h4>
      </div>

      <div class="top-border">
        <div class="col-md-6 ibox-content no-padding border-left-right">
          <a href="<?php echo site_url('home/city/'. $city->id);?>">
          <?php
            echo "<img alt='image' class='img-responsive' src='http://bespokenlifestyle.co.za/uploads/".$city->image."'/>";
          ?>
          </a>
        </div>
        <div class="col-md-6 ibox-content profile-content">
          <h5><strong>Address</strong></h5>
          <p><i class="fa fa-map-marker" style="padding-right: 5px;"></i><?php echo $city->address;?></p>

          <h5><strong>About City</strong></h5>
          <p>
          <?php
            $cityDesc = strip_tags($city->description);

            if (strlen($cityDesc) > 500) {
              $stringCut = substr($cityDesc, 0, 500);
              $cityDesc = substr($stringCut, 0, strrpos($stringCut, ' ')).'...';
            }
            echo $cityDesc;
          ?>
          </p>
          <div class="row m-t-lg">
            <div class="col-md-4">
              <span class="bar">5,3,9,6,5,9,7,3,5,2</span>
              <p><?php echo $this->category->count_all($city->id) ?>  Categories</p>
            </div>
            <div class="col-md-4">
              <span class="bar">5,3,9,6,5,9,7,3,5,2</span>
              <p><?php echo $this->item->count_all($city->id) ?> Items</p>
            </div>
            <div class="col-md-4">
              <span class="bar">5,3,9,6,5,9,7,3,5,2</span>
              <p><?php echo $this->inquiry->count_all($city->id) ?> Inquiry</p>
            </div>
          </div>
					<h5><strong><a href="<?php echo site_url('home/feeds/'. $city->id);?>">News Feed</a></strong></h5>
        </div>
        <div class="cls"></div>
      </div>
    </div>
  </div>
</div>

<?php
		echo '</div>';
	}
?>
