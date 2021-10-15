<?php
/**
 * Open Source Social Network
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.org>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
$vars   = array();
$fields = array(
		'host',
		'port',
		'username',
);
$oauth_type = input('oauth_type');
if(!$oauth_type || ($oauth_type && $oauth_type == 'no')) {
		$fields[] = 'password';
} else {
		$vars['password'] = '';
}
foreach($fields as $item) {
		$data = input("$item");
		if(empty($data)) {
				ossn_trigger_message(ossn_print('smtp:fields:required'), 'error');
				redirect(REF);
		} else {
				$vars[$item] = $data;
		}
}
$vars['clientId']     = input('clientId');
$vars['clientSecret'] = input('clientSecret');
$vars['oauth_type']   = input('oauth_type');

$com = new OssnComponents();
if($com->setSettings('SMTP', $vars)) {
		ossn_trigger_message(ossn_print('smtp:settings:saved'));
} else {
		ossn_trigger_message(ossn_print('smtp:settings:error'), 'error');
}
redirect(REF);