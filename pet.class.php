<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class plugin_hen_pet {
}
class plugin_hen_pet_forum extends plugin_hen_pet {
	function viewthread_sidebottom_output() {
		global $postlist,$_G;
		$output = array();
		if($_G['cache']['plugin']['hen_pet']['open']==2){return $output;}
		$i = 0;
		foreach($postlist as $p){
			if($pet = DB::fetch_first("SELECT n.*,m.image AS image, m.name AS name FROM ".DB::table('hen_mypet')." n LEFT JOIN ".DB::table('hen_petshop')." m ON n.pid=m.pid WHERE n.uid = {$p['authorid']} AND current = 1")){
				$output[$i] = '<div style="width:80%;border-top: 1px dashed #C3C3C3;padding-top:3px;margin:4px auto;"></div><center><strong>'.$pet['name'].'</strong></center><center><div style="width:140px;">'.$pet['text'].'<br><img src="'.$pet['image'].'" style="no-repeat;"></div>';
			}else{
				$output[$i] = '' ;
			}
			$i++;
		}

		return $output;
	}
}
?>