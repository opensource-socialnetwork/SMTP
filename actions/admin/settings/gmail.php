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
require_once __SMTP__ . 'vendor/google/vendor/autoload.php';
use League\OAuth2\Client\Provider\Google;

$smtp     = new OssnComponents();
$settings = $smtp->getSettings('SMTP');

$provider = new Google(array(
		'clientId'     => $settings->clientId,
		'clientSecret' => $settings->clientSecret,
		'redirectUri'  => ossn_site_url('smtp_oauth/google'),
		'accessType'   => 'offline',
));
$options = array(
		'prompt' => 'consent',
		'scope'  => array(
				'https://mail.google.com/',
		),
);
$authUrl                 = $provider->getAuthorizationUrl($options);
$_SESSION['oauth2state'] = $provider->getState();
header("Location: {$authUrl}");
exit();
