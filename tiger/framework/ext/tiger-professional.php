<?php

class professional_latest extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'tiger_widget_recent_entries', 'description' => esc_html__( "Recent Professional",'tiger' ) );
        parent::__construct('professional_latest', esc_html__('Recent Professional','tiger' ), $widget_ops);
        $this->alt_option_name = 'xxl_widget_recent_entries';

      
    }

    public function widget($args, $instance) {

        $cache = wp_cache_get('professional_latest_widget', 'widget');

        if ( !is_array($cache) )
            $cache = array();

        if ( ! isset( $args['widget_id'] ) )
            $args['widget_id'] = $this->id;

        if ( isset( $cache[ $args['widget_id'] ] ) ) {
            echo esc_attr($cache[ $args['widget_id']]);
            return;
        }

        ob_start();
        extract($args);

        //echo apply_filters( 'Social_before',  $args['before_widget'] );
       
		include( get_template_directory(). '/framework/ext/widget-latest-professional.php' ); 
		
		
        wp_cache_set('professional_latest_widget', $cache, 'widget');

    }

    function update( $new_instance, $old_instance ) {

        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['words'] = strip_tags($new_instance['words']);       
        $instance['number'] = (int) $new_instance['number'];
        $instance['display_option'] ='list'; //strip_tags($new_instance['display_option']);
	  	$instance['type'] = strip_tags($new_instance['type']);
	  	$instance['post_ids'] = strip_tags($new_instance['post_ids']);
       echo  $new_instance['display_option'];
        
        $this->flush_widget_cache_tiger();

        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['widget_recent_entries']) )
            delete_option('widget_recent_entries');

        return $instance;
    }

    function flush_widget_cache_tiger() {

        wp_cache_delete('professional_latest_widget', 'widget');

    }

    public function form( $instance ) {

        $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : esc_html__('Recent Professional','tiger'  ); 
        $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 3;
        $words    = isset( $instance['words'] ) ? absint( $instance['words'] ) : 15;
        

    ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e( 'Title:','tiger'  ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e( 'Number of posts to show:','tiger'  ); ?></label>
            <input id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr($number); ?>" size="3" />
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('words')); ?>"><?php esc_html_e( 'Words of words to be displayed:','tiger'  ); ?></label>
            <input id="<?php echo esc_attr($this->get_field_id('words')); ?>" name="<?php echo esc_attr($this->get_field_name('words')); ?>" type="text" value="<?php echo esc_attr($words); ?>" size="3" />
        </p>        
		
		
		<p><label for="<?php echo esc_attr($this->get_field_id('post_ids')); ?>"><?php esc_html_e('Only Display Ids ', 'ivproperty'); ?>:</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('post_ids')); ?>" name="<?php echo esc_attr($this->get_field_name('post_ids')); ?>" type="text" value="<?php echo esc_attr(strip_tags((isset($instance['post_ids'])? $instance['post_ids']:''))); ?>" placeholder="<?php esc_html_e('Enter IDs by , [# of post will not work]', 'tiger'); ?>"/>	
		</p>
    <?php
    }
}

add_action('widgets_init', 'professional_latest');

function professional_latest(){

    register_widget('professional_latest');

}
