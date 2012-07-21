<?php
/**
 *  Created: 01/27/2012
 *  Template Name: Resume
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

wp_enqueue_script('jquery');
wp_enqueue_style('sudaraka_org_colorbox');
wp_enqueue_script('sudaraka_org_colorbox');

wp_enqueue_style('sudaraka_org_page');
wp_enqueue_style('sudaraka_org_resume', get_template_directory_uri() . '/css/resume.css', null, null);
wp_enqueue_style('sudaraka_org_resume_print', get_template_directory_uri() . '/css/resume-print.css', null, null, 'print');

wp_enqueue_script('sudaraka_org_js_resume', get_template_directory_uri() . '/js/resume.js', null, null);

get_header();

?>
				<div id="body-content" class="page">
					
				<?php
				while(have_posts()) {
					
					the_post();
					get_template_part('content', 'page-about');
				}
				?>
				
				</div><!-- #body-content -->

<?php

get_footer();
