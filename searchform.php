<?php
/**
 * Displays the searchform of the theme.
 *
 * @package The NewsMag
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
	<label>
		<span class="screen-reader-text"><?php echo esc_html_e('Search for:', 'the-newsmag') ?></span>
		<input type="search" class="search-field" placeholder="<?php esc_attr_e('Search for&hellip;', 'the-newsmag') ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php esc_attr_e('Search for:', 'the-newsmag') ?>" />
	</label>
	<button class="searchsubmit" name="submit" type="submit"><i class="fa fa-search"></i></button>
</form>
