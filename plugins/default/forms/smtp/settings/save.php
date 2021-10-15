<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
 $smtp = new OssnComponents;
 $settings = $smtp->getSettings('SMTP');
 $gmaildiv = '';
 $style = '';
 if(isset($settings->oauth_type) && $settings->oauth_type == 'gmail'){
		$style = 'style="display:none;"'; 
 } else {
		$gmaildiv = 'style="display:none;"'; 
 }
 ?>
 <div class="alert alert-warning"><?php echo ossn_print('smtp:oauth:warning');?></div>
 <div>
 	<label class="required-smtp"><?php echo ossn_print('smtp:host');?></label>
 	<input type="text" name="host" value="<?php echo $settings->host;?>" />
 </div>
 <div>
 	<label class="required-smtp"><?php echo ossn_print('smtp:port');?></label>
    <input type="text" name="port" value="<?php echo $settings->port;?>" />
 </div> 
 <div>
 	<label class="required-smtp"><?php echo ossn_print('smtp:username');?></label>
    <input type="text" name="username" value="<?php echo $settings->username;?>" />
 </div>
 <div id="smtp-password" <?php echo $style;?>>
 	<label class="required-smtp"><?php echo ossn_print('smtp:password');?></label>
    <input type="password" name="password" value="<?php echo $settings->password;?>" />
 </div>
 <div>
 	<label class="required-smtp"><?php echo ossn_print('smtp:oauth');?></label>
    <?php echo ossn_plugin_view('input/dropdown', array(
				'name' => 'oauth_type',
				'id' => 'oauth-type',
				'value' => $settings->oauth_type,
				'options' => array(
					'no' => 'No',
					'gmail' => 'Gmail',
				),
		));
	?>
 </div>
 <div class="smtp-gmail" <?php echo $gmaildiv;?>>
 <strong>Gmail</strong>
 <div>
 	<label class="required-smtp"><?php echo ossn_print('smtp:clientid');?></label>
    <input type="text" name="clientId" value="<?php echo $settings->clientId;?>" />
 </div>
 <div>
 	<label class="required-smtp"><?php echo ossn_print('smtp:clientsecret');?></label>
    <input type="text" name="clientSecret" value="<?php echo $settings->clientSecret;?>" />
 </div>
 <div>
 
 	<label class="required-smtp"><?php echo ossn_print('smtp:oauth2:token');?> 
    <?php if(!empty($settings->clientId) && !empty($settings->clientSecret)){ ?>
	    <a href="<?php echo ossn_site_url('action/smtp/tokengmail', true);?>" class="badge bg-success"><?php echo ossn_print('smtp:token:oauth');?></a>
    <?php } ?>
    </label>
    <input type="text" name="oauth2Token" value="<?php echo $settings->oauth_token_google;?>" readonly="readonly" style="opacity:0.6;" />
 </div>
 <div>
 	<label><?php echo ossn_print('smtp:oauth2:gmail:url');?></label>
    <input type="text" value="<?php echo ossn_site_url('smtp_oauth/google');?>" readonly="readonly" /> 
 </div>  
 </div> 
 <div>
 	<input type="submit" class="btn btn-primary" />
 </div>
 <style>
 	.smtp-gmail {
		    border: 1px dashed #eee;
    		border-radius: 5px;
   			padding: 10px;
    		margin-bottom: 10px;
    		background: #e7e7e7
	}
  	.required-smtp:after {
    	content:" *";
    	color: red;
 	}	
 </style>
 <script>
 	$(document).ready(function(){
			$('body').on('change', '#oauth-type', function(){
						if($(this).val() == 'gmail'){
								$('#smtp-password').fadeOut();
								$('.smtp-gmail').fadeIn();
						} else{
								$('#smtp-password').fadeIn();
								$('.smtp-gmail').fadeOut();
						}
			});						   
	});
 </script>