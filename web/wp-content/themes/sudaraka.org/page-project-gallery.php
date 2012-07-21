<?php
/**
 *  Created: 03/23/2012
 *  Template Name: Project Gallery
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

wp_enqueue_script('sudaraka_org_lazy_load');
wp_enqueue_script('sudaraka_org_js_project_gallery', get_template_directory_uri() . '/js/page-project-gallery.js', null, null);

wp_enqueue_style('sudaraka_org_page');
wp_enqueue_style('sudaraka_org_project_gallery', get_template_directory_uri() . '/css/page-project-gallery.css', null, null);

get_header();

$project_category = get_category_by_slug('projects');
$gallery_category = get_category_by_slug('gallery');
$gallery_sub_categories = get_categories(array('child_of' => $gallery_category->term_id));

?>
<div id="body-content" class="project-gallery">
	
	<header class="page-header">
		<h1 class="page-title">
			<?php the_title(); ?>
		</h1>
		<menu class="gallery-sub">
		<?php foreach($gallery_sub_categories as $cat):?>
			<li><a href="/category/gallery/#<?php echo $cat->slug; ?>"><?php echo $cat->name; ?></a></li>
		<?php endforeach; ?>
		</menu>
		<div class="category-archive-meta"><p><?php echo $project_category->category_description;?></p></div>
	</header>
	
	<div class="gallery-section">
		<?php
		$post_list = get_posts(array('category__in' => array($project_category->term_id), 'nopaging' => true));
		if(is_array) {
		?>
		<ul>
		<?php
		foreach($post_list as $idx => $post) {
			$content = $post->post_content;
			
			// Get the top section as shown in category listing page
			$content = explode('<!--more', $content);
			$content = $content[0];
			
			// Remove margins and alignment classes (if any)
			$content = preg_replace('/margin.*:\s*[^;]+;/i', '', $content);
			
			// Only display if there is an image in the post.
			if(1 > preg_match('/(<img.+src=")([^"]+)([^>]+>)/i', $content, $matches)) continue;
			// Re-construct content
			$content = $matches[1] . get_bloginfo('template_directory') . '/images/spacer.gif" _lazy_src="' . $matches[2] . $matches[3];
		?>
			<li<?php if(0 == ($idx % 3)) { ?> class="col-1"<? } ?>>
				<a href="<?php echo post_permalink($post->ID, true) ;?>">
					<div class="caption"><?php echo $post->post_title; ?></div>
					<?php echo $content; ?>
				</a>
			</li>
		<?php
		}
		?>
		</ul>
		<?php
		}
		?>
		
		<div class="clear"></div>
	</div>

</div><!-- #body-content -->

<?php

get_footer();
