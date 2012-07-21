<?php
/**
 *  Created: 01/02/2012
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

define('RECENT_LIST_LENGTH', 4);

wp_enqueue_style('sudaraka_org_front-page', get_template_directory_uri() . '/css/front-page.css', null, null);
wp_enqueue_script('jquery');
wp_enqueue_script('sudaraka_org_cycle', get_template_directory_uri() . '/js/jquery.cycle.all.js', null, null);
wp_enqueue_script('sudaraka_org_js_init', get_template_directory_uri() . '/js/front-page.js', null, null);

get_header();
?>
				<div id="body-content" class="front-page">
					
					<section class="homepage-content">
						
						<?php while(have_posts()): the_post(); ?>
						<article class="article-content">
							<?php the_content(); ?>
						</article><!-- .page-content -->
						<?php
						endwhile; // post loop
						
						
						//Backup default post
						global $post;
						$saved_posts = $post;
						
						$sticky_id_list = get_option('sticky_posts');
						$exclude_category_id_list = array();
						
						$exclude_slugs = explode('|', EXCLUDE_HOME_SLUGS);
						if(is_array($exclude_slugs)) {
							foreach($exclude_slugs as $es) {
								$tmp = get_category_by_slug($es);
								$exclude_category_id_list[] = $tmp->term_id;
							}
						}
						
						$post_list = get_posts(
							array(
								'post__in' => $sticky_id_list, 
								'category__not_in' => $exclude_category_id_list,
								'orderby' => 'date',
								'order' => 'DESC',
								'posts_per_page' => RECENT_LIST_LENGTH,
								'ignore_sticky_posts' => 1,
							)
						);
						
						if(RECENT_LIST_LENGTH > sizeof($post_list)) {
							//Ignore any non-sticky posted selected above
							foreach($post_list as $post) {
								$sticky_id_list[] = $post->ID;
							}
							
							$tmp_list = get_posts(
								array(
									'post__not_in' => $sticky_id_list, 
									'category__not_in' => $exclude_category_id_list,
									'orderby' => 'date',
									'order' => 'DESC',
									'posts_per_page' => RECENT_LIST_LENGTH - sizeof($post_list),
									//'ignore_sticky_posts' => 1,
								)
							);
							
							$post_list = array_merge($post_list, $tmp_list);
						}
						
						foreach($post_list as $post) {
							setup_postdata($post);
							
							get_template_part('content', 'front-page-post');
						}
						
						$post = $saved_posts;
						?>
					</section>
					
					<?php dynamic_sidebar('front-page-tag-logo'); ?>
					
					<div class="project-wrap"><?php dynamic_sidebar('front-page-banner'); ?></div>

				</div><!-- #body-content -->
<?php

get_sidebar('front-page');

get_footer();
