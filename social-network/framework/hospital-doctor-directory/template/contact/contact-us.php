<form  name="chilepro_contact" id="chilepro_contact"  class="form-horizontal"  role="form">
							<div class="form-group row"  >
								<label for="text" class="col-md-12 control-label"><?php  _e('Name:','chilepro');?><span class="chili"></span></label>
								<div class="col-md-12">
									<input type="text"  name="contact_name" id="contact_name"   data-validation="required" data-validation-error-msg="<?php  esc_html_e(' Please Enter Your Name','chilepro');?>" class="form-control ctrl-textbox" placeholder="<?php esc_html_e( 'Enter your name', 'chilepro' ); ?>"  alt="required">

								</div>
							</div>

						<div class="form-group row">
							<label for="email" class="col-md-12 control-label" ><?php  esc_html_e('Email:','chilepro');?><span class="chili"></span></label>
							<div class="col-md-12">
								<input type="email" name="contact_email" id="contact_email" data-validation="email"  class="form-control ctrl-textbox" placeholder="<?php esc_html_e( 'Enter your email', 'chilepro' ); ?>" data-validation-error-msg="<?php  esc_html_e('Please enter a valid email address','chilepro');?> " >
							</div>
						</div>
						<div class="form-group row"  >
								<label for="text" class="col-md-12 control-label"><?php  esc_html_e('Subject:','chilepro');?><span class="chili"></span></label>
								<div class="col-md-12">
									<input type="text"  name="contact_subject"  class="form-control ctrl-textbox" placeholder="<?php esc_html_e( 'Enter subject', 'chilepro' ); ?>"  alt="required">

								</div>
						</div>
						<div class="form-group row"  >
								<label for="text" class="col-md-12 control-label"><?php  _e('Message:','chilepro');?><span class="chili"></span></label>
								<div class="col-md-12">
									<textarea id="contact_content" name="contact_content" class="form-control" placeholder="<?php esc_html_e( 'Enter message', 'chilepro' ); ?>" data-validation="required"></textarea>

								</div>
						</div>



						<div class="row">

								<div class="col-md-12 text-left">
									<button type="submit" class="btn-new btn-custom full-width" > <?php esc_html_e( 'Submit', 'chilepro' ); ?></button>
									 <div id="update_message">	</div>

								</div>
						</div>
</form>
<?php
wp_enqueue_script('iv_directories-script-contact', wp_iv_directories_URLPATH . 'admin/files/js/jquery.form-validator.js');
wp_enqueue_script( 'contact-us-js', SB_JS.'contact-us.js', array('jquery'), $ver = true, true );
wp_localize_script( 'contact-us-js', 'chilepro_data', array( 	'ajaxurl' 			=> admin_url( 'admin-ajax.php' ),
															'loading_image'		=> wp_iv_directories_URLPATH.'admin/files/images/loader.gif',) );

