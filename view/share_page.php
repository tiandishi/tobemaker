<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>share</title>
    <?php include "top_css.php" ?>
    <script type="text/javascript" src="js/md5.js"></script> 
    <link rel="stylesheet" type="text/css" href="css/redactor.css">
    <link rel="stylesheet" type="text/css" href="css/simditor.css"/>
</head>
<body>
<div id="top">
    <?php include "header.php" ?>
</div>
<div id="center">
    <div class="middle">
        <div class="share">
            <div class="pic">
                <div class="picture">
                    <label>标题</label>
                    <img id="coverPreview" src="asset/14.png" alt="">

                </div>
                <p>*上述内容均为原创作品</p>
                <p>*上述内容均为现实可实现的</p>

            </div>
            <div class="form">
                <form id="idea-form" method="POST">
                    <label>标题</label>
                    <input name="title" type="text">
                    <label>作者<span></span></label>
                    <input name="author" type="text" disabled="true" value=
                    <?php
                    echo "\"".$current_user['user_name']."\"";
                    ?>
                    >                    

    <input name="token" type="hidden" value=<?php
    echo "\"".$upToken."\"";

    ?>>

                    <label>封面<span>（大图片建议尺寸 900像素*500像素）</span></label>
                    <div class="fileupload">
                        <div>上传<i id='upload-progress-label'></i></div>
                        <input id="fileSelect" type="file" name="file" data-url="http://up.qiniu.com/">
                        <input id="fileurl" type="hidden" name="img_url" value=""/>
                    </div>
                    <input name="cover_display" type="checkbox" value="1"><span>封面图片显示在正文中</span>
                    <label>标签<span>（标签之前用英文逗号分隔，最多5个标签）</span></label>
                    <input id="tmpTagText" type="text" />
                    <input id="trueTagText" name="tags" type="hidden" />
                    <div id="tagView">d</div>
                    <label class="last">正文</label>
                    <div class="textdiv">
                  		<textarea id="editor" name="content" placeholder="这里输入内容" autofocus></textarea>					
                    </div>
                    <input type="hidden" name="act" value="create_share" />
                    <input type="hidden" name="user_id" value="2" />

                </form>
            </div>
            <div class="submit">
                <div class="out">
                    <div>
                        <button class="save">保存</button>
                        <button class="view">预览</button>
                    </div>
                </div>
            </div>
            <br class="clear"/>
        </div>

    </div>

</div>
<div id="footer">
    <?php include "footer.php" ?>
</div>
    
    <?php include "bottom_js.php" ?>
    <script src="js/redactor.js"></script>
    <script src="admin/assets/global/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js" ></script>
    <script src="admin/assets/global/plugins/jquery-file-upload/js/jquery.fileupload.js" ></script>
	<script src="js/simditor-all.min.js" type="text/javascript" charset="utf-8"></script>

    <script>
    $(document).ready(function(){
        $('#content').redactor();
        $('#fileSelect').fileupload({
            dataType: 'json',
            done: function (e, data) {
                if (data.result.key == null){
                    alert("错误：" + data.result.err_msg);
                }else{
                    var url="http://yzzwordpress.qiniudn.com/"+ data.result.key;
                    $("#coverPreview").attr('src', url);
                    $("#fileurl").val(url);
                }
                $('#upload-progress-label').text('');
            },
            progress: function (e, data) {
                console.log(data);
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#upload-progress-label').text(progress+'%');
            },
        });

        
        $('button.save').click(function(){
            $('#idea-form').action="../share.php";
            $('#idea-form').submit();
        });

        $('button.view').click(function(){
            // alert('结果预览');
            var formData = $('#idea-form').serialize();
            $.post('project.php', formData, function(data, textStatus){
                var win=window.open("about blank");
                win.document.write(data);
            });
        });
        
        $('#tmpTagText').keyup(function(){
            var labelArr = $(this).val().split(',');
            var trueLabelArr = new Array();
            console.log(labelArr);
            $('#tagView').html('');
            for (var i=0; i<5 && i<labelArr.length; i++){
                trueLabelArr.push(labelArr[i]);
                $('#tagView').append('<span class="tag">' + labelArr[i] + '</span>');
            }
//          $('#tagView').html(trueLabelArr.join(','));
            $('#trueTagText').val(trueLabelArr.join(','));
        });
    });

    </script>
    <script type="text/javascript" charset="utf-8">
		var editor = new Simditor({
			textarea: $('#editor'),
			 toolbar:  ['title', 'bold', 'italic', 'underline', 'strikethrough', 'color', '|', 'ol', 'ul', 'blockquote', 'code', 'table',  'link', 'image', 'hr', '|', 'indent', 'outdent'],
		});
    </script>
</body>
</html>