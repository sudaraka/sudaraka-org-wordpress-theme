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
	<div id="comments">
	<?php if(post_password_required()): ?>
		<p class="nopassword"><?php _e( 'This article is password protected. Enter the password to view any comments.', 'sudaraka.org'); ?></p>
	</div><!-- #comments -->
	<?php
			/* Stop the rest of comments.php from being processed,
			 * but don't kill the script entirely -- we still have
			 * to fully load the template.
			 */
			return;
		endif;
	?>
	
	<?php if(have_comments()): ?>
		<h2 id="comments-title">
			<?php
				printf(_n('One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'sudaraka.org'),
					number_format_i18n(get_comments_number()), '<span>' . get_the_title() . '</span>');
			?>
		</h2>
	<?php endif; ?>

	<?php if(1 < get_comment_pages_count() && get_option('page_comments')): // are there comments to navigate through ?>
		<nav id="comment-nav-above">
			<h1 class="assistive-text"><?php _e('Comment navigation', 'sudaraka.org'); ?></h1>
			<div class="nav-previous"><?php previous_comments_link(__('&larr; Older Comments', 'sudaraka.org')); ?></div>
			<div class="nav-next"><?php next_comments_link(__('Newer Comments &rarr;', 'sudaraka.org')); ?></div>
		</nav>
	<?php endif; // check for comment navigation ?>

		<ol class="commentlist">
			<?php
				/* Loop through and list the comments. Tell wp_list_comments()
				 * to use sudaraka_org_comment() to format the comments.
				 * If you want to overload this in a child theme then you can
				 * define sudaraka_org_comment() and that will be used instead.
				 */
				wp_list_comments(array('callback' => 'sudaraka_org_comment'));
			?>
		</ol>
		
		<?php if(1 < get_comment_pages_count() && get_option('page_comments')): // are there comments to navigate through ?>
		<nav id="comment-nav-below">
			<h1 class="assistive-text"><?php _e('Comment navigation', 'sudaraka.org'); ?></h1>
			<div class="nav-previous"><?php previous_comments_link(__( '&larr; Older Comments', 'sudaraka.org')); ?></div>
			<div class="nav-next"><?php next_comments_link(__('Newer Comments &rarr;', 'sudaraka.org')); ?></div>
		</nav>

	<?php
		/* If there are no comments and comments are closed, let's leave a little note, shall we?
		 * But we don't want the note on pages or post types that do not support comments.
		 */
		elseif (!comments_open() && ! is_page() && post_type_supports(get_post_type(), 'comments')):
	?>
		<p class="nocomments"><?php _e('Comments are closed.', 'sudaraka.org'); ?></p>
		<?php endif; // check for comment navigation ?>

	<?php comment_form(); ?>

	</div><!-- #comments -->
