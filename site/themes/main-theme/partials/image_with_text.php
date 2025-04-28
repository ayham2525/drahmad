 <?php if(get_sub_field('visible')):
  //$background_color = get_sub_field(selector: 'background_color') ?: '#FFFFFF';
  //$text_color = get_sub_field('text_color') ?: '#4D4D4D';
  ?>
 <section class="image_with_text py-5">
     <div class="container">
         <div class="row">
             <div class="col-sm-12 col-md-6 order-md-last">
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
                 <div class="text-container">
                     <?php if(get_sub_field('text')):?>
                     <div class="text pb-5" >
                        <i class="fa fa-quote-right quote-icon start"></i>
                            <?php echo get_sub_field('text');?>
                        <i class="fa fa-quote-left quote-icon end"></i>
                     </div>
                     <?php endif;?>
                     <?php if(get_sub_field('small_text')):?>
                     <div class="small_text pt-3">
                         <?php echo get_sub_field('small_text');?></div>
                     <?php endif;?>
                 </div>
             </div>
         </div>
     </div>

 </section>

 <?php endif;?>