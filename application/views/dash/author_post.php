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
                                    <button type='button' style="margin: 0 5px 0 5px;" class='btn btn-default' onclick="<?php echo "location.href='".base_url("dash/author")."'";?>">返回</button>
                                </div>
                                <div class="table-responsive">
                                    <form role="form" method="POST" action="<?php echo base_url("dash/author/info") ?>">
                                        <input type="hidden" name="id" value="<?php echo $this->config->item('about_file'); ?>">
                                        <div class="col-sm-12" style="margin-top: 10px;"><textarea id="textbox" name="content" style="width: 100%; height: 400px;">
                                        <?php include_once $this->config->item('content_url').$this->config->item('about_file').".html"; ?>
                                        </textarea></div>
                                        <div class="col-sm-12" style="margin-top: 10px;"><button type="submit" class="btn btn-primary">儲存</button></div>
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