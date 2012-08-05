<?php
/**
 *  Created: 01/31/2012
 *  Template Name: Contact
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

wp_enqueue_style('sudaraka_org_page');
wp_enqueue_style('sudaraka_org_contact', get_template_directory_uri() . '/css/contact.css', null, null);

wp_enqueue_script('sudaraka_org_js_gplusone', 'https://apis.google.com/js/plusone.js', null, null);
wp_enqueue_script('sudaraka_org_js_addthis', 'http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4fb29591223234b9', null, null);

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

get_sidebar('contact');

get_footer();
