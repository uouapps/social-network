<?php get_header(); ?>
<?php 
global $chameleon_option_data;
?>

<!-- SIngle page code **************************************************************************** -->

  <div class="blog-content pt60">
    <div class="container">
      <div class="row">
        <div class="col-md-9">

                <?php if (have_posts()) :while ( have_posts() ) : the_post(); ?>
                    <article <?php post_class( 'uou-block-7f blog-post-content'); ?> id="post-<?php the_ID(); ?>" >
                      <?php 
                      if ( has_post_thumbnail() ) {
                        $image_id =  get_post_thumbnail_id( get_the_ID() );
                        $large_image = wp_get_attachment_url( $image_id ,'full');  
                        $resize = chameleon_aq_resize( $large_image, true );
                       ?>
                      <img src="<?php echo esc_url($resize); ?>" alt="">
                      <?php } ?>


                      <div class="meta">
                         <span class="time-ago"><a href = "<?php the_permalink(); ?>" ><i class="fa fa-clock-o"></i> <?php echo esc_attr(human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'); ?></a></span>
                        <span class="category">
                        <?php if(has_category()): ?>
                          
                            <i class="fa fa-sitemap"></i>
                            <?php the_category('&nbsp;,&nbsp;'); ?>
                          
                        <?php endif; ?>
                        </span>
                        <span class="author">
                          <i class="fa fa-user"></i>
                          <?php esc_url(the_author_posts_link()); ?>
                        </span>
                        <span class="comments">
                          <i class="fa fa-comments"></i>
                          <?php 
                            if(comments_open() && !post_password_required()){
                              comments_popup_link( 'No comment', '1 comment', '% comments', 'article-post-meta' );
                            }
                          ?>            
                        </span>
                      </div>

                     <h4 class = "blog-title-heading"><?php the_title(); ?></h4>
                      <div class = "content-show"> <?php the_content(); ?> </div>
                      <div class = "meta">
                        <?php if(has_tag()) { ?>
                          <span class="category">
                            <i class="fa fa-tags"></i>
                            <?php the_tags( 'Tags: &nbsp; ', ', ', '<br />' ); ?>
                          </span>
                        <?php } else { ?> <i class="fa fa-tags"></i> <?php esc_html_e('No Tag have Found!', 'chilepro'); } ?>
                      </div>

                      <?php endwhile; else : ?>
                        <?php esc_html_e('No post have found!', 'chilepro'); ?> 
                      <?php endif; ?>


                      <div class="uou-share-story clearfix">
                        <div class="row">
                          <div class="col-sm-3">
                            <h5 class="sidebar-title">Share This Story</h5>
                          </div>


                            <div class="col-sm-9 ">
                              <div class="social-widget">
                                <div class="uou-block-4b">

                                <!-- Start Post-Share -->
                                <?php if(isset($chameleon_option_data['chameleon-share-button']) && $chameleon_option_data['chameleon-share-button'] == 1) : ?>
                                  <ul class="social-icons">
                                    <?php if(isset($chameleon_option_data['chameleon-share-button-facebook']) && $chameleon_option_data['chameleon-share-button-facebook'] == 1) : ?>
                                    <li><a  href="http://www.facebook.com/sharer.php?u=<?php home_url('/');?> "><i class="fa fa-facebook"></i></a></li>
                                    <?php endif; ?>
                                    <?php if(isset($chameleon_option_data['chameleon-share-button-twitter']) && $chameleon_option_data['chameleon-share-button-twitter'] == 1) : ?>
                                    <li><a  href="http://twitthis.com/twit?url=<?php home_url('/'); ?>"><i class="fa fa-twitter"></i></a></li>
                                    <?php endif; ?>
                                    <?php if(isset($chameleon_option_data['chameleon-share-button-linkedin']) && $chameleon_option_data['chameleon-share-button-linkedin'] == 1) : ?>
                                    <li><a href="http://www.linkedin.com/shareArticle??url=<?php home_url('/');?>"><i class="fa fa-linkedin"></i></a></li>
                                    <?php endif; ?>
                                    <?php if(isset($chameleon_option_data['chameleon-share-button-pinterest']) && $chameleon_option_data['chameleon-share-button-pinterest'] == 1) : ?>
                                    <li><a href="http://www.pinterest.com/shareArticle??url=<?php home_url('/');?>"><i class="fa fa-pinterest"></i></a></li>
                                    <?php endif; ?>
                                    <?php if(isset($chameleon_option_data['chameleon-share-button-envelope']) && $chameleon_option_data['chameleon-share-button-envelope'] == 1) : ?>
                                    <li><a href="http://www.envelopes.com//shareArticle??url=<?php home_url('/');?>"><i class="fa fa-envelope"></i></a></li>
                                    <?php endif; ?>
                                  </ul>
                          
                                <?php endif; ?>

                                </div> <!-- end .uou-block-4b -->
                              </div> <!-- end social widget -->
                            </div>
                          </div>
                        </div>
                          <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary ">Back To Home</a>
                  </article>
				
				<?php
				if(comments_open()) {
				?>
				<div class="row">
					<div class="col-md-12">			
						<div class="uou-post-comment"> 
							   <aside class="uou-block-14a">
								  <h5><?php _e('Comments','comments');?> 
								   <?php 
											if(comments_open() && !post_password_required()){
											  comments_popup_link( '(0)', '(1)', '(%)', 'article-post-meta' );
											}
									?> 
									   
								  </h5>          
								   <?php comments_template('', true); ?>
								</aside>
						</div> <!-- end of comment -->
					</div>
				 </div> 			
			
				<?php
					}
				?>
              
              
						
          </div> <!--  end blog-single -->

<!-- ************************** Start Sidebar **************************** -->


            <div class="col-md-3">
              <div class="uou-sidebar pt40">

            <?php if ( is_active_sidebar( 'mainsidebar' ) ) : ?>
                  
              <?php dynamic_sidebar( 'mainsidebar' ); ?>
                  
            <?php else : ?>
				<div class="alert alert-message">              
					<p><?php esc_html_e("Please activate some Widgets","chilepro"); ?></p>              
                </div>

            <?php endif; ?>

             </div>
            </div>
            

<!-- ************************** End Sidebar **************************** -->
        </div>
      </div> <!--  end blog-single -->
    </div> <!-- end container -->



<?php get_footer(); ?>
