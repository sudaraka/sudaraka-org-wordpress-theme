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

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="article-header">
	
		<h1 class="article-title"><?php the_title(); ?></h1>
		
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

	<?php if('post' == get_post_type()): ?>
		<div class="article-meta">
			<?php sudaraka_org_post_meta(false); ?>
		</div><!-- .article-meta -->
	<?php endif; ?>

	</header><!-- .article-header -->
	
	<div class="article-content">
		<?php
		if(defined('CODE_SNIPPETS')) {
			$content = get_the_content();
			$style_list = array();
			
			$matches = preg_split('/<(code)[\S\s]+class="syntax:([^"]+)"[^>]*>([\S\s]*)<\/code>/iU', $content, null, PREG_SPLIT_DELIM_CAPTURE);
			
			//preg_match('/^([\S\s]*)<code[\S\s]*class="([^"]+)"[^>]*>([\S\s]+)<\/code>([\S\s]*)$/iU', $content, $matches);
			if(is_array($matches)) {
				
				$content = '';
				
				while(!empty($matches)) {
					$block = array_shift($matches);
					
					if('code' == $block) {
						$lang = '';
						$hength = 0;
						
						$block = array_shift($matches);
						list($lang, $height) = explode(':', $block);
						if(!is_numeric($height)) $height = 0;
						
						$block = trim(array_shift($matches));
						
						$geshi = new GeSHi($block, $lang);
						$geshi->enable_classes();
						$geshi->set_overall_class('geshi');
						if(0 < $height) $geshi->set_overall_style('height: ' . ($height * 20 / 13) . 'em;');
						$geshi->set_header_type(GESHI_HEADER_PRE_VALID);
						$geshi->set_link_target('_blank');
						
						if(in_array($lang, array('cli'))) $geshi->enable_line_numbers(GESHI_NO_LINE_NUMBERS);
						else $geshi->enable_line_numbers(GESHI_NORMAL_LINE_NUMBERS);
						
						$block = $geshi->parse_code();
						
						if(empty($style_list[$lang])) $style_list[$lang] = $geshi->get_stylesheet();
					}
					
					$content .= $block;
				}
			}
			
			if(!empty($style_list)) {
				$content .= '<style type="text/css">' . join("\n", $style_list) . '</style>';
			}
			
			$content = apply_filters('the_content', $content);
			$content = str_replace(']]>', ']]&gt;', $content);
			
			echo $content;
		}
		else the_content();
		?>
		<?php wp_link_pages(array('before' => '<div class="page-link"><span>' . __('Pages:', 'sudaraka.org') . '</span>', 'after' => '</div>')); ?>
	</div><!-- .article-content -->
	
	<footer class="article-meta">

	<?php
	$categories_list = get_the_category_list(__(', ', 'sudaraka.org'));
	$tag_list = get_the_tag_list('', __(' ', 'sudaraka.org'));

	if(!empty($tag_list)) {
		$utility_text = __('This article was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'sudaraka.org' );
	} elseif(!empty($categories_list)) {
		$utility_text = __('This article was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'sudaraka.org');
	} else {
		$utility_text = __('Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'sudaraka.org');
	}
	
	printf(
		$utility_text,
		$categories_list,
		$tag_list,
		esc_url(get_permalink()),
		the_title_attribute('echo=0'),
		get_the_author(),
		esc_url(get_author_posts_url(get_the_author_meta('ID')) )
	);
	?>

		<div id="author-info">
			<div id="author-avatar">
				<a href="<?php echo esc_url(get_the_author_meta('user_url')); ?>" rel="author">
					<?php echo get_avatar(get_the_author_meta('user_email'), apply_filters('sudaraka_org_author_bio_avatar_size', 32)); ?>
				</a>
			</div><!-- #author-avatar -->
			<div id="author-description">
				<h3><?php printf(__('Author: <a href="%s" rel="author">%s</a>', 'sudaraka.org'), esc_url(get_the_author_meta('user_url')), trim(get_the_author('first_name') . ' ' . get_the_author_meta('last_name'))); ?></h3>
				<?php the_author_meta('description'); ?>
			</div><!-- #author-description -->
		</div><!-- #author-info -->
	
	</footer><!-- #article-meta -->
	
</article><!-- #post-<?php the_ID(); ?> -->
