<?php
		$args_p =array();$user_query='';		
		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Recent Professional','tiger'  );
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
			$args_p['post__in']=$post_ids_arr;

		}else{ 
			$args_p['number']=$number;
			$args_p['orderby']='rand';
		}
		$args_p['meta_query'] = array(
			'relation' => 'AND',
			array(
				'key'     => 'iv_member_type',
				'value'   => 'professional',
				'compare' => 'LIKE'
			),
			array(
					'key' => 'uou_tigerp_user_status',
					'value' => 'active',
					'compare' => '=',
					
				)						
		);
		 $user_query = new WP_User_Query( $args_p );
?>
<div class="col-md-3 col-sm-6">
			<h5 ><?php echo esc_attr($title); ?> </h5>

		<?php

			if ( ! empty( $user_query->results ) ) {
				   foreach ( $user_query->results as $user ) {
					
					$iv_profile_pic_url=get_user_meta($user->ID, 'iv_profile_pic_url',true);					
					$reg_page_user='';
					$user_type= get_user_meta($user->ID,'iv_member_type',true);
					if($iv_profile_pic_url==''){
					 $iv_profile_pic_url=tiger_IMAGE.'Blank-Profile.jpg';
					}
					$iv_redirect_user = get_option( '_iv_personal_profile_public_page');
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
							<?php echo substr(get_user_meta($user->ID,'designation',true), 0, 25 );  ?>
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


