<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {

	public function setArticleHeader($title){
		$data = array(
			'author' => $this->blogModel->getAuthInfo(),
			'app_link' => $this->blogModel->getAuthLink(),
			'cate_list' => $this->blogModel->getCateList(),
			'tags_list' => $this->blogModel->getTagsList(),
			'title' => $title
		);

		return $data;
	}

	public function index($page = 0){
		$this->load->model('blogModel');
		$data = $this->setArticleHeader("首頁");
		$data['subtitle'] = "初代自製個人網站，目前為個人作品展示用";
		$data['Article_list'] = $this->blogModel->getArticleList($page, 5);
		$data['Article_count'] = $this->blogModel->getArticleCount($page, 5);
		$this->load->helper('url');	
		$this->load->view('blog/layout/header',$data);
		$this->load->view('blog/layout/nav');
		$this->load->view('blog/index',$data);
		$this->load->view('blog/layout/left-nav',$data);
		$this->load->view('blog/layout/footer');
	}

	public function categoryView($name, $page = 0){
		$this->load->model('blogModel');
		$name = urldecode($name);
		$data = $this->setArticleHeader("分類 [".$name."]");
		$data['subtitle'] = "分類 [".$name."]";
		$data['Article_list'] = $this->blogModel->getCateTagList('category', $name, $page, 5);
		$data['Article_count'] = $this->blogModel->getCateTagCount('category', $name, $page, 5);
		$this->load->helper('url');	
		$this->load->view('blog/layout/header',$data);
		$this->load->view('blog/layout/nav');
		$this->load->view('blog/index',$data);
		$this->load->view('blog/layout/left-nav',$data);
		$this->load->view('blog/layout/footer');
	}

	public function tagView($name, $page = 0){
		$this->load->model('blogModel');
		$name = urldecode($name);
		$data = $this->setArticleHeader("標籤 #".$name);
		$data['subtitle'] = "標籤 #".$name;
		$data['Article_list'] = $this->blogModel->getCateTagList('tag', $name, $page, 5);
		$data['Article_count'] = $this->blogModel->getCateTagCount('tag', $name, $page, 5);
		$this->load->helper('url');	
		$this->load->view('blog/layout/header',$data);
		$this->load->view('blog/layout/nav');
		$this->load->view('blog/index',$data);
		$this->load->view('blog/layout/left-nav',$data);
		$this->load->view('blog/layout/footer');
	}

	public function SingleArticle($id){
		$this->load->model('blogModel');
		$data = $this->setArticleHeader($this->blogModel->getArticleTitle($id));
		$data['article'] = $this->blogModel->getSingleArticle($id);
		$this->load->helper('url');	
		$this->load->view('blog/layout/header',$data);
		$this->load->view('blog/layout/nav');
		$this->load->view('blog/article',$data);
		$this->load->view('blog/layout/left-nav',$data);
		$this->load->view('blog/layout/footer');
	}

	public function about(){
		$this->load->model('blogModel');
		$data['title'] = "關於我";
		$data['subtitle'] = "About Me";
		$data['app_link'] = $this->blogModel->getAuthLink();
		$data['author'] = $this->blogModel->getAuthInfo();
		$this->load->helper('url');	
		$this->load->view('blog/layout/header',$data);
		$this->load->view('blog/layout/nav');
		$this->load->view('blog/about',$data);
		$this->load->view('blog/layout/footer');
	}

	public function cpeList(){
		$this->load->model('blogModel');
		$data['title'] = "大學程式能力檢定(CPE) 一星精選題";
		$data['cpe_list'] = $this->blogModel->getCpeList();
		$this->load->helper('url');	
		$this->load->view('blog/layout/header',$data);
		$this->load->view('blog/layout/nav');
		$this->load->view('blog/cpe',$data);
		$this->load->view('blog/layout/footer');
	}

	public function cpeSingle($id){
		$this->load->model('blogModel');
		$data['title'] = "UVA".$id;
		$data['cpe'] = $this->blogModel->getSingleCpe($id);
		$this->load->helper('url');	
		$this->load->view('blog/layout/header',$data);
		$this->load->view('blog/layout/nav');
		$this->load->view('blog/cpe-view',$data);
		$this->load->view('blog/layout/footer');
	}
}
