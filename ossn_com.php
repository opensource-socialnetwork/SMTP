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
define('__SMTP__', ossn_route()->com . 'SMTP/');
/**
 * Initialize SMTP Component
 *
 * @return void
 * @access private
 */
function ossn_com_smtp_init() {
		ossn_add_hook('email', 'config', 'ossn_smtp', 1);
		ossn_register_com_panel('SMTP', 'settings');

		if(ossn_isAdminLoggedin()) {
				ossn_register_action('admin/smtp/settings/save', __SMTP__ . 'actions/admin/settings/save.php');
				ossn_register_action('smtp/tokengmail', __SMTP__ . 'actions/admin/settings/gmail.php');
				ossn_register_page('smtp_oauth', 'smtp_oauth_token_page_handler');
		}
}
function smtp_oauth_token_page_handler($pages) {
		switch($pages[0]) {
			case 'google':
				require_once __SMTP__ . 'vendor/google/vendor/autoload.php';
				$smtp     = new OssnComponents();
				$settings = $smtp->getSettings('SMTP');

				$provider = new League\OAuth2\Client\Provider\Google(array(
						'clientId'     => $settings->clientId,
						'clientSecret' => $settings->clientSecret,
						'redirectUri'  => ossn_site_url('smtp_oauth/google'),
						'accessType'   => 'offline',
				));
				$token = $provider->getAccessToken('authorization_code', array(
						'code' => input('code'),
				));
				$vars = array(
						'oauth_token_google' => $token->getRefreshToken(),
				);
				$com = new OssnComponents();
				if($com->setSettings('SMTP', $vars)) {
						ossn_trigger_message(ossn_print('smtp:oauth:token:received'));
				} else {
						ossn_trigger_message(ossn_print('smtp:oauth:token:notreceived'));
				}
				redirect('administrator/component/SMTP');
				break;
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
		require_once __SMTP__ . 'vendor/google/vendor/autoload.php';
		require_once __SMTP__ . 'vendor/phpmailer/OAuth.php';

		$smtp     = new OssnComponents();
		$settings = $smtp->getSettings('SMTP');
		if(!empty($settings->host) && !empty($settings->port) && !empty($settings->username) && !empty($settings->password)) {
				$mail->IsSMTP();
				$mail->SMTPAuth = true;
				//$mail->SMTPDebug = false;

				$mail->Host       = $settings->host;
				$mail->Port       = $settings->port;
				$mail->Username   = $settings->username;
				$mail->Password   = $settings->password;
				$mail->SMTPSecure = true;
				if(isset($settings->oauth_token_google) && !empty($settings->oauth_token_google)) {
						unset($mail->SMTPSecure);
						unset($mail->Password);
						$mail->SMTPSecure = 'ssl';
						$mail->AuthType   = 'XOAUTH2';
						$provider         = new League\OAuth2\Client\Provider\Google(array(
								'clientId'     => $settings->clientId,
								'clientSecret' => $settings->clientSecret,
						));
						$oauth = new OAuth(array(
								'provider'     => $provider,
								'clientId'     => $settings->clientId,
								'clientSecret' => $settings->clientSecret,
								'refreshToken' => $settings->oauth_token_google,
								'userName'     => $settings->username,
						));
						$mail->setOAuth($oauth);
				}
				//from ossn v5.6 allow to send email from default class
				return $mail;
		}
}
/**
 * Check if is connected to server or not
 *
 * @return array
 */
function ossn_smtp_connected() {
		require_once __SMTP__ . 'vendor/google/vendor/autoload.php';
		require_once __SMTP__ . 'vendor/phpmailer/OAuth.php';

		$return           = array();
		$mail             = new OssnMail();
		$smtp             = new OssnComponents();
		$settings         = $smtp->getSettings('SMTP');
		$return['status'] = ossn_print('smtp:connectio:failed');
		if(!empty($settings->host) && !empty($settings->port) && !empty($settings->username) && !empty($settings->password)) {
				$mail->IsSMTP();
				$mail->Timeout  = 5; //timeout after 10 seconds
				$mail->SMTPAuth = true;
				//$mail->SMTPDebug = true;

				$mail->Host       = $settings->host;
				$mail->Port       = $settings->port;
				$mail->Username   = $settings->username;
				$mail->Password   = $settings->password;
				$mail->SMTPSecure = true;
				if(isset($settings->oauth_token_google) && !empty($settings->oauth_token_google)) {
						unset($mail->SMTPSecure);
						unset($mail->Password);
						$mail->SMTPSecure = 'ssl';
						$mail->AuthType   = 'XOAUTH2';
						$provider         = new League\OAuth2\Client\Provider\Google(array(
								'clientId'     => $settings->clientId,
								'clientSecret' => $settings->clientSecret,
						));
						$grant = new League\OAuth2\Client\Grant\RefreshToken();
						$token = $provider->getAccessToken($grant, array(
								'refresh_token' => $settings->oauth_token_google,
						));
						try {
								$ownerDetails = $provider->getResourceOwner($token);
								$name         = $ownerDetails->getFirstName();
								if(!empty($name)) {
										$return['status'] = ossn_print('smtp:connection:connected');
								}
						} catch (Exception $e) {
								$return['status'] = ossn_print('smtp:connection:connected');
						}
				} else {
						if($mail->smtpConnect()) {
								$mail->smtpClose();
								$return['status'] = ossn_print('smtp:connection:connected');
						} else {
								$return['status'] = ossn_print('smtp:connectio:failed');
						}
				}
		}
		return $return;
}
//initilize ossn wall
ossn_register_callback('ossn', 'init', 'ossn_com_smtp_init');
