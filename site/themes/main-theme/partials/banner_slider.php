<?php if (get_sub_field('visible')): ?>
  <section class="banner_slider">
    <div id="owl-carousel-example" class="owl-carousel owl-theme">
      <?php if (have_rows('image_repeater')): ?>
        <?php while (have_rows('image_repeater')): the_row();
          $image = get_sub_field('image');
          if ($image):
            $img_src = wp_get_attachment_image_src($image['id'], 'large');
            $img_url = $img_src[0] ?? '';
            $alt = !empty($image['alt']) ? $image['alt'] : 'Dr Ahmad';
            $bg_position = $image['left'] . '% ' . $image['top'] . '%';
        ?>
          <div class="item">
            <div class="carousel-background-item" style="
              background-image: url('<?php echo $img_url; ?>');
              background-position: <?php echo $bg_position; ?>;
              background-size: cover;
              background-repeat: no-repeat;
              height: calc(100vh - 90px);
              position: relative;">
              <img src="<?php echo $img_url; ?>" alt="<?php echo $alt; ?>" style="opacity: 0; width: 100%; height: 100%;">

              <?php if (get_sub_field('text')): ?>
                <div class="carousel-caption">
                  <h4 style="color:<?php echo get_sub_field('text_color'); ?>">
                    <?php echo get_sub_field('text'); ?>
                  </h4>
                </div>
              <?php endif; ?>
            </div>
          </div>
        <?php endif; endwhile; ?>
      <?php endif; ?>
    </div>

    <?php if (have_rows('social')): ?>
      <div class="slider-social-container">
        <ul class="slider-social">
          <?php while (have_rows('social')): the_row();
            $link = get_sub_field('link');
            $image = get_sub_field('image');
            if ($link && $image):
              $image_src = wp_get_attachment_image_src($image, 'large');
              $img = $image_src[0] ?? '';
              $alt = get_sub_field('alt') ?: '';
          ?>
            <li>
              <a href="<?php echo $link['url']; ?>" target="<?php echo $link['target'] ?? '_self'; ?>">
                <img src="<?php echo $img; ?>" alt="<?php echo $alt; ?>" class="img-fluid" />
              </a>
            </li>
          <?php endif; endwhile; ?>
        </ul>
      </div>
    <?php endif; ?>
  </section>
<?php endif; ?>
