<form action="" method="post" id="ir_profileFields">
	<?php
		function isBoxChecked($id, $arr) {
			if(in_array($id, $arr)) {
				return 'checked';		
			}
		}
		
   	if(!empty($var['profile']['profile_id'])) {
			?>
			<input type="hidden" name="id" value="<?=$var['profile']['profile_id']; ?>" />
			<div class="ir_bodyRow ir_bodyRowEven ir_bodyRowFirst">
				<table>
					<tr>
						<td class="ir_splitColTitle">
							<h3 class="ir_subTitle">Profile ShortCode</h3>
							<p class="ir_instruct">Insert this shortcode onto the page that you wish to display your listings. The listings will be generated based on your settings below.</p>
						</td>
						
						<td class="ir_splitColField">
							<div class="ir_hlField">
                     	[inspiredRealty_listings options="profile:<?=$var['profile']['profile_id']; ?>"]
                     </div>
						</td>
					</tr>
				</table>
			</div>
			<?php
		}
	?>
   
   <div class="ir_bodyRow ir_bodyRowNumbered ir_bodyRowOdd">
      <table>
         <tr>
            <td class="ir_rowNumber">
               1
            </td>
            <td class="ir_splitColTitle">
               <h3 class="ir_subTitle">Profile Title</h3>
               <p class="ir_instruct">This is title for your profile and is only used for idenfitication purposes if you wish to update or remove this profile at a later date.</p>
            </td>
            
            <td class="ir_splitColField">
               <input type="text" name="title" id="ir_profileTitle" value="<?=$var['profile']['profile_title']; ?>" class="ir_field" />
            </td>
         </tr>
      </table>
   </div>
   
   <div class="ir_bodyRow ir_bodyRowNumbered ir_bodyRowEven">
      <table>
         <tr>
            <td class="ir_rowNumber">
               2
            </td>
            
            <td class="ir_fullCol">
               <h3 class="ir_subTitle">Available Statuses</h3>
               <p class="ir_instruct">Please select the statuses that you would like to be available through this profile.</p>
               
               <ul class="ir_checkboxes">
               	<?php
							foreach($var['statuses'] as $status) {
								echo '<li class="ir_checkbox">
									<input type="checkbox" value="'.$status['id'].'" '.isBoxChecked($status['id'], $var['profile']['profile_data']['statuses']).' name="statuses[]" id="status_'.$status['id'].'" />
									<span>'.$status['title'].'</span>
									
									<br class="ir_clr" />
								</li>';
							}
						?>
                  <br class="ir_clr" />
               </ul>
            </td>
         </tr>
      </table>
   </div>
   
   <div class="ir_bodyRow ir_bodyRowNumbered ir_bodyRowOdd">
      <table>
         <tr>
            <td class="ir_rowNumber">
               3
            </td>
            
            <td class="ir_fullCol">
               <h3 class="ir_subTitle">Available Cities</h3>
               <p class="ir_instruct">Please select the statuses that you would like to be available through this profile.</p>
               
               <ul class="ir_checkboxes">
               	<?php
							foreach($var['cities'] as $city) {
								echo '<li class="ir_checkbox">
									<input type="checkbox" value="'.$city['city_id'].'" '.isBoxChecked($city['city_id'], $var['profile']['profile_data']['cities']).' name="cities[]" id="city_'.$city['city_id'].'" />
									<span>'.$city['city_title'].', '.$city['region_abbrev'].'</span>
									<br class="ir_clr" />
								</li>';
							}
						?>
                  <br class="ir_clr" />
               </ul>
            </td>
         </tr>
      </table>
   </div>
   
   <div class="ir_bodyRow ir_bodyRowNumbered ir_bodyRowEven">
      <table>
         <tr>
            <td class="ir_rowNumber">
               4
            </td>
            
            <td class="ir_fullCol">
               <h3 class="ir_subTitle">Available Datatypes</h3>
               <p class="ir_instruct">Please select the datatypes that you would like to be available through this profile.</p>
               
               <ul class="ir_checkboxes">
               	<?php
							foreach($var['datatypes'] as $type) {
								echo '<li class="ir_checkbox">
									<input type="checkbox" value="'.$type['id'].'" '.isBoxChecked($type['id'], $var['profile']['profile_data']['datatypes']).' name="datatypes[]" id="datatype_'.$type['id'].'" />
									<span>'.$type['name'].'</span>
									<br class="ir_clr" />
								</li>';
							}
						?>
                  <br class="ir_clr" />
               </ul>
            </td>
         </tr>
      </table>
   </div>
   
   <div class="ir_bodyRow ir_bodyRowNumbered ir_bodyRowOdd">
      <table>
         <tr>
            <td class="ir_rowNumber">
               5
            </td>
            <td class="ir_splitColTitle">
               <h3 class="ir_subTitle">Filter Controls</h3>
               <p class="ir_instruct">Would you like the filter controls to be shown?</p>
            </td>
            
            <td class="ir_splitColField">
               <select name="showFilters" id="showFilters" class="ir_field">
               	<option value="1">Show Filter Controls</option>
               	<option value="0">Hide Filter Controls</option>
               </select>
            </td>
         </tr>
      </table>
   </div>
   
   <div class="ir_bodyRow ir_bodyRowNumbered ir_bodyRowEven">
   	<?php
			foreach($var['datatypes'] as $dt) {
				$name = 'dtFields_'.$dt['id'];
				$dtList.= '<a href="'.$name.'">'.$dt['name'].'</a>'.PHP_EOL;
				$fieldLists.= '<div id="'.$name.'" class="selectDataWrap">
					Fields for '.$dt['name'].';
				</div>';
			}
		?>
      <table >
         <tr>
            <td class="ir_rowNumber">
               6
            </td>
            
            <td class="ir_fullCol">
               <h3 class="ir_subTitle">Available Filters</h3>
               <p class="ir_instruct">Please select which fields you would like to use as filters.</p>
               
               <table id="ir_filterSelector" class="ir_multiSelectBox" cellpadding="0" cellspacing="0">
               	<tr>
                  	<th id="ir_dataTypeList" class="ir_catList">
                        <?=$dtList; ?>
                     </th>
                     <td id="ir_dataTypeFields" class="ir_dataLists">
                     	<?=$fieldLists; ?>	  
                     </td>
                  </tr>
               </table>
            </td>
         </tr>
      </table>
   </div>
   
</form>