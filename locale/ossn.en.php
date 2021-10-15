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
$en = array(
	'smtp' => 'SMTP',
	'smtp:settings' => 'SMTP Settings',
	'smtp:connection:connected' => 'SMTP Connection successfully established',
	'smtp:connectio:failed' => 'SMTP Connection Failed',
	'smtp:host' => "Mail Server (mail.yourdomain.com)",
	'smtp:port' => 'Port',
	'smtp:username' => 'Username (name@yourdomain.com)',
	'smtp:password' => 'Password',
	'smtp:oauth:warning' => 'Please note that this component will not work with providers requires OAUTH/2 authentication. Can work only with gmail OAUTH2 authentication. You may use a simple SMTP authentication if you do not have gmail,',
	'smtp:oauth' => 'Does this relates to OAUTH2?',
	'smtp:clientid' => 'Client ID',
	'smtp:clientsecret' => 'Client Secret',
	'smtp:oauth2:token' => 'OAUTH2 Token',
	'smtp:token:oauth' => 'Get Token',
	'smtp:settings:saved' => 'Settings has been saved',
	'smtp:oauth2:gmail:url' => 'Redirect URI',
	'smtp:oauth:token:received' => 'Token has been saved',
	'smtp:oauth:token:notreceived' => 'Unable to get a token',
	'smtp:fields:required' => 'Marked fields are required',	
);
ossn_register_languages('en', $en); 
