<body onload="index()">
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="page-header"><?php echo $title; ?></h2>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">
                    <div class="col-lg-12" style="margin-bottom: 10px;">
                        <div class="alert alert-danger" id="msg-box" style="display: none;">
                            <?php echo $msg ?>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div style="margin-bottom: 10px; display: inline-flex;">
                                    <button type='button' style="margin: 0 5px 0 5px;" class='btn btn-default' onclick="<?php echo "location.href='".base_url("dash/article")."'";?>">返回</button>
                                    <button type='button' style="margin: 0 5px 0 5px;" class='btn btn-success'>發布</button>
                                </div>
                                <div class="table-responsive">
                                    <form role="form" method="POST" action="<?php echo base_url("dash/article/save") ?>">
                                        <input type="hidden" name="mode" value="<?php echo $mode; ?>">
                                        <input type="hidden" name="aid" value="<?php echo $aid; ?>">
                                        <div class="col-sm-10"><input class="form-control" placeholder="標題" name="title" required value="<?php if($AC != -1) echo $AC[0]->title ?>"></div>
                                        <div class="col-sm-2">
                                            <select class="form-control" name="category" required>
                                                <?php
                                                foreach($type as $row) {
                                                    echo "<option value=\"".$row->id."\" ";
                                                    if(($AC != -1)AND($row->id == $AC[0]->category)) echo "selected=\"selected\"";
                                                    echo ">".$row->name."</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-12" style="margin-top: 10px;"><textarea id="textbox" name="content" style="width: 100%; height: 400px;">
                                        <?php if($AC != -1) include_once "application/content/".$AC[0]->id.".html"; ?>
                                        </textarea></div>
                                        <div class="col-sm-12" style="margin-top: 10px;"><input class="form-control" name="tag" placeholder="標籤" value="<?php if($AC != -1) echo $AC[0]->tags ?>"></div>
                                        <div class="col-sm-12" style="color: red;">注意：請使用[空格]來隔開標籤。</div>
                                        <div class="col-sm-12" style="margin-top: 10px;"><button type="submit" class="btn btn-primary">儲存文章</button></div>
                                    </form>
                                </div>
                            <!-- /.panel-body -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type='text/javascript' src='<?php echo base_url('asset/dash/textboxio/textboxio.js');?>'></script>
    <script>
        function index(){
            var msg = document.getElementById('msg-box').innerHTML;
            if(msg == -1) document.getElementById('msg-box').style.display = "none";
            else document.getElementById('msg-box').style.display = "block";
            init();
        }
        function init(){instantiateTextbox();}
        var instantiateTextbox = function () {textboxio.replaceAll('textarea', {paste: {style: 'clean'},css: {stylesheets: ['./example.css']}});};
        var getEditorContent = function(){
          var editors = textboxio.get('#textbox');
          var editor = editors[0];
          return editor.content.get();
        };
    </script>