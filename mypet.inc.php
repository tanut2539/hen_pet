<?php
require 'common.inc.php';
if(!$_G['uid']){showmessage('not_loggedin', NULL, array(), array('login' => 1));}
$width = $config['width'];
$colum = $config['colum'];
$navtitle = 'My Pet';
include template('hen_pet:header');

$re = DB::query("SELECT n.*,m.image AS image, m.name AS name FROM ".DB::table('hen_mypet')." n LEFT JOIN ".DB::table('hen_petshop')." m ON n.pid=m.pid WHERE n.uid = {$_G['uid']}");
echo '<style type="text/css">.pname{color:#39F;}.ppricet{color:#F93;}.ppricen{color:#0C3;}.plimitt{color:#B00;}</style>';
echo '<center><table width="'.$width.'px;"><tr style="width:'.($width/$colum).'px;">';

while($p = DB::fetch($re)){

	if($tmp_td==$colum){
		echo '</tr><tr style="width:'.($width/$colum).'px;">';
		$tmp_td = 0;
	}
	
	echo '<td><center><div id="pid'.$p['pid'].'" class="pet_wrap"><div class="pet_bg_wrap"><div class="pet_img" style="background-image:url('.$p['image'].')"><img src="/static/image/common/emp.gif" alt="">';
	echo '</div></br><strong>'.$p['name'].'</strong></br><span>'.$p['text'].'</span><br /><span class="ppricen" style="font-size: 12px;"></span><a href="plugin.php?id=hen_pet:descedit&pid='.$p['pid'].'" style="color:#000066;font-size: 12px;">[เปลี่ยนข้อความโชว์ใต้ Pet]</a><br />';
	if($p['current']==1){
		echo '<span>เป็นค่าเริ่มต้นขณะนี้</span>';
	}else{
		echo '<a class="petbuy" href="plugin.php?id=hen_pet:current&pid='.$p['pid'].'">ตั้งเป็นค่าเริ่มต้น</a>';
	}
	echo '</center></td></div></div>';
	$tmp_td++;
}
echo '</tr></table></center>';

include template('hen_pet:footer');
?>