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

$browser_title = wp_title( '&mdash;', false, 'right' ) . get_bloginfo( 'name' );

if(is_category()) {
	$meta_data = get_option('cat_' . get_query_var('cat'));
	
	$post_meta_description = $meta_data['description'];
	$post_meta_keywords = $meta_data['keywords'];
}
else {
	$post_meta_description = get_post_meta($post->ID, 'description', true);
	$post_meta_keywords = get_post_meta($post->ID, 'keywords', true);
}

$site_description = get_bloginfo( 'description', 'display' );
if(!empty($site_description) && (is_home() || is_front_page())) $browser_title .= ' &mdash; ' . $site_description;

if($paged>=2 || $page>=2) $browser_title .= ' &mdash; ' . sprintf(__( 'Page %s', 'sudaraka.org' ), max($paged, $page));
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
	<head profile="http://gmpg.org/xfn/11">
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width" />
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
		
		<title><?php echo $browser_title ?></title>
		<meta name="title" content="<?php echo $browser_title ?>" />
		
		<meta name="description" content="<?php echo empty($post_meta_description)?$site_description:$post_meta_description; ?>" />
		<meta name="keywords" content="<?php echo strtolower(empty($post_meta_keywords)?get_bloginfo('name'):$post_meta_keywords); ?>" />
		
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		
		<link rel="icon" type="image/png" href="<?php echo bloginfo('template_url'); ?>/images/favicon.png" />
		
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<div id="content-wraper">
			
			<div id="site-body">

