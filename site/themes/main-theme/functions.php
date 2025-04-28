<?php
    add_action('wp_enqueue_scripts', 'main_theme_enqueue_styles');
    function main_theme_enqueue_styles()
    {
        // Main theme style
        wp_enqueue_style('main-theme', get_stylesheet_directory_uri() . '/assets/style/css/main-theme.css');

        // External styles
        wp_enqueue_style('font-awesome', 'https://use.fontawesome.com/releases/v5.15.4/css/all.css', [], '5.15.4');
        wp_enqueue_style('owl-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css');
        wp_enqueue_style('owl-theme', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css');

        if (defined('ICL_LANGUAGE_CODE')) {
            if (ICL_LANGUAGE_CODE === 'en') {
                wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css', [], '5.3.2');
            }
            if (ICL_LANGUAGE_CODE === 'ar') {
                wp_enqueue_style('bootstrap-rtl-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css', [], '5.0.2');
                // Uncomment if you want Arabic custom style:
                // wp_enqueue_style('ar-css', get_stylesheet_directory_uri() . '/style/ar/css/ar.css');
            }
        }
    }

    add_action('wp_enqueue_scripts', 'my_custom_scripts');
    function my_custom_scripts()
    {
        // Use default WordPress jQuery
        wp_enqueue_script('jquery');
        wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js', ['jquery'], '5.3.2', true);
        wp_enqueue_script('owl.carousel.js', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js');
        wp_enqueue_script('fancybox-js', 'https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js', ['jquery'], '3.5.7', true);
        wp_enqueue_script('photo-sphere-viewer', 'https://cdnjs.cloudflare.com/ajax/libs/photo-sphere-viewer/4.0.0/photo-sphere-viewer.min.js', [], '4.0.0', true);
        wp_enqueue_script('aframe-js', 'https://aframe.io/releases/0.5.0/aframe.min.js', [], '0.5.0', true);
        // Custom local script
        wp_enqueue_script('banner-slider', get_stylesheet_directory_uri() . '/assets/js/banner_slider.js', ['jquery'], null, true);
        wp_enqueue_script('posts-slider', get_stylesheet_directory_uri() . '/assets/js/posts.js', ['jquery'], null, true);
        wp_enqueue_script('books-carousel', get_stylesheet_directory_uri() . '/assets/js/books-carousel.js', ['jquery'], null, true);
        wp_enqueue_script('videos', get_stylesheet_directory_uri() . '/assets/js/videos.js', ['jquery'], null, true);
        wp_enqueue_script('show-videos', get_stylesheet_directory_uri() . '/assets/js/show-videos.js', ['jquery'], null, true);
    }

    // Increase view count on post load
    function set_post_views($postID)
    {
        $key   = 'post_views_count';
        $count = (int) get_post_meta($postID, $key, true);
        $count++;
        update_post_meta($postID, $key, $count);
    }

    function track_views_on_single()
    {
        if (is_single()) {
            global $post;
            set_post_views($post->ID);
        }
    }
    add_action('wp_head', 'track_views_on_single');

    add_action('init', function () {
        load_plugin_textdomain('acf', false, dirname(plugin_basename(__FILE__)) . '/languages/');
    });
    // remove auther
    function disable_embeds_filter_oembed_responsedata($data)
    {
        unset($data['author_url']);
        unset($data['author_name']);
        return $data;
    }
    add_filter('oembed_response_data', 'disable_embeds_filter_oembed_responsedata');
    if (function_exists('acf_add_options_page')) {
        acf_add_options_page([
            'page_title' => 'Options',
            'menu_title' => 'Options',
            'menu_slug'  => 'theme-general-settings',
            'capability' => 'edit_posts',
            'redirect'   => false,
        ]);
    }
    function custom_excerpt($word_limit)
    {
        $content = wp_strip_all_tags(get_the_content(), true); // Get the post content without HTML tags
        $words   = explode(' ', $content);                     // Split the content into an array of words
                                                               // If the content has more words than the limit, truncate it
        if (count($words) > $word_limit) {
            $excerpt = implode(' ', array_slice($words, 0, $word_limit)) . '...';
        } else {
            $excerpt = implode(' ', $words);
        }
        return $excerpt;
    }
    function the_truncated_title($limit = 6)
    {
        $title = get_the_title();
        $words = explode(' ', $title);
        if (count($words) > $limit) {
            return implode(' ', array_slice($words, 0, $limit)) . '...';
        } else {
            return $title;
        }
    }
    // add new menu
    add_filter('acf/fields/flexible_content/layout_title/name=main_content', 'my_acf_fields_flexible_content_layout_title', 10, 4);
    function my_acf_fields_flexible_content_layout_title($title, $field, $layout, $i)
    {
        $title = $layout["label"];
        if ($text = get_sub_field('section_title')) {
            $title .= ' <b>(' . esc_html($text) . ')</b>';
        } else {
            if ($text = get_sub_field('title')) {
                $title .= ' <b>(' . esc_html($text) . ')</b>';
            }
        }
        return $title;
    }
    /*@ Change WordPress Admin Login Logo */
    if (! function_exists('tf_wp_admin_login_logo')):
        function tf_wp_admin_login_logo()
{?>
	<style type="text/css">
	body.login div#login h1 a {
	    background-image: url('<?php echo get_stylesheet_directory_uri() . "/assets/images/logo.png"; ?>');
	}
	</style>
	<?php }
            add_action('login_enqueue_scripts', 'tf_wp_admin_login_logo');
        endif;
        function add_svg_to_submit_button($form)
        {
            // Match the submit button and replace it with updated content
            $form = preg_replace_callback(
                '/<input([^>]*)class="([^"]*)wpcf7-submit([^"]*)"([^>]*)value="([^"]+)"([^>]*)>/',
                function ($matches) {
                    // Add the SVG inline after the text inside the button
                    return '<button' . $matches[1] . 'class="' . $matches[2] . 'wpcf7-submit' . $matches[3] . '"' . $matches[4] . '>
                        ' . $matches[5] . '
                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none">
                            <path d="M14.6667 7.1665L18 10.4998M18 10.4998L14.6667 13.8332M18 10.4998L3 10.4998" stroke="white" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </button>';
                },
                $form
            );
            return $form;
        }
        add_filter('wpcf7_form_elements', 'add_svg_to_submit_button');

        function allow_svg_uploads($mimes)
        {
            $mimes['svg'] = 'image/svg+xml';
            return $mimes;
        }
        add_filter('upload_mimes', 'allow_svg_uploads');

        // Allow only for admins (optional, for security)
        function fix_svg_mime_type_check($data, $file, $filename, $mimes)
        {
            $ext = isset($data['ext']) ? $data['ext'] : '';
            if ('svg' === $ext) {
                $data['type'] = 'image/svg+xml';
                $data['ext']  = 'svg';
            }
            return $data;
        }
        add_filter('wp_check_filetype_and_ext', 'fix_svg_mime_type_check', 10, 4);

        add_action('wp_ajax_increment_book_stats', 'increment_book_stats');
        add_action('wp_ajax_nopriv_increment_book_stats', 'increment_book_stats');

        function increment_book_stats()
        {
            $file_id = absint($_POST['file_id']);
            $type    = sanitize_text_field($_POST['type']);

            if ($file_id && in_array($type, ['view', 'download'])) {
                $meta_key = $type === 'view' ? 'book_views' : 'book_downloads';
                $count    = get_post_meta($file_id, $meta_key, true);
                $count    = $count ? (int) $count + 1 : 1;
                update_post_meta($file_id, $meta_key, $count);
                wp_send_json_success(['count' => $count]);
            } else {
                wp_send_json_error();
            }
        }

        function enqueue_books_carousel_assets()
        {
            wp_enqueue_script('books-carousel', get_template_directory_uri() . '/js/books-carousel.js', ['jquery'], null, true);

            wp_localize_script('books-carousel', 'bookAjax', [
                'ajax_url' => admin_url('admin-ajax.php'),
            ]);
        }
        add_action('wp_enqueue_scripts', 'enqueue_books_carousel_assets');

        function register_video_post_type() {
            $labels = array(
                'name' => 'Videos',
                'singular_name' => 'Video',
                'menu_name' => 'Videos',
                'name_admin_bar' => 'Video',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Video',
                'new_item' => 'New Video',
                'edit_item' => 'Edit Video',
                'view_item' => 'View Video',
                'all_items' => 'All Videos',
                'search_items' => 'Search Videos',
                'parent_item_colon' => 'Parent Videos:',
                'not_found' => 'No videos found.',
                'not_found_in_trash' => 'No videos found in Trash.'
            );
        
            $args = array(
                'labels' => $labels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'show_in_menu' => true,
                'query_var' => true,
                'rewrite' => array('slug' => 'videos'),
                'capability_type' => 'post',
                'has_archive' => true,
                'hierarchical' => false,
                'menu_position' => null,
                'supports' => array('title', 'thumbnail')
            );
        
            register_post_type('video', $args);
        }
        add_action('init', 'register_video_post_type');
        

        function load_more_videos_ajax() {
            $paged = intval($_GET['page']);
            $args = [
                'post_type' => 'video',
                'posts_per_page' => 12,
                'paged' => $paged
            ];
            $query = new WP_Query($args);
        
            $html = '';
        
            if ($query->have_posts()):
                ob_start(); // Start capturing output
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
                      </div>
                    </div>
                    <?php
                endwhile;
                $html = ob_get_clean(); // Get captured HTML
            endif;
            wp_reset_postdata();
        
            // Return JSON: html + count
            wp_send_json([
                'html' => $html,
                'count' => $query->post_count, // Number of videos in this page
            ]);
        }
        add_action('wp_ajax_load_more_videos', 'load_more_videos_ajax');
        add_action('wp_ajax_nopriv_load_more_videos', 'load_more_videos_ajax');
         

        function search_videos_ajax() {
            $search = isset($_GET['search']) ? sanitize_text_field($_GET['search']) : '';
        
            $args = [
                'post_type' => 'video',
                'posts_per_page' => -1, // Show all results in search
                's' => $search
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
                      </div>
                    </div>
                    <?php
                endwhile;
            else:
                echo '<div class="col-12 text-center mt-4"><p style="color: #00A14B; font-weight: bold;">لا توجد نتائج</p></div>';
            endif;
        
            wp_reset_postdata();
            die();
        }
        add_action('wp_ajax_search_videos', 'search_videos_ajax');
        add_action('wp_ajax_nopriv_search_videos', 'search_videos_ajax');
        


        // Register Navigation Menus
        function register_my_menus() {
            register_nav_menus([
                'header-menu'      => __('Header Menu', 'main-theme'),
                'first-footer-menu' => __('First Footer Menu', 'main-theme'),
                'second-footer-menu' => __('Second Footer Menu', 'main-theme'),
            ]);
        }
        add_action('after_setup_theme', 'register_my_menus');
