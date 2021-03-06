<?php $tiger_option_data =get_option('tiger_option_data');   ?>


<?php if(isset($tiger_option_data['tiger-blog-switch']) && ($tiger_option_data['tiger-blog-switch']==1)){?>

<?php if(isset($tiger_option_data['tiger-multi-blog-image'])&&($tiger_option_data['tiger-multi-blog-image']==1)){?>
<?php get_header(); ?>


  <div class="blog-content pt60">
    <div class="container">
      <div class="row">
        <div class="col-md-9">

            <?php if(have_posts()) : while(have_posts()): the_post(); ?>
                <?php get_template_part( 'templates/blog/content-list', get_post_format() ); ?>
            <?php endwhile; else : ?>
                <h5><?php esc_html_e( 'Sorry ! no blog post found ', 'tiger' ); ?></h5>
            <?php endif; ?>

  <?php if (function_exists("wp_pagination")) {
    wp_pagination();
} ?>


        </div> <!--  end blog-single -->

<!--  Start Sidebar ** -->

         <!-- SIDEBAR : begin -->  

        <div class="col-md-3">
          <div class="uou-sidebar">

            <?php if ( is_active_sidebar( 'mainsidebar' ) ) : ?>
                  
              <?php dynamic_sidebar( 'mainsidebar' ); ?>
                  
            <?php else : ?>
              <div class="alert alert-message">
              
                <p><?php esc_html_e("Please activate some Widgets","tiger"); ?></p>
              
                </div>

            <?php endif; ?>

             </div>
            </div>
          <!-- SIDEBAR : end -->
<!--  End Sidebar ** -->
      </div> <!-- end of row -->
  </div> <!-- end container -->
</div> <!-- end blog-content -->
<!-- ********* end of Blog - post  -->
<?php get_footer(); ?>
      <?php } ?>


<?php if(isset($tiger_option_data['tiger-multi-blog-image'])&&($tiger_option_data['tiger-multi-blog-image']==2)){?>
<?php get_header(); ?>
  <div class="blog-content pt60">
    <div class="container">
      <div class="row">
        <div class="col-md-9">
           <div class="row"> 

            <?php if(have_posts()) : while(have_posts()): the_post(); ?>
              <div class = "col-sm-4">
                
                <?php get_template_part( 'templates/blog/content-grid', get_post_format()); ?> 
              </div>
            <?php endwhile; else : ?>
                <h5><?php esc_html_e( 'Sorry ! no blog post found ', 'tiger' ); ?></h5>
            <?php endif; ?>

    </div>
<!--  start pagination * -->
  <?php if (function_exists("wp_pagination")) {
    wp_pagination();
} ?>
<!--  End of pagination * -->

        </div> <!--  end blog-single -->

<!--  Start Sidebar ** -->

         <!-- SIDEBAR : begin -->  

        <div class="col-md-3">
          <div class="uou-sidebar">

            <?php if ( is_active_sidebar( 'mainsidebar' ) ) : ?>
              <?php dynamic_sidebar( 'mainsidebar' ); ?>
            <?php else : ?>
              <div class="alert alert-message">
                <p><?php esc_html_e("Please activate some Widgets","tiger"); ?></p>
                </div>
            <?php endif; ?>
             </div>
            </div>
          <!-- SIDEBAR : end -->
<!--  End Sidebar ** -->
      </div> <!-- end of row -->
  </div> <!-- end container -->
</div> <!-- end blog-content -->
<!-- ********* end of Blog - post  -->
<?php get_footer(); ?>
<?php } ?>

<?php if(isset($tiger_option_data['tiger-multi-blog-image'])&&($tiger_option_data['tiger-multi-blog-image']==3)){?>
<?php get_header(); ?>
  <div class="blog-content pt60">
    <div class="container">
      <div class="row">
        <div class="col-md-12">

            <?php if(have_posts()) : while(have_posts()): the_post(); ?>
                
                <?php get_template_part( 'templates/blog/content-listNS', get_post_format()); ?>
            <?php endwhile; else : ?>
                <h5><?php esc_html_e( 'Sorry ! no blog post found ', 'tiger' ); ?></h5>
            <?php endif; ?>

      <!--  start pagination * -->
        <?php if (function_exists("wp_pagination")) {
          wp_pagination();
      } ?>
      <!--  End of pagination * -->
        </div> <!--  end blog-single -->
      </div> <!-- end of row -->
  </div> <!-- end container -->
</div> <!-- end blog-content -->
<!-- ********* end of Blog - post  -->
<?php get_footer(); ?>
<?php } ?>

<?php if(isset($tiger_option_data['tiger-multi-blog-image'])&&($tiger_option_data['tiger-multi-blog-image']==4)){?>
<?php get_header(); ?>
  <div class="blog-content pt60">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="row"> 

            <?php if(have_posts()) : while(have_posts()): the_post(); ?>
            <div class = "col-sm-4">
               
              <?php get_template_part( 'templates/blog/content-gridNS', get_post_format()); ?> 
            </div> 
                
            <?php endwhile; else : ?>
                <h5><?php esc_html_e( 'Sorry ! no blog post found ', 'tiger' ); ?></h5>
            <?php endif; ?>
          </div>

      <!--  start pagination * -->
        <?php if (function_exists("wp_pagination")) {
          wp_pagination();
      } ?>
      <!--  End of pagination * -->
        </div> <!--  end blog-single -->
      </div> <!-- end of row -->
  </div> <!-- end container -->
</div> <!-- end blog-content -->
<!-- ********* end of Blog - post  -->
<?php get_footer(); ?>
<?php } ?>

<?php } ?>