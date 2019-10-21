<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="navbar-header">
        <a class="navbar-brand" href="<?php echo base_url("dash"); ?>"><img src="<?php echo base_url("asset/default/logo.png"); ?>" alt="<?php echo $this->config->item('blog_name') ?>" style="margin-top: -2px;" height="23px"></a>
    </div>

    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>

    <!-- <ul class="nav navbar-nav navbar-left navbar-top-links">
        <li><a href="#"><i class="fa fa-home fa-fw"></i>&nbsp;返回網站</a></li>
    </ul> -->

    <ul class="nav navbar-right navbar-top-links">
        <li><div style="margin-top: 10px; margin-right: 10px; color: #ccc;">
            <img src="<?php echo base_url("asset/default/none.png"); ?>" width="30px" height="30px" style="border-radius: 15px;">
            &nbsp;<?php echo $username; ?>
        </div></li>
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li><a href="<?php echo base_url("dash"); ?>"><i class="fa fa-dashboard fa-fw"></i>&nbsp;儀錶板</a></li>
                <li>
                    <a href="#"><i class="fas fa-atlas"></i>&nbsp;文章<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="<?php echo base_url("dash/category");?>">類別/標籤</a></li>
                        <li><a href="<?php echo base_url("dash/article");?>">文章管理</a></li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li><a href="#"><i class="fas fa-chart-area"></i>&nbsp;統計分析</a></li>
                <li>
                    <a href="#"><i class="fas fa-cog"></i>&nbsp;設定<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="#">作者資訊</a></li>
                        <li><a href="<?php echo base_url("dash/changePasswd");?>">更改密碼</a></li>
                        <li><a href="#">系統重置</a></li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li><a href="<?php echo base_url("dash/logout");?>"><i class="fas fa-sign-out-alt"></i>&nbsp;登出</a></li>
            </ul>
        </div>
    </div>
</nav>
</head>