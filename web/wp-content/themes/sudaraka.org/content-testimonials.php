<?php
/**
 *  Created: 02/06/2012
 *  
 *  Wordpress theme for Sudaraka.Org
 *  Copyright (C) 2012 Sudaraka Wijesinghe <sudaraka.wijesinghe@gmail.com>
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU Affero General Public License as
 *  published by the Free Software Foundation, either version 3 of the
 *  License, or (at your option) any later version.
 *  
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU Affero General Public License for more details.
 *  
 *  You should have received a copy of the GNU Affero General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

global $article_counter;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('row-' . (($article_counter%2)?'odd':'even')); ?>>

	<div class="article-content">
		<div class="<?php echo ($article_counter%2)?'rdquo':'ldquo'; ?>"><?php echo ($article_counter%2)?'&rdquo;':'&ldquo;'; ?></div>
		
		<?php the_content( __('read complete article <span class="meta-nav">&rarr;</span>', 'sudaraka.org')); ?>
		<?php wp_link_pages(array('before' => '<div class="page-link"><span>' . __('Pages:', 'sudaraka.org') . '</span>', 'after' => '</div>')); ?>
		
		<div class="date">
			<span class="year"><?php echo get_the_date('Y'); ?></span>
			<span class="md"><?php echo get_the_date('M j'); ?></span>
		</div>
		
		<div class="clear"></div>
	</div><!-- .article-content -->
	
</article><!-- #post-<?php the_ID(); ?> -->
