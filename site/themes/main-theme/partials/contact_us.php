<?php if (get_sub_field('visible')): ?>
<section class="contact_us  py-5">
  <div class="container">
    <div class="row">
    <div class="col-sm-12 col-md-6">
    <?php if(get_sub_field('image')):?>
        <?php  
                     $src = null;
                     $image = get_sub_field('image'); 
                     $image_src = wp_get_attachment_image_src( $image, 'large' );

                     $img = $image_src[0]; ?>
        <img class="img-fluid" src="<?php echo $img;?>">
        <?php endif;?>
    </div>
      <div class="col-sm-12 col-md-6">
      <?php if(get_sub_field('title')):?>
          <h1 class="title mb-4"><?php echo get_sub_field('title'); ?></h1>
          <div class="section-accent-line mt-3 mb-4"></div>
        <?php endif; ?>
        <div class="form-container">
            <?php if(get_sub_field('form_code')):?>
                <?php echo do_shortcode(get_sub_field('form_code'));?>
            <?php endif;?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>
