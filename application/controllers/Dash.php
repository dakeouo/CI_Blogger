<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dash extends CI_Controller {

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

	public function index(){
		$this->load->helper('url');
		$data = $this->setHeaderInfo("儀錶板");
		$this->load->view('dash/layout/header', $data);
		$this->load->view('dash/layout/nav', $data);
		$this->load->view('dash/index', $data);
		$this->load->view('dash/layout/footer');
		$this->load->view('dash/layout/flot');
		$this->load->view('tag_body_end');
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
}
