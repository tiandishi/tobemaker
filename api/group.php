<?php
  /* 
   * Paging

   */
include_once "../config.php";
include_once ROOT_PATH."class/class_group.php";
$group=new class_group();
$iTotalRecords =$group->get_group_num();

//if (array_key_exists('action', $_REQUEST)){
//
//    var_dump($_REQUEST);
//    exit();
//}
function get_detail_by_group_id($group_id)
{

  //获取数据
  $requests=$group->get_group_by_id($group_id);

  //组织数据
  $cords = array();

  //返回数据
  echo json_encode($cords);
}

function update_one_group( $group_id,$column,$values){
  $group->update_one($group_id,$column,$values);
  // 返回数据
  $res= array();
  $res['status']='success';
  echo json_encode($res);
}

$status_list = array(

  array("success" => "正常"),
  array("error" => "下线")
  
);
//如果是修改请求
//则做出相应修改
if(isset($_POST["action"])&&isset($_POST["productID"])){
  $act=$_POST["action"];
  $pf_id=$_POST["productID"];
  $num=count($pf_id);
  $i=0;

  
}

elseif(isset($_POST["action"])&&empty($_POST["productID"])){
  $res= array();
     $res['status']='error';
     echo json_encode($res);
}

else {
  # code...
// 总项目数
// 当前显示数量
$iDisplayLength = intval($_REQUEST['length']);
$iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 

// 开始位置

$iDisplayStart = intval($_REQUEST['start']);

// Draw counter. 
// This is used by DataTables to ensure that the Ajax 
// returns from server-side processing requests are drawn 
// in sequence by DataTables (Ajax requests are asynchronous 
// and thus can return out of sequence). This is used as part 
// of the draw return parameter.
$sEcho = intval($_REQUEST['draw']);

$records = array();
$records["data"] = array(); 

$end = $iDisplayStart + $iDisplayLength;
$end = $end > $iTotalRecords ? $iTotalRecords : $end;
$real_length=$end-$iDisplayStart;

 // 获取数据

$datalist=$group->get_part_group($iDisplayStart,$real_length);
$real_length= count($datalist);
for($i = 0; $i < $real_length; $i++) {
    $status = $status_list[0];
  $id = $datalist[$i]["group_id"];
  $records["data"][] = array(
    '<input class="checkboxes" type="checkbox" name="id[]" value="'.$id.'"/>',
    $id,
    '<span name="name" id="name">'.$datalist[$i]["group_name"].'</span><input name="group_name" class="form-control input group-name" value="'.$datalist[$i]["group_name"].'" style="display:none"/>',
	
    '<a  class="btn btn-xs blue group-edit"><i class="fa fa-search"></i>编辑</a><a  class="btn btn-xs blue edit-confirm" style="display:none"><i class="fa fa-search"></i>确定</a><a style="display:none"  class="btn btn-xs blue edit-cancel"><i class="fa fa-search"></i>取消</a>',
      
  );
}


/*if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
  $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
  $records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
}*/
$records["draw"] = $sEcho;
$records["recordsTotal"] = $iTotalRecords;
$records["recordsFiltered"] = $iTotalRecords;
echo json_encode($records);
}
