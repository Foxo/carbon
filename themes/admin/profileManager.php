<style>
.ir_uiClickBtn { cursor: pointer; }
.ir_wrapper { width: 95%; }
.ir_menuCol { float: left; position: relative; width: 240px; height: 200px; z-index: 100; }
.ir_mainCol { float: left; position: relative; left: -10px; width: 730px }

#ir_profileNav li { height: 30px; padding-right: 12px; cursor: pointer; } 
#ir_profileNav li a { display: block; height: 16px; padding: 7px 0 7px 20px; text-decoration: none;  }
#ir_profileNav li:hover, #ir_profileNav li.ir_active { background: url('<?=ir_pluginUrl;?>/themes/admin/images/decoSelectProfileArrow.png') 100% 0 no-repeat; }
#ir_profileNav li:hover a, #ir_profileNav li.ir_active a { background: url('<?=ir_pluginUrl;?>/themes/admin/images/decoSelectProfileBg.png') 0 0 repeat-x; color: #fff; }



.ir_mainTopAffix { position: relative; width: 100%; height: 30px; border: 1px solid #dfdfdf; -webkit-border-top-left-radius: 2px; -webkit-border-top-right-radius: 2px; -moz-border-radius-topleft: 2px; -moz-border-radius-topright: 2px; border-top-left-radius: 2px; border-top-right-radius: 2px;background: url('<?=ir_pluginUrl;?>/themes/admin/images/boxAffixSpan.png') 0 0; }
.ir_mainBody { position: relative; width: 100%; padding: 1px 0; border-width: 0 1px; border-style: solid; border-color: #dfdfdf; overflow-y: hidden; } 
.ir_mainBottomAffix { width: 100%; height: 33px; border: 1px solid #dfdfdf; -webkit-border-bottom-right-radius: 2px; -webkit-border-bottom-left-radius: 2px; -moz-border-radius-bottomright: 2px; -moz-border-radius-bottomleft: 2px; border-bottom-right-radius: 2px; border-bottom-left-radius: 2px; background: url('<?=ir_pluginUrl;?>/themes/admin/images/boxAffixSpan.png') 0 0; }

.ir_bodyRow { position: relative; width: 688px; padding: 10px 20px; margin: 1px 0px 1px 1px;  border-bottom: 1px solid #dcdcdc;  border-top: 1px solid #e5e5e5; }
.ir_bodyRowEven { background: #f5f5f5;  } 
.ir_bodyRowOdd { background: #eeeeee;  }
.ir_bodyRowFirst { border-top: 0 !important; margin-top: 0 !important; }
.ir_bodyRowLast { border-bottom: 0 !important; margin-bottom: 0 !important; }

.ir_splitColTitle { width: 352px; padding-right: 30px;}
.ir_splitColField { width: 300px; }
.ir_splitColField .ir_field { width: 100%; }


.ir_rowNumber { width: 50px; font-size: 65px; color:#cec8c3; } 
.ir_bodyRowNumbered .ir_splitColTitle { width: 300px !important; padding-right: 30px !important; }

.ir_field { font-size: 14px; padding: 10px; border: 1px solid #d1d3d3; background: url('<?=ir_pluginUrl;?>/themes/admin/images/decoCheckboxBg.png') 0 0 repeat-x #f8f8f8 !important; }
.ir_hlField { font-size: 14px; padding: 10px; border: 1px solid #d1d3d3; background: url('<?=ir_pluginUrl;?>/themes/admin/images/decoFieldHlBg.png') 0 0 repeat-x #d8ecf3 !important; }

.ir_subTitle { margin: 0 0 5px 0; }
.ir_instruct { margin: 0 0 10px 0; }

#ir_main {  }

#ir_welcomeScreen { padding: 10px; }

#ir_loadingLayer { display: none; position: absolute; top: 0; left: 0; z-index: 98; background: url('<?=ir_pluginUrl;?>/themes/admin/images/loadingLayerBg.png') 0 0; }
#ir_loadingLayer .ir_loadingInd { position: relative; top: 50%; left: 50%; width: 200px; padding: 20px 0; margin: -25px 0 0 -100px; text-align: center; color: #fff; background: #333; -webkit-border-radius: 10px; -moz-border-radius: 10px; border-radius: 10px; }

#ir_preloadContent { position: absolute; top: 0; left: -9999px; width: 700px; }

#ir_profileOptions {  position: absolute; top: 1px; right:0; width: 360px; }

#ir_createNewProfile { display: block; width: 220px; height: 38px; padding: 0 5px; margin-bottom: 10px; background: url('<?=ir_pluginUrl;?>/themes/admin/images/btnNewProfile.png') 0 0 no-repeat; }
#ir_createNewProfile:hover { background-position: 0 -38px; }

#ir_saveProfile { display: block; float: right; width: 175px; height: 21px; padding: 4px 0; margin-left: 10px; background: url('<?=ir_pluginUrl;?>/themes/admin/images/decoSaveBtn.png') 0 0 no-repeat; text-align: center; color: #fff; text-transform: uppercase; text-decoration: none; }
#ir_saveProfile:hover { background-position: 0 -29px; }

#ir_removeProfile { display: block; float: left; width: 175px; height: 21px; padding: 4px 0; background: url('<?=ir_pluginUrl;?>/themes/admin/images/decoDeleteBtn.png') 0 0 no-repeat; text-align: center; color: #fff; text-transform: uppercase; text-decoration: none; }
#ir_removeProfile:hover { background-position: 0 -29px; }

.ir_checkbox { float: left; height: 25px; padding: 0 5px; border: 1px solid #d1d3d3; margin: 0 5px 5px 0; background: url('<?=ir_pluginUrl;?>/themes/admin/images/decoCheckboxBg.png') 0 0 repeat-x; }
.ir_checkbox span { display: block; float: right; padding-top: 3px; }
.ir_checkbox span::selection, .ir_checkbox span::-moz-selection, .ir_checkbox span::-webkit-selection { background: transparent; }

.fcb_clickElem { cursor: pointer; }
.fcb_stateElem { display: block; float: left; width: 22px; height: 18px; margin: 2px 10px 0 0; background-image: url('<?=ir_pluginUrl;?>/themes/admin/images/decoCheckboxStates.png'); background-repeat: no-repeat; }
.fcb_selected .fcb_stateElem { background-position: 0 3px; }
.fcb_deslected  .fcb_stateElem { background-position: 0 -14px; }

#ir_filterSelector { }

.ir_multiSelectBox { border: 1px solid #c1c6c9; }
.ir_multiSelectBox .ir_catList { width: 150px; padding: 10px 0 10px 10px; border-right: 1px solid #c1c6c9;  background: #e2e7ea; text-align: left; }
.ir_multiSelectBox .ir_catList a { display: block; padding: 5px; }
.ir_multiSelectBox .ir_catList a.selectedCat { width: 140px; margin-right: -1px; background: #fff; border-width: 1px 0 1px 1px; border-style: solid; border-color: #c1c6c9; }
.ir_multiSelectBox .ir_dataLists { background: #fff; width: 500px; min-height: 150px; }
.ir_multiSelectBox .ir_dataLists div { display: none; }
.ir_multiSelectBox .ir_dataLists .selectDataWrap { display: block; } 
.ir_clr { clear: both; }


</style>

<script type="text/javascript">
	(function($, undefined) {
		/**********************
		 * A custom checkbox plugin to handle the stylized checkboxes used by the InspiredRealty Wordpress Plugin
		 * To use, simply wrap your checkbox input and span with a container element, then apply the plugin to a master elem.
		 *********/
		$.fn.foxoCheckboxes = function(options) {
			var Me = $(this);
			
			var Elems = $('input:checkbox', Me);
			
			var defaults = {
				classes : {
					selected : 'fcb_selected',
					notSelected : 'fcb_deslected',
					hover : 'fcb_hover'	
				}
			};
			
			var Settings = $.extend({}, defaults, options);
			
			for(var x=0, len=Elems.length; x < len; x+=1) {
				var elem = $(Elems[x]);
				var parent = elem.parent();
				var elemId = elem.attr('id');
				var stateClass = (elem.is(':checked')) ? Settings.classes.selected : Settings.classes.notSelected;
				
				// Make the container a clickable element and give it an ID
				parent.addClass('fcb_clickElem '+stateClass).attr('id', 'fcb_'+elemId);
				
				// Make the input invisible and wrap it with the state indicator elem
				elem.css('visibility', 'hidden').wrap('<div class="fcb_stateElem" />');
			}
			
			Me.delegate('.fcb_clickElem', 'click', function() {
				var me = $(this);
				var input = $('#'+me.attr('id').replace('fcb_', ''));
				
				// Does the container indicate the checkbox is selected or not?
				if(me.hasClass(Settings.classes.selected)) {
					me.removeClass(Settings.classes.selected).addClass(Settings.classes.notSelected);
					input.attr('checked', false);
				} else {
					me.removeClass(Settings.classes.notSelected).addClass(Settings.classes.selected);
					input.attr('checked', true);
				}		
			});
			
			return {
				unhook : function() {
					Me.undelegate('.fcb_clickElem', 'click');	
				}
			}
		};
		
		$.fn.multiCatSelector = function(options) {
			var Elems = $(this);
			
			console.log(Elems);
			
			var Settings = $.extend({}, {
				selectedCatClass : 'selectedCat',
				catList : 'ir_catList',
				dataLists : 'ir_dataLists',
				selectedDataWrap : 'selectDataWrap'
			}, options);
			
			
			
			for(var x=0, len=Elems.length; x < len; x+=1) {
				var Me = $(Elems[x]);
				
				Me.delegate('.'+Settings.catList+' a', 'click', function(evt) {
					evt.preventDefault();
					
					var btn = $(this);
					var currentSel = $('.'+Settings.selectedCatClass, Me);
					
					if(currentSel.length > 0) {
						currentSel.removeClass(Settings.selectedCatClass);
						$('#'+currentSel.attr('href')).removeClass(Settings.selectedDataWrap);
					}
					
					btn.addClass(Settings.selectedCatClass);
					$('#'+btn.attr('href')).fadeIn(400, function() {
						$(this).addClass(Settings.selectedDataWrap);
					});
					
					return false;
				});
			}
			
			return {
				unhook : function() {
					//...	
				}		
			}
		};
		
		$.fn.serializeObject = function() {
			var o = {};
			var a = $(this).serializeArray();
			$.each(a, function() {
				 if (o[this.name]) {
					  if (!o[this.name].push) {
							o[this.name] = [o[this.name]];
					  }
					  o[this.name].push(this.value || '');
				 } else {
					  o[this.name] = this.value || '';
				 }
			});
			
			return o;
		};


		
		var ProfileManager = function() {
			var Me = $('#irProfileManager')
			
			/************************
			 * Settings
			 ********/
			var Settings = {
				stage : $('#ir_main'),
				menuStage : $('#ir_profileNav'),
				preload : $('#ir_preloadContent'),
				FCB : 0,
				transWrapper : 'ir_transportWrapper',
				loadingWrapper : $('#ir_loadingLayer'),
				filterSelector : $("#ir_filterSelector")
			};
			
			
			/************************
			 * Template Object - Stores simple HTML used by the UI;
			 ********/
			var Template = {
				profileMenuItem : function(d) {
					return '<li id="profile_'+d.profile_id+'"><a href="loadProfile" class="ir_uiClickBtn">'+d.profile_title+'</a></li>';	
				}
			};
			
			
			/************************
			 * Main UI Object - Events and functions that control the user interface
			 ********/
			var UI = {
				currentProfile : 0,
				init : function() {
					Me.delegate('.ir_uiClickBtn', 'click', function(evt) {
						evt.preventDefault();
						
						var btn = $(this);
						
						switch(btn.attr('href')) {
							case 'createNewProfile':
								Profile.new();
							break;
							
							case 'loadProfile':
								UI.loadProfile(btn);
							break;	
							
							case 'saveProfile':
								Profile.save();
							break;
						}
					});
					
					
				},
				loadHtmlContent : function(data) {
					Settings.preload.html(data.content);
					
					var contentHeight = Settings.preload.height()+50;
					
					Settings.stage.animate({ height : contentHeight }, 300, 'linear', function() {
						$(this).fadeOut(300, function() {
							$(this).html(data.content);
							Settings.preload.html(''); // Empty out the preload container otherwise duplicate ID's may exist.
							$(this).fadeIn(300);	
							data.completeFn();
						
							UI.toggleLoader(false);
						});
						
					});			
				},
				toggleLoader : function(enable) {
					var wrapper = Settings.loadingWrapper;
					var parent = $(wrapper.parent());
					
					if(enable === false) {
						// Hide the loading screen
						wrapper.fadeOut(100);
						
						Settings.loading = false;	
					} else {
						// Display the loading screen
						wrapper.css({ width: parent.width(), height : '100%' }).fadeIn(100);
						
						Settings.loading = true;
					}
				},
				loadProfile : function(profile) {
					UI.toggleLoader(true);
					
					if($.isNumeric(profile)) {
						var btnWrap = $('#profile_'+profile);
						var id = profile;		
					} else {
						var btnWrap = profile.parent('li');
						var id = btnWrap.attr('id').replace('profile_', '');
					}
					
					if(UI.currentProfile != 0) {
						UI.currentProfile.removeClass('ir_active');
					}
					
					UI.currentProfile = $(btnWrap);
					UI.currentProfile.addClass('ir_active');
					
					Profile.load(id, function() {
						if(Settings.FCB != 0) {
							Settings.FCB.unhook();	
						}
						
						Settings.FCB = Settings.stage.foxoCheckboxes();
						$('#ir_filterSelector', Me).multiCatSelector();
						
						console.log('Loaded');
						
						UI.toggleLoader(false);
					});
				},
				addProfile : function(data) {
					console.log(data);
					console.log(Settings.menuStage);
					
					Settings.menuStage.prepend(Template.profileMenuItem(data));	
				}
			};
			
			
			/************************
			 * Profile Object - Functions for loading, saving, creating and deleting profiles;
			 ********/
			var Profile = {
				// Function to load an existing profile;
				'load' : function(id, completeFn) {
					$.post(ajaxurl, { 'action' : 'ir_profiles', 'do' : 'profileForm', 'id' : id }, function(html) {
						UI.loadHtmlContent({
							content : html,
							completeFn : completeFn
						});
					}, 'html');		
				},
				
				// Function to save a profile;
				'save' : function() {
					UI.toggleLoader(true);
					
					$.post(ajaxurl, { 'action' : 'ir_profiles', 'do' : 'saveProfile', 'post' : $("#ir_profileFields").serialize() }, function(json) {
						if(json.success == 1) {
							Notifier.success('Your profile was successfuly saved!');
							
							if(json.profileIsNew === true) {
								UI.addProfile(json.profile);
								UI.loadProfile(json.profile.profile_id);
							}
							
						} else {
							UI.toggleLoader(false);		
						}
					}, 'json');
				},
				
				// Function to request an empty form 
				'new' : function() {
					UI.toggleLoader(true);
					
					$.post(ajaxurl, { 'action' : 'ir_profiles', 'do' : 'profileForm' }, function(html) {
						var completeFn = function() {
							if(Settings.FCB != 0) {
								Settings.FCB.unhook();	
							}
							
							Settings.FCB = Settings.stage.foxoCheckboxes();
						};
						
						UI.loadHtmlContent({
							content : html,
							completeFn : completeFn
						});
					}, 'html');	
				}
			};
			
			UI.init();
		};
		
		
		$(function() {
			ProfileManager();
		});
		
	})(jQuery);
	
	
</script>
<div id="irProfileManager" class="wrap ir_wrapper">
	<div id="ir_preloadContent"></div>
   
	<h2>INSPIREDREALTY: PROFILE MANAGER</h2>
   <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In enim dui, luctus dictum faucibus tincidunt, rhoncus facilisis neque. Quisque velit massa, bibendum ut lobortis et, varius non enim. Quisque tristique lorem nec dui fringilla aliquet. Fusce fringilla posuere euismod.</p>
   
   <div class="ir_menuCol">
   	<a href="createNewProfile" id="ir_createNewProfile" class="ir_uiClickBtn"></a>
   	<ul id="ir_profileNav">
      	<?php
				foreach($var['profiles'] as $profile) {
					echo '<li id="profile_'.$profile['profile_id'].'"><a href="loadProfile" class="ir_uiClickBtn">'.$profile['profile_title'].'</a></li>';	
				}
      	?>
      </ul>
   </div>
   
   <div class="ir_mainCol">
   	<div class="ir_mainTopAffix">
      	<div id="ir_profileOptions">
         	<a href="removeProfile" id="ir_removeProfile" class="ir_uiClickBtn">Remove Profile</a>
         	<a href="saveProfile" id="ir_saveProfile" class="ir_uiClickBtn">Save Profile</a>
            
            <br class="ir_clr" />
         </div>
      </div>
      <div class="ir_mainBody">
      	<div id="ir_loadingLayer">
         	<div class="ir_loadingInd">
            	Loading...
            </div>
         </div>
      	<div id="ir_main">
         	<div id="ir_welcomeScreen">
               <h3 class="ir_subTitle">Welcome to the InspiredRealty Wordpress Plugin</h3>
               <p class="ir_instruct">This plugin is designed to provide a layer of abstraction for the InspiredRealty API. This plugin uses "Profiles" that allow you to easily select options then insert your listings onto any page of your wordpress site.</p>
            </div>
         </div>
      </div>
      <div class="ir_mainBottomAffix"></div>
   </div>
   
   <br class="clear" />
</div>