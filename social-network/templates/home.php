<?php
/**
 * Template Name: Home Page
 *
 */
 ?>
<?php get_header(); ?>
<?php
wp_enqueue_style('iv_directories-owlcarousel', SB_CSS . 'owl.carousel.css');
wp_enqueue_style('iv_directories-copywriter', SB_CSS . 'copywriter-style.css');
wp_enqueue_style('iv_directories-creative', SB_CSS . 'creative-style.css');
wp_enqueue_style('iv_directories-profile', SB_CSS . 'user-public-profile.css');
?>

<div id="main-wrapper"> 

  <!-- HOME PRO-->
  <div class="home-pro"> 
    
    <!-- PRO BANNER HEAD -->
    <div class="banr-head">
      <div class="container">
        <div class="row"> 
          
          <!-- CONTENT -->
          <div class="col-sm-7">
            <div class="text-area">
              <div class="position-center-center col-md-10">
                <h1> Here comes the social networking platform that you’ve been waiting</h1>
                <h6>This is Photoshop's version  of Lorem Ipsum proin venin
                  consequat veniam.</h6>
              </div>
            </div>
          </div>
          
          <!-- FORM SECTION -->
          <div class="col-sm-5">
            <div class="login-sec"> 
              
              <!-- TABS -->
              <div class="uou-tabs">
                <ul class="tabs">
                  <li><a href="#register">Register Now</a></li>
                  <li class="active"><a href="#log-in">Member Login</a></li>
                </ul>
                
                <!-- REGISTER -->
                <div class="content">
                  <div id="register">
                    <form>
                      <input type="text" placeholder="Full Name">
                      <input type="email" placeholder="Email Address">
                      <input type="text" placeholder="Phone">
                      <input type="password" placeholder="Password">
                      <button type="submit">Register</button>
                      <div class="login-with"> <span>Or login with:</span> <a href="#."><i class="fa fa-facebook"></i></a> <a href="#."><i class="fa fa-google"></i></a> <a href="#."><i class="fa fa-linkedin"></i></a> </div>
                    </form>
                  </div>
                  
                  <!-- LOGIN -->
                  <div id="log-in"  class="active">
                    <form>
                      <input type="email" placeholder="Email Address">
                      <input type="password" placeholder="Password">
                      <button type="submit">Login</button>
                      <div class="login-with"> <span>Or login with:</span> <a href="#."><i class="fa fa-facebook"></i></a> <a href="#."><i class="fa fa-google"></i></a> <a href="#."><i class="fa fa-linkedin"></i></a> </div>
                      <div class="forget">Forgot your password? <a href="#."> Click Here</a></div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- SERVICES -->
    <section class="services"> 
      
      <!-- SERVICES ROW -->
      <ul class="row">
        
        <!-- SECTION -->
        <li class="col-md-4">
          <div class="ser-inn">
            <h4>Stay in touch with your
              colleagues</h4>
            <i class="fa fa-globe"></i>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue conseqaut nibbhi ellit ipsum consectetur.</p>
          </div>
        </li>
        
        <!-- SECTION -->
        <li class="col-md-4">
          <div class="ser-inn">
            <h4>Get the latest news
              in your industry</h4>
            <i class="fa fa-book"></i>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue conseqaut nibbhi ellit ipsum consectetur.</p>
          </div>
        </li>
        
        <!-- SECTION  -->
        <li class="col-md-4">
          <div class="ser-inn">
            <h4>Share what’s up
              with you</h4>
            <i class="fa fa-picture-o"></i>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue conseqaut nibbhi ellit ipsum consectetur.</p>
          </div>
        </li>
      </ul>
    </section>
    
    <!-- PRO SECTION -->
    <section class="pro-content">
      <div class="container-fluid">
        <div class="row"> 
          
          <!-- PRO IMAGE -->
          <div class="col-md-6 pro-inside" style="background:url(<?php echo SB_IMAGE;?>pro-img-1.jpg) center center no-repeat;"></div>
          
          <!-- PRO CONTENT -->
          <div class="col-md-6 pro-inside">
            <div class="position-center-center col-md-6">
              <h1>Interact with other
                professionals</h1>
              <p> Sed ut perspiciatis unde omnis iste natus error sit voluptatem 
                accusantium doloremque laudantium, totam rem aperiam, 
                eaque ipsa quae ab illo inventore veritatis et quasi architecto 
                beatae vitae dicta sunt explicabo. </p>
            </div>
          </div>
        </div>
      </div>
      
      <!-- PRO SECTION -->
      <div class="container-fluid">
        <div class="row"> 
          
          <!-- PRO TEXT -->
          <div class="col-md-6 pro-inside">
            <div class="position-center-center col-md-6">
              <h1>Collaborate on a
                project</h1>
              <p> Sed ut perspiciatis unde omnis iste natus error sit voluptatem 
                accusantium doloremque laudantium, totam rem aperiam, 
                eaque ipsa quae ab illo inventore veritatis et quasi architecto 
                beatae vitae dicta sunt explicabo. </p>
            </div>
          </div>
          
          <!-- PRO BACKGROUND -->
          <div class="col-md-6 pro-inside" style="background:url(<?php echo SB_IMAGE;?>pro-img-2.jpg) center center no-repeat;"></div>
        </div>
      </div>
    </section>
    
    <!-- APP IMAGE -->
    <section class="app-images">
      <div class="container">
        <div class="row"> 
          
          <!-- TEXT -->
          <div class="col-md-6 text-center text-area">
            <h1>SocialMe for your 
              Smartphone</h1>
            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem 
              accusantium doloremque laudantium, totam rem aperiam, 
              eaque ipsa quae ab illo inventore veritatis et quasi architecto 
              beatae vitae dicta sunt explicabo. </p>
            <a href="#."><i class="fa fa-apple"></i> App Store</a> </div>
          
          <!-- APP IMAGE -->
          <div class="col-md-6 text-right"><img src="<?php echo SB_IMAGE;?>app-img.png" alt="" > </div>
        </div>
      </div>
    </section>
    
    <!-- TESTIMONIALS -->
    <section class="clients-says">
      <div class="container">
        <h3 class="section-title">what our users say </h3>
        <div class="testi">
          <div class="texti-slide"> 
            <!-- SLide -->
            <div class="clints-text">
              <div class="text-in">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue.</p>
              </div>
              <div class="avatar">
                <div class="media-left"> <a href="#."> <img src="<?php echo SB_IMAGE;?>clients-avatar-1.jpg" alt=""> </a> </div>
                <div class="media-body">
                  <h6>John Kevin Mara</h6>
                  <span>smashingmagazine.com</span> </div>
              </div>
            </div>
            
            <!-- SLide -->
            <div class="clints-text">
              <div class="text-in">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue.</p>
              </div>
              <div class="avatar">
                <div class="media-left"> <a href="#."> <img src="<?php echo SB_IMAGE;?>clients-avatar-1.jpg" alt=""> </a> </div>
                <div class="media-body">
                  <h6>John Kevin Mara</h6>
                  <span>smashingmagazine.com</span> </div>
              </div>
            </div>
            
            <!-- SLide -->
            <div class="clints-text">
              <div class="text-in">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue.</p>
              </div>
              <div class="avatar">
                <div class="media-left"> <a href="#."> <img src="<?php echo SB_IMAGE;?>clients-avatar-1.jpg" alt=""> </a> </div>
                <div class="media-body">
                  <h6>John Kevin Mara</h6>
                  <span>smashingmagazine.com</span> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <!-- sponsors -->
    <div class="sponsors has-bg-image" data-bg-color="f5f5f5">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h3 class="section-title">Our Sponsors</h3>
            <div class="sponsors-slider">
              <div class="item"><img src="<?php echo SB_IMAGE;?>sponsor_logo1.png" alt="" class="img-responsive"></div>
              <div class="item"><img src="<?php echo SB_IMAGE;?>sponsor_logo2.png" alt="" class="img-responsive"></div>
              <div class="item"><img src="<?php echo SB_IMAGE;?>sponsor_logo3.png" alt="" class="img-responsive"></div>
              <div class="item"><img src="<?php echo SB_IMAGE;?>sponsor_logo4.png" alt="" class="img-responsive"></div>
              <div class="item"><img src="<?php echo SB_IMAGE;?>sponsor_logo5.png" alt="" class="img-responsive"></div>
              <div class="item"><img src="<?php echo SB_IMAGE;?>sponsor_logo6.png" alt="" class="img-responsive"></div>
              <div class="item"><img src="<?php echo SB_IMAGE;?>sponsor_logo4.png" alt="" class="img-responsive"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php get_footer();

