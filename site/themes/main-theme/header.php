<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<?php wp_head(); ?>
</head>

<?php
	$navbar_scheme   = get_theme_mod( 'navbar_scheme', 'navbar-light bg-light' ); // Get custom meta-value.
	$navbar_position = get_theme_mod( 'navbar_position', 'static' ); // Get custom meta-value.

	$search_enabled  = get_theme_mod( 'search_enabled', '1' ); // Get custom meta-value.
?>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

 
<div id="wrapper">
<header>
  <nav id="header" class="navbar navbar-expand-md <?php echo is_rtl() ? 'rtl' : 'ltr'; ?>">
    <div class="container-fluid">
      <a class="navbar-brand" href="<?php echo esc_url(home_url()); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
        <?php
        $header_logo = get_theme_mod('header_logo');
        if (!empty($header_logo)) :
        ?>
          <img src="<?php echo esc_url($header_logo); ?>" alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>">
        <?php else :
          echo esc_html(get_bloginfo('name', 'display'));
        endif;
        ?>
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation', 'main-theme'); ?>">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div id="navbar" class="collapse navbar-collapse">
    <?php
    wp_nav_menu([
        'theme_location' => 'header-menu', // This must match the location you register
        'container' => false,               // No extra div
        'menu_class' => 'navbar-nav me-auto', // Use your Bootstrap classes
        'fallback_cb' => false,              // No fallback if menu is not set
        'depth' => 2,                        // 2 levels deep (you can adjust if needed)
        'walker' => new WP_Bootstrap_Navwalker(), // If you are using Bootstrap Navwalker
    ]);
    ?>
</div>

    </div>
  </nav>
</header>


<main id="main" class="container-fluid p-0"<?php if ( isset( $navbar_position ) && 'fixed_top' === $navbar_position ) : echo ' style="padding-top: 100px;"'; elseif ( isset( $navbar_position ) && 'fixed_bottom' === $navbar_position ) : echo ' style="padding-bottom: 100px;"'; endif; ?>>
  
		 
