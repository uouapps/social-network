<?php
 global $chameleon_option_data;
 $my_profile= get_option('_iv_directories_profile_page');
 $register= get_option('_iv_directories_registration'); 
 
  if(isset($chameleon_option_data['chameleon-login-option']) && $chameleon_option_data['chameleon-login-option'] == 1) : ?>
  <?php $current_user = wp_get_current_user(); ?> 
  <?php if(is_user_logged_in()){ ?>
    <ul class="authentication">
      <li>
        <a href="<?php echo esc_url(home_url('/')); ?>" > <i class="fa fa-user"></i> <?php echo esc_attr($current_user->user_login ); ?></a>
        <div class="login-reg-popup">
          <ul class = "list-unstyled">
            <li><a href="<?php echo esc_url( get_page_link($my_profile)); ?>" > <i class="fa fa-edit"></i> <?php esc_html_e( '&nbsp;Profile &nbsp;' , 'chilepro' ); ?></a>  </li>
            <li><a href="<?php echo esc_url(wp_logout_url( home_url('/') )); ?>" > <i class="fa fa-power-off"></i> <?php esc_html_e( 'Logout' , 'chilepro' ); ?></a> </li>
          </ul>
        </div>
      </li>
    </ul> 
      
  <?php } else { ?>  


    <ul class="authentication">
      <li> <a href="#">Login</a>
        <div class="login-reg-popup">

          <form name="loginform" id="loginform" class="default-form" action="<?php echo esc_url(home_url('/').'/wp-login.php'); ?>" method="post">
              <input type="text" name="log" id="user_login"  value="" size="20" placeholder="User name">
              <input type="password" name="pwd" id="user_pass"  value="" size="20" placeholder="Password">
              <input type="submit" name="wp-submit" id="wp-submit" value = "Log In"  class="btn btn-primary">
              <input type="hidden" name="redirect_to" value="<?php echo esc_url(home_url('/')); ?>">
              <input type="hidden" name="testcookie" value="1">

               <label for="rememberme"> 
                <input name="rememberme" type="checkbox" id="rememberme" value="forever"> <?php esc_html_e( 'Remember Me' , 'chilepro' ); ?> 
               </label> 
          </form>
        </div>
      </li>

      <li><a href="<?php echo esc_url( get_page_link($register)); ?>" >Register</a>
      
       
      </li>
    </ul> 


  <?php } ?>


<?php endif; ?>
<!-- End Header-Login -->
