<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends CI_Controller {
	public function __construct() {
        parent::__construct();
	 $this->load->library('form_validation');
	}

	public function index(){
		if($this->admin->isLogged()){
	$this->load->view('admin/home/dashboard');
		}
		else{
			redirect('admin/common/login');
		}
}

	public function login(){
		$this->load->view('admin/home/login');
	}
	public function change_password(){
		$this->load->view('admin/home/change_password');
	}

	public function check_login(){
		if($this->admin->login($this->input->post('username'), $this->input->post('password'))){
			redirect('admin/common');
		}
		else{
			$this->session->set_flashdata("msg","Username Or Password not match.");
			redirect('admin/common/login');
		}
	}

	public function logout(){
		$t = $this->admin->logout();
			redirect('admin/common/login');
	}

	public function check_change_password(){
		$new_password = md5($this->input->post('new'));
		$old_password = md5($this->input->post('old'));
		$sql = $this->db->query("SELECT * FROM admin WHERE admin_id = '" . (int)$this->session->userdata('admin_id') . "' AND password = '" . $old_password . "'");
			if($sql->num_rows()){
				$q = $this->db->query("UPDATE admin SET password = '" . $new_password . "' WHERE admin_id = '" . (int)$this->session->userdata('admin_id') . "'");
					if($q){
						$msg_data = "Password Changed. Now You can login with new password";
					}
				else{
					$msg_data = "Database Error !!!!";
				}
			}
			else{
				$msg_data = "Don't you have your password";
			}
			redirect('admin/common/change_password?msg='.$msg_data);
	}

	public function edit(){
		$query = $this->db->query("SELECT * FROM admin WHERE admin_id = '" . $this->admin->getId() . "'");
		foreach($query->result() as $query){
			$data['id'] = $query->admin_id;
			$data['name'] = $query->name;
			$data['email'] = $query->email;
			$data['mobile'] = $query->mobile;
			$data['username'] = $query->username;
			$data['image'] = $query->image;
		}
		$this->load->view('admin/home/change_password',$data);
	}

	public function edit_admin(){
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		if($this->form_validation->run()==FALSE){
			 $this->session->set_userdata('info', "2--".validation_errors());
		}
		else{
			if($_FILES['image']['name']){
			 $con['upload_path']   = './uploads/';
         $con['allowed_types'] = 'gif|jpg|png|jpeg';
          $con['maintain_ratio'] = TRUE;
		 $con['max_filename'] = '50';
         $con['encrypt_name'] = TRUE;
         $this->load->library('upload', $con);
				if (!$this->upload->do_upload('image')) {
                  $this->session->set_userdata('info', "2--".$this->upload->display_errors());
				   exit;
                } else {
            $image_data = $this->upload->data();
			$image = "uploads/".$image_data['file_name'];
					$go['source_image'] = $image;
				$go['maintain_ratio'] = TRUE;
				$go['width'] = 200;
					$this->load->library('image_lib', $go);
					$this->image_lib->resize();
				}
		}
			else{
				$image = $this->input->post('o_image');
			}
		$query = $this->db->query("UPDATE admin SET name = '" . $this->db->escape_str($this->input->post('name')) . "', email = '" . $this->db->escape_str($this->input->post('email')) . "', username = '" . $this->db->escape_str($this->input->post('username')) . "', mobile = '" . $this->db->escape_str($this->input->post('mobile')) . "', image = '" . $image . "'");
		if($query){
			$this->session->set_userdata('info', "1--Successfully done");
		}
		else{
			$this->session->set_userdata('info', "2--Error!!!");
		}
		}
		redirect('admin/common');
	}

		public function pages(){
		$data['pages'] = $this->Master_model->get_pages();
		if ($this->admin->getInfo()){
			$info = explode('--', $this->admin->getInfo());
			$data['info'] = $info[1];
			$data['info_type'] = $info[0];
		} else {
			$data['info'] = '';
			$data['info_type'] = '';
		}
		$this->load->view('admin/master/page_list',$data);
	}

	public function pages_add(){
		if($this->input->get('id')){
			$query = $this->Master_model->get_page_by_id($this->input->get('id'));
			foreach($query->result() as $query){
			$data['id'] = $query->page_id;
			$data['name'] = $query->name;
			$data['seo'] = $query->slug;
			$data['data'] = $query->_data;
			$data['metatitle'] = $query->metatitle;
			$data['metadescription'] = $query->metadescription;
			$data['metakeyword'] = $query->metakeyword;
			$data['o_img'] = $query->image;
			$data['status'] = $query->status;
			}
		}
		else{
			$data['id'] = "";
			$data['name'] = "";
			$data['data'] = "";
			$data['seo'] = "";
			$data['metatitle'] = "";
			$data['metadescription'] = "";
			$data['o_img'] = "";
			$data['metakeyword'] = "";
			$data['status'] = "";
		}
		$this->load->view('admin/master/page',$data);
	}

	public function add_pages(){
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		if($this->form_validation->run()==FALSE){
			 $this->session->set_userdata('info', "2--".validation_errors());
		}
		else{
			if($_FILES['image']['name']){
			$con['upload_path']   = './uploads/';
         $con['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
         $con['max_size']      = 0;
         $con['max_width']     = 0;
         $con['max_height']    = 0;
		 $con['max_filename'] = '50';
         $con['encrypt_name'] = TRUE;
         $this->load->library('upload', $con);
				if (!$this->upload->do_upload('image')) {
                   echo $this->upload->display_errors();
				   exit;
                } else {
            $image_data = $this->upload->data();
			$image = "uploads/".$image_data['file_name'];
               }
		}
			else{
				$image = $this->input->post('o_image');
			}
		if($this->input->post('id')){
			$query = $this->Master_model->edit_page($image);
		}
		else{
			$query = $this->Master_model->add_page($image);
		}
		if($query){
				$this->session->set_userdata('info', "1--Successfully done");
			}
			else{
				$this->session->set_userdata('info', "2--Error!!!");
			}
		redirect('admin/common/pages');
	}
	}

	public function delete_page(){
		$id = implode(',',$this->input->post('check_list'));
		$query = $this->Master_model->delete_page($id);
		if($query){
				$this->session->set_userdata('info', "1--Successfully deleted");
			}
			else{
				$this->session->set_userdata('info', "2--Error!!!");
			}
		redirect('admin/common/pages');
	}
}
