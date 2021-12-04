<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BlogModel extends CI_model{

	public function __construct(){
		$this->load->database();
	}

	public function getAuthInfo(){
		$query = $this->db->query('SELECT `username`, `photo`, `slogan` FROM `ciblog_users` WHERE 1 LIMIT 0,1');
		$result = $query->result();		//放入查詢結果

		return $result[0];
	}

	public function getAuthLink(){
		$query = $this->db->query('SELECT * FROM `ciblog_app_icon` WHERE `link` IS NOT NULL');
		$result = $query->result();		//放入查詢結果
		foreach($result as $row){
			if($row->app == "Email") $row->link = "mailto:".$row->link;
		}

		return $result;
	}

	public function getCateList(){
		$query = $this->db->query('SELECT `ciblog_categorys`.`name`, COUNT(`ciblog_articles`.`id`) AS `times` FROM `ciblog_categorys` LEFT JOIN `ciblog_articles` ON `ciblog_categorys`.`id` = `ciblog_articles`.`category` WHERE `ciblog_categorys`.`id` != "C999" AND `ciblog_categorys`.`id` <> "C000" AND `ciblog_categorys`.`isActive` = 1 AND `ciblog_articles`.`status` = 1 GROUP BY  `ciblog_categorys`.`id` ORDER BY `ciblog_categorys`.`id`');
		$result = $query->result();		//放入查詢結果

		return $result;
	}

	public function getTagsList(){
		$query = $this->db->query('SELECT `t`.`name`, count(`t`.`aid`) AS `times` FROM `ciblog_tags` AS `t` JOIN `ciblog_articles` AS `a` ON `a`.`id` = `t`.`aid` WHERE `a`.`status` = 1 GROUP BY `name`');
		$result = $query->result();		//放入查詢結果

		return $result;
	}

	public function getArticleList($page, $seg){
		$start = $page*$seg;
		$query = $this->db->query('SELECT * FROM `_view_ciblog_articles_list` WHERE `status` = 1 ORDER BY `publishTime` DESC LIMIT '.$start.','.$seg);
		$result = $query->result();		//放入查詢結果

		return $result;
	}

	public function getArticleCount($page, $seg){
		$query = $this->db->query('SELECT count(*) AS `times` FROM `_view_ciblog_articles_list` WHERE `status` = 1');
		$result = $query->result();		//放入查詢結果

		$times = $result[0]->times;
		if($page > 0) $back = ($page - 1);
		else $back = -1;
		if($times > (++$page)*$seg) $next = $page;
		else $next = -1;

		return array("back" => $back, "next" => $next);
	}

	public function getCateTagList($mode, $name, $page, $seg){
		$start = $page*$seg;
		if($mode == "tag"){
			$query = $this->db->query('SELECT * FROM `_view_ciblog_articles_list` WHERE `status` = 1 AND `ciblog_tags` LIKE "%'.$name.'%" ORDER BY `publishTime` DESC LIMIT '.$start.','.$seg);
		}else if($mode == "cate"){
			$query = $this->db->query('SELECT * FROM `_view_ciblog_articles_list` WHERE `status` = 1 AND `category` = "'.$name.'" ORDER BY `publishTime` DESC LIMIT '.$start.','.$seg);
		}
		
		$result = $query->result();		//放入查詢結果

		return $result;
	}

	public function getCateTagCount($mode, $name, $page, $seg){
		if($mode == "tag"){
			$query = $this->db->query('SELECT count(*) AS `times` FROM `_view_ciblog_articles_list` WHERE `status` = 1 AND `ciblog_tags` LIKE "%'.$name.'%"');
		}else if($mode == "category"){
			$query = $this->db->query('SELECT count(*) AS `times` FROM `_view_ciblog_articles_list` WHERE `status` = 1 AND `category` = "'.$name.'"');
		}
		$result = $query->result();		//放入查詢結果

		$times = $result[0]->times;
		$base = $mode."/".$name."/";
		if($page > 0) $back = $base.($page - 1);
		else $back = -1;
		if($times > (++$page)*$seg) $next = $base.$page;
		else $next = -1;

		return array("back" => $back, "next" => $next);
	}

	public function getArticleTitle($id){
		$query = $this->db->query('SELECT `title` FROM `ciblog_articles` WHERE `id` = "'.$id.'" LIMIT 0,1');
		$result = $query->result();		//放入查詢結果

		return $result[0]->title;
	}

	public function getSingleArticle($id){
		$query = $this->db->query('SELECT * FROM `_view_ciblog_articles_list` WHERE `id` = "'.$id.'" GROUP BY `id`  LIMIT 0,1');
		$result = $query->result();		//放入查詢結果

		return $result[0];
	}

	public function getCpeList(){
		$query = $this->db->query('SELECT `l`.`no`, `c`.`name` AS `category`, `l`.`topic`, `l`.`uva`, `l`.`finishTime` FROM `ciblog_cpe_list` AS `l` JOIN `ciblog_cpe_cate` AS `c` ON `l`.`category` = `c`.`id` WHERE 1 ORDER BY `l`.`no`');
		$result = $query->result();		//放入查詢結果

		return $result;
	}

	public function getSingleCpe($id){
		$query = $this->db->query('SELECT `l`.`no`, `c`.`name` AS `category`, `l`.`topic`, `l`.`uva`, `l`.`finishTime` FROM `ciblog_cpe_list` AS `l` JOIN `ciblog_cpe_cate` AS `c` ON `l`.`category` = `c`.`id` WHERE `l`.`uva` = "'.$id.'" LIMIT 0,1');
		$result = $query->result();		//放入查詢結果

		return $result[0];
	}

	public function DeleteCpe($id){
		$query = $this->db->query('SELECT `uva` FROM `ciblog_cpe_list` WHERE `uva` = "'.$id.'" LIMIT 0,1');
		$result = $query->result();
		if($query->num_rows() < 0) return array("mode"=>-1,"msg"=>"查無此資料");

		//刪除資料
		$this->db->where('uva', $id);
		$query = $this->db->update('ciblog_cpe_list', array("finishTime" => NULL));

		//刪除文件
		$content_url = "application/CPE/";
		$fileName = ($content_url."UVA".$result[0]->uva).".cpp";
		unlink($fileName) or die("Couldn't delete file");

		return array("mode"=>3,"msg"=>"檔案刪除成功");
	}

	public function CodePost($data){
		date_default_timezone_set("Asia/Taipei");
		$uvaId = $data['uva'];
		$codeFile = $data['code'];
		$finishTime = date("Y-m-d H:i:s");

		if($codeFile['name'] != ""){
			$file_dir = "application/CPE/";
			$file_name = "UVA".$uvaId.".cpp";
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));

			$check = getimagesize($codeFile["tmp_name"]);
			if(move_uploaded_file($codeFile["tmp_name"], $file_dir.$file_name)){
		        $this->db->where('uva', $uvaId);
				$query = $this->db->update('ciblog_cpe_list', array('finishTime' => $finishTime));
		    }else{
		    	return array("mode"=>2,"msg"=>"上傳檔案失敗");
		    }
		}

		return array("mode"=>3,"msg"=>"上傳成功");
	}
}
