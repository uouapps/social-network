<?php
global $post,$wpdb;

		$id=$_GET['id'];
		$post_id_1 = get_post($id);
		$post_id_1->post_title;
		$currentCategory=wp_get_object_terms( $id, 'doctor-category');
		$cat_link='';$cat_name='';$cat_slug='';
		if(isset($currentCategory[0]->slug)){										
			$cat_slug = $currentCategory[0]->slug;
			$cat_name = $currentCategory[0]->name;						
			$cat_link= get_term_link($currentCategory[0], 'doctor-category');						
		}
		
?>

<div class="cbp-l-inline">
    <div class="cbp-l-inline-left">       
	   <?php
	   if(has_post_thumbnail($id)){		
			echo get_the_post_thumbnail($id, 'large');		
		}else{
			?>							
			<img   src="<?php echo  wp_iv_directories_URLPATH."/assets/images/default-doctor.jpg";?>">			 
		<?php
		}	
	   ?>
    </div>

    <div class="cbp-l-inline-right">
        <div class="cbp-l-inline-title"><?php echo $post_id_1->post_title; ?></div>
        <div class="cbp-l-inline-subtitle"><?php echo $cat_name; ?></div>      

        <div class="cbp-l-inline-desc">
			<?php  
			echo $post_id_1->post_content;
			?>
				
		</div>

        <a href="<?php echo get_permalink($id);  ?>"  class="cbp-l-inline-view"><?php esc_html_e('MORE DETAIL','chilepro'); ?></a>
    </div>
</div>
