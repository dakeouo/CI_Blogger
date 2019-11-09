<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dash extends CI_Controller {

	public function setHeaderInfo($title){
		$this->load->library('session');
		if(!$this->session->has_userdata('userEmail')) header("Location:".base_url("dash/login"));
		$data = array(
			'email' => $this->session->userdata('userEmail'),
			'username' => $this->session->userdata('userName'),
			'userphoto' => $this->session->userdata('userPhoto'),
			'title' => $title
		);

		return $data;
	}

	public function index(){
		$this->load->helper('url');
		header("Location:".base_url("dash/article")); 
		// $data = $this->setHeaderInfo("儀錶板");
		// $this->load->view('dash/layout/header', $data);
		// $this->load->view('dash/layout/nav', $data);
		// $this->load->view('dash/index', $data);
		// $this->load->view('dash/layout/footer');
		// $this->load->view('dash/layout/flot');
		// $this->load->view('tag_body_end');
	}

	public function changePasswd($msg = -1){
		$this->load->helper('url');
		$data = $this->setHeaderInfo("變更密碼");
		$data['msg'] = $msg;
		$this->load->view('dash/layout/header', $data);
		$this->load->view('dash/layout/nav', $data);
		$this->load->view('dash/changePasswd', $data);
		$this->load->view('dash/layout/footer');
		$this->load->view('tag_body_end');
	}

	public function changePasswdCheck(){
		$this->load->model('userModel');
		$this->load->library('session');
		$data = array(
			'email' => $this->session->userdata('userEmail'),
			'old_passwd' => md5($_POST['old_passwd']),
			'new_passwd' => md5($_POST['new_passwd'])
		);
		if($_POST['confirm_passwd'] != $_POST['new_passwd']) $this->changePasswd("兩次密碼輸入不一致");
		else{
			$this->load->helper('url');
			$result = $this->userModel->ChangePasswd($data);
			if($result["mode"] == 3) header("Location:".base_url("dash/logout"));
			else $this->changePasswd($result["msg"]);
		}
	}

	public function loginCheck(){
		$this->load->model('userModel');
		$data = array(
			'email' => $_POST['email'],
			'passwd' => md5($_POST['password']),
			'mode' => $_POST['mode']
		);
		if(isset($_POST['code'])) $data['code'] = $_POST['code'];
		$result = $this->userModel->userLogin($data);
		switch ($result["mode"]) {
			case -1:
				$this->login($result["msg"]);
				break;
			case 1:
				$this->loginSetup($data["email"],$result["code"]);
				break;
			case 2:
				$this->login($result["msg"]);
				break;
			case 3:
				$this->load->helper('url');
				header("Location:".base_url("dash")); 
				break;
			default:
				# code...
				break;
		}
	}

	public function loginSetup($email,$code=NULL){
		$this->load->helper('url');
		$data['title'] = "設定密碼";
		$data['msg'] = "初次使用請輸入新密碼";
		$data['email'] = $email;
		$data['code'] = $code;
		$this->load->view('dash/layout/header', $data);
		$this->load->view('dash/setup');
		$this->load->view('dash/layout/footer');
		$this->load->view('tag_body_end');
	}

	public function login($msg = -1){
		$this->load->helper('url');
		$data['title'] = "登入";
		$data['msg'] = $msg;
		$this->load->view('dash/layout/header', $data);
		$this->load->view('dash/login');
		$this->load->view('dash/layout/footer');
		$this->load->view('tag_body_end');
	}
	public function logout(){
		$this->load->helper('url');
		$this->load->library('session');
		$this->session->unset_userdata('userEmail');
		$this->session->unset_userdata('userName');
		header("Location:".base_url("dash"));
	}

	public function author($msg = -1){
		$this->load->helper('url');
		$this->load->model('userModel');
		$data = $this->setHeaderInfo("作者資訊");
		$data['msg'] = $msg;
		$data['app'] = $this->userModel->getApp();
		$this->load->view('dash/layout/header', $data);
		$this->load->view('dash/layout/nav', $data);
		$this->load->view('dash/author', $data);
		$this->load->view('dash/layout/footer');
		$this->load->view('tag_body_end');
	}

	public function userUpload(){
		$this->load->model('userModel');
		$data = array(
			'image' => $_FILES['author-img'],
			'name' => urldecode($_POST['author-name'])
		);
		$result = $this->userModel->userUpload($data);
		switch ($result["mode"]) {
			case -1:
				$this->author($result["msg"]);
				break;
			case 2:
				$this->author($result["msg"]);
				break;
			case 3:
				$this->load->helper('url');
				header("Location:".base_url("dash/author")); 
				break;
			default:
				# code...
				break;
		}
	}

	public function linkEdit($msg = -1){
		$this->load->helper('url');
		$this->load->model('userModel');
		$data = $this->setHeaderInfo("編輯外部連結");
		$data['msg'] = $msg;
		$data['app'] = $this->userModel->getApp();
		$this->load->view('dash/layout/header', $data);
		$this->load->view('dash/layout/nav', $data);
		$this->load->view('dash/link_edit', $data);
		$this->load->view('dash/layout/footer');
		$this->load->view('tag_body_end');
	}

	public function linkEditPost(){
		$this->load->model('userModel');
		$data = array(
			'input' => $_POST['link-input'],
			'type' => $_POST['link-type']
		);
		$result = $this->userModel->linkPost($data);
		switch ($result["mode"]) {
			case 3:
				$this->load->helper('url');
				header("Location:".base_url("dash/author")); 
				break;
			default:
				# code...
				break;
		}
	}

	public function userInfo($msg = -1){
		$this->load->helper('url');
		$this->load->model('userModel');
		$data = $this->setHeaderInfo("編輯關於我");
		$data['msg'] = $msg;
		$data['app'] = $this->userModel->getApp();
		$this->load->view('dash/layout/header', $data);
		$this->load->view('dash/layout/nav', $data);
		$this->load->view('dash/author_post', $data);
		$this->load->view('dash/layout/footer');
		$this->load->view('tag_body_end');
	}

	public function userInfoPost(){
		date_default_timezone_set("Asia/Taipei");
		$this->load->model('userModel');
		$data = array(
			'id' => $_POST['id'],
			'content' => $_POST['content'],
			'editTime' => date("Y-m-d H:i:s")
		);
		$result = $this->userModel->aboutPost($data);
		switch ($result["mode"]) {
			case -1:
				$this->userInfo($result["msg"]);
				break;
			case 2:
				$this->userInfo($result["msg"]);
				break;
			case 3:
				$this->load->helper('url');
				header("Location:".base_url("dash/author")); 
				break;
			default:
				# code...
				break;
		}
	}

	public function CPE_Index($msg = -1){
		$this->load->helper('url');
		$this->load->model('blogModel');
		$data = $this->setHeaderInfo("CPE管理");
		$data['msg'] = $msg;
		$data['CPE_list'] = $this->blogModel->getCpeList();
		$this->load->view('dash/layout/header', $data);
		$this->load->view('dash/layout/nav', $data);
		$this->load->view('dash/cpe_index', $data);
		$this->load->view('dash/layout/footer');
		$this->load->view('tag_body_end');
	}

	public function CPE_Upload(){
		$this->load->model('blogModel');
		$data = array(
			'code' => $_FILES['upload_code'],
			'uva' => $_POST['uva']
		);
		$result = $this->blogModel->CodePost($data);
		switch ($result["mode"]) {
			case 2:
				$this->CPE_Index($result["msg"]);
				break;
			case 3:
				$this->load->helper('url');
				header("Location:".base_url("dash/cpe")); 
				break;
			default:
				# code...
				break;
		}
	}

	public function previewCPE($id){
		$this->load->model('blogModel');
		$data['title'] = "[預覽]UVA".$id;
		$data['cpe'] = $this->blogModel->getSingleCpe($id);
		$this->load->helper('url');	
		$this->load->view('blog/layout/header',$data);
		$this->load->view('blog/preCode',$data);
		$this->load->view('blog/layout/footer');
	}

	public function CPE_Delete($id){
		$this->load->model('blogModel');
		$result = $this->blogModel->DeleteCpe($id);
		switch ($result["mode"]) {
			case -1:
				$this->CPE_Index($result["msg"]);
				break;
			case 2:
				$this->CPE_Index($result["msg"]);
				break;
			case 3:
				$this->load->helper('url');
				header("Location:".base_url("dash/cpe"));
				break;
			default:
				# code...
				break;
		}
	}
}
