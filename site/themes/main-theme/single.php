<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php $bg_image = get_the_post_thumbnail_url(null, 'full'); ?>

<section class="post-hero-section" style="background-image: url('<?php echo esc_url($bg_image); ?>');">
    <div class="overlay-text">
        <div class="content-box text-center position-relative">
            <i class="fa fa-quote-right quote-icon start"></i>
            <h1><?php the_title(); ?></h1>
            <i class="fa fa-quote-left quote-icon end"></i>
        </div>
    </div>
</section>

<section id="post-content" class="container py-5">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="post-meta-container position-relative mb-4 ps-md-4 pe-md-4">
                <div class="green-bar"></div>

                <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <div class="views text-muted d-flex align-items-center">
                        <i class="far fa-eye me-1 ms-1"></i>
                        <span>
                            <?php echo esc_html(get_post_meta(get_the_ID(), 'post_views_count', true) ?: 0); ?>
                            <?php esc_html_e('المشاهدات', 'main-theme'); ?>
                        </span>
                    </div>

                    <div class="share-icons d-flex align-items-center flex-wrap">
                        <span class="me-2"><?php esc_html_e('مشاركة','main-theme'); ?></span>
                        <?php
                        $share_url = urlencode(get_permalink());
                        $share_links = [
                            ['url' => "https://www.facebook.com/sharer/sharer.php?u=$share_url", 'icon' => 'facebook-f', 'title' => 'Facebook'],
                            ['url' => "https://twitter.com/intent/tweet?url=$share_url", 'icon' => 'twitter', 'title' => 'Twitter'],
                            ['url' => "https://api.whatsapp.com/send?text=$share_url", 'icon' => 'whatsapp', 'title' => 'WhatsApp'],
                            ['url' => "https://www.linkedin.com/shareArticle?mini=true&url=$share_url", 'icon' => 'linkedin-in', 'title' => 'LinkedIn'],
                        ];
                        foreach ($share_links as $link) :
                        ?>
                            <a href="<?php echo esc_url($link['url']); ?>" target="_blank" class="me-2" title="<?php echo esc_attr($link['title']); ?>">
                                <i class="fab fa-<?php echo esc_attr($link['icon']); ?>"></i>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <hr class="mb-4 mt-0">

            <div class="post-content">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</section>

<section class="related-posts-section mt-5">
    <div class="container">
        <h3 class="section-title mb-5 text-center"><?php esc_html_e('مقالات ذات صلة', 'main-theme'); ?></h3>
        <div class="row g-4">
            <?php
            $related_query = new WP_Query([
                'posts_per_page' => 3,
                'post__not_in' => [get_the_ID()],
                'category__in' => wp_get_post_categories(get_the_ID()),
                'orderby' => 'rand',
                'no_found_rows' => true,
                'ignore_sticky_posts' => 1,
            ]);
            if ($related_query->have_posts()) :
                while ($related_query->have_posts()) : $related_query->the_post(); ?>
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
                                <a href="<?php the_permalink(); ?>" class="read-more mt-auto">
                                    <?php esc_html_e('اقرأ المزيد', 'main-theme'); ?> →
                                </a>
                                <div class="img-bottom-line"></div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; wp_reset_postdata(); endif; ?>
        </div>

        <div class="text-center mt-4">
            <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="view-all-articles-btn">
                <?php esc_html_e('مشاهدة جميع المقالات', 'main-theme'); ?>
                <i class="fas fa-arrow-left ms-2"></i>
            </a>
        </div>
    </div>
</section>

<?php endwhile; endif; ?>
<?php get_footer(); ?>
