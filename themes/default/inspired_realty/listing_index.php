<div id="Listings">
	<header>
   	<h1>Feature Listings</h1>
  		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada tortor a tellus mollis dignissim. Nulla facilisi. Vestibulum egestas varius enim at lacinia. Aliquam ut interdum orci. Quisque tortor sapien, dapibus in cursus eget, placerat eu erat. Donec condimentum fringilla felis. In vitae erat augue. Suspendisse molestie vestibulum tortor, ut interdum orci pellentesque sit amet. Curabitur dapibus, urna at mattis condimentum, felis nunc pretium dolor, sed adipiscing mi orci vel purus.</p>
   </header>
	
   <section id="IR_Wrap" class="container-fluid">
   	<div id="IR_Controls">
      
      </div>
      
      <div id="IR_Results">
      	<?php
			echo '<div class="row-fluid">';
			
			foreach($var['listings'] as $x => $listing) {
				if($x > 0 && ($x%3) === 0) {
					echo '</div>';
					echo '<div class="row-fluid">';
				}
				?>
            <div class="span4">
               <img class="listing_thumb_image" src="<?=$listing['images'][0]['medium']; ?>" />
               
               <div class="listing_thumb_info">
                  <span class="listing_thumb_street"><?=$listing['street_address']; ?></span><br />
                  <span class="listing_thumb_city"><?=$listing['city']['city_title'].', '.$listing['city']['region_abbv']; ?></span> 
               </div>
               
               <div class="row-fluid">
                  <div class="span8">
                     <h5 class="listing_thumb_price"><?=$listing['fields']['Price']; ?></h5>
                  </div>
                  <div class="span4">
                     <a href="" class="btn btn-mini">Details</a>
                  </div>
               </div>
            </div>
            <?php	
			}
			
			echo '</div>';
			?>
      </div>
   </section>
</div>