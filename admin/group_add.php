<?php

include_once '../config.php';
include_once '../class/class_group.php';

// 导航 当前页面控制
$current_page = 'group-group_add';
$page_level = explode('-', $current_page);

$page_level_style = '
<link rel="stylesheet" type="text/css" href="./assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="./assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
';

$page_level_plugins = '
<script type="text/javascript" src="./assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="./assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="./assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
';

$page_level_script = '<script src="./assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="./assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="./assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="./assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="./assets/user/pages/scripts/product_list.js"></script>

 
<script>

jQuery(document).ready(function() {       
    Metronic.init(); // init metronic core components
    Layout.init(); // init current layout
    QuickSidebar.init(); // init quick sidebar
    Demo.init(); // init demo features
    TableManaged.init();
	
		
    
});
</script>
';

include 'view/header.php';

include 'view/leftnav.php';

include 'view/group_add.php';

include 'view/quick_bar.php';

include 'view/footer.php';
//表单处理
$group=new class_group();
if(array_key_exists('group_name',$_POST))
{
$arr=array("group_name"=>$_POST["group_name"]);
//验证是否重复
$result=$group->check_is_unique('group',$arr);

if(!$result)
{
$result=$group->insert($_POST["group_name"]);

}
else
{
//弹出重复框
}
             
//返回成功信息
}