<?php if(get_sub_field('visible')): 
  //$background_color = get_sub_field('background_color') ?: '#FFFFFF';
  $text_color = get_sub_field('text_color') ?: '#FFFFFF';
  $title_color = get_sub_field('title_color') ?: '#4D4D4D';
  ?>
  <section class="show_articles py-5" id="home-articles">
      <div class="container">
          <div class="row pb-5">
              <div class="col-12">
                  <?php if(get_sub_field('text')):?>
                      <h2><?php echo get_sub_field('text');?></h2>
                      <div class="section-accent-line mt-3 mb-4"></div>
                      <?php endif;?>
              </div>
          </div>

          <div class="row">
              <div class="col-12">
                  <div id="posts-carousel" class="owl-carousel owl-theme">
                      <?php
                      // Query to get 4 posts
                      $posts = get_posts([
                          'numberposts' => 4, // 4 posts
                          'post_status' => 'publish'
                      ]);

                      // Loop through the posts
                      foreach ($posts as $post):
                          setup_postdata($post);
                      ?>
                          <div class="item">
                              <div class="post-card">
                                  <!-- Make the entire card clickable -->
                                  <a href="<?php the_permalink(); ?>" class="post-link">
                                      <!-- Display Post Image (if it exists) -->
                                      <?php if(has_post_thumbnail()): ?>
                                          <div class="post-image">
                                              <?php the_post_thumbnail('full', ['class' => 'img-fluid']); ?>
                                          </div>
                                      <?php endif; ?>
                                  
                                      <!-- Post Title and Date (positioned at the bottom) -->
                                      <div class="post-info">
                                      <p class="post-date" style="color:<?php echo $text_color;?>;"><?php echo get_the_date(); ?></p>

                                          <h5 class="post-title" style="color:<?php echo $text_color;?>;"><?php the_title(); ?></h5>
                                      </div>
                                  </a>
                              </div>
                          </div>
                      <?php endforeach; wp_reset_postdata(); ?>
                  </div>
              </div>
          </div>
          <div class="svg-container">
                    <!-- Previous Button -->
                    <button class="our_partners-prev-btn">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g>
                                <path d="M6.33333 7.59009L3 10.9234M3 10.9234L6.33333 14.2568M3 10.9234L18 10.9234"
                                    stroke="#FFFFFF" stroke-linecap="round" stroke-linejoin="round" />
                            </g>
                        </svg>
                    </button>

                    <!-- Next Button -->
                    <button class="our_partners-next-btn">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g>
                                <path d="M14.6667 7.59009L18 10.9234M18 10.9234L14.6667 14.2568M18 10.9234L3 10.9234"
                                    stroke="#FFFFFF" stroke-linecap="round" stroke-linejoin="round" />
                            </g>
                        </svg>
                    </button>
          </div>
      </div>
  </section>
<?php endif; ?>
