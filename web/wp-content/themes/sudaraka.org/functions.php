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


define('FS_METHOD', 'direct');
define('WP_POST_REVISIONS', 0);
define('CONCATENATE_SCRIPTS', true);
define('DISALLOW_FILE_EDIT', true);
define('DISALLOW_FILE_MODS', true);
define('EMPTY_TRASH_DAYS', 1);
define('EXCLUDE_CATEGORY_SLUGS', 'note-to-self|home-banner');
define('EXCLUDE_HOME_SLUGS', 'projects|testimonials|note-to-self|gallery|gallery-web-design|gallery-photographs|home-banner');
define('EXCLUDE_SEARCH_SLUGS', 'gallery|gallery-web-design|gallery-photographs|home-banner');

add_action('init', 'sudaraka_org_initialize');
add_action('widgets_init', 'sudaraka_org_widgets_initialize');
add_action('after_setup_theme', 'sudaraka_org_plugin_initialize');
add_action('wp_enqueue_scripts', 'sudaraka_org_load_scripts');

$taxonomy = sanitize_key($_REQUEST['taxonomy']);
add_action($taxonomy . '_add_form_fields', 'sudaraka_org_taxonomy_add_fields');
add_action('create_' . $taxonomy, 'sudaraka_org_taxonomy_save_fields');
add_action($taxonomy . '_edit_form_fields', 'sudaraka_org_taxonomy_edit_fields');
add_action('edited_' . $taxonomy, 'sudaraka_org_taxonomy_save_fields');

add_filter('request', 'sudaraka_org_request_filter');
add_filter('widget_categories_args', 'sudaraka_org_cateory_widget_filter');
//add_filter('wp_tag_cloud', 'sudaraka_org_tag_widget_filter');

function sudaraka_org_initialize() {
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'wp_generator');

	register_nav_menu('header_page_links', __('Header Links', 'sudaraka.org'));
	register_nav_menu('main_menu', __('Main Menu', 'sudaraka.org'));
	register_nav_menu('footer_links', __('Footer Links', 'sudaraka.org'));

	wp_register_script('sudaraka_org_lazy_load', get_template_directory_uri() . '/js/lazy-load.js', null, null);
	
	//wp_register_script('sudaraka_org_tagcanvas', get_template_directory_uri() . '/js/tagcanvas.js', null, null);
	//wp_register_script('sudaraka_org_tagcanvas_init', get_template_directory_uri() . '/js/tagcanvas-init.js', null, null);
	//wp_register_style('sudaraka_org_tagcanvas', get_template_directory_uri() . '/css/tagcanvas.css', null, null);

	wp_register_script('sudaraka_org_colorbox', get_template_directory_uri() . '/js/jquery.colorbox-min.js', null, null);
	wp_register_style('sudaraka_org_colorbox', get_template_directory_uri() . '/css/colorbox.css', null, null);

	wp_register_style('sudaraka_org_page', get_template_directory_uri() . '/css/page.css', null, null);
}

function sudaraka_org_widgets_initialize() {

	register_sidebar(array(
		'name' => __('Default Sidebar', 'sudaraka.org'),
		'id' => 'sidebar-default',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => __('Front Page: Sidebar', 'sudaraka.org'),
		'id' => 'sidebar-front-page',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => __('Front Page: Tag Logo Widgets', 'sudaraka.org'),
		'id' => 'front-page-tag-logo',
		'before_widget' => '<aside id="%1$s" class="widget tag-logo %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '',
		'after_title' => '',
	));
	register_sidebar(array(
		'name' => __('Front Page: Banner Widgets', 'sudaraka.org'),
		'id' => 'front-page-banner',
		'before_widget' => '<div id="%1$s" class="widget project-slideshow %2$s">',
		'after_widget' => "</div>",
		'before_title' => '',
		'after_title' => '',
	));

	register_sidebar(array(
		'name' => __('Category Page Sidebar', 'sudaraka.org'),
		'id' => 'sidebar-category',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => __('Tag Page Sidebar', 'sudaraka.org'),
		'id' => 'sidebar-tag',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => __('Testimonial Page Sidebar', 'sudaraka.org'),
		'id' => 'sidebar-testimonials',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => __('About Page Sidebar', 'sudaraka.org'),
		'id' => 'sidebar-about',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => __('Footer Widgets', 'sudaraka.org'),
		'id' => 'footer-widgets',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	));

	register_widget('Sudaraka_Org_Category_Head_Widget');
}

function sudaraka_org_plugin_initialize() {

	//load_theme_textdomain( 'sudaraka.org', get_template_directory() . '/L10n' );
	//
	//$locale = get_locale();
	//$locale_file = get_template_directory() . '/L10n/' . $locale . '.php';
	//if(is_readable( $locale_file)) require_once($locale_file);

	require_once(get_template_directory() . '/includes/widgets.php');

}

function sudaraka_org_load_scripts() {
	wp_enqueue_style('sudaraka_org_fonts', get_template_directory_uri() . '/css/fonts.css', null, null);
}

function sudaraka_org_remove_more_jump($content) {
	return preg_replace('/#more-\d+/', '', $content);
}

function sudaraka_org_taxonomy_add_fields() {
?>
<div class="form-field">
	<label for="tag-description">Description (HTML META)</label>
	<textarea  name="taxonomy_meta[description]" id="tag-description" rows="2" cols="40"></textarea>
	<p>Description that will go in the HTML META tag on category listing page.</p>
</div>
<div class="form-field">
	<label for="tag-keywords">Keywords (HTML META)</label>
	<textarea  name="taxonomy_meta[keywords]" id="tag-keywords" rows="2" cols="40"></textarea>
	<p>Keyword that will go in the HTML META tag on category listing page.</p>
</div>
<?
}

function sudaraka_org_taxonomy_edit_fields($term) {
	$meta_data = get_option('cat_' . $term->term_id);
?>
<tr class="form-field">
	<th valign="top" scope="row"><label for="description">Description (HTML META)</label></th>
	<td>
		<textarea style="width: 97%;" cols="50" rows="2" id="description" name="taxonomy_meta[description]"><?php echo $meta_data['description']; ?></textarea><br />
		<span class="description">Description that will go in the HTML META tag on category listing page.</span>
	</td>
</tr>
<tr class="form-field">
	<th valign="top" scope="row"><label for="keywords">Keywords (HTML META)</label></th>
	<td>
		<textarea style="width: 97%;" cols="50" rows="2" id="keywords" name="taxonomy_meta[keywords]"><?php echo $meta_data['keywords']; ?></textarea><br />
		<span class="description">Keyword that will go in the HTML META tag on category listing page.</span>
	</td>
</tr>
<?
}

function sudaraka_org_taxonomy_save_fields($term_id) {

	if(isset($_POST['taxonomy_meta'])) {
		$meta_data = get_option('cat_' . $term_id);

		if(is_array($_POST['taxonomy_meta'])) {
			foreach($_POST['taxonomy_meta'] as $key => $value) {
				$meta_data[$key] = $value;
			}
		}

		update_option('cat_' . $term_id, $meta_data);
	}

}


function sudaraka_org_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	switch($comment->comment_type):
		case 'pingback':
		case 'trackback':
	?>
	<li class="post pingback">
		<p><?php _e('Pingback:', 'sudaraka.org'); ?><?php comment_author_link(); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php
						$avatar_size = 32;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 24;

						$avatar_html = get_avatar($comment, $avatar_size);
						if(!empty($avatar_html)) echo $avatar_html;

						/* translators: 1: comment author, 2: date and time */
						printf(__('%1$s on %2$s <span class="says">said:</span>', 'sudaraka.org'),
							sprintf('<span class="fn">%s</span>', get_comment_author_link()),
							sprintf('<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
								esc_url(get_comment_link( $comment->comment_ID)),
								get_comment_time('c'),
								/* translators: 1: date, 2: time */
								sprintf(__('%1$s at %2$s', 'sudaraka.org' ), get_comment_date(), get_comment_time())
							)
						);
					?>

				</div><!-- .comment-author .vcard -->

				<?php if('0' == $comment->comment_approved): ?>
					<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'sudaraka.org'); ?></em>
					<br />
				<?php endif; ?>

			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link(array_merge( $args, array('reply_text' => __('Reply <span>&darr;</span>', 'sudaraka.org'), 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
			</div><!-- .reply -->
		</article><!-- #comment-<?php comment_ID(); ?> -->

	<?php
			break;
	endswitch;
}

function sudaraka_org_post_meta($show_author = true) {
	$string = '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="article-date" datetime="%3$s" pubdate="pubdate">%4$s</time></a>';
	if($show_author) $string .= '<span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>';

	printf(__($string, 'sudaraka.org'),
		esc_url(get_permalink()),
		esc_attr(get_the_time()),
		esc_attr(get_the_date('c')),
		esc_html(get_the_date()),
		esc_url(get_the_author_meta('user_url')),
		esc_attr(sprintf(__('View all posts by %s', 'sudaraka.org' ), get_the_author())),
		get_the_author()
	);
}

function sudaraka_org_crop($text, $length, $end = '&hellip;', $crop_words = true) {
	if(!is_numeric($length) || 1 > $length) return $text;

	if(strlen($text) < $length) return $text;

	$text = trim(substr($text, 0, $length));
	if(sudaraka_org_is_unicode($text) || !$crop_words) $text = substr($text, 0, strrpos($text, ' '));

	return $text . $end;
}

function sudaraka_org_is_unicode($text) {
	return (strlen($text) != strlen(utf8_decode($text)));
}

function sudaraka_org_request_filter($request_data) {

	//FIX: When empty search query is submitted, index.php is used instead of search.php
	if(isset($_GET['s']) && empty($_GET['s'])) $request_data['s'] = ' ';

	return $request_data;
}

function sudaraka_org_cateory_widget_filter($args) {
	$exclude_category_id_list = array();
	
	$exclude_slugs = explode('|', EXCLUDE_CATEGORY_SLUGS);
	if(is_array($exclude_slugs)) {
		foreach($exclude_slugs as $es) {
			$tmp = get_category_by_slug($es);
			$exclude_category_id_list[] = $tmp->term_id;
		}
	}
	
	$args['exclude'] = join(',', $exclude_category_id_list);
	
	return $args;
}

//function sudaraka_org_tag_widget_filter($html)
//{
//	wp_enqueue_style('sudaraka_org_tagcanvas');
//	wp_enqueue_script('sudaraka_org_tagcanvas');
//	wp_enqueue_script('sudaraka_org_tagcanvas_init');
//	//print_r($args);
//	$html = '<canvas id="tcw-canvas">' . $html . '</canvas>';
//	
//	return $html;
//}
//class Walker_Sudaraka_Org_Menu extends Walker_Nav_Menu
//{
//	private $__target = null;
//	private $__rel = null;
//
//	private function __construct($target = null, $rel = null) {
//		$this->__target = $target;
//		$this->__rel = $rel;
//	}
//
//	function start_el(&$output, $item, $depth, $args) {
//		if(!empty($this->__target) && !empty($item->target)) $item->target = $this->__target;
//		if(!empty($this->__rel) && !empty($item->xfn)) $item->xfn = $this->__rel;
//		elseif(0 < preg_match('/about-sudaraka-wijesinghe/', $item->url)) $item->xfn = 'me';
//
//		parent::start_el($output, $item, $depth, $args);
//	}
//
//	public static function create($target = null, $rel = null) {
//		return new Walker_Sudaraka_Org_Menu($target, $rel);
//	}
//}
