<?php
require 'common.inc.php';
$navtitle = 'Add Pet';
if(!$is_admin){showmessage('Access Denied.');}

if($_POST['submit']=='เพิ่ม'){
	if(!$_POST['image']||!$_POST['name']||!$_POST['price']){showmessage('กรอกข้อมูลให้ครบ');}
	$islimited = ($_POST['islimited']==1) ? 1 : 0;
	$limited = intval($_POST['limited']);
	if(DB::query("INSERT INTO ".DB::table('hen_petshop')." (image,name,price,islimited,limited,onsell) VALUES ('{$_POST['image']}','{$_POST['name']}','{$_POST['price']}','{$islimited}','{$limited}','1')")){
		showmessage('เสร็จสิ้นในการเพิ่ม Pet +_+','plugin.php?id=hen_pet:petshop');
	}else{
		showmessage('Adding fail.');
	}
}else{
	include template('hen_pet:header');
	echo '<center><form action="plugin.php?id=hen_pet:admin&do=add" method="post" name="addpet">';
	echo '<table>';
	echo '<tr><td><span style="font-size: 14.5px;">URL ไฟล์รูป</td><td><input type="text" name="image" id="goog-wm-qt" value="" /></td></tr>';
	echo '<tr><td><span style="font-size: 14.5px;" >ชื่อ</td><td><input type="text" name="name" value="" id="goog-wm-qt" /></td></tr>';
	echo '<tr><td><span style="font-size: 14.5px;color:red;">ราคา</td><td><input type="text" name="price" value="" id="goog-wm-qt" maxlength="4" /></td></tr>';
	echo '<tr><td><span style="font-size: 14.5px;color:red;">จำกัดจำนวน<input type="checkbox" id="islimited" name="islimited" value="1" /></td><td><input type="text" id="goog-wm-qt" name="limited" value="" maxlength="3" />&nbsp;&nbsp;<span style="font-size: 14.5px;color:red;">ชิ้น</span></td></tr>';
	echo '<tr><td></td><td><br><input class="btn" type="submit" name="submit" value="เพิ่ม"/></td></tr>';
	echo '</table></form><span style="font-size: 14.5px;color:red;">หมายเหตุ: หากจะทำการกำหนดจำกัดจำนวนสินค้ากรุณาติ๊กถูกที่ช่องสี่เหลี่ยม</span></center>';
	include template('hen_pet:footer');
}
?>