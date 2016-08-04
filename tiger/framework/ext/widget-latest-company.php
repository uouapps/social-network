<?php


//wp_enqueue_style('uou_tigerp-style-64', wp_uou_tigerp_URLPATH . 'assets/cube/css/cubeportfolio.css');
//wp_enqueue_style('uou_tigerp-style-66', tiger_CSS . 'widget.css');

		$args_c =array();$user_query_c='';
		$display_option ='list';// (isset($instance['display_option'])? $instance['display_option']:'list');
		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Recent Company','tiger'  );

        $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 3;
        if ( ! $number ){
            $number = 3;
        }
        $words = ( ! empty( $instance['words'] ) ) ? absint( $instance['words'] ) : 15;
        if ( ! $words ){
            $words = 15;
       }

		$post_ids=(isset($instance['post_number'])? $instance['post_ids']:'');
		
		if($post_ids!=""){
			$post_ids_arr=explode(",",$post_ids);
			$args_c['post__in']=$post_ids_arr;

		}else{ 
			$args_c['number']=$number;
			$args_c['orderby']='rand';
		}
		$args_c['meta_query'] = array(
			'relation' => 'AND',
			array(
				'key'     => 'iv_member_type',
				'value'   => 'corporate',
				'compare' => 'LIKE'
			),
			array(
				'key' => 'uou_tigerp_user_status',
				'value' => 'active',
				'compare' => '=',
				
			)						
		);

		 $user_query_c = new WP_User_Query( $args_c );


?>
<div class="col-md-3 col-sm-6">
	 <h5 ><?php echo esc_attr($title); ?> </h5>

		<?php

			if ( ! empty( $user_query_c->results ) ) {
				   foreach ( $user_query_c->results as $user ) {
					
					$iv_profile_pic_url=get_user_meta($user->ID, 'iv_profile_pic_url',true);					
					$reg_page_user='';
					$user_type= get_user_meta($user->ID,'iv_member_type',true);
					if($iv_profile_pic_url==''){
					 $iv_profile_pic_url=tiger_IMAGE.'avatar-profile.jpg';
					}
					$iv_redirect_user = get_option( '_iv_corporate_profile_public_page');
					$reg_page_user= get_permalink( $iv_redirect_user) ;
			 ?>
			 <div class="margin-top parent-listing" >
				 <div class="widget_right" >
						 <div class="blog-posts" >
							 <p>
								<a href="<?php echo $reg_page_user.'?&id='.$user->user_login; ?>" >								 
								 <?php echo substr(get_user_meta($user->ID,'profile_name',true), 0, $words); ?>
								 </a>
							 </p>
						</div>
						<span class="cbp-l-grid-projects-desc">
							<?php //echo esc_attr(get_the_date('F j, Y')); ?>

						</span>

					</div>
					 <div class="widget_left"  >
						 	<a href="<?php echo $reg_page_user.'?&id='.$user->user_login; ?>">
						
						<img  class="image-80" src="<?php echo  $iv_profile_pic_url;?>" alt="<?php esc_html_e( 'image', 'tiger' ); ?>">
						
						</a>

					</div>
			 </div>

		<?php

		}
	}	
		?>

 </div>


