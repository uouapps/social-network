<form  name="tiger_contact" id="tiger_contact"  class="form-horizontal"  role="form">
							<div class="form-group row"  >
								<label for="text" class="col-md-12 control-label"><?php  _e('Name:','tiger');?><span class="chili"></span></label>
								<div class="col-md-12">
									<input type="text"  name="contact_name" id="contact_name"   data-validation="required" data-validation-error-msg="<?php  esc_html_e(' Please Enter Your Name','tiger');?>" class="form-control ctrl-textbox" placeholder="<?php esc_html_e( 'Enter your name', 'tiger' ); ?>"  alt="required">

								</div>
							</div>

						<div class="form-group row">
							<label for="email" class="col-md-12 control-label" ><?php  esc_html_e('Email:','tiger');?><span class="chili"></span></label>
							<div class="col-md-12">
								<input type="email" name="contact_email" id="contact_email" data-validation="email"  class="form-control ctrl-textbox" placeholder="<?php esc_html_e( 'Enter your email', 'tiger' ); ?>" data-validation-error-msg="<?php  esc_html_e('Please enter a valid email address','tiger');?> " >
							</div>
						</div>
						<div class="form-group row"  >
								<label for="text" class="col-md-12 control-label"><?php  esc_html_e('Subject:','tiger');?><span class="chili"></span></label>
								<div class="col-md-12">
									<input type="text"  name="contact_subject"  class="form-control ctrl-textbox" placeholder="<?php esc_html_e( 'Enter subject', 'tiger' ); ?>"  alt="required">

								</div>
						</div>
						<div class="form-group row"  >
								<label for="text" class="col-md-12 control-label"><?php  _e('Message:','tiger');?><span class="chili"></span></label>
								<div class="col-md-12">
									<textarea id="contact_content" name="contact_content" class="form-control" placeholder="<?php esc_html_e( 'Enter message', 'tiger' ); ?>" data-validation="required"></textarea>

								</div>
						</div>



						<div class="row">

								<div class="col-md-12 text-left">
									<button type="submit" class="btn-new btn-custom full-width" > <?php esc_html_e( 'Submit', 'tiger' ); ?></button>
									 <div id="update_message">	</div>

								</div>
						</div>
</form>
<?php
wp_enqueue_script('iv_directories-script-contact', wp_iv_directories_URLPATH . 'admin/files/js/jquery.form-validator.js');
wp_enqueue_script( 'contact-us-js', tiger_JS.'contact-us.js', array('jquery'), $ver = true, true );
wp_localize_script( 'contact-us-js', 'tiger_data', array( 	'ajaxurl' 			=> admin_url( 'admin-ajax.php' ),
															'loading_image'		=> wp_iv_directories_URLPATH.'admin/files/images/loader.gif',) );

