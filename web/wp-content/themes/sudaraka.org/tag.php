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

wp_enqueue_style('sudaraka_org_category', get_template_directory_uri() . '/css/category.css', null, null);
wp_enqueue_style('sudaraka_org_tag', get_template_directory_uri() . '/css/tag.css', null, null);

get_header();

?>
				<div id="body-content" class="tag">
				
					<?php if(have_posts()): ?>
					
					<?php include_once get_template_directory() . '/includes/archive-header.php'; ?>
					
					<?php get_template_part('navigation'); ?>
					<div class="clear"></div>
					
					<?php
						
						while(have_posts()) {
							
							the_post();
							get_template_part('content-tag', get_post_format());
						}
						
						get_template_part('navigation');
					
					else: // have_posts ?>

					<article class="post no-results not-found">
						<header class="page-header">
							<h1 class="page-title"><?php _e( 'No Articles Found', 'sudaraka.org' ); ?></h1>
						</header><!-- .page-header -->
	
						<div class="page-content">
						<?php get_template_part('content', 'not-found'); ?>
						</div>
						
					</article><!-- .no-results .not-found -->
					
					<?php endif; // have_posts ?>
				
				</div><!-- #body-content -->
<?php

get_sidebar('tag');

get_footer();
