<!DOCTYPE html>
<!--[if IE 9]>         <html class="no-js ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php wp_title(''); ?></title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="icon" type="image/png" href="<?php bloginfo('template_directory'); ?>/favicon-32x32.png" sizes="32x32" />
	<link rel="icon" type="image/png" href="<?php bloginfo('template_directory'); ?>/favicon-16x16.png" sizes="16x16" />

	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
	
	<!-- <script src="<?php bloginfo('template_directory'); ?>/bower_components/modernizr/src/Modernizr.js"></script>  possibly not needed - replace this with a custom Modernizr build on production projects and point to JS folder -->
    <!--[if lt IE 9]><script src="<?php bloginfo('template_directory'); ?>/js/IE7-8Fixes.min.js"></script><![endif]-->


	<?php wp_head(); ?>

	<script> (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){ (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o), m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m) })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	ga('create', 'UA-XXXXXXX', 'auto'); ga('send', 'pageview');
	</script>

	
</head>

<?php echo '<body class="' . join(' ', get_body_class()) . '">'; ?>

<header class="page">




<img src="<?php bloginfo('template_directory'); ?>/img/logo.png" alt="logo" />



<nav class="mainNav">
	<ul>
    <!--<li <?php if(is_page( 'home-page' )){ echo 'class="current_page_item"';} ?>><a title="Home" href="<?php echo esc_url( home_url() ); ?>">Home</a></li>-->

	<?php
		$args = array(
			'exclude_tree'	=> '',
			'depth'      	=> 1,
			'title_li' 		=> '',
			'meta_key'   => 'show_in_menu',
			'meta_value' => '1',			
			'post_status' 	=> 'publish'
		);

		wp_list_pages( $args )
	?> 
	</ul>
</nav>



<nav class="mainNav">
	<ul>
		<?php
			$args = array(
				'exclude_tree'	=> '',
				'depth'      	=> 2,
				'title_li' 		=> '',
				'meta_key'   	=> 'show_in_menu',
				'meta_value' 	=> '1',			
				'post_status' 	=> 'publish'
			);

			wp_list_pages( $args );
		?> 
	</ul>
</nav>


			
</header>


			