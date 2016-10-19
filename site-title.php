<?php
	if(strlen($secondary) > 0 && strlen($secondarylink) > 0){
		if(substr($secondarylink,0,4) != 'http'){
			$secondarylink = 'http://'.$secondarylink;
		}
		echo '<p id="uc-site-parent"><a href="'.$secondarylink.'">'.$secondary.'</a></p>';
	}
?>
<h1 id="uc-site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>