<?php
/**
 * 404 file when the page is not found.
 *
 * @package cuisine-palace
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$cuisine_palace_pagetype = '';
if ( is_search() ) {
	$cuisine_palace_pagetype = 'search';
} elseif ( is_archive() ) {
	$cuisine_palace_pagetype = 'archive';
} else {
	$cuisine_palace_pagetype = 'page';
}

?>

<div class="error-page">
	<div id="content" class="container">
		<div class="wrapper">
			<?php get_template_part( 'template-parts/404/content-none', $cuisine_palace_pagetype ); ?>
		</div>
	</div>
</div>


<?php
