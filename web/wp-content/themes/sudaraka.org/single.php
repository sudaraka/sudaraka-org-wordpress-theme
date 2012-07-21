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

wp_enqueue_style('sudaraka_org_single', get_template_directory_uri() . '/css/single.css', null, null);

$sw_post_category_list = get_the_category();
if(is_array($sw_post_category_list)) {
	foreach($sw_post_category_list as $cat) {
		if('home-banner' == $cat->slug) {
			ob_clean();
			header('Location: /');
			exit;
		}
		
		if('testimonials' == $cat->slug) {
			ob_clean();
			header('Location: /category/testimonials/#post-' . get_the_ID());
			exit;
		}
		
		if('projects' == $cat->slug) {
			wp_enqueue_script('jquery');
			wp_enqueue_style('sudaraka_org_colorbox');
			wp_enqueue_script('sudaraka_org_colorbox');
			
			wp_enqueue_script('sudaraka_org_js_single_project', get_template_directory_uri() . '/js/single-project.js', null, null);
			
			wp_enqueue_style('sudaraka_org_single_project', get_template_directory_uri() . '/css/single-project.css', null, null);
		}
		
		if(in_array($cat->slug, array('snippets', 'how-to'))) {
			include_once get_template_directory() . '/includes/geshi.php';
			define('CODE_SNIPPETS', true);
			
			wp_enqueue_style('sudaraka_org_single_code_snippets', get_template_directory_uri() . '/css/single-code-snippets.css', null, null);
		}
	}
}

get_header();
?>
				<div id="body-content" class="post">
					
				<?php
				while(have_posts()) {
					
					the_post();
					
					get_template_part('content', 'single');
					
					get_template_part('navigation');
					
					comments_template('', true);
				}
				?>
				
				</div><!-- #body-content -->

<?php

get_footer();
