<?php if (get_sub_field('visible')): ?>
<section class="title_with_text  py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12">
        <?php if(get_sub_field('title')):?>
          <h1 class="title mb-4"><?php echo get_sub_field('title'); ?></h1>
          <div class="section-accent-line mt-3 mb-4"></div>
        <?php endif; ?>
        <?php if(get_sub_field('text')):?>
          <div class="text-content"><?php echo get_sub_field('text'); ?></div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>
