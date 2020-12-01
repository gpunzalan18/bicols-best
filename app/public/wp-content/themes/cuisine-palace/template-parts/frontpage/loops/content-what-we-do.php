<?php
/**
 * Loop file for the services section.
 *
 * @package cuisine-palace
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


?>


<div class="grid-item">
	<div class="grid-item-wrapper">
<!-- 
		<div class="grid-item-icon">
			<i class="fas fa-gift"></i>
		</div> -->

		<div class="grid-item-detail">
			<?php

			the_title( '<h3>', '</h3>' );


			the_content();

			?>
		</div>
	</div>
</div>
