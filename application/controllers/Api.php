<?php

require_once APPPATH . 'libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Api extends REST_Controller {
	function __construct($config = 'rest'){
		parent::__construct($config);
	}

function nilais_get(){
	$id = $this->get('id');
	if ($id){
		$nilai = $this->db->get_where('nilai',
			array('id' => $id))->result();
	} else {
		$nilai = $this->db->get('nilai')->result();
	}
	if($nilai){
		$this->response($nilai,200);
	} else {
		$this->response(array('status'=>'not found'),404);
	}
}

function nilais_post(){
	$params = array(
		'kode' => $this->post('Kode'),
		'nim' => $this->post('Nim'),
		'matakuliah' => $this->post('Matakuliah'),
		'kpkl' => $this->post('Kpkl'),
		'khs' => $this->post('Khs'),
		'dosenp' => $this->post('Dosenp'));
	$process = $this->db->insert('nilai', $params);
	if($process){
		$this->response(array('status'=>'success'),201);
	} else {
		return $this->response(array('status'=>'fail'), 502);
	}
}

function nilais_put(){
	$params = array(
		'kode' => $this->put('Kode'),
		'nim' => $this->put('Kim'),
		'matakuliah' => $this->put('Matakuliah'),
		'kpkl' => $this->put('Kpkl'),
		'khs' => $this->put('Khs'),
		'dosenp' => $this->put('Dosenp'));
	$this->db->where('id', $this->put('id'));
	$execute = $this->db->update('nilai', $params);
	if($execute){
		$this->response(array('status'=>'success'),201);
	} else {
		return $this->response(array('status'=>'fail'), 502);
	}
}

function nilais_delete(){
	$this->db->where('id', $this->delete('id'));
	$execute = $this->db->delete('nilai');
	if($execute){
		$this->response(array('status'=>'success'),201);
	} else {
		return $this->response(array('status'=>'fail'), 502);
	}
}
}
?>