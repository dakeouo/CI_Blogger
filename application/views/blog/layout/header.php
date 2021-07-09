<html lang="en">
<head>
	<title><?php echo $title." - ".$this->config->item('blog_name'); ?></title>
	<link rel="icon" href="<?php echo base_url("asset/blog/img/favicon.ico"); ?>" type="image/x-icon" />
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<script src="<?php echo base_url('asset/blog/js/jquery.min.js');?>"></script>
	<script src="<?php echo base_url('asset/blog/js/skel.min.js');?>"></script>
	<script src="<?php echo base_url('asset/blog/js/skel-layers.min.js');?>"></script>
	<script src="<?php echo base_url('asset/blog/js/init.js');?>"></script>
	<!-- Custom Fonts -->
	<script src="https://kit.fontawesome.com/cdb1f069da.js"></script>
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.7.0/styles/agate.min.css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.7.0/highlight.min.js"></script>
	<script>hljs.initHighlightingOnLoad();</script>
	<noscript>
		<link rel="stylesheet" href="<?php echo base_url('asset/blog/css/skel.css'); ?>" />
		<link rel="stylesheet" href="<?php echo base_url('asset/blog/css/style.css'); ?>" />
		<link rel="stylesheet" href="<?php echo base_url('asset/blog/css/xlarge.css'); ?>" />
	</noscript>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-152749873-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-152749873-1');
	</script>
</head>
<body>