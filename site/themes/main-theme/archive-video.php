<?php get_header(); ?>
<section class="video-series-section py-5">
  <div class="container">
    <div class="section-header d-flex justify-content-between align-items-center mb-4 flex-wrap">
      <h2 class="section-title mb-2 mb-md-0"><?php _e('سلسلة الفيديوهات', 'textdomain'); ?></h2>
    </div>
    <div class="video-search text-center mb-5">
  <input type="text" id="search-input" class="search-field" placeholder="<?php _e('ابحث عن فيديو...', 'textdomain'); ?>">
  <button id="search-btn" class="btn-search">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
      <circle cx="11" cy="11" r="7" stroke="#00A14B" stroke-width="2"/>
      <line x1="16" y1="16" x2="22" y2="22" stroke="#00A14B" stroke-width="2"/>
    </svg>
  </button>
</div>

    <div id="videos-container" class="row">
      <?php
      $paged = get_query_var('paged') ? get_query_var('paged') : 1;
      $args = [
        'post_type' => 'video',
        'posts_per_page' => 12,
        'paged' => $paged,
        'post_status' => 'any'
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
              <h5 class="video-title text-center mt-3"></h5>
            </div>
          </div>
        <?php endwhile;
      endif;
      wp_reset_postdata();
      ?>
    </div>

    <div class="text-center mt-4">
      <button id="load-more-btn" class="btn btn-outline-primary btn-load-more">
        <span id="load-more-text"><?php _e('تحميل المزيد', 'textdomain'); ?></span>
        <span id="load-more-loader" style="display:none;">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
            <circle cx="12" cy="12" r="10" stroke="#00A14B" stroke-width="2" stroke-dasharray="31.4" stroke-linecap="round">
              <animateTransform attributeName="transform" type="rotate" dur="1s" repeatCount="indefinite" from="0 12 12" to="360 12 12" />
            </circle>
          </svg>
        </span>
      </button>
    </div>

    <!-- Modal -->
    <div id="videoModal" class="video-modal">
      <div class="video-modal-content">
        <span class="close-modal">&times;</span>
        <div class="video-wrapper">
          <iframe id="youtubePlayer" src="" frameborder="0" allow="autoplay" allowfullscreen></iframe>
        </div>
      </div>
    </div>
    <script type="text/javascript">
    var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
</script>
</section>
<?php get_footer(); ?>
