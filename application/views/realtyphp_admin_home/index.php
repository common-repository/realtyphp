<div class="wrap">

<h2><?php _e('Realtyphp for Wordpress', 'realtyphp') ?></h2>

<p>
	<h3><?php _e('Overview', 'realtyphp') ?></h3>
	<?php _e('Welcome to Realtyphp. Realtyphp is a real estate listing plugin for Wordpress.', 'realtyphp') ?>
</p>

<p>
	<h3><?php _e('License', 'realtyphp') ?></h3>
	<?php _e('Realtyphp licensed under', 'realtyphp');
	    echo " <a href='http://www.gnu.org/licenses/gpl.html' target='_blank'>GNU/GPL</a>" ?>
</p>

<p>
	<h3><?php _e('Download', 'realtyphp') ?></h3>
	<?php _e('You can download the latest version from', 'realtyphp');
	    if(WPLANG != 'hu_HU')
		    echo " <a href='http://en.easymysoft.com' target='_blank'>en.easymysoft.com</a>".'.';
		else 
			echo " <a href='http://www.easymysoft.com' target='_blank'>www.easymysoft.com</a>".'.';
	?>
</p>

<p>
	<h3><?php _e('Developer', 'realtyphp') ?></h3>
	<?php
	    if(WPLANG != 'hu_HU')
		    echo " Elod Horvath <a href='http://en.easymysoft.com' target='_blank'>en.easymysoft.com</a>".'.';
		else 
			echo " Horváth Előd <a href='http://www.easymysoft.com' target='_blank'>www.easymysoft.com</a>".'.';
	?>
</p>

<p>
	<h3><?php _e('Support', 'realtyphp') ?></h3>
	<?php _e('For support please contact me:', 'realtyphp');
	    if(WPLANG != 'hu_HU')
		    echo " <a href='http://en.easymysoft.com' target='_blank'>en.easymysoft.com</a>".'.';
		else 
			echo " <a href='http://www.easymysoft.com' target='_blank'>www.easymysoft.com</a>".'.';
	?>
</p>


</div>