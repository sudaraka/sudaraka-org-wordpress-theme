<?php
/**
 *  Created: 03/22/2012
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

wp_enqueue_script('sudaraka_org_lazy_load');
wp_enqueue_script('sudaraka_org_js_gallery', get_template_directory_uri() . '/js/category-gallery.js', null, null);
wp_enqueue_script('sudaraka_org_js_addthis', 'http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4fb29591223234b9', null, null);

wp_enqueue_style('sudaraka_org_category', get_template_directory_uri() . '/css/category.css', null, null);
wp_enqueue_style('sudaraka_org_gallery', get_template_directory_uri() . '/css/category-gallery.css', null, null);

get_header();

$gallery_category = get_category_by_slug('gallery');
$gallery_sub_categories = get_categories(array('child_of' => $gallery_category->term_id));
//print_r($gallery_sub_categories);

?>
<div id="body-content" class="gallery">
	
	<header class="page-header">
		<h1 class="page-title">
			<?php single_cat_title(); ?>
		</h1>
		<menu class="gallery-sub">
		<?php foreach($gallery_sub_categories as $cat):?>
			<li><a href="#<?php echo $cat->slug; ?>"><?php echo $cat->name; ?></a></li>
		<?php endforeach; ?>
			<li><a href="/project-gallery/">Projects</a></li>
		</menu>
		<?php
		if(is_category()) $category_description = category_description();
		if(!empty($category_description))
			echo apply_filters('category_archive_meta', '<div class="category-archive-meta">' . $category_description . '</div>');
		?>
	</header>
	
	<?php foreach($gallery_sub_categories as $cat): ?>
	<div id="<?php echo $cat->slug; ?>" class="gallery-section">
		<h2><?php echo $cat->name; ?></h2>
		
		<?php
		$post_list = get_posts(array('category__in' => array($cat->term_id), 'nopaging' => true));
		if(is_array) {
		?>
		<ul>
		<?php
		foreach($post_list as $idx => $post) {
			$cc = get_metadata('post', $post->ID, 'CC', true);
			
			$content = preg_replace('/(<a[^>]*)(>)/i', '$1 rel="' . $cat->slug . '"$2', $post->post_content);
			$content = preg_replace('/^(.+)src="(.+)"(.*)$/i', '$1src="' . get_bloginfo('template_directory') . '/images/spacer.gif" _lazy_src="$2"$3', $content);
		?>
			<li<?php if(0 == ($idx % 4)) { ?> class="col-1"<? } ?>>
				<?php echo $content; ?>
				<?php if(!empty($cc)): ?>
				<div class="cc-icon">
					<?php echo $cc; ?>
				</div>
				<?php endif; ?>
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
	<?php endforeach; ?>

</div><!-- #body-content -->
<?php

get_footer();
