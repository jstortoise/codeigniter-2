<div class="col-md-12">
  <div class="grid" style="text-align: left;">
    <div class="ibox float-e-margins">

      <div class="ibox-title">
        <h4><strong><?php echo $this->city->get_info($city_id)->name; ?> - News Feeds</strong></h4>
      </div>

      <div class="top-border">


        <?php
        	$index = 0;
        	foreach ($feeds as $feed) {
        		echo '<div class="row">';
        ?>

        	<div class="col-md-12">
        	  <div class="grid" style="text-align: left;">
        	    <div class="ibox float-e-margins">

        	      <div class="top-border">
        	        <div class="col-md-4 ibox-content no-padding border-left-right">
        	          <a href="<?php echo site_url('dashboard/index/'. $feed->id);?>">
        	          <?php
        	            echo "<img alt='image' class='img-responsive' src='http://bespokenlifestyle.co.za/uploads/".$feed->image."'/>";
        	          ?>
        	          </a>
        	        </div>
        	        <div class="col-md-8 ibox-content profile-content">
                    <h5><strong><?php echo $feed->title;?></strong></h5>
        	          <p id="less_<?php echo $feed->id;?>">
        	          <?php
        	            $description = strip_tags($feed->description);

        	            if (strlen($description) > 250) {
        	              $stringCut = substr($description, 0, 250);
                        $all_description = str_replace("\n", "<br>", $description);
        	              $description = substr($stringCut, 0, strrpos($stringCut, ' ')) . '... <a style="color: blue;" href="javascript:showAll(\'' . $feed->id . '\')"> More</a>';
        	            }
                      $description = str_replace("\n", "<br>", $description);
        	            echo $description;
        	          ?>
        	          </p>
                    <p id="all_<?php echo $feed->id;?>" style="display: none;">
        	          <?php
        	            $description = strip_tags($feed->description);
                      $description = str_replace("\n", "<br>", $description) . '     <a style="color: blue;" href="javascript:showLess(\'' . $feed->id . '\')"> Less</a>';;
        	            echo $description;
        	          ?>
        	          </p>

                    <p style="text-align: right;">
                      <?php echo date("Y-m-d", strtotime($feed->added)); ?>
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
<script>
  function showAll(id) {
    $("#less_" + id).hide();
    $("#all_" + id).show();
  }

  function showLess(id) {
    $("#all_" + id).hide();
    $("#less_" + id).show();
  }
</script>
