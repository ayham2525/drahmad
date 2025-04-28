<?php get_header(); ?>

<section class="blog-archive-section py-5">
  <div class="container">
    <h1 class="section-title text-center mb-5">
      <?php echo is_home() && !is_front_page() ? single_post_title('', false) : __('جميع المقالات', 'main-theme'); ?>
    </h1>

    <div class="row g-4">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="col-md-4 d-flex">
          <div class="related-card w-100 d-flex flex-column">
            <?php if (has_post_thumbnail()) : ?>
              <div class="related-img position-relative">
                <a href="<?php the_permalink(); ?>">
                  <?php the_post_thumbnail('full', ['class' => 'w-100 h-100']); ?>
                </a>
              </div>
            <?php endif; ?>

            <div class="related-content p-3 d-flex flex-column flex-grow-1">
              <h5 class="related-title mb-2">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
              </h5>
              <p class="text-muted small mb-3 d-flex align-items-center">
                <i class="far fa-calendar-alt me-1 ms-1 text-success"></i>
                <?php echo get_the_date(); ?>
              </p>
              <p class="excerpt small text-muted">
                <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
              </p>
              <a href="<?php the_permalink(); ?>" class="read-more mt-auto">
                <?php esc_html_e('اقرأ المزيد', 'main-theme'); ?> →
              </a>
              
            </div>
          </div>
        </div>
      <?php endwhile; else : ?>
        <p class="text-center"><?php esc_html_e('لا توجد مقالات حالياً.', 'main-theme'); ?></p>
      <?php endif; ?>
    </div>

    <!-- Pagination -->
    <div class="pagination-wrapper mt-5 text-center">
      <?php
      the_posts_pagination([
        'mid_size' => 2,
        'prev_text' => __('« السابق', 'main-theme'),
        'next_text' => __('التالي »', 'main-theme'),
        'screen_reader_text' => '',
      ]);
      ?>
    </div>
  </div>
</section>

<?php get_footer(); ?>
