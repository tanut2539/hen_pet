<?php
require 'common.inc.php';
if(!$is_admin){showmessage('Access Denied.');}

if($_POST['submit']=='แก้ไข'){
	if(!$_POST['image']||!$_POST['name']||!$_POST['price']){showmessage('กรุณากรอกข้อมูลให้ครบ');}
	$islimited = ($_POST['islimited']==1) ? 1 : 0;
	$onsell = ($_POST['onsell']==1) ? 1 : 0;
	$limited = intval($_POST['limited']);
	$pid = intval($_POST['pid']);
	if(!$pid){
		showmessage('Invail PID.','plugin.php?id=hen_pet:admin');
	}
	if(DB::query("UPDATE ".DB::table('hen_petshop')." SET image='{$_POST['image']}',name='{$_POST['name']}',price='{$_POST['price']}',islimited='{$islimited}',limited='{$limited}',onsell='{$onsell}' WHERE pid='$pid' LIMIT 1")){
		showmessage('แก้ไขเรียบร้อย +_+  Success.','plugin.php?id=hen_pet:admin');
	}else{
		showmessage('แก้ไขผิดพลาด +_+ Error.');
	}
}else{
	$pid = intval($_GET['pid']);
	if(!$pid){
		showmessage('Invail PID.','plugin.php?id=hen_pet:admin');
	}
	$pet = DB::fetch_first("SELECT * FROM ".DB::table('hen_petshop')." WHERE pid='$pid'");
	include template('hen_pet:header');
             echo'<tr><td><div id="pid'.$pet['pid'].'" class="pet_wrap pet_left" style="margin-bottom: 44px;"><div class="pet_bg_wrap"><div class="pet_img" style="background-image:url('.$pet['image'].')"><img src="/static/image/common/emp.gif" alt=""></div></div></div></tr></td>';
	echo '<center><div class="pet_right" style="margin-bottom: 30px;"><form action="plugin.php?id=hen_pet:admin&do=edit" method="post" name="addpet">';
             echo '<table>';
	echo '<tr><td><span style="font-size: 14.5px;">URL ไฟล์รูป</td><td><input id="goog-wm-qt" type="text" name="image" value="'.$pet['image'].'"></td></tr>';
	echo '<tr><td><span style="font-size: 14.5px;">ชื่อ</td><td><input id="goog-wm-qt" type="text" name="name" value="'.$pet['name'].'"></td></tr>';
	echo '<tr><td><span style="font-size: 14.5px;">ราคา</td><td><input id="goog-wm-qt" type="text" name="price" value="'.$pet['price'].'" maxlength="4" /></td></tr>';
	echo '<tr><td><span style="font-size: 14.5px;color:red;">จำกัดจำนวน<input type="checkbox" id="islimited" name="islimited" value="1"'.($pet['islimited']?' checked="checked"':'').' /></td><td><input id="goog-wm-qt" type="text" id="limited" name="limited" value="'.$pet['limited'].'" maxlength="3" />&nbsp;&nbsp;<span style="font-size: 14.5px;color:red;">ชิ้น</span</td></tr>';
	echo '<tr><td><span style="font-size: 14.5px;color:red;">เปิดขายสิ้นค้าหรือไม่ !</td><td><input type="checkbox" id="onsell" name="onsell" value="1"'.($pet['onsell']?' checked="checked"':'').' /><strong>Pet (N.'.$pet['pid'].')</strong></td></tr>';
	echo '<tr><td></td><td><input class="btn btn-danger" type="submit" name="submit" value="แก้ไข"/></td></tr>';
	echo '</table><input type="hidden" name="pid" value="'.$pet['pid'].'" /></form><br /><span style="font-size: 14.5px;color:red;">หมายเหตุ: หากจะทำการกำหนดจำกัดจำนวนสินค้ากรุณาติ๊กถูกที่ช่องสี่เหลี่ยม</span></center>';
	include template('hen_pet:footer');
}
?>