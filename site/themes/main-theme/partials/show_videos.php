
<section class="show_videos py-5" id="home-videos">
  <div class="container">
    <div class="row pb-5">
              <div class="col-12">
                  <?php if(get_sub_field('text')):?>
                      <h2 class="section-title"><?php echo get_sub_field('text');?></h2>
                      <div class="section-accent-line mt-3 mb-4"></div>
                      <?php endif;?>
              </div>
          </div>

    <div class="row">
      <?php
      $args = [
        'post_type' => 'video',
        'posts_per_page' => 4,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC'
      ];
      $query = new WP_Query($args);
      if ($query->have_posts()):
        while ($query->have_posts()): $query->the_post();
          $video_url = get_field('video_url');
          preg_match('/(?:v=|\/)([0-9A-Za-z_-]{11}).*/', $video_url, $matches);
          $video_id = $matches[1] ?? '';
          ?>
          <div class="col-12 col-md-6 col-lg-3 mb-4">
            <div class="video-card" data-video-id="<?php echo esc_attr($video_id); ?>">
              <div class="youtube-thumb">
                <img src="https://img.youtube.com/vi/<?php echo esc_attr($video_id); ?>/hqdefault.jpg" alt="<?php the_title(); ?>">
                <div class="play-icon">
                  <i class="fas fa-play"></i>
                </div>
              </div>
              <h5 class="video-title text-center mt-3"><?php the_title(); ?></h5>
            </div>
          </div>
          <?php
        endwhile;
      else:
        ?>
        <p class="text-center"><?php _e('لا توجد فيديوهات حالياً.', 'textdomain'); ?></p>
      <?php
      endif;
      wp_reset_postdata();
      ?>
    </div>

    <div class="text-center mt-4">
      <a href="<?php echo esc_url(get_post_type_archive_link('video')); ?>" class="btn btn-outline-primary home-btn-load-more">
        <?php _e('عرض كل الفيديوهات', 'textdomain'); ?>
      </a>
    </div>

    <!-- Modal for Video Preview (Optional if you want) -->
    <div id="videoModalHome" class="video-modal" style="display:none;">
      <div class="video-modal-content">
        <span class="close-modal">&times;</span>
        <div class="video-wrapper">
          <iframe id="youtubePlayerHome" src="" frameborder="0" allow="autoplay" allowfullscreen></iframe>
        </div>
      </div>
    </div>

  </div>
</section>
