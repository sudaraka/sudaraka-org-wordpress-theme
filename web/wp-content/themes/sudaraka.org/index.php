<?php
/**
 *  Created: 01/01/2012
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

get_header();
?>

				<div id="body-content" class="index">
					
					<?php
					if(have_posts()):
					
						get_template_part('navigation');
						
						while(have_posts()) {
							
							the_post();
							get_template_part('content', get_post_format());
						}
						
						get_template_part('navigation');
					
					else: // have_posts ?>

					<article class="no-results not-found">
						<header class="page-header">
							<h1 class="page-title"><?php _e( 'Article Not Found', 'sudaraka.org' ); ?></h1>
						</header><!-- .page-header -->
	
						<div class="page-content">
						<?php get_template_part('content', 'not-found'); ?>
						</div>
						
					</article><!-- .no-results .not-found -->
					
					<?php endif; // have_posts ?>

				</div><!-- #body-content -->

<?php

get_sidebar();

get_footer();
