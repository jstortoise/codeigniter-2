<div class="col-md-12">
  <div class="grid" style="text-align: left;">
    <div class="ibox float-e-margins">

      <div class="ibox-title">
        <h4><strong><?php echo $this->category->get_info($category_id)->name; ?></strong></h4>
      </div>

      <div class="top-border">


        <?php
        	$index = 0;
        	foreach ($items as $item) {
        		echo '<div class="row">';
        ?>

        	<div class="col-md-12">
        	  <div class="grid" style="text-align: left;">
        	    <div class="ibox float-e-margins">

        	      <div class="top-border">
        	        <div class="col-md-4 ibox-content no-padding border-left-right">
        	          <a href="<?php echo site_url('items/index/'. $item->id);?>">
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
                    <div class="col-md-4">
      								<span class="bar">5,3,9,6,5,9,7,3,5,2</span>
      								<p><?php echo $this->like->count_all($sel_city_id, $item->id) ?>  Likes</p>
      	            </div>
      	            <div class="col-md-4">
      								<span class="bar">5,3,9,6,5,9,7,3,5,2</span>
      	              <p><?php echo $this->review->count_all($sel_city_id, $item->id) ?>  Reviews</p>
      	            </div>
      	            <div class="col-md-4">
      	              <span class="bar">5,3,9,6,5,9,7,3,5,2</span>
      	              <p><?php echo $this->inquiry->count_all($city->id, $item->id) ?> Inquiry</p>
      	            </div>
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
