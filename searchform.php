<?php
/**
 * Template for search form.
 *
 *
 * @package Raindrops
 * @since Raindrops 0.1
 */
?>
<form method="get" name="searchform" id="searchform" action="<?php echo esc_url( home_url( ) ); ?>/">
  <div class="searchform"><label class="screen-reader-text" for="s">Search for:</label>
    <input type="text" value="<?php the_search_query( ); ?>" name="s" id="s" />
    <input type="submit" id="searchsubmit" value="<?php esc_html_e( 'Search', 'Raindrops' );?>" />
  </div>
</form>
