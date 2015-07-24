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
define('__SMTP__', ossn_route()->com . 'SMTP/');
/**
 * Initialize SMTP Component
 *
 * @return void
 * @access private
 */
function ossn_com_smtp_init() {
		ossn_add_hook('email', 'send', 'ossn_smtp', 1);
		ossn_register_com_panel('SMTP', 'settings');
		
		if(ossn_isAdminLoggedin()) {
				ossn_register_action('admin/smtp/settings/save', __SMTP__ . 'actions/admin/settings/save.php');
		}
}
/**
 * Ossn SMTP
 * 
 * Send notification emails using your smtp server
 * Few hosting providers didn't have php mail() enabled,
 * Users belong to this category can try this component.
 * 
 * @return void|boolean
 */
function ossn_smtp($hook, $type, $mail, $return) {
		$smtp     = new OssnComponents;
		$settings = $smtp->getSettings('SMTP');
		if(!empty($settings->host) && !empty($settings->port) && !empty($settings->username) && !empty($settings->password)) {
				$mail->IsSMTP();
				$mail->SMPTAuth = true;
				$mail->Host     = $settings->host;
				$mail->Port     = $settings->port;
				$mail->Username = $settings->username;
				$mail->Password = $settings->password;
				return $mail->send();
		}
}
/**
 * Check if is connected to server or not
 * 
 * @return array
 */
function ossn_smpt_connected() {
		$return           = array();
		$mail             = new OssnMail;
		$smtp             = new OssnComponents;
		$settings         = $smtp->getSettings('SMTP');
		$return['status'] = ossn_print("smtp:connectio:failed");
		if(!empty($settings->host) && !empty($settings->port) && !empty($settings->username) && !empty($settings->password)) {
				$mail->IsSMTP();
				$mail->SMPTAuth = true;
				$mail->Host     = $settings->host;
				$mail->Port     = $settings->port;
				$mail->Username = $settings->username;
				$mail->Password = $settings->password;
				if($mail->smtpConnect()) {
						$mail->smtpClose();
						$return['status'] = ossn_print("smtp:connection:connected");
				} else {
						$return['status'] = ossn_print("smtp:connectio:failed");
				}
		}
		return $return;
}
//initilize ossn wall
ossn_register_callback('ossn', 'init', 'ossn_com_smtp_init');
