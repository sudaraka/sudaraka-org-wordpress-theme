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
wp_enqueue_style('sudaraka_org_testimonials', get_template_directory_uri() . '/css/category-testimonials.css', null, null);

get_header();

?>
				<div id="body-content" class="testimonials">
				
					<?php if(have_posts()): ?>
					
					<header class="page-header">
						<h1 class="page-title">
							<?php single_cat_title(); ?>
						</h1>
						
						<?php
							if(is_category()) $category_description = category_description();
							if(is_tag()) $category_description = tag_description();
							if(!empty($category_description))
								echo apply_filters('category_archive_meta', '<div class="category-archive-meta">' . $category_description . '</div>');
						?>
					</header>
					
					<?php get_template_part('navigation'); ?>
					<div class="clear"></div>
					
					<?php
						
						$article_counter = 0;
						
						while(have_posts()) {
							the_post();
							
							get_template_part('content-testimonials', get_post_format());
							
							$article_counter++;
						}
						
						get_template_part('navigation');
					
					else: // have_posts ?>

					<article class="post no-results not-found">
						<header class="page-header">
							<h1 class="page-title"><?php _e( 'No Testimonials Found', 'sudaraka.org' ); ?></h1>
						</header><!-- .page-header -->
	
						<div class="page-content">
						<?php get_template_part('content', 'not-found'); ?>
						</div>
						
					</article><!-- .no-results .not-found -->
					
					<?php endif; // have_posts ?>
				
				<p id="send-yours">&nbsp;</p>
				<h3>Send in Your Testimonial</h3>
				<?php echo do_shortcode( '[contact-form-7 id="1272" title="Send in Your Testimonial"]' ); ?>
				
				</div><!-- #body-content -->

<?php

get_sidebar('testimonials');

get_footer();
