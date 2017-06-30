<div class="row">
  <div class="col-md-12">
    <div class="grid" style="text-align: left;">
      <div class="ibox float-e-margins">

        <div class="ibox-title">
          <h4><strong><?php echo $city->name; ?></strong></h4>
        </div>

        <div class="top-border">
          <div class="col-md-6 ibox-content no-padding border-left-right">
            <a href="<?php echo site_url('cities/index/'. $city->id);?>">
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
            <br>
            <h5><strong><a href="#">News Feed</a></strong></h5>
          </div>
          <div class="cls"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="grid" style="text-align: left;">
      <div class="ibox float-e-margins">

        <div class="ibox-title">
          <h4><strong>Categories</strong></h4>
        </div>

        <?php
          $index = 0;
          foreach ($city->categories as $category) {
            if (($index % 6) == 0) {
              echo '<div class="row m-t-lg">';
            }
            $index++;
        ?>
          <div class="col-sm-2">
            <div class="grid" style="text-align: left;">
              <div class="ibox float-e-margins">

                <div class="col-md-12 no-padding">
                  <a href="#<?php echo $category->name;?>">
                  <?php
                    echo "<img alt='image' class='img-responsive' src='http://bespokenlifestyle.co.za/uploads/".$category->image."'/>";
                  ?>
                  </a>
                </div>
                <div class="cls"></div>
                <div class="col-md-12 " style="text-align: center;">
                  <h5><strong><?php echo $category->name;?></strong></h5>
                </div>
              </div>
            </div>
          </div>

        <?php
            if (($index % 6) == 0) {
              echo '</div>';
            }
          }
        ?>
      </div>
    </div>
  </div>
</div>
<div class="cls"></div>
<?php
	foreach ($city->categories as $category) {
		echo '<div class="row">';
?>

<div class="col-md-12">
  <div class="grid" style="text-align: left;">
    <div class="ibox float-e-margins">

      <div class="ibox-title" id="<?php echo $category->name;?>">
        <h4><strong><?php echo $category->name; ?></strong></h4>
      </div>

      <div class="top-border">


        <?php
        	$index = 0;
        	foreach ($category->items as $item) {
        		echo '<div class="row">';
        ?>

        	<div class="col-md-12">
        	  <div class="grid" style="text-align: left;">
        	    <div class="ibox float-e-margins">

        	      <div class="top-border">
        	        <div class="col-md-4 ibox-content no-padding border-left-right">
        	          <a href="<?php echo site_url('dashboard/index/'. $item->id);?>">
        	          <?php
        	            echo "<img alt='image' class='img-responsive' src='http://bespokenlifestyle.co.za/uploads/".$item->image."'/>";
        	          ?>
        	          </a>
        	        </div>
        	        <div class="col-md-8 ibox-content profile-content">
                    <h4><strong><?php echo $item->name;?></strong></h4>

                    <h5><strong>Address</strong></h5>
        	          <p><i class="fa fa-map-marker" style="padding-right: 5px;"></i><?php echo $item->address;?></p>

        	          <h5><strong>About City</strong></h5>
        	          <p>
        	          <?php
        	            $itemDesc = strip_tags($item->description);

        	            if (strlen($itemDesc) > 500) {
        	              $stringCut = substr($itemDesc, 0, 500);
        	              $itemDesc = substr($stringCut, 0, strrpos($stringCut, ' ')).'...';
        	            }
        	            echo $itemDesc;
        	          ?>
        	          </p>
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

      </div>
    </div>
  </div>
</div>

<?php
		echo '</div>';
	}
?>
