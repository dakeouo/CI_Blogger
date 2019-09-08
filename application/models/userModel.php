<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class userModel extends CI_model{

	public function __construct(){
		$this->load->database();
	}

	public function getRand($len){
		$result = "";
		for($i=0;$i<$len; $i++) { 
			$rand = Rand(0,35);
			if($rand < 10) $result = $result.chr($rand + 48);
			else $result = $result.chr($rand + 55);
		}

		return $result;
	}

	public function ChangePasswd($data){
		$email = $data['email'];
		$old_passwd = $data['old_passwd'];
		$new_passwd = $data['new_passwd'];

		$this->db->select('passwd');
		$query = $this->db->get_where('users', array('email' => $email));
		$result = $query->result();		//放入查詢結果
		if(!count($result)) return array("mode"=>-1,"msg"=>"查無此帳號");
		else if($old_passwd != $result[0]->passwd) return array("mode"=>2,"msg"=>"舊密碼輸入錯誤");
		else if($new_passwd == $old_passwd) return array("mode"=>1,"msg"=>"新密碼與舊密碼相同");
		else{
			$this->db->set('passwd', $new_passwd)->where('email', $email);
			$this->db->update('users');
			return array("mode"=>3,"msg"=>"密碼修改成功");
		}

	}

	public function UserLogin($data){
		$email = $data['email'];
		$passwd =$data['passwd'];
		$mode = $data['mode'];
		if(isset($data['code'])) $code = $data['code'];

		$this->db->select('passwd, username');
		$query = $this->db->get_where('users', array('email' => $email));
		$result = $query->result();		//放入查詢結果
		if(!count($result)) return array("mode"=>-1,"msg"=>"查無此帳號，請重新輸入"); 	//查不到回傳-1

		switch ($mode) {
			case 0:
				if($result[0]->passwd == '123456' && $passwd == md5("123456")){
					$code = $this->getRand(10);
					$this->db->set('passwd', $code)->where('email', $email);
					$this->db->update('users');
					return array("mode"=>1,"code"=>$code);
				}else if($passwd != $result[0]->passwd) return array("mode"=>2,"msg"=>"密碼錯誤，請重新輸入");
				else if($passwd == $result[0]->passwd){
					$this->load->library('session');
					$this->session->set_userdata('userEmail', $email);
					$this->session->set_userdata('userName', $result[0]->username);
					return array("mode"=>3,"msg"=>"登入成功");
				}
				else return array("mode"=>-1,"msg"=>"發生技術性錯誤，請稍後再試");
				break;
			case 1:
				if($result[0]->passwd == $code){
					$this->db->set('passwd', $passwd)->where('email', $email);
					$this->db->update('users');
					return array("mode"=>3,"msg"=>"登入成功");
				}else return array("mode"=>2,"msg"=>"無法變更密碼");
				break;
			default:
				return array("mode"=>-1,"msg"=>"發生技術性錯誤，請稍後再試");
				break;
		}
	}
}
