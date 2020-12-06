<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

		public function __construct() {
			parent::__construct();
			$this->load->model('admin/User_model');
			$this->load->library('form_validation');
		}

		public function index(){
		if ($this->admin->getInfo()){
			$info = explode('--', $this->admin->getInfo());
			$data['info'] = $info[1];
			$data['info_type'] = $info[0];
		} else {
			$data['info'] = '';
			$data['info_type'] = '';
		}
		$this->load->view('admin/user/user_list',$data);
	}

	public function update(){
		$query = $this->User_model->update($this->input->get('id'), $this->input->get('status'));
		if($query){
				$this->session->set_userdata('info', "1--Successfully updated");
			}
			else{
				$this->session->set_userdata('info', "2--Error!!!");
			}
		redirect('admin/user');
	}

	public function delete(){
		$id = implode(',',$this->input->post('check_list'));
		$query = $this->User_model->delete($id);
		if($query){
				$this->session->set_userdata('info', "1--Successfully deleted");
			}
			else{
				$this->session->set_userdata('info', "2--Error!!!");
			}
		redirect('admin/user');
	}


	public function get_list(){
		   $fetch_data = $this->User_model->get_list();
		//	$i = $_POST['start'] + 1 ;
           $data = array();
           foreach($fetch_data as $user){
                $sub_array = array();
                $sub_array[] = ' <input type="checkbox" name="check_list[]" id="checkbox" class="checkbox" value="'.$user->id.'" />';

				$sub_array[] = $user->first_name . " " . $user->last_name;
				$sub_array[] = $user->email;
				$sub_array[] = $user->mobile;
				$sub_array[] = $user->address."<br/>".$user->city.", ".$user->state.", ".$user->pincode;
				$sub_array[] = date("d/m/Y", strtotime($user->created));
				$sub_array[] = ($user->status == '1') ? '<div class="label label-success">Enabled</div>':'<div class="label label-danger">Disabled</div>';
				$sub_array[] = ($user->status == '1') ? '<a class="btn btn-info btn-sm" data-toggle="tooltip" title="Edit" href="'.base_url().'admin/user/update?id='.$user->id.'&status=2">Disable</a>':'<a class="btn btn-info btn-sm" data-toggle="tooltip" title="Edit" href="'.base_url().'admin/user/update?id='.$user->id.'&status=1">Enable</a>';
                $data[] = $sub_array;
           }
           $output = array(
                "draw"                    =>     intval($_POST["draw"]),
                "recordsTotal"          =>      $this->User_model->get_all_data(),
                "recordsFiltered"     =>     $this->User_model->get_filtered_data(),
                "data"                    =>     $data
           );
           echo json_encode($output);
	}

}
