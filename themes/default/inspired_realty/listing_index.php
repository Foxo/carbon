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
			foreach($var['listings'] as $listing) {
				?>
            <div class="span4">
               <img class="listing_thumb_image" src="http://placehold.it/233x120" />
               <div class="row-fluid">
                  <div class="span8">
                     <h5 class="listing_thumb_price">$5,000,000</h5>
                  </div>
                  <div class="span4">
                     <a href="" class="btn btn-mini">Details</a>
                  </div>
               </div>
               
               <div class="listing_thumb_info">
                  <span class="listing_thumb_street">2171 E King Secondary Street</span><br />
                  <span class="listing_thumb_city">Vancouver, BC</span> 
               </div>
            </div>
            <?php	
			}
			?>
      </div>
   </section>
</div>