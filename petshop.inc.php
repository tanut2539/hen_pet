<?php
require 'common.inc.php';
if(!$_G['uid']){showmessage('not_loggedin', NULL, array(), array('login' => 1));}
$width = $config['width'];
$colum = $config['colum'];
$navtitle = 'Pet Shop';
include template('hen_pet:header');

$money = DB::fetch_first("SELECT extcredits{$config['money']} FROM ".DB::table('common_member_count')." WHERE uid = {$_G['uid']}");
$re = DB::query("SELECT * FROM ".DB::table('hen_petshop')." WHERE (onsell = '1' AND islimited = '0' ) OR (onsell = '1' AND islimited = '1' AND limited > '0')");

$tmp_td = 0;

echo '<style type="text/css"></style>';
echo '<center><table width="'.$width.'px;"><tr style="width:'.($width/$colum).'px;">';

while($p = DB::fetch($re)){

	if($tmp_td==$colum){
		echo '</tr><tr style="width:'.($width/$colum).'px;">';
		$tmp_td = 0;
	}
	
	echo '<td><center><div id="pid'.$p['pid'].'" class="pet_wrap"><div class="pet_bg_wrap"><div class="pet_img" style="background-image:url('.$p['image'].')"><img src="/static/image/common/emp.gif" alt="">';
	
	if($p['islimited']==1){
		echo '<div style="width:158px;height:100px;background:url(\'',$config['limitedurl'],'\') top right no-repeat;"></div>';
	}
		
	echo '</div></br><strong>'.$p['name'].'</strong><br />';
	echo '<span>Prince:</span> <span>'.$p['price'].'</span><br />';
             echo'<span>คุณมีเงิน <span style="color:#F93;">'.$money['extcredits'.$config['money']].' </span>'.$_G['setting']['extcredits'][$config['money']]['title'].'</span><br />';
	
	if($p['islimited']==1){
		echo '<span style="color:red;font-size: 12px;">จำนวนจำกัด: ',$p['limited'],' ชิ้น</span>';
	}

	echo '<form action="plugin.php?id=hen_pet:buy&pid='.$p['pid'].'" method="post">
<input type="hidden" name="ok" value="1">
<input class="btn btn-danger" type="submit" name="submit" value="Buy"></input>
</form>';
	echo '</center></td></div></div>';
	$tmp_td++;
}
echo '</tr></table></center>';

include template('hen_pet:footer');
?>