<?php

include_once '../config.php';
include_once '../class/class_product.php';
include_once '../class/class_file.php';
// 导航 当前页面控制
$current_page = 'product-product_add';
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

    <script src="./assets/global/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js" ></script>
<script src="./assets/global/plugins/jquery-file-upload/js/jquery.fileupload.js" ></script>
<script>

jQuery(document).ready(function() {       
    Metronic.init(); // init metronic core components
    Layout.init(); // init current layout
    QuickSidebar.init(); // init quick sidebar
    Demo.init(); // init demo features
    TableManaged.init();
	$(\'#fileSelect\').fileupload({
            dataType: \'json\',
            done: function (e, data) {
                if (data.result.url == null){
                    alert("错误：" + data.result.err_msg);
                }else{
                    //$("#coverPreview").attr(\'src\', data.result.url);
                    $("#fileurl").val(data.result.url);
					$("#fileurl_display").text(data.result.url);
                }
            },
            progress: function (e, data) {

            },
        });
		
    
});
</script>
';
//获取目录数量及内容
$product=new class_product();
$strsql='select * from `product_category`';
$categoryList=$product->select($strsql);
$file=new class_file();
//保存表单内容到数据库
if(array_key_exists('category',$_POST))
{
$imgUrl=$file->save($_POST["img_url"]);

$time = time();
$arr= array("pf_name"=>$_POST["name"],"pf_image"=>$imgUrl,
            "pf_link"=>$_POST["link"],"pf_label"=>$_POST["label"],
			"pf_price"=>$_POST["price"],"pf_discount"=>$_POST["discount"],
			"pc_id"=>$_POST["category"],"pf_addDate"=>date("y-m-d",$time));

$result=$product->insert('product_info',$arr);
}
include 'view/header.php';

include 'view/leftnav.php';

include 'view/product_add.php';

include 'view/quick_bar.php';

include 'view/footer.php';