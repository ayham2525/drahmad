<?php if (get_sub_field('visible')): ?>
<section class="show_books books-carousel-section py-5" id="home-books">
    <div class="container">
        <div class="row mb-4 text-center">
            <div class="col">
                <?php if (get_sub_field('text')): ?>
                    <h2 class="section-title">
                        <?php echo esc_html(get_sub_field('text')); ?>
                    </h2>
                <?php endif; ?>
                <div class="section-accent-line mt-3 mb-4"></div>
            </div>
        </div>

        <?php if (have_rows('books_repeater')): ?>
        <div id="books-carousel" class="owl-carousel owl-theme">
            <?php while (have_rows('books_repeater')): the_row(); ?>
            <?php 
              $popup_text = get_sub_field('text'); 
              $title = get_sub_field('title');
              $image = get_sub_field('image');
              $image_src = $image ? wp_get_attachment_image_src($image, 'large')[0] : '';
              $file_id = get_sub_field('file');
              $file_url = $file_id ? wp_get_attachment_url($file_id) : '';
            ?>
            <div class="item">
                <div class="book-card" 
                    data-title="<?php echo ($title); ?>" 
                    data-text="<?php echo ($popup_text); ?>" 
                    data-image="<?php echo esc_url($image_src); ?>"
                    data-link="<?php echo esc_url($file_url); ?>">
                    <div class="book-cover">
                        <?php if ($image_src): ?>
                        <img class="img-fluid" src="<?php echo esc_url($image_src); ?>" alt="<?php echo esc_attr($title); ?>">
                        <?php endif; ?>
                    </div>
                    <div class="book-info text-center p-3">
                        <?php if ($title): ?>
                        <h5 class="book-title"><?php echo esc_html($title); ?></h5>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>

        <div class="svg-container">
            <button id="books-prev-btn" class="our_partners-prev-btn">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M6.33333 7.59009L3 10.9234L6.33333 14.2568L3 10.9234H18" stroke="#4D4D4D" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
            <button id="books-next-btn" class="our_partners-next-btn">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M14.6667 7.59009L18 10.9234L14.6667 14.2568L18 10.9234H3" stroke="#4D4D4D" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        </div>
        <?php endif; ?>
    </div>
</section>
<?php endif; ?>

<!-- Popup Modal OUTSIDE the section -->
<div id="book-popup" class="book-popup" style="display:none;">
    <div class="popup-content">
        <span class="close-popup">&times;</span>
        <img id="popup-image" src="" alt="" class="img-fluid mb-3">
        <div id="popup-text" class="popup-text"></div>
    </div>
</div>
