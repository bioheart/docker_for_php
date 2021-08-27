
<div id="image-sizes_faq_content" class="image-sizes_tabcontent active">
	 <div class='wrap'>
	 	<div id='image-sizes-helps'>
	    <?php

	    $helps 	= get_option( 'image-sizes-docs-json', [] );
		$utm 	= [ 'utm_source' => 'dashboard', 'utm_medium' => 'settings', 'utm_campaign' => 'faq' ];
	    if( is_array( $helps ) ) :
	    foreach ( $helps as $help ) {
	        ?>
	        <div id='image-sizes-help-<?php echo $help['id']; ?>' class='image-sizes-help'>
	            <h2 class='image-sizes-help-heading' data-target='#image-sizes-help-text-<?php echo $help['id']; ?>'>
	                <a href='<?php echo $help['link']; ?>' target='_blank'>
	                <span class='dashicons dashicons-admin-links'></span></a>
	                <span class="heading-text"><?php echo $help['title']['rendered']; ?></span>
	            </h2>
	            <div id='image-sizes-help-text-<?php echo $help['id']; ?>' class='image-sizes-help-text' style='display:none'>
	                <?php echo wpautop( wp_trim_words( $help['content']['rendered'], 55, " <a class='sc-more' href='{$help['link']}' target='_blank'>[more..]</a>" ) ); ?>
	            </div>
	        </div>
	        <?php

	    }
	    else:
	        _e( 'Something is wrong! No help found!', 'image-sizes' );
	    endif;
	    ?>
	    </div>
	    <?php printf( __( '<p>If you need further assistance, please <a href="%s" target="_blank">reach out to us!</a></p>', 'image-sizes' ), add_query_arg( $utm, 'https://codexpert.io/hire/' ) ); ?>
	</div>
</div>