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
//default empty variables
$vars = array(
		'host'               => '',
		'port'               => '',
		'username'           => '',
		'clientId'           => '',
		'clientSecret'       => '',
		'oauth_type'         => 'no',
		'oauth_token_google' => '',
);
$com = new OssnComponents();
$com->setSettings('SMTP', $vars);
