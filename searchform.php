<?php
/**
 * Template for search form.
 *
 *
 * @package Raindrops
 * @since Raindrops 0.1
 */
?>
<form method="get" name="searchform" id="searchform" action="<?php echo home_url( ); ?>/"><div class="searchform"><input type="text" value="<?php the_search_query( ); ?>" name="s" id="s" accesskey="s" tabindex="1" />&nbsp;<input type="submit" id="searchsubmit" value="<?php esc_html_e( 'Search', 'Raindrops' );?>" accesskey="b" tabindex="2" /></div></form>
