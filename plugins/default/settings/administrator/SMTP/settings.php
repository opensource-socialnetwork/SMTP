<?php
/**
 * Open Source Social Network
 *
 * @packageOpen Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
$smtp = ossn_smtp_connected(); 
echo ossn_view_form('smtp/settings/save', array(
    'action' => ossn_site_url() . 'action/admin/smtp/settings/save',
    'class' => 'ossn-admin-form'	
));
echo "<div class='margin-top-10'><strong>", $smtp['status'],  "</strong></div>";
