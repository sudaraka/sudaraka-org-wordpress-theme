<?php
/**
 *  Created: 01/15/2012
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

global $more;
$more = 0;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('featured-post'); ?>>

	<header class="article-header">
	
		<h2 class="article-title" title="<?php the_title(); ?>">
			<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'sudaraka.org'), the_title_attribute('echo=0')); ?>" rel="bookmark">
				<?php the_title(); ?>
			</a>
		</h2>

	</header><!-- .article-header -->
	
	<div class="article-content">
		<?php the_content(__('<br />read complete article <span class="meta-nav">&rarr;</span>', 'sudaraka.org')); ?>
		<?php wp_link_pages(array('before' => '<div class="page-link"><span>' . __('Pages:', 'sudaraka.org') . '</span>', 'after' => '</div>')); ?>
	</div><!-- .article-content -->
	
	
</article><!-- #post-<?php the_ID(); ?> -->
