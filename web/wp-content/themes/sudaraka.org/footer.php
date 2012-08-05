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
?>

			</div><!-- #site-body -->
			
			<div class="clear"></div>
			
			<div id="site-header">
				<?php get_template_part('header', 'content'); ?>
			
			</div><!-- #site-header -->
			
			<div id="site-footer">
			
				<?php dynamic_sidebar('footer-widgets'); ?>
				<div class="clear"></div>
				<?php
				wp_nav_menu(
					array(
						'theme_location'	=> 'footer_links',
						'items_wrap'		=> '<menu id="%1$s" class="%2$s">%3$s</menu>',
						'container'			=> null,
						//'walker'			=> Walker_Sudaraka_Org_Menu::create(),
					)
				);
				?>
				
				<div class="leagal">
					<div class="left">
						<p>Powered by <a href="http://wordpress.org/" target="_blank">WordPress</a> under <a href="http://wordpress.org/about/license/" target="_blank"><abbr title="GNU is Not Unix">GNU</abbr> <abbr title="General Public License">GPL</abbr>v2</a> (or later).</p>
						<p>
							<small>
								WordPress theme of Sudaraka.Org &mdash; <cite><a href="/about-the-web-site/copyright/#code">Copyright</a> 2012 <a href="/about-sudaraka-wijesinghe/" rel="me">Sudaraka Wijesinghe</a>.</cite><br />
								This WordPress theme is free software: you can redistribute it and/or modify <br />
								it under the terms of the <abbr title="GNU is Not Unix">GNU</abbr> Affero General Public License as published by<br />
								the Free Software Foundation, either version 3 of the License, or <br />
								(at your option) any later version.
							</small>
						</p>
						<p>
							<small>
								This WordPress theme comes with ABSOLUTELY NO WARRANTY; for details see <a href="/about-the-web-site/disclaimer/#code-warranty">Disclaimer</a>.<br />
								This is free software, and you are welcome to redistribute it<br />
								under certain conditions; see <a href="/about-the-web-site/terms-and-conditions/">Terms &amp; Conditions</a> for details.
							</small>
						</p>
						<p><small>Get the source code from <a href="https://gitorious.org/sudaraka-org/wordpress-theme" target="_blank">here</a>.</small></p>
					</div>
					
					<div class="right">
						<p><cite>Sudaraka.Org &mdash; <a href="/about-the-web-site/copyright/#content">Copyright</a> 2012 <a href="/about-sudaraka-wijesinghe/" rel="me">Sudaraka Wijesinghe</a>.</cite></p>
						<p>
							<small>
								Unless explicitly mentioned in the content otherwise, all the contents of Sudarka.Org are<br />
								licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-sa/3.0/" target="_blank">Creative Commons Attribution-ShareAlike 3.0 Unported License</a>.<br />
								Based on a work at <a xmlns:dct="http://purl.org/dc/terms/" href="http://sudaraka.org/" rel="dct:source">sudaraka.org</a>.<br />
								Permissions beyond the scope of this license may be available on <a xmlns:cc="http://creativecommons.org/ns#" href="/about-the-web-site/terms-and-conditions/" rel="cc:morePermissions">Terms &amp; Conditions</a>.
							</small>
						</p>
					</div>
					
					<div class="logos">
						<a rel="license" href="http://creativecommons.org/licenses/by-sa/3.0/"><img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by-sa/3.0/88x31.png" /></a>
						<a href="http://www.gnu.org/licenses/agpl.html" target="_blank">
							<img src="<?php echo bloginfo('template_directory'); ?>/images/agplv3-88x31.png" alt="GNU AGPLv3 (or later)" />
						</a>
						<a href="/feed/" target="_blank"><img src="<?php echo bloginfo('template_directory'); ?>/images/rss2-btn.png" alt="RSS 2.0 Feed" /></a>
						<a href="http://gmpg.org/xfn" target="_blank"><img src="<?php echo bloginfo('template_directory'); ?>/images/xfn-btn.gif" alt="XFN Friendly" /></a>
						<a href="http://www.php.net/" target="_blank"><img src="<?php echo bloginfo('template_directory'); ?>/images/php-power-micro.png" alt="PHP: Hypertext Preprocessor" /></a>
						<br />
						<br />
						
						<a href="http://www.w3.org/html/logo/" target="_blank" title="HTML5 Powered with CSS3 / Styling">
							<img src="http://www.w3.org/html/logo/badge/html5-badge-h-css3.png" width="133" height="64" alt="HTML5 Powered with CSS3 / Styling" />
						</a>
						
						<a href="http://wordpress.org/" target="_blank" title="Powered by Wordpress">
							<img src="<?php echo bloginfo('template_directory'); ?>/images/wordpress-logo.png" width="282" height="64" alt="Powered by Wordpress" />
						</a>
					</div>
				</div>
			
			</div><!-- #site-footer -->
			<?php wp_footer(); ?>
		
		</div><!-- #site-wraper -->
		<?php if(!(is_home() || is_front_page() || is_page()) && is_singular() && get_option('thread_comments')) wp_enqueue_script('comment-reply'); ?>
		
		<script type="text/javascript">
		
		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-33560559-1']);
		  _gaq.push(['_setDomainName', 'sudaraka.org']);
		  _gaq.push(['_trackPageview']);
		
		  (function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();
		
		</script>

	</body>
</html>
