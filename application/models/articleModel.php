<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class articleModel extends CI_model{

	public function __construct(){
		$this->load->database();
	}

	public function getID($type, $len, $num){
		return $type.str_pad($num, $len, "0", STR_PAD_LEFT);
	}

	public function deleteCategory($id){
		$query = $this->db->query('SELECT `name` FROM `categorys` WHERE `id` = \''.$id.'\' LIMIT 0,1');
		if($query->num_rows() < 0) return array("mode"=>-1,"msg"=>"查無此類別");
		$result = $query->result();

		#更新系統變數
		$this->db->where('id', $id);
		$query = $this->db->update('categorys', array('isActive' => 0));

		return array("mode"=>3,"msg"=>"類別刪除成功");
	}

	public function updateCategory($data){
		$id = $data['id'];
		$name = $data['name'];
		
		$query = $this->db->query('SELECT `id`, `name` FROM `categorys` WHERE `id` != "C999" AND `id` = \''.$id.'\' LIMIT 0,1');
		if($query->num_rows() < 0) return array("mode"=>-1,"msg"=>"查無此類別");
		$result = $query->result();
		$oldName = $result[0]->name;
		if($name == $oldName) return array("mode"=>2,"msg"=>"與舊名稱重複");

		#更新系統變數
		$this->db->where('id', $id);
		$query = $this->db->update('categorys', array('name' => $name));

		return array("mode"=>3,"msg"=>"類別更新成功");
	}

	public function getNewCategory($name){
		#查詢目前編號值
		$query = $this->db->query('SELECT `value` FROM `sys_val` WHERE `name` = "artice_category_id" LIMIT 0,1');
		$result = $query->result();
		if($query->num_rows() < 1) return array("mode"=>-1,"msg"=>"編號時發生錯誤");
		$nowNum = $result[0]->value;
		$newID = 'C'.str_pad(++$nowNum, 3, "0", STR_PAD_LEFT); #進行新編號

		#查詢名稱是否重複
		$query = $this->db->query('SELECT `id` FROM `categorys` WHERE `name` = "'.$name.'" LIMIT 0,1');
		if($query->num_rows() > 0) return array("mode"=>2,"msg"=>"類別名稱重複");

		#新增類別
		$newData = array('id' => $newID, 'name' => $name);
		$query = $this->db->insert('categorys', $newData);
		#更新系統變數
		$this->db->where('name', "artice_category_id");
		$query = $this->db->update('sys_val', array('value' => $nowNum));

		return array("mode"=>3,"msg"=>"類別新增成功");
	}

	public function getType(){
		$query = $this->db->query('SELECT `id`, `name` FROM `categorys` WHERE `id` != "C999" ORDER BY `id`');
		$result = $query->result();		//放入查詢結果
		if($query->num_rows() < 1) return -1;
		else return $result;
	}

	public function getCategory(){
		$query = $this->db->query('SELECT `categorys`.`id`, `categorys`.`name`, COUNT(`articles`.`id`) AS `times` FROM `categorys` LEFT JOIN `articles` ON `categorys`.`id` = `articles`.`category` WHERE `categorys`.`id` != "C999" AND `categorys`.`id` <> "C000" AND `categorys`.`isActive` = 1 GROUP BY  `categorys`.`id` ORDER BY `categorys`.`id`');
		$result = $query->result();		//放入查詢結果
		if($query->num_rows() < 1) return -1;
		else return $result;
	}

	public function getTag(){
		$query = $this->db->query('SELECT `name`, count(`aid`) AS `times` FROM `tags` GROUP BY `name`');
		$result = $query->result();		//放入查詢結果
		if($query->num_rows() < 1) return -1;
		else return $result;
	}

	public function getArticle(){
		$query = $this->db->query('SELECT `a`.`id`, `c`.`name` AS `category`, `a`.`title`, `a`.`editTime`, `a`.`publishTime`, `a`.`status` FROM `articles` AS `a` LEFT JOIN `categorys` AS `c` ON `a`.`category` = `c`.`id`  WHERE `c`.`id` != "C999" ORDER BY `a`.`publishTime` DESC');
		$result = $query->result();		//放入查詢結果
		if($query->num_rows() < 1) return -1;
		else return $result;
	}

	public function postDraft($data){
		date_default_timezone_set("Asia/Taipei");
		if($data['mode'] == 0) $id = date('Ymd').str_pad(hexdec(uniqid())%1000000,6,'0',STR_PAD_LEFT);
		else $id = $data['id'];

		//新增內文檔案
		$content_url = $this->config->item('content_url');
		$fileName = $content_url.$id.".html";
		$createFile = fopen($fileName, 'w+') or die('Cannot open file:  '.$fileName);
		fwrite($createFile, $data['content']);
		fclose($createFile);

		#儲存文章
		if($data['mode'] == 0){
			$newData = array(
				'id' => $id, 'title' => $data['title'], 
				'category' => $data['category'], 'above' => $data['above'],
				'editTime' => $data['editTime']
			);
			$query = $this->db->insert('articles', $newData);
		}else{
			$newData = array(
				'title' => $data['title'], 'category' => $data['category'], 
				'above' => $data['above'], 'editTime' => $data['editTime']
			);
			$this->db->where('id', $id);
			$query = $this->db->update('articles', $newData);
		}
		
		if($data['mode'] == 1){
			//刪除標籤
			$this->db->where('aid', $id);
			$query = $this->db->delete('tags');
		}

		#新增標籤
		$tags = $data['tag'];
		if($tags[0] != ""){
			for($i=0;$i<count($tags);$i++){
				$query = $this->db->insert('tags', array('name' => $tags[$i], 'aid' => $id));
			}
		}
		
		return array("mode"=>3,"msg"=>"文章儲存成功");
	}

	public function publishDraft($id){
		date_default_timezone_set("Asia/Taipei");
		$query = $this->db->query('SELECT `id` FROM `articles` WHERE `status` = 1 AND `category` <> "C999" ORDER BY `publishTime` DESC LIMIT 0,1');
		$result = $query->result();		//放入查詢結果
		if($query->num_rows() < 1) $back_id = NULL;
		else{
			$back_id = $result[0]->id;
			if($back_id != $id){
				$this->db->where('id', $back_id);
				$query = $this->db->update('articles', array('next_id' => $id));
			}
		}

		$newData = array('publishTime' => date("Y/m/d H:i:s"), 'back_id' => $back_id, 'status' => 1);
		$this->db->where('id', $id);
		$query = $this->db->update('articles', $newData);
		
		return array("mode"=>3,"msg"=>"文章發布成功");
	}

	public function toDraft($id){
		date_default_timezone_set("Asia/Taipei");
		$query = $this->db->query('SELECT `back_id`, `next_id` FROM `articles` WHERE `id` = "'.$id.'" LIMIT 0,1');
		$result = $query->result();		//放入查詢結果
		if($query->num_rows() < 1) return -1;
		else{
			$back_id = $result[0]->back_id;
			$next_id = $result[0]->next_id;
			if($back_id != $id){
				$this->db->where('id', $back_id);
				$query = $this->db->update('articles', array('next_id' => $next_id));
			}
			if($next_id != $id){
				$this->db->where('id', $next_id);
				$query = $this->db->update('articles', array('back_id' => $back_id));
			}
			$newData = array('publishTime' => NULL, 'back_id' => NULL, 'next_id' => NULL, 'status' => 0);
			$this->db->where('id', $id);
			$query = $this->db->update('articles', $newData);
		}
		
		return array("mode"=>3,"msg"=>"文章還原成功");
	}

	public function getDraft($id){
		$query = $this->db->query('SELECT `articles`.`id`, `articles`.`category`, `articles`.`title`, `articles`.`status`,  GROUP_CONCAT((`tags`.`name`) separator \' \') AS `tags` FROM `articles` LEFT JOIN `tags` ON `articles`.`id` = `tags`.`aid` WHERE `articles`.`id` = "'.$id.'" GROUP BY `articles`.`id`  LIMIT 0,1');
		$result = $query->result();		//放入查詢結果
		if($query->num_rows() < 1) return -1;
		else return $result;
	}

	public function getDraft2Cate($id){
		$query = $this->db->query('SELECT `articles`.`id`, `categorys`.`name` AS `category`,  `articles`.`title`, `articles`.`publishTime`, `articles`.`editTime`, `articles`.`status` FROM `tags` JOIN `articles` ON `tags`.`aid` = `articles`.`id` JOIN `categorys` ON `categorys`.`id` = `articles`.`category` WHERE `categorys`.`id` != "C999" AND `categorys`.`id` = "'.$id.'" GROUP BY `articles`.`id`');
		$result = $query->result();		//放入查詢結果
		if($query->num_rows() < 1) return -1;
		else return $result;
	}

	public function getDraft2Tag($name){
		$query = $this->db->query('SELECT `articles`.`id`, `categorys`.`name` AS `category`,  `articles`.`title`, `articles`.`publishTime`, `articles`.`editTime`, `articles`.`status` FROM `tags` JOIN `articles` ON `tags`.`aid` = `articles`.`id` JOIN `categorys` ON `categorys`.`id` = `articles`.`category` WHERE `categorys`.`id` != "C999" AND `tags`.`name` = "'.$name.'" GROUP BY `articles`.`id`');
		$result = $query->result();		//放入查詢結果
		if($query->num_rows() < 1) return -1;
		else return $result;
	}

	public function DeleteArticle($id){
		$query = $this->db->query('SELECT `id` FROM `Articles` WHERE `id` = \''.$id.'\' LIMIT 0,1');
		if($query->num_rows() < 0) return array("mode"=>-1,"msg"=>"查無此文章");
		$result = $query->result();

		//刪除標籤
		$this->db->where('aid', $id);
		$query = $this->db->delete('tags');

		//刪除文章
		$this->db->where('id', $id);
		$query = $this->db->delete('articles');

		//刪除文件
		$content_url = $this->config->item('content_url');
		$fileName = ($content_url.$result[0]->id).".html";
		unlink($fileName) or die("Couldn't delete file");

		return array("mode"=>3,"msg"=>"文章刪除成功");
	}
}
