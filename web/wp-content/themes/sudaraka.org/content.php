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
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="article-header">
	
	<?php if(is_sticky()): ?>
		<hgroup>
			<h2 class="article-title"><a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'sudaraka.org'), the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<h3 class="article-format"><?php _e('Featured', 'sudaraka.org'); ?></h3>
		</hgroup>
	<?php else: ?>
		<h2 class="article-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'sudaraka.org'), the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
	<?php endif; ?>

	<?php if('post' == get_post_type()): ?>
		<div class="article-meta">
			<?php sudaraka_org_post_meta(); ?>
		</div><!-- .article-meta -->
	<?php endif; ?>

	<?php if(comments_open() && !post_password_required()): ?>
		<div class="comments-link">
			<?php comments_popup_link('<span class="leave-reply">' . __( 'Reply', 'sudaraka.org' ) . '</span>', _x('1', 'comments number', 'sudaraka.org'), _x('%', 'comments number', 'sudaraka.org')); ?>
		</div>
	<?php endif; ?>

	</header><!-- .article-header -->
	
	<div class="article-content">
		<?php the_content( __('read complete article <span class="meta-nav">&rarr;</span>', 'sudaraka.org')); ?>
		<?php wp_link_pages(array('before' => '<div class="page-link"><span>' . __('Pages:', 'sudaraka.org') . '</span>', 'after' => '</div>')); ?>
	</div><!-- .article-content -->
	
	<footer class="article-meta">

	<?php
	$show_sep = false;
	if('post' == get_post_type()) { // Hide category and tag text for pages on Search
		
		$categories_list = get_the_category_list(__(', ', 'sudaraka.org'));
		if($categories_list) {
		?>
		<span class="cat-links">
			<?php printf(__('<span class="%1$s">Posted in</span> %2$s', 'sudaraka.org' ), 'article-utility-prep article-utility-prep-cat-links', $categories_list);
			$show_sep = true; ?>
		</span>
		<?php
		}
		
		$tags_list = get_the_tag_list('', __(', ', 'sudaraka.org'));
		if($tags_list ) {
			if($show_sep) {
		?>
		<span class="sep"> | </span>
			<?php } ?>
		<span class="tag-links">
			<?php printf(__('<span class="%1$s">Tagged</span> %2$s', 'sudaraka.org' ), 'article-utility-prep article-utility-prep-tag-links', $tags_list);
			$show_sep = true; ?>
		</span>
		<?php
		}
	
	}
	?>

	<?php
	if(comments_open()) {
		if( $show_sep) {
	?>
	<span class="sep"> | </span>
	<?php }	?>
	<span class="comments-link"><?php comments_popup_link('<span class="leave-reply">' . __( 'Leave a reply', 'sudaraka.org' ) . '</span>', __('<b>1</b> Reply', 'sudaraka.org'), __( '<b>%</b> Replies', 'sudaraka.org')); ?></span>
	<?php } ?>
	
	</footer><!-- #article-meta -->
	
</article><!-- #post-<?php the_ID(); ?> -->
