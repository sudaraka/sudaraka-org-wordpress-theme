<?php
/**
 *  Created: 01/05/2012
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
?>

					<article id="content-<?php the_ID(); ?>" <?php post_class(); ?>>
					
						<header class="content-header">
							<h1 class="content-title"><?php the_title(); ?></h1>
							
							<a href="http://flattr.com/thing/683962/Sudaraka-Org" target="_blank">
								<img src="http://api.flattr.com/button/flattr-badge-large.png" alt="Flattr this" title="Flattr this" border="0" class="flattr_button" />
							</a>
							
							<!-- AddThis Button BEGIN -->
							<div class="addthis_toolbox addthis_default_style ">
							<a class="addthis_counter addthis_pill_style"></a>
							</div>
							<!-- AddThis Button END -->
							
							<!-- Place this tag where you want the +1 button to render. -->
							<div class="g-plusone"></div>
							
							<br />
							
						</header><!-- .content-header -->
					
						<div class="content">
						<?php
						the_content();
						wp_link_pages(array('before' => '<div class="page-link"><span>' . __('Pages:', 'sudaraka.org') . '</span>', 'after' => '</div>'));
						?>
						</div><!-- .content -->
						
					</article><!-- #content-<?php the_ID(); ?> -->
