<!-- Latest Posts Subscription Ajax Save -->

<?php if (empty($ajax)) : ?>
<div id="latestposts_save_wrapper">
<?php endif; ?>

<div class="wrap <?php echo $this -> pre; ?> newsletters">
	<h2><?php _e('Save Latest Posts Subscription', 'wp-mailinglist'); ?></h2>
	
	<?php $this -> render('error', array('errors' => $errors), true, 'admin'); ?>
	
	<form action="<?php echo admin_url('admin-ajax.php?action=newsletters_latestposts_save'); ?>" onsubmit="latestposts_save(); return false;" method="post" id="latestposts_form">
		<?php wp_nonce_field('newsletters_latestposts_save'); ?>
		<input type="hidden" name="id" value="<?php echo esc_attr(wp_unslash($latestpostssubscription -> id)); ?>" />
		
		<table class="form-table">
	    	<tbody>
	        	<tr>
	            	<th><label for="subject"><?php _e('Email Subject', 'wp-mailinglist'); ?></label></th>
	                <td>
	                	<input class="widefat" type="text" name="subject" value="<?php echo esc_attr(wp_unslash($latestpostssubscription -> subject)); ?>" id="subject" />
	                    <span class="howto"><?php _e('Subject of the email to the subscribers. Supports shortcodes.', 'wp-mailinglist'); ?></span>
	                </td>
	            </tr>
	            <tr>
	            	<th><label for="number"><?php _e('Number of Posts', 'wp-mailinglist'); ?></label>
	            	<?php echo $Html -> help(__('Specify the number of posts to include. If you are using Post Categories and Group by Category is turned on below, the number of posts will be used per category, not in total.', 'wp-mailinglist')); ?></th>
	                <td>
	                	<input type="text" class="widefat" style="width:65px;" name="number" value="<?php echo esc_attr(wp_unslash($latestpostssubscription -> number)); ?>" id="number" />
	                    <span class="howto"><?php _e('Only new posts will be sent out and each post not more than once.', 'wp-mailinglist'); ?></span>
	                </td>
	            </tr>
	            <tr>
	            	<th><label for="minnumber"><?php _e('Minimum Posts', 'wp-mailinglist'); ?></label></th>
	            	<td>
		            	<input type="text" class="widefat" style="width:65px;" name="minnumber" value="<?php echo esc_attr(wp_unslash($latestpostssubscription -> minnumber)); ?>" id="minnumber" />
		            	<span class="howto"><small><?php _e('(optional)', 'wp-mailinglist'); ?></small> <?php _e('Specify a minimum number of posts required to send the newsletter.', 'wp-mailinglist'); ?></span>
	            	</td>
	            </tr>
	            <?php if ($this -> language_do()) : ?>
	                <?php $language = $latestpostssubscription -> language; ?>
	                <?php if ($languages = $this -> language_getlanguages()) : ?>
	                	<tr>
	                    	<th><?php _e('Language', 'wp-mailinglist'); ?></th>
	                        <td>
			                	<?php foreach ($languages as $lang) : ?>
									<label><input <?php echo (!empty($language) && $language == $lang) ? 'checked="checked"' : ''; ?> type="radio" name="language" value="<?php echo esc_attr($lang); ?>" id="language_<?php echo $lang; ?>" /> <?php echo $this -> language_flag($lang); ?></label>
			                    <?php endforeach; ?>
			                    <span class="howto"><?php _e('Choose the language part which should be used for the posts.', 'wp-mailinglist'); ?></span>
	                    	</td>
					<?php endif; ?>
	            <?php endif; ?>
	            <?php $takefrom = $latestpostssubscription -> takefrom; ?>
	            <tr>
	            	<th><label for="takefrom_categories"><?php _e('Take Posts From', 'wp-mailinglist'); ?></label></th>
	            	<td>
	            		<label><input onclick="jQuery('#posttypesdiv').hide(); jQuery('#postcategoriesdiv').show();" <?php echo (empty($takefrom) || (!empty($takefrom) && $takefrom == "categories")) ? 'checked="checked"' : ''; ?> type="radio" name="takefrom" value="categories" id="takefrom_categories" /> <?php _e('Post Categories', 'wp-mailinglist'); ?></label>
	            		<label><input onclick="jQuery('#posttypesdiv').show(); jQuery('#postcategoriesdiv').hide();" <?php echo (!empty($takefrom) && $takefrom == "posttypes") ? 'checked="checked"' : ''; ?> type="radio" name="takefrom" value="posttypes" id="takefrom_posttypes" /> <?php _e('Custom Post Types', 'wp-mailinglist'); ?></label>
	            		<label><input onclick="jQuery('#posttypesdiv').hide(); jQuery('#postcategoriesdiv').hide();" <?php echo (!empty($takefrom) && $takefrom == "pages") ? 'checked="checked"' : ''; ?> type="radio" name="takefrom" value="pages" id="takefrom_pages" /> <?php _e('Pages', 'wp-mailinglist'); ?></label>
	            		<span class="howto"><?php _e('Should posts be regular posts in categories or posts from custom post types?', 'wp-mailinglist'); ?></span>
	            	</td>
	            </tr>
	        </tbody>
	    </table>
	    
	    <div id="posttypesdiv" style="display:<?php echo (!empty($takefrom) && $takefrom == "posttypes") ? 'block' : 'none'; ?>;">
	    	<table class="form-table">
	    		<tbody>
	    			<tr>
	    				<?php $posttypes = maybe_unserialize($latestpostssubscription -> posttypes); ?>
	    				<th><label for="posttypesselectall"><?php _e('Custom Post Types', 'wp-mailinglist'); ?></label></th>
	    				<td>
	    					<div>
								<input type="checkbox" name="posttypesselectall" value="1" id="posttypesselectall" onclick="jqCheckAll(this, '<?php echo $this -> sections -> settings; ?>', 'posttypes');" />
								<label for="posttypesselectall"><strong><?php _e('Select All', 'wp-mailinglist'); ?></strong></label>
		                    </div>
		                    <div class="scroll-list">
		    					<label><input <?php echo (!empty($posttypes) && in_array('post', $posttypes)) ? 'checked="checked"' : ''; ?> type="checkbox" name="posttypes[]" value="post" id="posttypes_post" /> <?php _e('Post', 'wp-mailinglist'); ?></label>
		    					<?php if ($post_types = $this -> get_custom_post_types()) : ?>
		    						<?php foreach ($post_types as $ptypekey => $ptype) : ?>
		    							<br/><label><input <?php echo (!empty($posttypes) && in_array($ptypekey, $posttypes)) ? 'checked="checked"' : ''; ?> type="checkbox" name="posttypes[]" value="<?php echo $ptypekey; ?>" id="posttype_<?php echo $ptypekey; ?>" /> <?php echo $ptype -> labels -> name; ?></label>
		    						<?php endforeach; ?>
		    					<?php endif; ?>
		    				</div>
		    				<span class="howto"><?php _e('Tick/check custom post types to take posts from for sending.', 'wp-mailinglist'); ?></span>
	    				</td>
	    			</tr>
	    		</tbody>
	    	</table>
	    </div>
				
		<div id="postcategoriesdiv" style="display:<?php echo (empty($takefrom) || (!empty($takefrom) && $takefrom == "categories")) ? 'block' : 'none'; ?>;">            
			<table class="form-table">
				<tbody>
		            <tr>
		            	<th><label for="categoriesselectall"><?php _e('Post Categories', 'wp-mailinglist'); ?></label></th>
		                <td>
			                <div>
				                <p>
					                <label><input <?php echo (!empty($latestpostssubscription -> categories) && $latestpostssubscription -> categories == "all") ? 'checked="checked"' : ''; ?> onclick="if (jQuery(this).is(':checked')) { jQuery('#categories_notall').hide(); } else { jQuery('#categories_notall').show(); }" type="checkbox" name="allcategories" value="1" id="allcategories" /> <?php _e('All Categories', 'wp-mailinglist'); ?></label>
					                <span class="howto"><?php _e('Select this to automatically use all categories.', 'wp-mailinglist'); ?></span>
					            </p>
			                </div>
			                
			                <div id="categories_notall" style="display:<?php echo (!empty($latestpostssubscription -> categories) && $latestpostssubscription -> categories == "all") ? 'none' : 'block'; ?>;">
				                <?php global $sitepress, $newsletters_languageplugin; ?>
				                <?php if ($this -> language_do() && $newsletters_languageplugin == "wpml") : ?>
				                	<?php if ($languages = $this -> language_getlanguages()) : ?>
				                		<?php $categories = maybe_unserialize($latestpostssubscription -> categories); ?>
										<div>
											<input type="checkbox" name="categoriesselectall" value="1" id="categoriesselectall" onclick="jqCheckAll(this, '<?php echo $this -> sections -> settings; ?>', 'categories');" />
											<label for="categoriesselectall"><strong><?php _e('Select All', 'wp-mailinglist'); ?></strong></label>
				                        </div>
				                		<?php foreach ($languages as $language) : ?>
				                			<div><?php echo $this -> language_flag($language); ?> <strong><?php echo $this -> language_name($language); ?></strong></div>
				                			<?php $sitepress -> switch_lang($language, true); ?>
				                			<?php if ($cats = get_categories(array('hide_empty' => 0, 'pad_counts' => 1))) : ?>
						                    	<div class="scroll-list">
						                        	<?php foreach ($cats as $category) : ?>
						                            	<label><input <?php echo (!empty($categories) && in_array($category -> cat_ID, $categories)) ? 'checked="checked"' : ''; ?> type="checkbox" name="categories[]" value="<?php echo esc_attr($category -> cat_ID); ?>" id="categories_<?php echo $category -> cat_ID; ?>" /> <?php echo $category -> cat_name; ?></label><br/>
						                            <?php endforeach; ?>
						                        </div>
				                			<?php endif; ?>
				                		<?php endforeach; ?>
				                	<?php endif; ?>
				                <?php else : ?>
				                	<?php if ($cats = get_categories(array('hide_empty' => 0, 'pad_counts' => 1))) : ?>
				                    	<?php $categories = maybe_unserialize($latestpostssubscription -> categories); ?>
										<div>
											<input type="checkbox" name="categoriesselectall" value="1" id="categoriesselectall" onclick="jqCheckAll(this, '<?php echo $this -> sections -> settings; ?>', 'categories');" />
											<label for="categoriesselectall"><strong><?php _e('Select All', 'wp-mailinglist'); ?></strong></label>
				                        </div>
				                    	<div class="scroll-list">
				                        	<?php foreach ($cats as $category) : ?>
				                            	<label><input <?php echo (!empty($categories) && in_array($category -> cat_ID, $categories)) ? 'checked="checked"' : ''; ?> type="checkbox" name="categories[]" value="<?php echo esc_attr($category -> cat_ID); ?>" id="categories_<?php echo $category -> cat_ID; ?>" /> <?php echo $category -> cat_name; ?></label><br/>
				                            <?php endforeach; ?>
				                        </div>
				                        
				                        <span class="howto"><?php _e('categories for posts to be taken from.', 'wp-mailinglist'); ?></span>
				                    <?php else : ?>
				                    	<p class="newsletters_error"><?php _e('No categories are available', 'wp-mailinglist'); ?></p>
				                    <?php endif; ?>
				                <?php endif; ?>
			                </div>
		                </td>
		            </tr>
		            <?php
		            
		            $groupbycategory = $latestpostssubscription -> groupbycategory;
		            
		            ?>
		            <tr>
		            	<th><label for="groupbycategory_Y"><?php _e('Group by Category', 'wp-mailinglist'); ?></label></th>
		            	<td>
		            		<label><input <?php echo (!empty($groupbycategory) && $groupbycategory == "Y") ? 'checked="checked"' : ''; ?> type="radio" name="groupbycategory" value="Y" id="groupbycategory_Y" /> <?php _e('Yes', 'wp-mailinglist'); ?></label>
		            		<label><input <?php echo (empty($groupbycategory) || (!empty($groupbycategory) && $groupbycategory == "N")) ? 'checked="checked"' : ''; ?> type="radio" name="groupbycategory" value="N" id="groupbycategory_N" /> <?php _e('No', 'wp-mailinglist'); ?></label>
		            		<span class="howto"><?php _e('Group posts by category, each set with a category heading and link.', 'wp-mailinglist'); ?></span>
		            	</td>
		            </tr>
		        </tbody>
		    </table>
	    </div> 
		           
		<table class="form-table">
		    <tbody>
	            <tr>
	            	<th><label for="exclude"><?php _e('Exclude Posts', 'wp-mailinglist'); ?></label></th>
	                <td>
	                	<input class="widefat" style="width:250px;" type="text" name="exclude" value="<?php echo esc_attr(wp_unslash($latestpostssubscription -> exclude)); ?>" id="exclude" />
	                	<span class="howto"><?php _e('optional. comma separated post IDs to exclude from the latest posts subscription email.', 'wp-mailinglist'); ?></span>
	                </td>
	            </tr>
	            <tr>
	            	<th><label for="order"><?php _e('Order Posts', 'wp-mailinglist'); ?></label></th>
	            	<td>
	            		<?php
	            		
	            		$order = $latestpostssubscription -> order;
	            		$orderby = $latestpostssubscription -> orderby;
	            		
	            		?>
	            		<select name="order">
	            			<option <?php echo (!empty($order) && $order == "ASC") ? 'selected="selected"' : ''; ?> value="ASC"><?php _e('Ascending', 'wp-mailinglist'); ?></option>
	            			<option <?php echo (!empty($order) && $order == "DESC") ? 'selected="selected"' : ''; ?> value="DESC"><?php _e('Descending', 'wp-mailinglist'); ?></option>
	            		</select>
	            		<?php _e('by', 'wp-mailinglist'); ?>
	            		<?php 
	            		
	            		$orderby = array(
	            			'ID'			=>	__('ID', $this -> plugin),
	            			'date'			=>	__('Date', 'wp-mailinglist'),
	            			'author'		=>	__('Author', 'wp-mailinglist'),
	            			'title'			=>	__('Title', 'wp-mailinglist'),
	            			'parent'		=>	__('Parent', 'wp-mailinglist'),
	            			'comment_count'	=>	__('Comment Count', 'wp-mailinglist'),
	            			'menu_order'	=>	__('Menu Order', 'wp-mailinglist')
	            		);
	            		
	            		$orderby = apply_filters('newsletters_posts_orderby_values', $orderby);
	            		
	            		?>
	            		<select name="orderby" id="orderby">
	            			<?php foreach ($orderby as $okey => $oval) : ?>
	            				<option <?php echo (!empty($latestpostssubscription -> orderby) && $latestpostssubscription -> orderby == $okey) ? 'selected="selected"' : ''; ?> value="<?php echo esc_attr($okey); ?>"><?php echo $oval; ?></option>
	            			<?php endforeach; ?>
	            		</select>
	            	</td>
	            </tr>
	            <tr>
	            	<th><label for="olderthan"><?php _e('Oldest Post Date/Time', 'wp-mailinglist'); ?></label></th>
	            	<td>
	            		<input type="text" name="olderthan" value="<?php echo esc_attr(wp_unslash(date("Y-m-d H:i:s", strtotime($latestpostssubscription -> olderthan)))); ?>" id="olderthan" />
	            		<span class="howto"><small><?php _e('(format: YYYY-MM-DD HH:MM:SS)', 'wp-mailinglist'); ?></small> <?php _e('Show posts with a publish date no older than the specified date above.', 'wp-mailinglist'); ?></span>
	            	</td>
	            </tr>
	            <tr>
	            	<th><label for="mailinglistsselectall"><?php _e('Mailing List/s', 'wp-mailinglist'); ?></label></th>
	                <td>
	                	<?php if ($mailinglists = $Mailinglist -> select(true)) : ?>
	                    	<label style="font-weight:bold;"><input type="checkbox" name="mailinglistsselectall" value="1" id="mailinglistsselectall" onclick="jqCheckAll(this, '<?php echo $this -> sections -> settings; ?>', 'lists');" /> <?php _e('Select All', 'wp-mailinglist'); ?></label><br/>
	                    	<?php $lists = maybe_unserialize($latestpostssubscription -> lists); ?>
	                    	<div class="scroll-list">
	                        	<?php foreach ($mailinglists as $list_id => $list_title) : ?>
	                            	<label><input <?php echo (!empty($lists) && in_array($list_id, $lists)) ? 'checked="checked"' : ''; ?> type="checkbox" name="lists[]" value="<?php echo esc_attr($list_id); ?>" id="lists_<?php echo $list_id; ?>" /> <?php echo $list_title; ?> (<?php echo $SubscribersList -> count(array('list_id' => $list_id, 'active' => "Y")); ?> <?php _e('active', 'wp-mailinglist'); ?>)</label><br/>
	                            <?php endforeach; ?>
	                        </div>
	                    <?php else : ?>
	                    	<p class="newsletters_error"><?php _e('No mailing lists are available', 'wp-mailinglist'); ?></p>
	                    <?php endif; ?>
	                	<span class="howto"><?php _e('Mailing list/s to send latest posts subscriptions to.', 'wp-mailinglist'); ?></span>
	                </td>
	            </tr>
		    </tbody>
		</table>
		
		<?php if (!empty($latestpostssubscription -> id)) : ?>
		<table class="form-table">
			<tbody>
	            <tr>
	            	<th><label for="updateinterval_N"><?php _e('Update Schedule Interval?', 'wp-mailinglist'); ?></label></th>
	                <td>
	                	<label><input onclick="jQuery('#updateinterval_div').show();" type="radio" name="updateinterval" value="Y" id="updateinterval_Y" /> <?php _e('Yes', 'wp-mailinglist'); ?></label>
	                    <label><input onclick="jQuery('#updateinterval_div').hide();" type="radio" name="updateinterval" value="N" id="updateinterval_N" checked="checked" /> <?php _e('No', 'wp-mailinglist'); ?>
	                	<span class="howto"><?php _e('leave this as No to leave the interval and current schedule unchanged.', 'wp-mailinglist'); ?></span>
	                </td>
	            </tr>
	        </tbody>
	    </table>
	    
	    <div id="updateinterval_div" style="display:none;">
		<?php else : ?>
			<input type="hidden" name="updateinterval" value="Y" />
		<?php endif; ?>
	    	<table class="form-table">
	        	<tbody>
	        		<tr>
		            	<th><label for="startdate"><?php _e('Start Date/Time', 'wp-mailinglist'); ?></label></th>
		            	<td>
		            		<?php
		            		
		            		$startdate = $latestpostssubscription -> startdate;
		            		if (empty($startdate)) { $startdate = $Html -> gen_date("Y-m-d H:i:s"); }
		            		
		            		?>
		            	
		            		<input type="text" name="startdate" value="<?php echo esc_attr(wp_unslash(date("Y-m-d H:i:s", strtotime($startdate)))); ?>" id="startdate" /> <strong><?php _e('Current Date/Time:', 'wp-mailinglist'); ?> <?php echo $Html -> gen_date("Y-m-d H:i:s"); ?></strong>
		            		<span class="howto"><small><?php _e('(format: YYYY-MM-DD HH:MM:SS)', 'wp-mailinglist'); ?></small> <?php _e('Choose the day to start sending these posts for the first time with the settings configured.', 'wp-mailinglist'); ?></span>
		            	</td>
		            </tr>
	                <tr>
	                    <th><label for="interval"><?php _e('Sending Interval', 'wp-mailinglist'); ?></label></th>
	                    <td>
	                        <?php if ($schedules = wp_get_schedules()) : ?>
	                            <?php $interval = $latestpostssubscription -> interval; ?>
	                            <select name="interval" id="interval">
	                                <option value=""><?php _e('- Select Schedule -', 'wp-mailinglist'); ?></option>
	                                <?php foreach ($schedules as $skey => $sval) : ?>
	                                    <option <?php echo (!empty($interval) && $skey == $interval) ? 'selected="selected"' : ''; ?> value="<?php echo esc_attr($skey); ?>"><?php echo $sval['display']; ?></option>
	                                <?php endforeach; ?>
	                            </select>
	                        <?php else : ?>
	                            <p class="newsletters_error"><?php _e('No schedules are available', 'wp-mailinglist'); ?></p>
	                        <?php endif; ?>
	                        <span class="howto"><?php _e('Set how often the latest posts subscription should be sent out.', 'wp-mailinglist'); ?></span>
	                        <span class="howto"><?php _e('The first execution will be right now, unless you specify a future start date/time above.', 'wp-mailinglist'); ?></span>
	                    </td>
	                </tr>
	            </tbody>
	        </table>
	    <?php if (!empty($latestpostssubscription -> id)) : ?></div><?php endif; ?>
	    
	    <table class="form-table">
	    	<tbody>
	            <tr>
	            	<th><label for="theme_id_0"><?php _e('Email Template', 'wp-mailinglist'); ?></label></th>
	                <td>
	                	<?php $Db -> model = $Theme -> model; ?>
	                    <?php if ($themes = $Db -> find_all(false, false, array('title', "ASC"))) : ?>
	                        <?php $default_theme_id = $this -> default_theme_id('sending'); ?>
	                    	<div class="scroll-list">
	                        	<label><input type="radio" name="theme_id" value="0" id="theme_id_0" /> <?php _e('NONE', 'wp-mailinglist'); ?></label><br/>
	                        	<?php foreach ($themes as $theme) : ?>
	                            	<label><input <?php echo ((!empty($theme) && $theme -> id == $latestpostssubscription -> theme_id) || (empty($latestpostssubscription -> theme_id) && $theme -> id == $default_theme_id)) ? 'checked="checked"' : ''; ?> type="radio" name="theme_id" value="<?php echo esc_attr($theme -> id); ?>" id="theme_id_<?php echo $theme -> id; ?>" /> <?php echo $theme -> title; ?></label> <a class="" href="" onclick="jQuery.colorbox({iframe:true, width:'80%', height:'80%', href:'<?php echo home_url(); ?>/?wpmlmethod=themepreview&amp;id=<?php echo $theme -> id; ?>'}); return false;"><i class="fa fa-eye fa-fw"></i></a> <a href="" onclick="jQuery.colorbox({title:'<?php echo sprintf(__('Edit Template: %s', 'wp-mailinglist'), $theme -> title); ?>', href:newsletters_ajaxurl + 'action=newsletters_themeedit&security=<?php echo wp_create_nonce('themeedit'); ?>&id=<?php echo $theme -> id; ?>'}); return false;" class=""><i class="fa fa-pencil fa-fw"></i></a><br/>
	                            <?php endforeach; ?>
	                        </div>
	                    <?php else : ?>
	                    	<p class=""><?php _e('No templates are available', 'wp-mailinglist'); ?></p>
	                    <?php endif; ?>
	                	<span class="howto"><?php _e('Template to use for the latest posts subscription email.', 'wp-mailinglist'); ?></span>
	                </td>
	            </tr>
	            <tr>
		            <th><label for="status_active"><?php _e('Status', 'wp-mailinglist'); ?></label></th>
		            <td>
			            <label class="newsletters_success"><input <?php echo (empty($latestpostssubscription -> status) || $latestpostssubscription -> status == "active") ? 'checked="checked"' : ''; ?> type="radio" name="status" value="active" id="status_active" /> <i class="fa fa-play fa-fw"></i> <?php _e('Active', 'wp-mailinglist'); ?></label>
			            <label class="newsletters_error"><input <?php echo (!empty($latestpostssubscription -> status) && $latestpostssubscription -> status == "inactive") ? 'checked="checked"' : ''; ?> type="radio" name="status" value="inactive" id="status_inactive" /> <i class="fa fa-pause fa-fw"></i> <?php _e('Paused', 'wp-mailinglist'); ?></label>
		            </td>
	            </tr>
	        </tbody>
	    </table>
		    
		<p class="submit">
			<button type="button" onclick="jQuery.colorbox.close();" class="button button-secondary" name="cancel" value="1">
				<i class="fa fa-times fa-fw"></i> <?php _e('Cancel', 'wp-mailinglist'); ?>
			</button>
			<button value="1" type="submit" id="latestposts_save_button" class="button button-primary" name="save">
				<i class="fa fa-check fa-fw"></i> <?php _e('Save Settings', 'wp-mailinglist'); ?>
				<span style="display:none;" id="latestposts_loading"><i class="fa fa-refresh fa-spin fa-fw"></i></span>
			</button>
		</p>
	</form>
</div>

<?php if (empty($ajax)) : ?>
</div>
<?php endif; ?>

<script type="text/javascript">
jQuery(document).ready(function() {
	<?php if (!empty($success)) : ?>
		jQuery.colorbox.close();
		wpml_scroll('#latestposts_wrapper');
		
		jQuery.post(newsletters_ajaxurl + 'action=newsletters_latestposts_settings&security=<?php echo wp_create_nonce('latestposts_settings'); ?>', false, function(response) {
			jQuery('#latestposts_wrapper').html(response).fadeIn();
		});
	<?php endif; ?>
});

function latestposts_save() {
	jQuery('#latestposts_save_button').prop('disabled', true);
	jQuery('#latestposts_loading').show();
	jQuery('#latestposts_table').addClass('loading');
	var formdata = jQuery('#latestposts_form').serialize();
	jQuery.post(newsletters_ajaxurl + 'action=newsletters_latestposts_save', formdata, function(response) {
		jQuery('#latestposts_save_wrapper').html(response);
		
		<?php if (!empty($errors)) : ?>
		wpml_scroll('#latestposts_save_wrapper');
		<?php endif; ?>
	});
}
</script>