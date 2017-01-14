<?php
require 'common.inc.php';
if(!$_GET['pid']){showmessage('Error.');}
if(!$_G['uid']){showmessage('not_loggedin', NULL, array(), array('login' => 1));}
$pet = DB::fetch_first("SELECT price,islimited,limited FROM ".DB::table('hen_petshop')." WHERE pid = {$_GET['pid']}");
if($pet['islimited'] == 1 && $pet['limited'] <= 0){showmessage('สิ้นค้าตัวนี้หมดแล้ว');}
if(!$pet){showmessage('Pet Dosen\'t exit.');}
if(DB::fetch_first("SELECT pid FROM ".DB::table('hen_mypet')." WHERE uid = {$_G['uid']} AND pid = {$_GET['pid']}")){showmessage('คุณได้ทำการซื้อสิ้นค้าชิ้นนี้ไปแล้ว','plugin.php?id=hen_pet:petshop');}

$money = DB::fetch_first("SELECT extcredits{$config['money']} FROM ".DB::table('common_member_count')." WHERE uid = {$_G['uid']}");
if($pet['price'] > $money['extcredits'.$config['money']]){showmessage('ขออภัยคุณมีจำนวนเงินไม่พอที่จะซื้อสินค้า','plugin.php?id=hen_pet:petshop');}
$change = $money['extcredits'.$config['money']] - $pet['price'];

if(DB::query("UPDATE ".DB::table('common_member_count')." SET extcredits{$config['money']} = {$change} WHERE uid = {$_G['uid']} LIMIT 1")){
	if($pet['islimited']==1){
		$limit_rem = $pet['limited']-1;
		DB::query("UPDATE ".DB::table('hen_petshop')." SET limited = {$limit_rem} WHERE pid = {$_GET['pid']}");
	}
	DB::query("INSERT INTO ".DB::table('hen_mypet')." (uid,pid) VALUES ('{$_G['uid']}','{$_GET['pid']}')");
		showmessage('คุณได้ทำการซื้อสิ้นค้าชิ้นนี้เรียบร้อยแล้ว','plugin.php?id=hen_pet:mypet');
}
?>