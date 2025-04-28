		
		</main><!-- /#main -->

        <!-- #region -->  
        <footer id="footer">
  <div class="container-fluid">
    <div class="footer-top d-flex flex-wrap align-items-center">
      
      <!-- Social Media -->
      <div class="footer-social d-flex">
        <?php if(get_field('social_media', 'options')):?>
                <?php $social_media = get_field('social_media', 'options'); ?>
                <?php foreach($social_media as $social):?>
                   <?php $link = $social['link'];?>
                   <?php if($link):?>
                    <a href="<?php echo $link["url"]?>" title="<?php echo $social['alt'];?>"><?php echo $social['icon'];?></a>
                    <?php endif;?>
                  <?php endforeach;?>
        <?php endif;?>
      </div>

      <!-- Menu 1 -->
      <div class="footer-menu">
    <?php
    wp_nav_menu([
        'theme_location' => 'first-footer-menu',
        'container'      => false,
        'menu_class'     => 'nav flex-wrap',
        'fallback_cb'    => false,
        'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        'depth'          => 1
    ]);
    ?>
</div>


      <!-- Menu 2 -->
      <div class="footer-menu">
    <?php
    wp_nav_menu([
        'theme_location' => 'second-footer-menu',
        'container'      => false,
        'menu_class'     => 'nav flex-wrap',
        'fallback_cb'    => false,
        'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        'depth'          => 1
    ]);
    ?>
</div>


      <!-- Logo -->
      <div class="footer-logo">
        <a class="navbar-brand" href="<?php echo esc_url(home_url()); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
          <?php
          $header_logo = get_theme_mod('header_logo');
          if (!empty($header_logo)) :
          ?>
            <img src="<?php echo esc_url($header_logo); ?>" alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" />
          <?php else :
            echo esc_html(get_bloginfo('name', 'display'));
          endif; ?>
        </a>
      </div>

    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom text-center mt-4">
      <?php echo get_field('copy_right','options');?>
    </div>

  </div>
</footer>


	</div><!-- /#wrapper -->
	<?php
		wp_footer();
	?>
</body>
</html>
