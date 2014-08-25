<?php

include 'config.php';
include_once ROOT_PATH."class/class_file.php";
include_once ROOT_PATH."class/class_idea.php";

// 导航 当前页面控制
$current_page = 'share';
$page_level = explode('-', $current_page);


//保存提交的想法
if(array_key_exists('img_url',$_POST))
{
	//保存图片
	$tmp_url=$_POST['img_url'];
	$file_instance = new class_file();
	$pic_url=$file_instance->save($tmp_url);
	// 保存其他信息  预留字段user_id 和user_name
	$arr= array();
	$arr['name']=$_POST['title'];
	$arr['content']=$_POST['content'];
	$arr['picture_url']=$pic_url;
	if(array_key_exists('cover-display', $_POST))
	{
		$arr['cover_display']=1;
	}

	//$arr['user_name']=$_POST['user_id'];
	$arr['user_id']=3;

	$new_idea= new class_idea();
	$new_idea_id=$new_idea->insert("idea_info",$arr);
	$url="Location:".BASE_URL."project.php?idea_id=".$new_idea_id;
	header($url);
}


include 'view/share_page.php';
