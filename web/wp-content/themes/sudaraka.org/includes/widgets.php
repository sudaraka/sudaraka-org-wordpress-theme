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

class Sudaraka_Org_Category_Head_Widget extends WP_Widget
{
	private $__content_options = array(
		'EXCERPT' => 'Excerpt Only',
		'FULL' => 'Full Post',
		'NONE' => 'None',
	);
	
	private $__content_status = array(
		'STICKY' => 'Sticky Posts Only',
		'STICKY_FIRST' => 'Sticky Posts First',
		'ALL' => 'All',
	);
	
	function __construct() {
		parent::__construct(
			'widget_sudaraka_org_category_head',
			__('Category Head', 'sudaraka.org'),
			array(
				'classname' => 'widget_sudaraka_org_category_head',
				'description' => __('Display latest (n) posts from a given category', 'sudaraka.org')
			)
		);
		
		$this->alt_option_name = 'widget_sudaraka_org_category_head';
		
		add_action('save_post', array(&$this, 'flush_widget_cache'));
		add_action('deleted_post', array(&$this, 'flush_widget_cache'));
		add_action('switch_theme', array(&$this, 'flush_widget_cache'));
	}
	
	function flush_widget_cache() {
		wp_cache_delete('widget_sudaraka_org_category_head', 'widget');
	}
	
	function form($instance) {
		$show_title = !empty($instance['show_title']);
		$link_title = !empty($instance['link_title']);
		$show_desc = !empty($instance['show_desc']);
		$show_random = !empty($instance['show_random']);
		$show_count = (isset($instance['show_count']))?$instance['show_count']:5;
		$skip_count = (isset($instance['skip_count']))?$instance['skip_count']:0;
		$crop_length = (isset($instance['crop_length']))?$instance['crop_length']:20;
		$excerpt_length = (isset($instance['excerpt_length']))?$instance['excerpt_length']:40;
		
		$show_content = $instance['show_content'];
		if(!in_array($show_content, array_keys($this->__content_options))) $show_content = 'NONE';
		
		$show_stickyness = $instance['show_stickyness'];
		if(!in_array($show_stickyness, array_keys($this->__content_status))) $show_stickyness = 'ALL';
		
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('category')); ?>"><?php _e('Category:', 'sudaraka.org'); ?></label><br />
			<?php
			wp_dropdown_categories(
				array(
					'show_option_none' => ' ',
					'class'=> 'widefat',
					'id' => $this->get_field_id('category'),
					'name' => $this->get_field_name('category'),
					'selected' => $instance['category'],
					'orderby' => 'name',
					'hide_empty' => false,
					'hierarchical' => true,
				)
			);
			?>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('show_title')); ?>">
				<input type="checkbox" id="<?php echo $this->get_field_id('show_title'); ?>" name="<?php echo $this->get_field_name('show_title'); ?>" value="X"<?php echo ($show_title)?' checked="checked"':''?> />
				<?php _e('Display category name as title', 'sudaraka.org'); ?>
			</label>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('link_title')); ?>">
				<input type="checkbox" id="<?php echo $this->get_field_id('link_title'); ?>" name="<?php echo $this->get_field_name('link_title'); ?>" value="X"<?php echo ($link_title)?' checked="checked"':''?> />
				<?php _e('Make category name a link', 'sudaraka.org'); ?>
			</label>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('crop_length')); ?>"><?php _e('Title crop length:', 'sudaraka.org'); ?></label><br />
			<input id="<?php echo esc_attr( $this->get_field_id('crop_length')); ?>" name="<?php echo esc_attr($this->get_field_name('crop_length')); ?>" type="text" value="<?php echo esc_attr($crop_length); ?>" size="3" maxlength="2" style="text-align: right;" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('show_desc')); ?>">
				<input type="checkbox" id="<?php echo $this->get_field_id('show_desc'); ?>" name="<?php echo $this->get_field_name('show_desc'); ?>" value="X"<?php echo ($show_desc)?' checked="checked"':''?> />
				<?php _e('Display category description', 'sudaraka.org'); ?>
			</label>
		</p>
		
		<hr />
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('show_count')); ?>"><?php _e('Number of post to display:', 'sudaraka.org'); ?></label><br />
			<input id="<?php echo esc_attr( $this->get_field_id('show_count')); ?>" name="<?php echo esc_attr($this->get_field_name('show_count')); ?>" type="text" value="<?php echo esc_attr($show_count); ?>" size="3" maxlength="2" style="text-align: right;" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('skip_count')); ?>"><?php _e('Number of post to skip:', 'sudaraka.org'); ?></label><br />
			<input id="<?php echo esc_attr( $this->get_field_id('skip_count')); ?>" name="<?php echo esc_attr($this->get_field_name('skip_count')); ?>" type="text" value="<?php echo esc_attr($skip_count); ?>" size="3" maxlength="2" style="text-align: right;" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('show_random')); ?>">
				<input type="checkbox" id="<?php echo $this->get_field_id('show_random'); ?>" name="<?php echo $this->get_field_name('show_random'); ?>" value="X"<?php echo ($show_random)?' checked="checked"':''?> />
				<?php _e('Randomize display order', 'sudaraka.org'); ?>
			</label>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('show_stickyness')); ?>"><?php _e('Post display priority:', 'sudaraka.org'); ?></label><br />
			<select  id="<?php echo $this->get_field_id('show_stickyness'); ?>" name="<?php echo $this->get_field_name('show_stickyness'); ?>" class="widefat">
				<?php foreach($this->__content_status as $opt => $text): ?>
				<option value="<?php echo $opt?>"<?php echo ($show_stickyness == $opt)?' selected="selected"':'';?>><?php echo $text; ?></option>
				<?php endforeach; ?>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('show_content')); ?>"><?php _e('Post content display:', 'sudaraka.org'); ?></label><br />
			<select  id="<?php echo $this->get_field_id('show_content'); ?>" name="<?php echo $this->get_field_name('show_content'); ?>" class="widefat">
				<?php foreach($this->__content_options as $opt => $text): ?>
				<option value="<?php echo $opt?>"<?php echo ($show_content == $opt)?' selected="selected"':'';?>><?php echo $text; ?></option>
				<?php endforeach; ?>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('excerpt_length')); ?>"><?php _e('Excerpt length:', 'sudaraka.org'); ?></label><br />
			<input id="<?php echo esc_attr( $this->get_field_id('excerpt_length')); ?>" name="<?php echo esc_attr($this->get_field_name('excerpt_length')); ?>" type="text" value="<?php echo esc_attr($excerpt_length); ?>" size="3" maxlength="2" style="text-align: right;" />
		</p>
		<?php
	}
	
	function update($new_instance, $old_instance) {
		$new_instance['show_title'] = !empty($new_instance['show_title']);
		$new_instance['link_title'] = !empty($new_instance['link_title']);
		$new_instance['show_desc'] = !empty($new_instance['show_desc']);
		$new_instance['show_random'] = !empty($new_instance['show_random']);
		$new_instance['category'] = (!empty($new_instance['category']) && is_numeric($new_instance['category']))?(int)$new_instance['category']:null;
		$new_instance['show_count'] = (!empty($new_instance['show_count']) && is_numeric($new_instance['show_count']))?(int)$new_instance['show_count']:5;
		$new_instance['skip_count'] = (!empty($new_instance['skip_count']) && is_numeric($new_instance['skip_count']))?(int)$new_instance['skip_count']:0;
		$new_instance['crop_length'] = (!empty($new_instance['crop_length']) && is_numeric($new_instance['crop_length']))?(int)$new_instance['crop_length']:20;
		$new_instance['excerpt_length'] = (is_numeric($new_instance['excerpt_length']))?(int)$new_instance['excerpt_length']:40;
		
		if(!in_array($new_instance['show_content'], array_keys($this->__content_options))) $new_instance['show_content'] = 'NONE';
		
		if(!in_array($new_instance['show_stickyness'], array_keys($this->__content_status))) $new_instance['show_stickyness'] = 'ALL';
		
		$this->flush_widget_cache();
		
		$alloptions = wp_cache_get('alloptions', 'options');
		if(isset($alloptions['widget_sudaraka_org_category_head']))
			delete_option('widget_sudaraka_org_category_head');
		
		return $new_instance;
	}
	
	function widget($args, $instance) {
		$cache = wp_cache_get('widget_sudaraka_org_category_head', 'widget');
		if(!is_array($cache)) $cache = array();
		
		if(empty($args['widget_id'])) $args['widget_id'] = null;
		if(!empty($cache[$args['widget_id']])) {
			echo $cache[$args['widget_id']];
			return;
		}
		
		//If category is not selected, do not display the widget
		if(!is_numeric($instance['category'])) return;
		
		//Backup default post
		global $post;
		$saved_posts = $post;
		
		$sticky_id_list = ('ALL' != $instance['show_stickyness'])?get_option('sticky_posts'):null;
		
		$post_list = get_posts(
			array (
				'post__in' => $sticky_id_list,
				'posts_per_page' => $instance['show_count'],
				'offset' => $instance['skip_count'],
				'category__in' => $instance['category'],
				'orderby' => $instance['show_random']?'rand':'date',
				'order' => 'DESC',
			)
		);
		
		if(sizeof($post_list) < $instance['show_count'] && 'STICKY_FIRST' == $instance['show_stickyness']) {
			//Ignore any non-sticky posted selected above
			foreach($post_list as $post) {
				$sticky_id_list[] = $post->ID;
			}
			
			$tmp_list = get_posts(
				array (
					'post__not_in' => $sticky_id_list,
					'posts_per_page' => $instance['show_count'] - sizeof($post_list),
					'category__in' => $instance['category'],
					'orderby' => $instance['show_random']?'rand':'date',
					'order' => 'DESC',
				)
			);
			
			$post_list = array_merge($post_list, $tmp_list);
		}
		
		//Start collecting output for cache
		ob_start();
		
		extract($args, EXTR_SKIP);
		
		echo $before_widget;
		
		$category = get_category($instance['category']);
		
		if($instance['show_title']) {
			if($instance['link_title']) echo '<a href="' . get_category_link($category->cat_ID) . '">';
			
			echo $before_title;
			echo sudaraka_org_crop($category->name, $instance['crop_length']);
			echo $after_title;
			
			if($instance['link_title']) echo '</a>';
		}
		
		if($instance['show_desc']) {
		?>
		<p><?php echo $category->description; ?></p>
		<?php
		}
		
		if(empty($post_list)):
		?>
		<p class="no-post"><? _e('no articles in this topic', 'sudaraka.org'); ?></p>
		<?php
		else:
		?>
		<ul>
		<?php
			foreach($post_list as $post):
				setup_postdata($post);
				
				$title_crop_length = $instance['excerpt_length'];
				if(sudaraka_org_is_unicode(get_the_title())) $title_crop_length *= 2;
				?>
				<li class="category-head-item">
					<a class="post-title" href="<?php the_permalink(); ?>" rel="bookmark" title="Permalink link to <?php the_title_attribute(); ?>"><?php echo (('NONE' == $instance['show_content'] && 0 < $instance['excerpt_length']))?sudaraka_org_crop(get_the_title(), $title_crop_length):get_the_title(); ?></a>
					<?php
					switch($instance['show_content']) {
						case 'EXCERPT': {
							if(0 < $instance['excerpt_length'])  add_filter('excerpt_length', create_function('$length', 'return ' . $instance['excerpt_length'] . ';'));
							?>
							<small><?php the_excerpt(); ?></small>
							<?php
							break;
						}
						case 'FULL': {
							global $more;
							$more = 0;
							
							the_content(__('see full article &rarr;', 'sudaraka.org'));
							break;
						}
					}
					?>
				</li>
				<?php
			endforeach;
		?>
		</ul>
		<?php
		endif;
		
		echo $after_widget;
		
		//Populate cache
		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_sudaraka_org_category_head', $cache, 'widget');
		
		$post = $saved_posts;
	}
}
