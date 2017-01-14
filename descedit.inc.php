<?php
require 'common.inc.php';
$navtitle = 'Edit Title';
if(!$_G['uid']){showmessage('not_loggedin', NULL, array(), array('login' => 1));}
if(!$_GET['pid']){showmessage('Error.');}

if($_POST['submit']==true){
	if($_POST['pid']!=$_GET['pid']){showmessage('Error.');}
	if(DB::query("UPDATE ".DB::table('hen_mypet')." SET text = '{$_POST['newtext']}' WHERE uid = {$_G['uid']} AND pid = {$_POST['pid']}")){
		showmessage('แก้ไขข้อมูลเรียบร้อย','plugin.php?id=hen_pet:mypet');
	}else{
		showmessage('Error.');
	}
}else{
	include template('hen_pet:header');
	echo '<br /><center><form action="plugin.php?id=hen_pet:descedit&pid='.$_GET['pid'].'" method="post">
	<input name="pid" type="hidden" value="'.$_GET['pid'].'" />
	<div style="text-align:center;width:490px;height: 0px;"><input name="newtext" type="text" maxlength="25" placeholder="ใส่ข้อความ (จำกัด 25 ตัวอักษร)" id="goog-wm-qt">&nbsp;
	<input type="submit" name="submit"  value="แก้ไข" class="btn btn-danger"></input></div></form></center><br /><br /><br />';
	include template('hen_pet:footer');
}
?>