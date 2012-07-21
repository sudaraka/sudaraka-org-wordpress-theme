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
							<p>
								<?php _e( 'The page or article you were looking for is not available in this location.', 'sudaraka.org' ); ?><br />
								<?php _e( 'You might be able to find what you were looking for using the "search" option below.', 'sudaraka.org' ); ?>
							</p>
							<p>
								<?php _e( 'If you were directed this this location (URL) from an external source, please inform the relevant parties to update their links.', 'sudaraka.org' ); ?>
								<?php _e( 'Meanwhile, feel free to browse through rest of the interesting content of my web site.', 'sudaraka.org' ); ?><br />
							</p>
							<?php get_search_form(); ?>
