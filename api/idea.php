<?php
  /* 
   * Paging
   */

// 总项目数
$iTotalRecords = 208;


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


// 随机生成数据
$status_list = array(
  array("success" => "Pending"),
  array("info" => "Closed"),
  array("danger" => "On Hold"),
  array("warning" => "Fraud")
);

for($i = $iDisplayStart; $i < $end; $i++) {
  $status = $status_list[rand(0, 2)];
  $id = ($i + 1);
  $records["data"][] = array(
    '<input type="checkbox" name="id[]" value="'.$id.'"/>',
    $id,
    '12/09/2013',
    'Jhon Doe',
    'Jhon Doe',
    '<span class="label label-sm label-'.(key($status)).'">'.(current($status)).'</span>',
    '<a href="javascript:;" class="btn btn-xs blue"><i class="fa fa-search"></i>批准</a>'
      . '<a href="javascript:;" class="btn btn-xs red"><i class="fa fa-search"></i>拒绝</a>'
      . '<a href="javascript:;" class="btn btn-xs default"><i class="fa fa-search"></i>查看</a>',
  );
}

if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
  $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
  $records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
}

$records["draw"] = $sEcho;
$records["recordsTotal"] = $iTotalRecords;
$records["recordsFiltered"] = $iTotalRecords;

echo json_encode($records);
