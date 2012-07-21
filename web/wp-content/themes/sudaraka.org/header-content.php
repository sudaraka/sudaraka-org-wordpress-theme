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

$upload_url = wp_upload_dir();
if(empty($upload_url['url'])) $upload_url = '';
else $upload_url = $upload_url['url'];

?>

				<a href="/about-sudaraka-wijesinghe/" rel="me">
					<img src="<?php echo $upload_url . '/mug-shot' . ((is_home() || is_front_page())?'':'-60x58') . '.jpg' ?>" alt="" class="mug-shot" />
				</a>
				
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<<?php echo (is_home() || is_front_page())?'h1':'div'; ?> class="title"><?php bloginfo( 'name' ); ?></<?php echo (is_home() || is_front_page())?'h1':'div'; ?>>
				</a>
				<p class="slogan">...<?php bloginfo( 'description' ); ?>...</p>

<?php
wp_nav_menu(
	array(
		'theme_location'	=> 'header_page_links',
		'items_wrap'		=> '<menu id="%1$s" class="%2$s">%3$s</menu>',
		'container'			=> null,
		//'walker'			=> Walker_Sudaraka_Org_Menu::create(),
	)
);

wp_nav_menu(
	array(
		'theme_location'	=> 'main_menu',
		'items_wrap'		=> '<menu id="%1$s" class="%2$s">%3$s</menu>',
		'container'			=> null,
		//'walker'			=> Walker_Sudaraka_Org_Menu::create(),
	)
);
