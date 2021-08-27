<!-- Import/Export -->

<?php 
	
$lists = $Mailinglist -> select(true); 
$csvdelimiter = $this -> get_option('csvdelimiter');

$import_notification = $this -> get_option('import_notification');

if ($this -> import_process -> queued_items()) {
	$messageid = (empty($import_notification)) ? 21 : 19;
	$this -> render_message(19, array('<a href="' . admin_url('admin.php?page=' . $this -> sections -> importexport . '&method=clear') . '" onclick="if (!confirm(\'' . __('Are you sure you want to cancel and stop the import?', 'wp-mailinglist') . '\')) { return false; }" class="button"><i class="fa fa-times fa-fw"></i> ' . __('Stop Import', 'wp-mailinglist') . '</a>', '<a href="' . admin_url('admin.php?page=' . $this -> sections -> settings_tasks . '&method=runschedule&hook=wp_import_process_cron') . '" class="button button-secondary"><i class="fa fa-check fa-fw"></i> ' . __('Run Now', 'wp-mailinglist') . '</a>'), true);
}

?>

<div class="wrap <?php echo $this -> pre; ?> newsletters">
	<h2><?php _e('Import/Export Subscribers', 'wp-mailinglist'); ?></h2>
	
	<div id="import-export-tabs">
		<ul>
			<li><a href="#import-tab"><i class="fa fa-upload"></i> <?php _e('Import', 'wp-mailinglist'); ?></a></li>
			<li><a href="#export-tab"><i class="fa fa-download"></i> <?php _e('Export', 'wp-mailinglist'); ?></a></li>
			<li><a href="#delete-tab"><i class="fa fa-times"></i> <?php _e('Delete', 'wp-mailinglist'); ?></a></li>
		</ul>
		<div id="import-tab">
			<h3><?php _e('Import', 'wp-mailinglist'); ?></h3>
    
			<form action="?page=<?php echo $this -> sections -> importexport; ?>&amp;method=import&action=import" id="import-form" method="post" enctype="multipart/form-data">
				<?php wp_nonce_field($this -> sections -> importexport . '_import'); ?>
				<table class="form-table">
					<tbody>
						<tr>
							<th><?php _e('File Type', 'wp-mailinglist'); ?></th>
							<td>
								<label><input onclick="jQuery('#csvdiv').show(); jQuery('#macdiv').hide();" <?php echo (empty($_POST['filetype']) || (!empty($_POST['filetype']) && $_POST['filetype'] == "csv")) ? 'checked="checked"' : ''; ?> type="radio" name="filetype" value="csv" /> <?php _e('CSV Spreadsheet', 'wp-mailinglist'); ?></label><br/>
								<label><input onclick="jQuery('#csvdiv').hide(); jQuery('#macdiv').show();" <?php echo (!empty($_POST['filetype']) && $_POST['filetype'] == "mac") ? 'checked="checked"' : ''; ?> type="radio" name="filetype" value="mac" /> <?php _e('Mac OS Address Book (vCard file)', 'wp-mailinglist'); ?></label>
		                        <?php if (!empty($importerrors['filetype'])) : ?><div class="ui-state-error ui-corner-all"><p><i class="fa fa-exclamation-triangle"></i> <?php echo $importerrors['filetype']; ?></p></div><?php endif; ?>
							</td>
						</tr>
						<tr>
							<th><label for="importfile"><?php _e('File', 'wp-mailinglist'); ?></label></th>
							<td>
								
								<label id="importfile_button" class="btn btn-primary btn-file disabled">
									<?php _e('Browse...', 'wp-mailinglist'); ?> <input onchange="jQuery('#importfile_info').html(jQuery(this).val().replace('C:\\fakepath\\', ''));" type="file" name="file" id="importfile" />
								</label>
								<span class="label label-info" id="importfile_info"></span>
								
								<a style="display:none;" class="newsletters_error" href="" id="importfile_clear"><i class="fa fa-times"></i></a>
								<span id="importfile_info"></span>
								<span id="importfile_loading"><i class="fa fa-refresh fa-spin"></i></span>
								<input type="hidden" name="uploadedfile" id="uploadedfile" value="" />
								
								<span class="howto"><?php _e('CSV/vCard file', 'wp-mailinglist'); ?></span>
		                        <?php if (!empty($importerrors['file'])) : ?><div class="ui-state-error ui-corner-all"><p><i class="fa fa-exclamation-triangle"></i> <?php echo $importerrors['file']; ?></p></div><?php endif; ?>
		                        
		                        <div id="importfile_progress">
			                        <!-- Progress bar -->
		                        </div>
		                        
		                        <div id="importfile_result">
			                        <!-- Result goes here... -->
		                        </div>
		                        
		                        <style type="text/css">
			                    .widefat th {
				                    padding: 8px 10px !important;
			                    }
			                    
			                    #importfile_loading {
				                    display:none;
			                    }
			                    </style>
		                        
		                        <script type="text/javascript">
			                    var importfilerequest = false;
			                        
			                    jQuery(document).ready(function() {		
				                    
				                    jQuery('#importfile_button').removeClass('disabled');
				                    		                    
				                    jQuery('#importfile_clear').on('click', function() {
					                    jQuery('#importfile').val('');
					                    jQuery('#importfile_info').html('');
					                    jQuery('#importfile_result').html('');
					                    jQuery('#importfile_loading').hide();
					                    jQuery('#importfile_clear').hide();
					                    
					                    if (importfilerequest) {
						                    importfilerequest.abort();
					                    }
					                    
					                    return false;
				                    });
				                    
				                    jQuery('#importfile').on('change', function() {		
					                    jQuery('#importfile_info').html(jQuery(this).val().replace('C:\\fakepath\\', ''));
					                    jQuery('#importfile_result').html('');
					                    jQuery('#importfile_clear').show();
					                    			                    
					                    var importfile_options = {
						                    target: '#importfile_result',
						                    url: newsletters_ajaxurl + "action=newsletters_importfile&security=<?php echo wp_create_nonce('importfile'); ?>",
						                    type: "POST",
						                    dataType: "json",
						                    cache: false,
						                    beforeSend: function(jqXHR, PlainObject) {
							                    jQuery('#importfile_loading').show();
												jQuery('#importfile_progress').progressbar({value:0});
												importfilerequest = jqXHR;
											},
											uploadProgress: function(event, position, total, percentComplete) {
												jQuery('#importfile_progress').progressbar("value", percentComplete);
											},
											success: function(response) {																								
												if (response.success == true) {
													jQuery('#importfile_progress').progressbar("value", 100);
													jQuery('#importfile_result').html(response.preview);
													jQuery('#delimiter').val(response.delimiter);
													jQuery('#uploadedfile').val(response.movefile.file);
												} else {
													jQuery('#importfile_result').html('<p class="newsletters_error">' + response.errormessage + '</p>');
												}											
											},
											error: function(xhr, textStatus, errorThrown) {
												jQuery('#importfile_result').html('An Ajax error occurred: ' + errorThrown);
											},
											complete: function(xhr) {
												jQuery('#importfile_loading').hide();
												jQuery('#importfile_progress').progressbar("destroy");
												jQuery('#importfile').val('');
											}
					                    };
					                    
					                    if (importfilerequest) {
						                    importfilerequest.abort();
					                    }
					                    
					                    jQuery('#import-form').ajaxSubmit(importfile_options);
					                    
					                    return false;
				                    });
			                    });
			                    </script>
							</td>
						</tr>
					</tbody>
				</table>
				
				<div id="csvdiv" style="display:<?php echo (empty($_POST['filetype']) || (!empty($_POST['filetype']) && $_POST['filetype'] == "csv")) ? 'block' : 'none'; ?>;">		
					<table class="form-table">
						<tbody>
							<tr>
								<th><label for="delimiter"><?php _e('Delimiter', 'wp-mailinglist'); ?></label></th>
								<td>
									<input class="widefat" style="width:45px;" type="text" name="delimiter" value="<?php echo (empty($_POST['delimiter'])) ? $csvdelimiter : esc_attr(wp_unslash($_POST['delimiter'])); ?>" id="delimiter" />
									<span class="howto"><?php echo sprintf(__('Operator delimiting field values. Open your CSV in a text editor to confirm with which operator field values are delimited. The default is comma (%s).', 'wp-mailinglist'), $csvdelimiter); ?></span>
			                        <?php if (!empty($importerrors['delimiter'])) : ?><div class="ui-state-error ui-corner-all"><p><i class="fa fa-exclamation-triangle"></i> <?php echo $importerrors['delimiter']; ?></p></div><?php endif; ?>
								</td>
							</tr>
							<tr>
								<th><?php _e('Mailing list Column', 'wp-mailinglist'); ?></th>
								<td>
									<table>
									<tbody>
									<tr>
										<th style="padding:15px 0;"><label><input <?php echo $fieldemailcheck = ($_POST['fields']['mailinglists'] == "Y") ? 'checked="checked"' : ''; ?> onclick="jQuery('#mailinglistscolumn').toggle();" type="checkbox" name="fields[mailinglists]" value="Y" /> <?php _e('Mailing List/s', 'wp-mailinglist'); ?></label></th>
										<td>
											<span id="mailinglistscolumn" style="display:<?php echo $fieldemaildisplay = ($_POST['fields']['mailinglists'] == "Y") ? 'block' : 'none'; ?>;">
												<b><?php _e('Column Number:', 'wp-mailinglist'); ?></b> <input type="text" class="widefat" style="width:45px;" name="mailinglistscolumn" value="<?php echo esc_attr($_POST['mailinglistscolumn']); ?>" />
												<br/><label><input <?php echo (!empty($_POST['autocreatemailinglists']) && $_POST['autocreatemailinglists'] == "Y") ? 'checked="checked"' : ''; ?> type="checkbox" name="autocreatemailinglists" value="Y" id="autocreatemailinglists" /> <?php _e('Auto create these lists by title if they do not exist', 'wp-mailinglist'); ?></label>
												<span class="howto"><?php _e('Comma (,) separated mailing list names/titles to add subscribers to in addition to the list(s) ticked/checked above.', 'wp-mailinglist'); ?></span>
											</span>
										</td>
									</tr>
									</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				
				<div id="macdiv" style="display:<?php echo (!empty($_POST['filetype']) && $_POST['filetype'] == "mac") ? 'block' : 'none'; ?>;">
					<!-- Mac DIV -->
				</div>
				
				<table class="form-table">
					<tbody>
						<tr>
							<th><label for="importlistid"><?php _e('Mailing List/s', 'wp-mailinglist'); ?></label></th>
							<td>
								<?php if (!empty($lists)) : ?>
									<label style="font-weight:bold;"><input type="checkbox" name="checkboxall" value="checkboxall" id="checkboxall" /> <?php _e('Select all', 'wp-mailinglist'); ?></label><br/>
									<div id="newsletters-mailinglists-checkboxes" class="scroll-list">
										<?php foreach ($lists as $id => $title) : ?>
											<?php $Db -> model = $SubscribersList -> model; ?>
											<label><input <?php echo (!empty($_POST['importlists']) && in_array($id, $_POST['importlists'])) ? 'checked="checked"' : ''; ?> type="checkbox" name="importlists[]" value="<?php echo $id; ?>" id="checklist<?php echo $id; ?>" /> <?php echo $title; ?> (<?php echo $Db -> count(array('list_id' => $id)); ?> <?php _e('subscribers', 'wp-mailinglist'); ?>)</label><br/>
										<?php endforeach; ?>
									</div>
									
									<p><a href="#" class="button" onclick="jQuery.colorbox({title:'<?php echo esc_attr(wp_unslash(__('Add a Mailing List', 'wp-mailinglist'))); ?>', href:newsletters_ajaxurl + 'action=newsletters_mailinglist_save&security=<?php echo wp_create_nonce('mailinglist_save'); ?>&fielddiv=newsletters-mailinglists-checkboxes&fieldname=importlists'}); return false;"><i class="fa fa-plus-circle"></i> <?php _e('Add Mailing List', 'wp-mailinglist'); ?></a></p>
								<?php else : ?>
									<p class="newsletters_error"><?php _e('No mailing lists are available', 'wp-mailinglist'); ?></p>
								<?php endif; ?>
		                        
		                        <?php if (!empty($importerrors['mailinglists'])) : ?><div class="ui-state-error ui-corner-all"><p><i class="fa fa-exclamation-triangle"></i> <?php echo $importerrors['mailinglists']; ?></p></div><?php endif; ?>
							</td>
						</tr>
						<tr>
							<th><label for="preventautoresponders"><?php _e('Prevent Autoresponders', 'wp-mailinglist'); ?></label></th>
							<td>
								<label><input <?php checked($_POST['preventautoresponders'], 1, true); ?> type="checkbox" name="preventautoresponders" value="1" id="preventautoresponders" /> <?php _e('Yes, prevent the sending of current autoresponders.', 'wp-mailinglist'); ?></label>
								<span class="howto"><?php _e('Tick/check this if you do not want autoresponders to send for the subscribers in this import.', 'wp-mailinglist'); ?></span>
							</td>
						</tr>
						<tr>
							<th><label for="activation_Y"><?php _e('Require Activation?', 'wp-mailinglist'); ?></label></th>
							<td>
								<label><input onclick="jQuery('#activation_div').show();" <?php echo (!empty($_POST['activation']) && $_POST['activation'] == "Y") ? 'checked="checked"' : ''; ?> type="radio" name="activation" value="Y" id="activation_Y" /> <?php _e('Yes, require activation', 'wp-mailinglist'); ?></label>
								<label><input onclick="jQuery('#activation_div').hide();" <?php echo (empty($_POST['activation']) || (!empty($_POST['activation']) && $_POST['activation'] == "N")) ? 'checked="checked"' : ''; ?> type="radio" name="activation" value="N" id="activation_N" /> <?php _e('No, activate immediately', 'wp-mailinglist'); ?></label>
								<span class="howto"><?php _e('Would you like to send an activation/confirmation email to each subscriber to activate their subscription?', 'wp-mailinglist'); ?></span>
							</td>
						</tr>
					</tbody>
				</table>
				
				<div id="activation_div" style="display:<?php echo (!empty($_POST['activation']) && $_POST['activation'] == "Y") ? 'block' : 'none'; ?>;">			
					<table class="form-table">
						<tbody>
							<tr>
								<th><label for="confirmation_email"><?php _e('Confirmation Email', 'wp-mailinglist'); ?></label></th>
								<td>
									<p class="howto">
										<?php _e('An activation/confirmation email will be sent to each new subscriber imported. You may modify the email template below which will be sent out.', 'wp-mailinglist'); ?>
									</p>
									<?php $confirmation_subject = (empty($_POST['confirmation_subject'])) ? $this -> get_option('etsubject_confirm') : esc_html($_POST['confirmation_subject']); ?>
									<div id="titlediv">
		                        		<div id="titlewrap">
											<input type="text" name="confirmation_subject" value="<?php echo esc_attr(wp_unslash(__($confirmation_subject))); ?>" id="title" class="widefat" />
		                        		</div>
									</div>
									<?php $confirmation_email = (empty($_POST['confirmation_email'])) ? __($this -> et_message('confirm', false, false, false)) : __(esc_html($_POST['confirmation_email'])); ?>							
									<!-- The Editor -->
									<?php if (version_compare(get_bloginfo('version'), "3.3") >= 0) : ?>
										<?php wp_editor(wp_unslash($confirmation_email), 'content', array('tabindex' => 2, 'textarea_name' => "confirmation_email", 'textarea_rows' => "10")); ?>
									<?php else : ?>
										<?php the_editor(wp_unslash($confirmation_email), 'confirmation_email', 'title', true, 2); ?>
									<?php endif; ?>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				
				<table class="form-table">
					<tbody>
						<tr>
							<th><label for="import_overwrite"><?php _e('Update Subscribers', 'wp-mailinglist'); ?></label></th>
							<td>
								<label><input checked="checked" type="checkbox" name="import_overwrite" value="1" id="import_overwrite" /> <?php _e('Yes, update/overwrite existing subscribers with import data', 'wp-mailinglist'); ?></label>
								<span class="howto"><?php _e('Turning this on will take longer and could overwrite custom field values of subscribers.', 'wp-mailinglist'); ?></span>
							</td>
						</tr>
						<tr>
							<th><label for="import_preventbu"><?php _e('Bounces/Unsubscribes', 'wp-mailinglist'); ?></label>
							<?php echo $Html -> help(__('You can drastically reduce the load and processing of importing by disabling this.', 'wp-mailinglist')); ?></th>
							<td>
								<label><input onclick="if (jQuery(this).is(':checked')) { if (!confirm('<?php _e('Enabling this will drastically increase processing time and queries to do all the checks.', 'wp-mailinglist'); ?>')) { return false; } }" type="checkbox" name="import_preventbu" value="1" id="import_preventbu" /> <?php _e('Prevent previous bounces/unsubscribes from being imported again', 'wp-mailinglist'); ?></label>
								<span class="howto"><?php _e('By ticking this, the system will check each subscriber and if they bounced/unsubscribed, they will not be imported.', 'wp-mailinglist'); ?></span>
							</td>
						</tr>
						<tr>
							<th><label for="import_progress_N"><?php _e('Import Now', 'wp-mailinglist'); ?></label></th>
							<td>
								<label><input <?php echo (!empty($_POST['import_progress']) && (!empty($_POST['import_progress']) && $_POST['import_progress'] == "Y")) ? 'checked="checked"' : ''; ?> type="radio" name="import_progress" value="Y" id="import_progress_Y" /> <?php _e('Yes and show progress', 'wp-mailinglist'); ?></label><br/>
								<label><input <?php echo (empty($_POST['import_progress']) || $_POST['import_progress'] == "N") ? 'checked="checked"' : ''; ?> type="radio" name="import_progress" value="N" id="import_progress_N" /> <?php _e('No, import in the background (recommended and better for large lists)', 'wp-mailinglist'); ?></label>
								<span class="howto"><?php _e('Show Ajax progress as the import is done?', 'wp-mailinglist'); ?></span>
							</td>
						</tr>
					</tbody>
				</table>
				
				<p class="submit">
					<button type="submit" name="importsubscribers" value="1" class="button button-primary">
						<i class="fa fa-check fa-fw"></i> <?php echo __('Import Subscribers', 'wp-mailinglist'); ?>
					</button>
				</p>
			</form>
		</div>
		<div id="export-tab">
			<h3 id="export"><?php _e('Export', 'wp-mailinglist'); ?></h3>	
	
			<?php $this -> render('error', array('errors' => $exporterrors), true, 'admin'); ?>
							
			<?php if (!empty($exportfile)) : ?>
				<div class="updated fade"><p><i class="fa fa-check"></i> <?php _e('Subscribers have been exported.', 'wp-mailinglist'); ?> <a href="<?php echo home_url(); ?>/?<?php echo $this -> pre; ?>method=exportdownload&file=<?php echo urlencode($exportfile); ?>" title="<?php _e('Download the subscribers CSV document to your computer', 'wp-mailinglist'); ?>"><?php _e('Download CSV', 'wp-mailinglist'); ?> <i class="fa fa-download"></i></a></p></div>
			<?php endif; ?>		
			<form action="?page=<?php echo $this -> sections -> importexport; ?>&amp;method=export#export" method="post" enctype="multipart/form-data" id="export-form">
				<input type="hidden" name="export_filetype" value="csv" />
			
				<table class="form-table">
					<tbody>
						<tr>
							<th><label for="exportlist"><?php _e('Mailing List/s', 'wp-mailinglist'); ?></label></th>
							<td>
								<?php if (!empty($lists)) : ?>
									<div><label class="selectit" style="font-weight:bold;"><input type="checkbox" id="mailinglistsselectall" name="mailinglistsselectall" value="1" onclick="jqCheckAll(this, 'export-form', 'export_lists');" /> <?php _e('Select All Lists', 'wp-mailinglist'); ?></label></div>
									<div class="scroll-list">
										<?php foreach ($lists as $list_id => $list_title) : ?>
											<?php $Db -> model = $SubscribersList -> model; ?>
											<div><label><input <?php echo (!empty($_POST['export_lists']) && in_array($list_id, $_POST['export_lists'])) ? 'checked="checked"' : ''; ?> type="checkbox" name="export_lists[]" value="<?php echo $list_id; ?>" id="export_lists_<?php echo $list_id; ?>" /> <?php echo $list_title; ?> (<?php echo $Db -> count(array('list_id' => $list_id)); ?> <?php _e('subscribers', 'wp-mailinglist'); ?>)</label></div>
										<?php endforeach; ?>
									</div>
								<?php else : ?>
									<p class="newsletters_error"><?php _e('No mailing lists are available.', 'wp-mailinglist'); ?></p>
								<?php endif; ?>
								<span class="howto"><?php _e('Choose the mailing list/s to export', 'wp-mailinglist'); ?></span>
							</td>
						</tr>
		                <tr>
		                    <th><label for="export_status_all"><?php _e('Export Status', 'wp-mailinglist'); ?></label></th>
		                    <td>
		                        <label><input <?php echo (empty($_POST['export_status']) || (!empty($_POST['export_status']) && $_POST['export_status'] == "all")) ? 'checked="checked"' : ''; ?> type="radio" name="export_status" value="all" id="export_status_all" /> <?php _e('All Subscriptions', 'wp-mailinglist'); ?></label><br/>
		                        <label><input <?php echo (!empty($_POST['export_status']) && $_POST['export_status'] == "active") ? 'checked="checked"' : ''; ?> type="radio" name="export_status" value="active" id="export_status_active" /> <?php _e('Active Subscriptions Only', 'wp-mailinglist'); ?></label><br/>
		                        <label><input <?php echo (!empty($_POST['export_status']) && $_POST['export_status'] == "inactive") ? 'checked="checked"' : ''; ?> type="radio" name="export_status" value="inactive" id="export_status_inactive" /> <?php _e('Inactive Subscriptions Only', 'wp-mailinglist'); ?></label>
		                    </td>
		                </tr>
		                <tr>
		                	<th><label for="export_purpose_newsletters"><?php _e('Export Purpose', 'wp-mailinglist'); ?></label></th>
		                	<td>
		                		<label><input <?php echo (empty($_POST['export_purpose']) || (!empty($_POST['export_purpose']) && $_POST['export_purpose'] == "newsletters")) ? 'checked="checked"' : ''; ?> type="radio" name="export_purpose" value="newsletters" id="export_purpose_newsletters" /> <?php _e('Newsletter plugin', 'wp-mailinglist'); ?></label>
		                		<label><input <?php echo (!empty($_POST['export_purpose']) && $_POST['export_purpose'] == "other") ? 'checked="checked"' : ''; ?> type="radio" name="export_purpose" value="other" id="export_purpose_other" /> <?php _e('3rd Party Software', 'wp-mailinglist'); ?></label>
		                		<span class="howto"><?php _e('Choose the purpose of this export.', 'wp-mailinglist'); ?></span>
		                	</td>
		                </tr>
		                <tr>
		                	<th><label for="export_delimiter"><?php _e('Delimiter', 'wp-mailinglist'); ?></label></th>
		                	<td>
		                		<input type="text" class="widefat" style="width:45px;" name="export_delimiter" value="<?php echo (!empty($_POST['export_delimiter'])) ? esc_attr(wp_unslash($_POST['export_delimiter'])) : $csvdelimiter; ?>" id="export_delimiter" />
		                		<span class="howto"><?php echo sprintf(__('Choose the delimiter to delimit columns with. The default is semi-colon (%s)', 'wp-mailinglist'), $csvdelimiter); ?></span>
		                	</td>
		                </tr>
		                <tr>
		                	<th><label for="export_progress_N"><?php _e('Show Progress', 'wp-mailinglist'); ?></label></th>
		                	<td>
		                		<label><input <?php echo (empty($_POST['export_progress']) || (!empty($_POST['export_progress']) && $_POST['export_progress'] == "Y")) ? 'checked="checked"' : ''; ?> type="radio" name="export_progress" value="Y" id="export_progress_Y" /> <?php _e('Yes', 'wp-mailinglist'); ?></label>
		                		<label><input <?php echo (!empty($_POST['export_progress']) && $_POST['export_progress'] == "N") ? 'checked="checked"' : ''; ?> type="radio" name="export_progress" value="N" id="export_progress_N" /> <?php _e('No', 'wp-mailinglist'); ?></label>
		                		<span class="howto"><?php _e('Show Ajax progress as the export is done?', 'wp-mailinglist'); ?></span>
		                	</td>
		                </tr>
					</tbody>
				</table>
		
				<p class="submit">
					<button type="submit" name="exportsubscribers" value="1" class="button button-primary">
						<i class="fa fa-check fa-fw"></i> <?php echo __('Export Subscribers', 'wp-mailinglist'); ?>
					</button>
				</p>
			</form>
		</div>
		
		<div id="delete-tab">
			<h3><?php _e('Delete', 'wp-mailinglist'); ?></h3>

			<form action="?page=<?php echo $this -> sections -> importexport; ?>&amp;method=delete&action=delete" id="delete-form" method="post" enctype="multipart/form-data">
				<?php wp_nonce_field($this -> sections -> importexport . '_delete'); ?>
				<table class="form-table">
					<tbody>
						<tr>
							<th><label for="deletefile"><?php _e('File', 'wp-mailinglist'); ?></label></th>
							<td>
								
								<label id="deletefile_button" class="btn btn-primary btn-file disabled">
									<?php _e('Browse...', 'wp-mailinglist'); ?> <input type="file" name="file" id="deletefile" />
								</label>
								<span class="label label-info" id="deletefile_info"></span>
								
								<a style="display:none;" class="newsletters_error" href="" id="deletefile_clear"><i class="fa fa-times"></i></a>
								<span id="deletefile_info"></span>
								<span class="howto"><?php _e('CSV file with a list of email addresses in the first column to delete', 'wp-mailinglist'); ?></span>
		                        <?php if (!empty($deleteerrors['file'])) : ?><div class="ui-state-error ui-corner-all"><p><i class="fa fa-exclamation-triangle"></i> <?php echo $deleteerrors['file']; ?></p></div><?php endif; ?>
		                        
		                        <script type="text/javascript">
			                    var deletefilerequest = false;
			                        
			                    jQuery(document).ready(function() {		
				                    
				                    jQuery('#deletefile_button').removeClass('disabled');
				                    		                    
				                    jQuery('#deletefile_clear').on('click', function() {
					                    jQuery('#deletefile').val('');
					                    jQuery('#deletefile_info').html('');
					                    jQuery('#deletefile_clear').hide();					                    
					                    return false;
				                    });
				                    
				                    jQuery('#deletefile').on('change', function() {		
					                    jQuery('#deletefile_info').html(jQuery(this).val().replace('C:\\fakepath\\', ''));
					                    jQuery('#deletefile_clear').show();					                    
					                    return false;
				                    });
			                    });
			                    </script>
							</td>
						</tr>
					</tbody>
				</table>
				<div id="macdiv" style="display:<?php echo (!empty($_POST['filetype']) && $_POST['filetype'] == "mac") ? 'block' : 'none'; ?>;">
					<!-- Mac DIV -->
				</div>
				<div id="activation_div" style="display:<?php echo (!empty($_POST['activation']) && $_POST['activation'] == "Y") ? 'block' : 'none'; ?>;">			
					<table class="form-table">
						<tbody>
							<tr>
								<th><label for="confirmation_email"><?php _e('Confirmation Email', 'wp-mailinglist'); ?></label></th>
								<td>
									<p class="howto">
										<?php _e('An activation/confirmation email will be sent to each new subscriber imported. You may modify the email template below which will be sent out.', 'wp-mailinglist'); ?>
									</p>
									<?php $confirmation_subject = (empty($_POST['confirmation_subject'])) ? $this -> get_option('etsubject_confirm') : esc_html($_POST['confirmation_subject']); ?>
									<div id="titlediv">
		                        		<div id="titlewrap">
											<input type="text" name="confirmation_subject" value="<?php echo esc_attr(wp_unslash(__($confirmation_subject))); ?>" id="title" class="widefat" />
		                        		</div>
									</div>
									<?php $confirmation_email = (empty($_POST['confirmation_email'])) ? __($this -> et_message('confirm', false, false, false)) : __(esc_html($_POST['confirmation_email'])); ?>							
									<!-- The Editor -->
									<?php if (version_compare(get_bloginfo('version'), "3.3") >= 0) : ?>
										<?php wp_editor(wp_unslash($confirmation_email), 'content', array('tabindex' => 2, 'textarea_name' => "confirmation_email", 'textarea_rows' => "10")); ?>
									<?php else : ?>
										<?php the_editor(wp_unslash($confirmation_email), 'confirmation_email', 'title', true, 2); ?>
									<?php endif; ?>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<p class="submit">
					<button type="submit" name="deletesubscribers" value="1" class="button button-primary">
						<i class="fa fa-check fa-fw"></i> <?php echo __('Delete Subscribers', 'wp-mailinglist'); ?>
					</button>
				</p>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
jQuery(document).ready(function() {
	<?php 
	
	$method = esc_html($_GET['method']);	
	$active = (!empty($method) && $method == "export") ? 1 : 0; 
	
	?>
	
	if (jQuery.isFunction(jQuery.fn.tabs)) {
		jQuery('#import-export-tabs').tabs({active:<?php echo $active; ?>});
	}
});
</script>