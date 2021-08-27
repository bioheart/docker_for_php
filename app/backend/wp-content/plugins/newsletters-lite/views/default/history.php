<?php if (!empty($emails)) : ?>
	<div class="newsletters">
		<div id="<?php echo $this -> pre; ?>history" class="<?php echo $this -> pre; ?>history">
			<?php if (!empty($linksonly)) : ?>
				<ul class="newsletters-history-index">
					<?php foreach ($emails as $email) : ?>
						<li><a href="<?php echo $Html -> retainquery('newsletters_method=newsletter&id=' . $email -> id . '&history=1', '', home_url()); ?>" title="<?php echo esc_attr(wp_unslash(__($email -> subject))); ?>"><?php echo wp_unslash(__($email -> subject)); ?></a>
					<?php endforeach; ?>
				</ul>
			<?php else : ?>
		    	<?php if (!empty($history_index) && $history_index == true) : ?>
		            <ul class="<?php echo $this -> pre; ?>history_index">
		            	<?php foreach ($emails as $email) : ?>
		                	<li><a href="#<?php echo $this -> pre; ?>history_email<?php echo $email -> id; ?>"><?php echo wp_unslash(__($email -> subject)); ?></a></li>
		                <?php endforeach; ?>
		            </ul>
		        <?php endif; ?>
		    	<div class="<?php echo $this -> pre; ?>history_emails">
					<?php foreach ($emails as $email) : ?>
		                <div id="<?php echo $this -> pre; ?>history_email<?php echo $email -> id; ?>" class="<?php echo $this -> pre; ?>history_email">
		                    <h3 class="<?php echo $this -> pre; ?>history_title"><a href="<?php echo $Html -> retainquery('newsletters_method=newsletter&id=' . $email -> id . '&history=1', '', home_url()); ?>" title="<?php echo esc_attr(wp_unslash(__($email -> subject))); ?>"><?php echo wp_unslash(__($email -> subject)); ?></a></h3>
		                    <div class="<?php echo $this -> pre; ?>history_meta"><small><?php _e('Sent on:', 'wp-mailinglist'); ?> <?php echo $email -> modified; ?></small></div>
		                    <div class="<?php echo $this -> pre; ?>history_content"><?php echo wpautop($this -> strip_set_variables($email -> message)); ?></div>
		                </div>
		            <?php endforeach; ?>
		        </div>
		    <?php endif; ?>
	    </div>
	</div>
<?php endif; ?>