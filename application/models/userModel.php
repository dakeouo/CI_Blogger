<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_model{

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
		$query = $this->db->get_where('ciblog_users', array('email' => $email));
		$result = $query->result();		//放入查詢結果
		if(!count($result)) return array("mode"=>-1,"msg"=>"查無此帳號");
		else if($old_passwd != $result[0]->passwd) return array("mode"=>2,"msg"=>"舊密碼輸入錯誤");
		else if($new_passwd == $old_passwd) return array("mode"=>1,"msg"=>"新密碼與舊密碼相同");
		else{
			$this->db->set('passwd', $new_passwd)->where('email', $email);
			$this->db->update('ciblog_users');
			return array("mode"=>3,"msg"=>"密碼修改成功");
		}

	}

	public function UserLogin($data){
		$email = $data['email'];
		$passwd =$data['passwd'];
		$mode = $data['mode'];
		if(isset($data['code'])) $code = $data['code'];

		$this->db->select('passwd, username, photo, slogan');
		$query = $this->db->get_where('ciblog_users', array('email' => $email));
		$result = $query->result();		//放入查詢結果
		if(!count($result)) return array("mode"=>-1,"msg"=>"查無此帳號，請重新輸入"); 	//查不到回傳-1

		switch ($mode) {
			case 0:
				if($result[0]->passwd == '123456' && $passwd == md5("123456")){
					$code = $this->getRand(10);
					$this->db->set('passwd', $code)->where('email', $email);
					$this->db->update('ciblog_users');
					return array("mode"=>1,"code"=>$code);
				}else if($passwd != $result[0]->passwd) return array("mode"=>2,"msg"=>"密碼錯誤，請重新輸入");
				else if($passwd == $result[0]->passwd){
					$this->load->library('session');
					$this->session->set_userdata('userEmail', $email);
					$this->session->set_userdata('userName', $result[0]->username);
					$this->session->set_userdata('userPhoto', $result[0]->photo);
					$this->session->set_userdata('userSlogan', $result[0]->slogan);
					return array("mode"=>3,"msg"=>"登入成功");
				}
				else return array("mode"=>-1,"msg"=>"發生技術性錯誤，請稍後再試");
				break;
			case 1:
				if($result[0]->passwd == $code){
					$this->db->set('passwd', $passwd)->where('email', $email);
					$this->db->update('ciblog_users');
					return array("mode"=>3,"msg"=>"登入成功");
				}else return array("mode"=>2,"msg"=>"無法變更密碼");
				break;
			default:
				return array("mode"=>-1,"msg"=>"發生技術性錯誤，請稍後再試");
				break;
		}
	}

	public function getApp(){
		$query = $this->db->query('SELECT * FROM `ciblog_app_icon` WHERE 1 ORDER BY `icon_front` ASC');
		$result = $query->result();		//放入查詢結果
		if($query->num_rows() < 1) return -1;
		else return $result;
	}

	public function userUpload($data){
		$this->load->library('session');
		$image = $data['image'];
		$newName = $data['name'];
		$newSlogan = $data['slogan'];
		$oldName = $this->session->userdata('userName');
		$oldPhoto = $this->session->userdata('userPhoto');
		$oldSlogan = $this->session->userdata('userSlogan');
		$email = $this->session->userdata('userEmail');

		//變更作者名稱
		if(($newName != $oldName) or ($newSlogan != $oldSlogan)){
			$this->db->select('username');
			$query = $this->db->get_where('ciblog_users', array('email' => $email));
			$result = $query->result();		//放入查詢結果
			if(!count($result)) return array("mode" => -1,"msg" => "查無此帳號");
			else{
				$this->db->where('email', $email);
				$query = $this->db->update('ciblog_users', array('username' => $newName, 'slogan' => $newSlogan));
				$this->session->set_userdata('userName', $newName);
				$this->session->set_userdata('userSlogan', $newSlogan);
			}
		}

		if($image['name'] != ""){
			$file_dir = "asset/default/users/";
			$file_name = $image["name"];
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));

			$check = getimagesize($image["tmp_name"]);
    		if($check !== false) {
        		if(move_uploaded_file($image["tmp_name"], $file_dir.$file_name)){
			        if(($oldPhoto != "none.png")AND($oldPhoto != $file_name)){
			        	unlink($file_dir.$oldPhoto);
			        }
			        $this->db->where('email', $email);
					$query = $this->db->update('ciblog_users', array('photo' => $file_name));
					$this->session->set_userdata('userPhoto', $file_name);
			    }else{
			    	return array("mode"=>2,"msg"=>"上傳圖片失敗");
			    }
    		}else{
        		return array("mode"=>2,"msg"=>"上傳的並非圖片");
    		}
		}
		

		return array("mode"=>3,"msg"=>"修改完成");
	}

	public function linkPost($data){
		$input = $data['input'];
		$type = $data['type'];
		for($i=0; $i<count($type); $i++){
			if($input[$i] == "") $input[$i] = NULL;
			$this->db->where('app', $type[$i]);
			$query = $this->db->update('ciblog_app_icon', array("link" => $input[$i]));
		}

		return array("mode"=>3,"msg"=>"修改完成");
	}

	public function aboutPost($data){
		date_default_timezone_set("Asia/Taipei");

		//新增內文檔案
		$id = $data['id'];
		$content_url = $this->config->item('content_url');
		$fileName = $content_url.$id.".html";
		$createFile = fopen($fileName, 'w+') or die('Cannot open file:  '.$fileName);
		fwrite($createFile, $data['content']);
		fclose($createFile);

		//儲存編輯時間
		$this->db->where('id', $id);
		$query = $this->db->update('ciblog_articles', array('editTime' => $data['editTime']));
		
		return array("mode"=>3,"msg"=>"文章儲存成功");
	}
}
