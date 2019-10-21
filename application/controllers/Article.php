<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends CI_Controller {

	public function setHeaderInfo($title){
		$this->load->library('session');
		if(!$this->session->has_userdata('userEmail')) header("Location:".base_url("dash/login"));
		$data = array(
			'email' => $this->session->userdata('userEmail'),
			'username' => $this->session->userdata('userName'),
			'title' => $title
		);

		return $data;
	}

	public function index($msg = -1){
		$this->load->helper('url');
		$this->load->model('articleModel');
		$data = $this->setHeaderInfo("文章管理");
		$data['msg'] = $msg;
		$data['article'] = $this->articleModel->getArticle();	
		$this->load->view('dash/layout/header', $data);
		$this->load->view('dash/layout/nav', $data);
		$this->load->view('dash/article', $data);
		$this->load->view('dash/layout/footer');
		$this->load->view('tag_body_end');
	}

	public function category($msg = -1){
		$this->load->helper('url');
		$this->load->model('articleModel');
		$data = $this->setHeaderInfo("類別/標籤");
		$data['msg'] = $msg;
		$data['category'] = $this->articleModel->getCategory();
		$data['tag'] = $this->articleModel->getTag();
		$this->load->view('dash/layout/header', $data);
		$this->load->view('dash/layout/nav', $data);
		$this->load->view('dash/category', $data);
		$this->load->view('dash/layout/footer');
		$this->load->view('tag_body_end');
	}

	public function categoryDelete($id){
		$this->load->model('articleModel');
		$result = $this->articleModel->DeleteCategory($id);
		switch ($result["mode"]) {
			case -1:
				$this->category($result["msg"]);
				break;
			case 2:
				$this->category($result["msg"]);
				break;
			case 3:
				$this->load->helper('url');
				header("Location:".base_url("dash/category")); 
				break;
			default:
				# code...
				break;
		}
	}

	public function categoryNew(){
		$this->load->model('articleModel');
		$cate_name = $_POST['name'];
		$result = $this->articleModel->getNewCategory($cate_name);
		switch ($result["mode"]) {
			case -1:
				$this->category($result["msg"]);
				break;
			case 2:
				$this->category($result["msg"]);
				break;
			case 3:
				$this->load->helper('url');
				header("Location:".base_url("dash/category")); 
				break;
			default:
				# code...
				break;
		}
	}

	public function categoryEdit(){
		$this->load->model('articleModel');
		$data = array(
			'id' => $_POST['id'],
			'name' => $_POST['name']
		);
		$result = $this->articleModel->updateCategory($data);
		switch ($result["mode"]) {
			case -1:
				$this->category($result["msg"]);
				break;
			case 2:
				$this->category($result["msg"]);
				break;
			case 3:
				$this->load->helper('url');
				header("Location:".base_url("dash/category")); 
				break;
			default:
				# code...
				break;
		}
	}

	public function categoryView($id ,$msg = -1){
		$this->load->helper('url');
		$this->load->model('articleModel');
		$data = $this->setHeaderInfo("檢視類別 - ".$id);
		$data['msg'] = $msg;
		$data['article'] = $this->articleModel->getDraft2Cate($id);
		$this->load->view('dash/layout/header', $data);
		$this->load->view('dash/layout/nav', $data);
		$this->load->view('dash/cate_tagView', $data);
		$this->load->view('dash/layout/footer');
		$this->load->view('tag_body_end');
	}

	public function tagView($name ,$msg = -1){
		$name = urldecode($name);
		$this->load->helper('url');
		$this->load->model('articleModel');
		$data = $this->setHeaderInfo("檢視標籤 #".$name);
		$data['msg'] = $msg;
		$data['article'] = $this->articleModel->getDraft2Tag($name);
		$this->load->view('dash/layout/header', $data);
		$this->load->view('dash/layout/nav', $data);
		$this->load->view('dash/cate_tagView', $data);
		$this->load->view('dash/layout/footer');
		$this->load->view('tag_body_end');
	}

	public function postArticle($msg = -1){
		$this->load->helper('url');
		$this->load->model('articleModel');
		$data = $this->setHeaderInfo("新增文章");
		$data['msg'] = $msg;
		$data['mode'] = 0;
		$data['type'] = $this->articleModel->getType();
		$data['AC'] = -1;
		$data['aid'] = -1;
		$this->load->view('dash/layout/header', $data);
		$this->load->view('dash/layout/nav', $data);
		$this->load->view('dash/article-post', $data);
		$this->load->view('dash/layout/footer');
		$this->load->view('tag_body_end');
	}

	public function postArticleSave(){
		date_default_timezone_set("Asia/Taipei");
		$this->load->model('articleModel');
		$data = array(
			'title' => $_POST['title'],
			'id' => $_POST['aid'],
			'category' => $_POST['category'],
			'content' => $_POST['content'],
			'mode' => $_POST['mode'],
			'above' => mb_substr(strip_tags($_POST['content']),0,80,"utf-8"),
			'tag' => preg_split('/[\s,]+/', $_POST['tag']),
			'editTime' => date("Y-m-d H:i:s")
		);
		$result = $this->articleModel->postDraft($data);
		switch ($result["mode"]) {
			case -1:
				$this->postArticle($result["msg"]);
				break;
			case 2:
				$this->postArticle($result["msg"]);
				break;
			case 3:
				$this->load->helper('url');
				header("Location:".base_url("dash/article")); 
				break;
			default:
				# code...
				break;
		}
	}

	public function ArticleDelete($id){
		$this->load->model('articleModel');
		echo $id;
		$result = $this->articleModel->DeleteArticle($id);
		switch ($result["mode"]) {
			case -1:
				$this->index($result["msg"]);
				break;
			case 2:
				$this->index($result["msg"]);
				break;
			case 3:
				$this->load->helper('url');
				header("Location:".base_url("dash/article"));
				break;
			default:
				# code...
				break;
		}
	}

	public function ArticleEdit($id = "1", $msg = -1){
		$this->load->helper('url');
		$this->load->model('articleModel');
		$data = $this->setHeaderInfo("修改文章");
		$data['msg'] = $msg;
		$data['mode'] = 1;
		$data['type'] = $this->articleModel->getType();
		$data['AC'] = $this->articleModel->getDraft($id);
		$data['aid'] = $id;
		$this->load->view('dash/layout/header', $data);
		$this->load->view('dash/layout/nav', $data);
		$this->load->view('dash/article-post', $data);
		$this->load->view('dash/layout/footer');
		$this->load->view('tag_body_end');
	}
}
