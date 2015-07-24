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
 $vars = array();
 $fields = array('host', 'port', 'username', 'password');
 foreach($fields as $item){
	 $data = input("$item");
	 if(empty($data)){
		 ossn_trigger_message(ossn_print('smpt:fields:required'), 'error');
		 redirect(REF);
	 } else {
		 $vars[$item] = $data;
	 }
 }
 
 $com = new OssnComponents;
 if($com->setSettings('SMTP', $vars)){
    ossn_trigger_message(ossn_print('smpt:settings:saved'));
 } else {
    ossn_trigger_message(ossn_print('smpt:settings:error'), 'error');
 }
    redirect(REF);	 	  