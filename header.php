<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 */
if ( apply_filters( 'load_custom_header', false ) ) {   
    $custom_header = apply_filters( 'get_custom_header', '' );

    if ( '' != $custom_header ) {       
        // Get the header that we just received
        // and call the native 'get_header' function
        // as usual
        load_template( $custom_header );

        // By calling 'return' we are skipping
        // parsing this template any further        
        return;
    }
}
 include 'inc/vars.php';
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
<!--[if !IE]><!--><script>
if (/*@cc_on!@*/false) {
    document.documentElement.className+=' ie10';
}
</script><!--<![endif]-->
</head>
<body <?php body_class(); ?>>
<!--[if lt IE 7]>      <div class="ie lte9 lte8 lte7 lte6"> <![endif]-->
<!--[if IE 7]>         <div class="ie ie7 lte9 lte8 lte7"> <![endif]-->
<!--[if IE 8]>         <div class="ie ie8 lte9 lte8"> <![endif]-->
<!--[if IE 9]>         <div class="ie ie9 lte9"> <![endif]-->
<nav id="skiplinks">
	<a href="#site-navigation">Skip to Navigation</a>
	<a href="#uc-search">Skip to UConn Search</a>
	<a href="#content">Skip to Content</a>
</nav>
<?php if(function_exists('uconn_banner_hook')){uconn_banner_hook();}?>
<div id="page" class="hfeed site">
	<header id="masthead" class="site-header <?php if ($headerImg != ''){echo 'header-image';} ?>" role="banner">
		<div id="site-title" class="hidden-xs">
			<div class="container">
				<?php include 'inc/header-img.php'; ?>
				<div class="row">
					<div class="col-sm-8">
						<div class="site-branding" id="uc-site-header">
							<?php include 'inc/site-title.php'; ?>
						</div>
					</div>
					<div class="col-sm-4">
						<?php get_search_form(); ?>
					</div>
				</div>
			</div>
		</div>
		<div id="nav-wrapper">
			
				<?php
					// Check to see if max mega menu is active
					include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
					$maxMegaMenuActive = is_plugin_active('megamenu/megamenu.php');
					
					if (!$maxMegaMenuActive){
						if ($navStyle == 'drop-multi'){
							include 'inc/nav-drop-multi.php';
						} else if ($navStyle == 'tabs'){
							include 'inc/nav-tabs.php';
						} else {
							// std. Bootstrap dropdowns. 
							include 'inc/nav.php';
						}
					} else {
						include 'inc/nav-maxmegamenu.php';
					}

					
				?>
		</div>
	</header>
	<!-- #masthead -->	
	<div id="content" class="site-content">
		<div class="container">