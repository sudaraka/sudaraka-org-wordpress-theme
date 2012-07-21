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

?>
					<header class="page-header">
						<h1 class="page-title">
							<?php
							if(is_search()): 
								printf(__('<span>Search Results for:</span> %s', 'sudaraka.org'), get_search_query());
							elseif(is_tag()):
								single_tag_title('<span>' . __('Articles tagged as: ', 'sudaraka.org') . '</span>');
							else:
								single_cat_title(__('Articles in ', 'sudaraka.org'));
							endif;
							?>
						</h1>
						
						<a href="feed/<?php echo empty($_SERVER['QUERY_STRING'])?'':'?' . $_SERVER['QUERY_STRING']; ?>"><img src="<?php echo bloginfo('template_directory'); ?>/images/rss2-btn.png" alt="<?php single_cat_title(__('Subscribe to ', 'sudaraka.org')); ?> RSS feed" class="feed-icon" /></a>
	
						<?php
							if(is_category()) $category_description = category_description();
							if(is_tag()) $category_description = tag_description();
							if(!empty($category_description))
								echo apply_filters('category_archive_meta', '<div class="category-archive-meta">' . $category_description . '</div>');
						?>
					</header>
