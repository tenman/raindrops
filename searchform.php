<?php
/**
 * search form for our theme.
 *
 *
 * @package WordPress
 * @subpackage Raindrops
 * @since Raindrops 0.1
 */
?>
<form method="get" name="searchform" id="searchform" action="<?php echo home_url(); ?>/"><?php //<label class="hidden" for="s"> ?><?php //__('Search for:'); ?><?php //</label> ?><div><input type="text" value="<?php the_search_query(); ?>" name="s" id="s" accesskey="s" tabindex="1" />&nbsp;<input type="submit" id="searchsubmit" value="検索" accesskey="b" tabindex="2" /></div></form>
