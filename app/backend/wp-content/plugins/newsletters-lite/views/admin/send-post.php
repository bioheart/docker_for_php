<!-- Send Post -->

<?php
	
$exportfile = 'failedsubscribers-' . date_i18n("Ymd") . '.csv';
$exportfilepath = $Html -> uploads_path() . DS . $this -> plugin_name . DS . 'export' . DS;
$exportfilefull = $exportfilepath . $exportfile;
@unlink($exportfilefull);
$downloadurl = $Html -> retainquery('wpmlmethod=exportdownload&file=' . urlencode($exportfile), home_url());
	
?>

<div class="wrap newsletters <?php echo $this -> pre; ?>">
	<?php if (empty($_POST['sendtype']) || $_POST['sendtype'] == "send") : ?>
		<h2 id="pageheading"><?php _e('Sending Newsletter', 'wp-mailinglist'); ?></h2>
	<?php else : ?>
		<h2 id="pageheading"><?php _e('Queuing Newsletter', 'wp-mailinglist'); ?></h2>
	<?php endif; ?>
	
	<?php if (!empty($subscribers)) : ?>
		<?php if (!empty($_POST['sendtype']) && $_POST['sendtype'] == "queue") : ?>
			<p>
				<?php _e('This newsletter will be scheduled for:', 'wp-mailinglist'); ?> <strong><?php echo esc_html($_POST['senddate']); ?></strong>
			</p>
		<?php else : ?>
			<p>
				<?php _e('This newsletter will be sent immediately, as fast as possible.', 'wp-mailinglist'); ?><br/>
				<?php _e('Please consult your hosting provider to find out if you have hourly/daily/weekly/monthly email sending limits.', 'wp-mailinglist'); ?><br/>
				<?php _e('In case there are limits, rather tick the "Queue this newsletter instead" checkbox below to queue and throttle accordingly.', 'wp-mailinglist'); ?><br/>
				<?php echo sprintf(__('Check %s > Configuration > Email Scheduling for queue/schedule/throttling settings.', 'wp-mailinglist'), $this -> name); ?>
			</p>
		<?php endif; ?>
	
		<p class="newsletters_sendajaxcount">
			<span id="sendajaxcount"><strong><span id="sendajaxcountinside" class="newsletters_success">0</span></strong></span> <span id="sendajaxfailedcount">(<strong><span id="sendajaxfailedcountinside" class="newsletters_error">0</span></strong> failed)</span> <?php _e('out of', 'wp-mailinglist'); ?> <strong><?php echo count($subscribers); ?></strong>
			<?php if (empty($_POST['sendtype']) || $_POST['sendtype'] == "send") : ?>
				<span id="havebeenqueued"><?php _e('emails have been sent out.', 'wp-mailinglist'); ?></span>
			<?php else : ?>
				<span id="havebeenqueued"><?php _e('emails have been queued.', 'wp-mailinglist'); ?></span>
			<?php endif; ?>
		</p>
		
		<div id="sendprogressbar"></div>
		
		<p class="submit">
			<a href="javascript:history.go(-1);" class="button button-secondary" onclick=""><i class="fa fa-arrow-left"></i> <?php _e('Back', 'wp-mailinglist'); ?></a>
			<a id="cancelbutton" href="" onclick="cancelsending(); return false;" disabled="disabled" style="display:none;" class="button button-secondary"><i class="fa fa-pause"></i> <?php _e('Pause', 'wp-mailinglist'); ?></a>
			<?php if (empty($_POST['sendtype']) || $_POST['sendtype'] == "send") : ?>
				<a id="startsending" href="" onclick="startsending(); return false;" disabled="disabled" class="button button-primary"><i class="fa fa-refresh fa-spin"></i> <?php _e('Reading data, please wait', 'wp-mailinglist'); ?></a>
				<span id="queuecheckboxspan"><label><input onclick="queuecheckbox();" type="checkbox" name="queuecheckbox" value="1" id="queuecheckbox" /> <?php _e('Queue this newsletter instead.', 'wp-mailinglist'); ?></label></span>
			<?php else : ?>
				<a id="startsending" href="" onclick="startsending(); return false;" disabled="disabled" class="button button-primary"><i class="fa fa-refresh fa-spin"></i> <?php _e('Reading data, please wait', 'wp-mailinglist'); ?></a>
			<?php endif; ?>
		</p>
		
		<h3 id="successfullheader" style="display:none;"><?php if (empty($_POST['sendtype']) || $_POST['sendtype'] == "send") { _e('Successfully Sent', 'wp-mailinglist'); } else { _e('Successfully Queued', 'wp-mailinglist'); }; ?></h3>
		<div id="sendajaxsuccessrecords" class="scroll-list" style="display:none;"><!-- successful records --></div>
		
		<h3 id="failedheader" style="display:none;"><?php if (empty($_POST['sendtype']) || $_POST['sendtype'] == "send") { _e('Failed Sending', 'wp-mailinglist'); } else { _e('Failed Queuing', 'wp-mailinglist'); }; ?></h3>
		<div class="submit" style="margin-left:15px; display:none;" id="failedselectall">
			<label style="font-weight:bold;"><input type="checkbox" name="checkboxallfailed" value="1" onclick="jqCheckAll(this, false, 'failed');" /> <?php _e('Select all', 'wp-mailinglist'); ?></label>
		</div>
		<div id="sendajaxfailedrecords" class="scroll-list" style="display:none;"><!-- failed records --></div>
		<div id="failedactions" style="display:none;">
			<p class="submit">
				<a href="" onclick="exportfailed(); return false;" class="button button-primary"><?php _e('Export Failed', 'wp-mailinglist'); ?></a>
				<span id="failedloading" style="display:none;"><i class="fa fa-refresh fa-spin"></i></span>
			</p>
		</div>
		
		<h3><?php _e('Email Preview', 'wp-mailinglist'); ?></h3>
		
		<?php if (!empty($attachments)) : ?>
			<h4><?php _e('Attachments', 'wp-mailinglist'); ?></h4>
            <div id="currentattachments">
               <ul style="margin:0; padding:0;"> 
                    <?php foreach ($attachments as $attachment) : ?>
                    	<li class="<?php echo $this -> pre; ?>attachment">
                        	<?php echo $Html -> attachment_link($attachment, false); ?>
                        </li>    
                    <?php endforeach; ?>
               </ul>
            </div>
        <?php endif; ?>
		
		<iframe width="100%" frameborder="0" scrolling="no" class="autoHeight widefat" style="width:100%; margin:15px 0 0 0;" src="<?php echo admin_url('admin-ajax.php'); ?>?action=<?php echo $this -> pre; ?>historyiframe&id=<?php echo $history_id; ?>&security=<?php echo wp_create_nonce('historyiframe'); ?>&rand=<?php echo rand(1,999); ?>" id="historypreview<?php echo $history_id; ?>"></iframe>
		
		<script type="text/javascript">	
		var allsubscribers = [];
		var subscribers = [];
		var failedSubscribers = [];
		var failedcompleted = 0;
		var headings = [{'email':"Email Address"}, {'id':"ID"}];
				
		jQuery(document).ready(function() {
			<?php if (!empty($subscribers)) : ?>
				<?php foreach ($subscribers as $subscriber) : ?>
					allsubscribers.push(<?php echo json_encode($subscriber); ?>);
				<?php endforeach; ?>
			<?php endif; ?>
			
			warnMessage = "<?php _e('You have unsaved changes on this page! All unsaved changes will be lost and it cannot be undone.', 'wp-mailinglist'); ?>";

			window.onbeforeunload = function () {
			    if (warnMessage != false) { return warnMessage; }
			}
		
			requestArray = new Array();
			sendtype = "<?php echo esc_js($_POST['sendtype']); ?>";
			
			settexts();
			
			jQuery('#startsending').removeAttr('disabled').html(startsendingtext);
			cancensend = "N";
		});
		
		function exportfailed() {
			var failed = [];
			var i = 0;
			jQuery('#failedloading').show().css('display', "block");
			
			jQuery('input[name="failed[]"]:checked').each(function() {
				var email = jQuery(this).val();
				
				var index = jQuery.grep(failedSubscribers, function(e, i) {					
					if (e.email == email) {
						failed.push(e);
					}
				});
			});
			
			if (failed.length > 0) {
				for (var e = 0; e < failed.length; e++) {
					exportsubscriber(failed[e]);
				}	
			}
			
			jQuery('#failedloading').hide();
			
			return false;
		}
		
		function exportsubscriber(subscriber) {
			
			jQuery.post(newsletters_ajaxurl + 'action=<?php echo $this -> pre; ?>exportsubscribers', {subscriber:subscriber, headings:headings, exportfile:'<?php echo $exportfile; ?>'}, function(response) {
				// Ajax call is done
			}).done(function(response) {	
				failedcompleted++;
							
				if (failedcompleted == failedSubscribers.length) {
					window.location = '<?php echo $downloadurl; ?>';	
				}
			}).fail(function() {
				//do nothing, it failed
			});
		}
		
		function settexts() {		
			if (sendtype == "send") { 
				startsendingnumber = 50;
				startsendingtext = "<i class=\"fa fa-play\"></i> <?php echo addslashes(__('Start Sending', 'wp-mailinglist')); ?>"; 
				sendingnowtext = "<i class=\"fa fa-refresh fa-spin\"></i> <?php echo addslashes(__('Sending Now', 'wp-mailinglist')); ?>";
				resumesendingtext = "<i class=\"fa fa-play\"></i> <?php echo addslashes(__('Resume Sending', 'wp-mailinglist')); ?>";
				jQuery('#successfullheader').text('<?php echo addslashes(__('Successfully Sent', 'wp-mailinglist')); ?>');
				jQuery('#failedheader').text('<?php echo addslashes(__('Failed Sending', 'wp-mailinglist')); ?>');
			} else { 
				startsendingnumber = 50;
				startsendingtext = "<i class=\"fa fa-play\"></i> <?php echo addslashes(__('Start Queuing', 'wp-mailinglist')); ?>"; 
				sendingnowtext = "<i class=\"fa fa-refresh fa-spin\"></i> <?php echo addslashes(__('Queuing Now', 'wp-mailinglist')); ?>";
				resumesendingtext = "<i class=\"fa fa-play\"></i> <?php echo addslashes(__('Resume Queuing', 'wp-mailinglist')); ?>";
				jQuery('#successfullheader').text('<?php echo addslashes(__('Successfully Queued', 'wp-mailinglist')); ?>');
				jQuery('#failedheader').text('<?php echo addslashes(__('Failed Queuing', 'wp-mailinglist')); ?>');
			}
		}
		
		function queuecheckbox() {
			if (jQuery('#queuecheckbox').attr('checked')) {
				sendtype = "queue";
				settexts();
				jQuery('#pageheading').text('<?php echo addslashes(__('Queuing Newsletter', 'wp-mailinglist')); ?>');
				jQuery('#startsending').html(startsendingtext);
				jQuery('#havebeenqueued').html('<?php echo addslashes(__('emails have been queued.', 'wp-mailinglist')); ?>');
			} else {
				sendtype = "send";
				settexts();
				jQuery('#pageheading').text('<?php echo addslashes(__('Sending Newsletter', 'wp-mailinglist')); ?>');
				jQuery('#startsending').html(startsendingtext);
				jQuery('#havebeenqueued').html('<?php echo addslashes(__('emails have been sent out.', 'wp-mailinglist')); ?>');
			}
		}
		
		function cancelsending() {
			cancelsend = "Y";
			jQuery('#cancelbutton').attr("value", "<i class=\"fa fa-times\"></i> <?php echo addslashes(__('Cancelled', 'wp-mailinglist')); ?>").attr('disabled', "disabled");
			jQuery('#startsending').removeAttr('disabled').attr('onclick', 'resumesending(); return false;').html(resumesendingtext);
			
			for (var f in requestArray) {
				requestArray[f].abort();
			}			
			
			requestArray = new Array();
		}
		
		function resumesending() {
			cancelsend = "N";
			jQuery('#startsending').attr('disabled', "disabled").html(sendingnowtext);
			jQuery('#cancelbutton').removeAttr('disabled');
			
			var newsendingnumber = (startsendingnumber - completed);
			requests = (completed - 1);
			
			var sendsubscribers = [];
			var i = (completed - 1);
			requests = i;
			
			while (subscribers.length > i) {
				sendsubscribers.push(subscribers[i]);				
				if (sendsubscribers.length == startsendingnumber || (i + 1) >= subscribers.length) {
					if (sendtype == "send") {
						executemultiple(sendsubscribers);
					} else {
						queuemultiple(sendsubscribers);								
					}
					sendsubscribers = [];
				}
				
				i++;
			}
		}
		
		function startsending() {
			jQuery('#queuecheckboxspan').hide();
			jQuery('#startsending').attr('disabled', "disabled");
			jQuery('#cancelbutton').removeAttr('disabled').show();
			jQuery('#startsending').html(sendingnowtext);
			cancelsend = "N";
			subscribercount = allsubscribers.length;
			subscribers = allsubscribers;
			requests = 0;
			completed = 0;
			sent = 0;
			failed = 0;
			
			jQuery('#sendprogressbar').progressbar({value:0});
			
			var i = 0;
			var sendsubscribers = [];
			
			while (i < subscribers.length) {
				sendsubscribers.push(subscribers[i]);
				if (sendsubscribers.length == startsendingnumber || (i + 1) >= subscribers.length) {					
					if (sendtype == "send") {
						executemultiple(sendsubscribers);
					} else {
						queuemultiple(sendsubscribers);
					}
					sendsubscribers = [];
				}
				i++;
			}
		}
		
		function executemultiple(sendsubscribers) {			
			if (cancelsend == "Y" || completed >= subscribercount) {
				return;
			}
			
			requests += sendsubscribers.length;
			
			requestArray.push(jQuery.post(newsletters_ajaxurl + 'action=newsletters_executemultiple&security=<?php echo wp_create_nonce('executemultiple'); ?>', {
				subscribers:sendsubscribers,
				attachments:'<?php echo maybe_serialize($attachments); ?>',
				history_id:'<?php echo $history_id; ?>',
				post_id:'<?php echo $post_id; ?>',
				theme_id:'<?php echo $theme_id; ?>'
			}, function(response) {
				var senddata = response.split("<||>");
				if (senddata.length > 1) {
					for (d = 0; d < senddata.length; d++) {
						var response = senddata[d];
						if (response != "") {
							var data = response.split('<|>');
							var success = data[0];
							var email = data[1];
							var message = data[2];
							
							if (success == "Y") {
								sent++;
								if ((sent + failed) <= subscribercount) { 
									jQuery('#sendajaxcountinside').text(sent); 
									jQuery('#sendajaxsuccessrecords').prepend('<div class="ui-state-highlight ui-corner-all" style="margin-bottom:3px;"><p><i class="fa fa-check"></i> ' + email + '</p></div>').fadeIn().prev().fadeIn();
								}
							} else {
								failed++;
								if ((sent + failed) <= subscribercount) { 
									jQuery('#sendajaxfailedcountinside').text(failed); 
									jQuery('#sendajaxfailedrecords').prepend('<div class="ui-state-error ui-corner-all" style="margin-bottom:3px;"><p><label><input type="checkbox" name="failed[]" value="' + email + '" id="" /> <i class="fa fa-exclamation-triangle"></i>' + email + ' - ' + message + '</label></p></div>').fadeIn().prev().fadeIn().prev().fadeIn();
									jQuery('#failedactions').show();
								}
							}
							
							completed++;
							var value = (completed * 100) / subscribercount;
							jQuery("#sendprogressbar").progressbar("value", value);
						}
					}
				} else {
					failed += sendsubscribers.length;
					jQuery('#sendajaxfailedcountinside').text(failed);
					completed += sendsubscribers.length;
				}
			}).success(function() { 			
				if (completed >= subscribercount) {
					finished();
				}
			}).fail(function() {
				completed += sendsubscribers.length;
				failed += sendsubscribers.length;
				jQuery('#sendajaxfailedcountinside').text(failed);
			}));
		}
		
		function queuemultiple(sendsubscribers) {
			if (cancelsend == "Y" || completed >= subscribercount) {
				return;
			}
			
			requests += sendsubscribers.length;
			
			requestArray.push(jQuery.post(newsletters_ajaxurl + 'action=newsletters_queuemultiple&security=<?php echo wp_create_nonce('queuemultiple'); ?>', {
				subscribers: sendsubscribers,
				attachments:'<?php echo maybe_serialize($attachments); ?>',
				history_id:'<?php echo $history_id; ?>',
				post_id:'<?php echo $post_id; ?>',
				theme_id:'<?php echo $theme_id; ?>',
				senddate:'<?php echo esc_js($_POST['senddate']); ?>'
			}, function(response) {				
				var senddata = response.split("<||>");
				if (senddata.length > 1) {
					for (d = 0; d < senddata.length; d++) {
						var response = senddata[d];
						if (response != "") {
							var data = response.split('<|>');
							var success = data[0];
							var email = data[1];
							var message = data[2];
							
							if (success == "Y") {
								sent++;
								if ((sent + failed) <= subscribercount) { 
									jQuery('#sendajaxcountinside').text(sent); 
									jQuery('#sendajaxsuccessrecords').prepend('<div class="ui-state-highlight ui-corner-all" style="margin-bottom:3px;"><p><i class="fa fa-check"></i> ' + email + '</p></div>').fadeIn().prev().fadeIn();
								}
							} else {
								failed++;
								if ((sent + failed) <= subscribercount) { 
									jQuery('#sendajaxfailedcountinside').text(failed); 
									jQuery('#sendajaxfailedrecords').prepend('<div class="ui-state-error ui-corner-all" style="margin-bottom:3px;"><p><i class="fa fa-exclamation-triangle"></i> ' + email + ' - ' + message + '</p></div>').fadeIn().prev().fadeIn();
								}
							}
							
							completed++;
							var value = (completed * 100) / subscribercount;
							jQuery("#sendprogressbar").progressbar("value", value);
						}
					}
				} else {
					failed += sendsubscribers.length;
					jQuery('#sendajaxfailedcountinside').text(failed);
					completed += sendsubscribers.length;
				}
			}).success(function() { 			
				if (completed >= subscribercount) {
					finished();
				}
			}).fail(function() {
				completed += sendsubscribers.length;
				failed += sendsubscribers.length;
				jQuery('#sendajaxfailedcountinside').text(failed);
			}));
		}
		
		function finished() {
			jQuery('#cancelbutton').hide();
			warnMessage = false;
			
			if (sendtype == "send") {
				jQuery('#startsending').html('<?php echo addslashes(__('Continue to History', 'wp-mailinglist')); ?> <i class="fa fa-arrow-right"></i>').removeAttr('disabled').removeAttr('onclick').attr("href", "?page=<?php echo $this -> sections -> history; ?>&method=view&id=<?php echo $history_id; ?>");
			} else {
				jQuery('#startsending').html('<?php echo addslashes(__('Continue to Queue', 'wp-mailinglist')); ?> <i class="fa fa-arrow-right"></i>').removeAttr('disabled').removeAttr('onclick').attr("href", "?page=<?php echo $this -> sections -> queue; ?>");
			}
				
			jQuery('#sendprogressbar').progressbar("option", "disabled", true);
			cancelsend = "Y";
		}
		</script>
	<?php else : ?>
		<p class="newsletters_error"><?php _e('No subscribers are available, please try again.', 'wp-mailinglist'); ?></p>
		<p>
			<a href="javascript:history.go(-1);" class="button button-primary" onclick=""><?php _e('&laquo; Back', 'wp-mailinglist'); ?></a>
		</p>
	<?php endif; ?>
</div>