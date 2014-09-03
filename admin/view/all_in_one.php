<!DOCTYPE html>
<!-- 
Description: Responsive Admin Dashboard Template build with Twitter Bootstrap 3.2.0
Version: 3.1.3
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="cn">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title>呆萌科技</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>

    <?php include 'inc_global_css.php'; ?>

    <!-- BEGIN PAGE LEVEL STYLES -->
    <?=@$page_level_style?>
    <!-- END PAGE LEVEL STYLES -->

    <?php include 'inc_theme_css.php'; ?>

    <link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<body class="page-header-fixed page-quick-sidebar-over-content page-header-fixed-mobile page-footer-fixed1">
    
    <?php include "inc_header.php"; ?>
    <div class="clearfix"></div>
    
    <!-- BEGIN CONTAINER -->
    <div class="page-container">
        <?php include 'leftnav.php'; ?>
        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <div class="page-content">

                <?php include "inc_page_header.php"; ?>

                <!-- BEGIN PAGE CONTENT-->
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet box grey-cascade">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-globe"></i>项目列表
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse">
                                    </a>
                                    <a href="#portlet-config" data-toggle="modal" class="config">
                                    </a>
                                    <a href="javascript:;" class="reload">
                                    </a>
                                    <a href="javascript:;" class="remove">
                                    </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                    <div class="table-toolbar">
                                            <div class="row">
                                                    <div class="col-md-6">
                                                            <div class="btn-group">
                                                                    <button id="sample_editable_1_new" class="btn green">
                                                                    添加项目 <i class="fa fa-plus"></i>
                                                                    </button>

                                                            </div>
                                                            <div class="btn-group">
                                                                    <button id="sample_editable_1_pass" class="btn blue">
                                                                    批准项目 <i class="fa fa-plus"></i>
                                                                    </button>
                                                            </div>
                                                            <div class="btn-group">
                                                                    <button id="sample_editable_1_reject" class="btn red">
                                                                    拒绝项目 <i class="fa fa-plus"></i>
                                                                    </button>
                                                            </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                            <div class="btn-group pull-right">
                                                            <button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i>
                                                            </button>
                                                            <ul class="dropdown-menu pull-right">
                                                                    <li>
                                                                            <a href="#">
                                                                            Print </a>
                                                                    </li>
                                                                    <li>
                                                                            <a href="#">
                                                                            Save as PDF </a>
                                                                    </li>
                                                                    <li>
                                                                            <a href="#">
                                                                            Export to Excel </a>
                                                                    </li>
                                                            </ul>
                                                            </div>
                                                    </div>
                                            </div>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover" id="idea_list_table" data-url="<?=BASE_URL?>api/idea.php">
                                    <thead>
                                    <tr>
                                            <th class="table-checkbox">
                                                    <input type="checkbox" class="group-checkable" data-set="#idea_list_table .checkboxes"/>
                                            </th>
                                            <th>
                                                     想法id
                                            </th>
                                            <th>
                                                     想法名称
                                            </th>
                                            <th>
                                                     想法作者
                                            </th>
                                            <th>
                                                     简介
                                            </th>
                                            <th>
                                                     状态
                                            </th>
                                            <th>
                                                     操作
                                            </th>
                                    </tr>
                                    </thead>
                                    </table>
                            </div>
                        </div>
                        <!-- END EXAMPLE TABLE PORTLET-->
                    </div>
                </div>

                <!-- END PAGE CONTENT-->
            </div>
        </div>
        <!-- END CONTENT -->

    </div>
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    <?php include 'inc_footer_bar.php'; ?>
    <!-- END FOOTER -->
    <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
    <!-- BEGIN CORE PLUGINS -->
    <?php include 'inc_core_plugin.php'; ?>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <?=@$page_level_plugins?>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <?=@$page_level_script?>
    <!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>