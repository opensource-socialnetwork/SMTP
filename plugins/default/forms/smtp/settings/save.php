<?php
/**
 * Open Source Social Network
 *
 * @packageOpen Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org
 */
 $smtp = new OssnComponents;
 $settings = $smtp->getSettings('SMTP');
 ?>
 <div class="alert alert-warning"><?php echo ossn_print('smtp:oauth:warning');?></div>
 <div>
 	<label><?php echo ossn_print('smtp:host');?></label>
 	<input type="text" name="host" value="<?php echo $settings->host;?>" />
 </div>
 <div>
 	<label><?php echo ossn_print('smtp:port');?></label>
    <input type="text" name="port" value="<?php echo $settings->port;?>" />
 </div> 
 <div>
 	<label><?php echo ossn_print('smtp:username');?></label>
    <input type="text" name="username" value="<?php echo $settings->username;?>" />
 </div>
 <div>
 	<label><?php echo ossn_print('smtp:password');?></label>
    <input type="password" name="password" value="<?php echo $settings->password;?>" />
 </div>
 <div>
 	<input type="submit" class="btn btn-primary" />
 </div>