<?php 
	global $wpdb, $post;
	$currencyCode= get_option('_uou_tigerp_api_currency');
	$currencies = array();
	$currencies['AUD'] ='$';$currencies['CAD'] ='$';
	$currencies['EUR'] ='€';$currencies['GBP'] ='£';
	$currencies['JPY'] ='¥';$currencies['USD'] ='$';
	$currencies['NZD'] ='$';$currencies['CHF'] ='Fr';
	$currencies['HKD'] ='$';$currencies['SGD'] ='$';
	$currencies['SEK'] ='kr';$currencies['DKK'] ='kr';
	$currencies['PLN'] ='zł';$currencies['NOK'] ='kr';
	$currencies['HUF'] ='Ft';$currencies['CZK'] ='Kč';
	$currencies['ILS'] ='₪';$currencies['MXN'] ='$';
	$currencies['BRL'] ='R$';$currencies['PHP'] ='₱';
	$currencies['MYR'] ='RM';$currencies['AUD'] ='$';
	$currencies['TWD'] ='NT$';$currencies['THB'] ='฿';	
	$currencies['TRY'] ='TRY';	$currencies['CNY'] ='¥';		
	$currencies['INR'] ='₹';
	
	$currencyCode= get_option('_uou_tigerp_api_currency');
	
	$currencyCode=(isset($currencies[$currencyCode]) ? $currencies[$currencyCode] :$currencyCode );
	
	//$currencyCode = (isset($paypal_api_currency)) ? $paypal_api_currency : '$';
		 $sql = "
			SELECT $wpdb->posts.* 
			FROM $wpdb->posts, $wpdb->postmeta
			WHERE $wpdb->posts.ID = $wpdb->postmeta.post_id 
			AND $wpdb->postmeta.meta_key = 'uou_tigerp_user_type' 
			AND $wpdb->postmeta.meta_value = 'professional' 
			AND $wpdb->posts.post_status = 'draft' 
			AND $wpdb->posts.post_type = 'uou_tigerp_pack'	
		 ";
	//$sql="SELECT * FROM $wpdb->posts WHERE post_type = 'uou_tigerp_pack' and post_status='draft'";
	$membership_pack = $wpdb->get_results($sql);
	 $total_package=count($membership_pack);
	if($total_package>0){
		if($total_package==1 || $total_package==2){
			$window_ratio='33.33';
		}else{
			$window_ratio= 100/$total_package;
		}
	}
?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php
wp_enqueue_style('pricing-table-style', tiger_CSS.'price-table.css', array(), $ver = false, $media = 'all');
?>

<div class="text-center">
<?php
					
					
							if(sizeof($membership_pack)>0){
								 $page_name_reg=get_option('_uou_tigerp_registration' ); 
								$feature_max=0;
								
								foreach ( $membership_pack as $row5 )
								{
									$feature_arr = array_filter(explode("\n", $row5->post_content));
									
									
									$last_li_no=sizeof($feature_arr);
									if($last_li_no > $feature_max){
										$feature_max=$last_li_no;
										
									}
									
								}	
								
								
								$i=0;
								$pt=0;
								foreach ( $membership_pack as $row )
								{
									$recurring_text='  '; 
									if(get_post_meta($row->ID, 'uou_tigerp_package_cost', true)=='0' or get_post_meta($row->ID, 'uou_tigerp_package_cost', true)==""){
									  $amount= 'Free';
									}else{
									  $amount= $currencyCode.' '. get_post_meta($row->ID, 'uou_tigerp_package_cost', true);
									}
									
									$recurring= get_post_meta($row->ID, 'uou_tigerp_package_recurring', true);	
									if($recurring == 'on'){
										$amount= $currencyCode.' '. get_post_meta($row->ID, 'uou_tigerp_package_recurring_cost_initial', true);
										$count_arb=get_post_meta($row->ID, 'uou_tigerp_package_recurring_cycle_count', true); 	
										if($count_arb=="" or $count_arb=="1"){
										$recurring_text=" per ".' '.get_post_meta($row->ID, 'uou_tigerp_package_recurring_cycle_type', true);
										}else{
										$recurring_text=' per '.$count_arb.' '.get_post_meta($row->ID, 'uou_tigerp_package_recurring_cycle_type', true).'s';
										}
										
									}else{
										$recurring_text=' &nbsp; ';
									}
												
									if($i>3){
										$i=0;
										$pt=0;
									}
									$pt++;
									?><ul id="pt-<?php echo $pt;?>" style="width: <?php echo $window_ratio ?>%;" >
										<li>
											<h2><?php echo strtoupper($row->post_title); ?></h2>
											<h3><?php echo $amount; ?><span><?php echo $recurring_text; ?></span></h3>
											 <ul>
											<?php
												$row->post_content;
												$ii=0;
												$feature_all = explode("\n", $row->post_content);
											
												$last_li_no=sizeof($feature_all);
												foreach($feature_all as $feature){
													if(trim($feature)!=""){
														echo '<li class=" '.($ii == 0 ? 'first' : ''). ($ii == $last_li_no ? 'last' : ''). ($ii %2== 0 ? ' even' : ' odd').'">'.$feature.'</li>';
													
													$ii++;
													}												
												
												}
												
												if($feature_max > $ii){
													while ($ii < $feature_max) {
														echo '<li class=" '.($ii == 0 ? 'first' : ''). ($ii == $feature_max ? 'last' : ''). ($ii %2== 0 ? ' even' : ' odd').'">&nbsp; </li>';
													 $ii++;	
													}
												}
												
											?>										  
										 </ul>
									    <div class="submit-btn"> <a href="<?php echo get_page_link($page_name_reg).'?&package_id=	'.$row->ID ; ?>&type=professional">Sign up</a> </div>
									 </li>
									</ul><?php
								$i++;
								}
							}
						?>	
</div>


