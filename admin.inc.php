<?php
require 'common.inc.php';
$navtitle = 'Edit Pet';
$petadmin = true;
$width = $config['width'];
$colum = $config['colum'];
if(!$_G['uid']){showmessage('not_loggedin', NULL, array(), array('login' => 1));}
if(!$_GET['do']){
	include template('hen_pet:header');
	echo '<style type="text/css"></style>';
echo '<center><table width="'.$width.'px;"><tr style="width:'.($width/$colum).'px;">';
	$re = DB::query("SELECT * FROM ".DB::table('hen_petshop')."");
	while($p = DB::fetch($re)){
if($tmp_td==$colum){
		echo '</tr><tr style="width:'.($width/$colum).'px;">';
		$tmp_td = 0;
	}
echo '<td><center><div id="pid'.$p['pid'].'" class="edit pet_wrap"><div class="pet_bg_wrap"><div class="pet_img" style="background-image:url('.$p['image'].')"><img src="/static/image/common/emp.gif" alt="">
                       </div><br /><strong>'.$p['name'].'</strong> <strong>(N.'.$p['pid'].')</strong><br />
		<span>Prince:</span> <span>'.$p['price'].'</span><br />
		';
		if($p['islimited']){
			echo '<span style="color:red;">คงเหลือ:</span> <span style="color:#228B22;">',$p['limited'],'</span> ชิ้น<br />';
		}
		echo '<a style="color:green;" href="plugin.php?id=hen_pet:admin&do=edit&pid=',$p['pid'],'">[Edit Pet]</a>&nbsp<a style="color:red;" href="javascript:;" onClick="if(confirm(\'ต้องการลบ Pet N.('.$p['pid'].')\')){location.href=\'plugin.php?id=hen_pet:admin&do=del&pid=',$p['pid'],'\'}">[Delete Pet]</a>';

echo '</center></td></div></div>';
$tmp_td++;
}
echo '</tr></table></center>';

	include template('hen_pet:footer');
}else{

	if(in_array($_GET['do'],array('add','edit','del'))){
		include $_GET['do'].'.admin.php';
	}else{
		showmessage('Unknow Operation.');
	}
}
?>