<?php
/**
 *  Created: 01/07/2012
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

wp_enqueue_style('sudaraka_org_404', get_template_directory_uri() . '/css/404.css', null, null);

get_header();

?>
				<div id="body-content" class="404">
					
					<article class="article-content error404 not-found">
						
						<header class="page-header">
							<h1 class="page-title"><?php _e( 'Page Not Found', 'sudaraka.org' ); ?></h1>
						</header><!-- .page-header -->
						
						<div class="page-content">
						<?php get_template_part('content', 'not-found'); ?>
						
						<?php the_widget('WP_Widget_Recent_Posts', array('number' => 10), array('widget_id' => '404')); ?>
	
						<div class="widget widget_frequant_topics">
							<h2 class="widgettitle"><?php _e('Frequant Topics', 'sudaraka.org'); ?></h2>
							<ul>
							<?php wp_list_categories(array('orderby' => 'count', 'order' => 'DESC', 'show_count' => 1, 'title_li' => '', 'number' => 10)); ?>
							</ul>
						</div>
	
						<?php the_widget('WP_Widget_Tag_Cloud'); ?>
						
						</div>
						
					</article>
					
				</div><!-- #body-content -->

<?php

get_sidebar('404');

get_footer();
