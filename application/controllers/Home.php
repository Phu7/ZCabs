<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('api/Api_model');
		$this->load->library('form_validation');
	}

	public function index(){
		$data['locations'] = $this->Api_model->get_location();
		$data['site_locations'] = $this->Api_model->get_site_location();
		$this->load->view("front/home",$data);
	}

	public function cms(){
		$slug = $this->uri->segment(1);
		$result = $this->Api_model->get_cms($slug);
		if($result->num_rows()){
		$data['result'] = $result->row();
		$this->load->view("front/cms",$data);
		}
		else{
		redirect("/");
		}
	}

	public function offers(){
		$data['result'] = $this->Api_model->get_offers();
		$this->load->view("front/offers",$data);
	}

	public function sight_areas(){
		$data['result'] = $this->Api_model->get_site_location();
		$this->load->view("front/areas",$data);
	}

	public function sight_area(){
		$slug = $this->uri->segment(2);
		$id = $this->customer->isArea($slug);
		if($id){
		$data['result'] = $this->Api_model->get_packages($id);
		$this->load->view("front/packages",$data);
		}
		else{
			redirect("/");
		}
	}

	public function package_detail(){
		$id = $this->input->post('id');
		if($id){
		$data['result'] = $this->Api_model->get_package($id);
		$this->load->view("front/package",$data);
		}
		else{
			echo "No page Found";
		}
	}

	public function package_detail_reserve(){
		$id = $this->input->post('id');
		if($id){
		$data['result'] = $this->Api_model->get_package($id);
		$this->load->view("front/package_reserve",$data);
		}
		else{
			echo "No page Found";
		}
	}

	public function get_outstation_price(){
		/* echo '<pre>';print_r($_POST);exit();  */
		$data['to'] = $this->input->post('_to');
		$data['from'] = $this->input->post('_from');
		$data['return_date'] = $this->input->post('return_date');
		$data['date'] = $this->input->post('departure_date');
		$data['passengers'] = $this->input->post('passengers');
		$data['type'] = $this->input->post('type');
		$data['pool_type'] = $this->input->post('pool_type');

		if($data['pool_type'] == 'Shared'){
		$data['lo_to'] = $this->Api_model->get_locality($data['to']);
		$data['lo_from'] = $this->Api_model->get_locality($data['from']);
		$data['result'] = $this->Api_model->get_outstation_price($data['to'], $data['from'], $data['date']);
		if($data['result']->num_rows()){
			$this->load->view('front/outstation_price', $data);
		}
		else{
			echo '2';
		}
		}
		else{
		$data['result'] = $this->Api_model->get_reserved_outstation_price($data['to'], $data['from']);
		if($data['result']->num_rows()){
			$this->load->view('front/outstation_reserved_price', $data);
		}
		else{
			echo '2';
		}
		}
	}

	public function contact_us(){
		if($this->input->get('status') == 2){
			$this->session->set_flashdata('msg','This route is not currently available. But it is coming soon.<br/>For more enquiry please leave us a message.');
			$this->session->set_flashdata('is_success','1');
		}
		$this->load->view("front/contact_us");
	}

	public function submit_contact_us(){
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|valid_email');
		$this->form_validation->set_rules('message', 'Message', 'trim|required');


		if($this->form_validation->run()==FALSE){
			 $data['success'] = '0';
			$data['message'] = validation_errors();
		}
		else{
		$query = $this->Api_model->send_contact();
		if($query){
			$data['success'] = '1';
			$data['message'] = "Your Query submitted successfully. We will catch you as soon as possible.";
		}
		else{
			$data['success'] = '0';
			$data['message'] = "Some error Occures. Please Inform us.";
		}
		}
		echo json_encode($data);
	}

	public function submit_outstation(){
		$this->form_validation->set_rules('_to', 'To', 'trim|required');
		$this->form_validation->set_rules('_from', 'From', 'trim|required');
		$this->form_validation->set_rules('departure_date', 'Departure date', 'trim|required');
		$this->form_validation->set_rules('return_date', 'Return Date', 'trim');
		$this->form_validation->set_rules('passengers', 'Passengers', 'trim|required');


		if($this->form_validation->run()==FALSE){
			$data['success'] = '0';
		 $data['message'] =  validation_errors();
		}
		else{
			$id = $this->customer->getId();
			if($id){
		$query = $this->Api_model->add_outstation($id);
		if($query){
			$data['success'] = '1';
			$data['message'] = "Your Query submitted successfully. We will catch you as soon as possible.";
		}
		else{
			$data['success'] = '0';
			$data['message'] = "Some error Occures. Please Inform us.";
		}
		}
		else{
			$data['success'] = '2';
			$data['message'] = 'Login To Submit Request.';
			$data['code_string'] = array("_to"=>$this->input->post("_to"),
										 "_from"=>$this->input->post("_from"),
										 "departure_date"=>$this->input->post("departure_date"),
										 "return_date"=>$this->input->post("return_date"),
										 "passengers"=>$this->input->post("passengers"),
										 "type"=>$this->input->post("type"),
										 "pull_type"=>$this->input->post("pull_type"),
										);
		}
		}

		echo json_encode($data);
	}

	public function add_final_outstation(){
		$data['id'] = $this->input->get('id');
		$data['oedid'] = $this->input->get('oedid');
		$data['pool_type'] = $this->input->get('pool_type');
		$data['type'] = $this->input->get('type');
		$data['dep_date'] = $this->input->get('dep_date');
		$data['return_date'] = $this->input->get('return_date');
		$data['passengers'] = $this->input->get('passengers');
		$data['pickup_point'] = $this->input->get('pickup');
		$data['drop_point'] = $this->input->get('drop');
		if($data['pool_type'] == 'Shared'){
			$query = $this->Api_model->get_shared_trip($data['id']);
			if($query->num_rows()){
				$q = $query->row();
				$data['vehicle_name'] = $q->vehicle_name;
				$data['price'] = $q->fare * $data['type'] * $data['passengers'];
				$data['from'] = $q->from;
				$data['to'] = $q->to;

			}
		}
		else{
			$query = $this->Api_model->get_reserved_trip($data['id']);
			if($query->num_rows()){
				$q = $query->row();
				$data['vehicle_name'] = $q->vehicle_name;
				$data['price'] = $q->fare * $data['type'];
				$data['from'] = $q->from;
				$data['to'] = $q->to;
			}
		}


		if($this->customer->isLogged()){
			$r = $this->Api_model->add_final_razor($data);
			$raz['order_id'] = $r['order_id'];
			$raz['oedid'] = $data['oedid'];
			$walletAmount = $this->customer->getWallet();
						if($walletAmount >= $r['price']){
							$se['walletToCut'] = $r['price'];
							$se['toPay'] = 0;
							$this->session->set_userdata("payment", $se);
							$this->load->view("front/razorpay/confirm_wallet", $raz);

						} else{
							$se['walletToCut'] = $walletAmount;
							$se['toPay'] = $r['price'] - $walletAmount;
							$this->session->set_userdata("payment", $se);
							$raz['amount'] = $r['price'] - $walletAmount;


						$raz['title'] = 'Checkout payment | Razorpay';
						$raz['total'] = ($r['price'] - $walletAmount) * 100;

						$cst = $this->db->query("SELECT first_name, last_name, email, mobile FROM customer WHERE id = '" . (int)$this->customer->getId() . "'")->row();

						$raz['name'] = $cst->first_name . " " . $cst->last_name;
						$raz['email'] = $cst->email;
						$raz['mobile'] = $cst->mobile;

						$raz['return_url'] = site_url().'razorpay/callback_final';
						$raz['surl'] = site_url().'razorpay/success_order';
						$raz['furl'] = site_url().'razorpay/failed';
						$raz['currency_code'] = 'INR';
						$this->load->view("front/razorpay/chf", $raz);
					}
		}
		else{
			$this->session->set_userdata('d', $data);
			$this->session->set_flashdata('msg','Please Login /Register To Scheduled a Trip.');
			$this->session->set_flashdata('is_success','1');
				redirect('login');
		}
	}

	public function confirmByWallet(){
		$order_id = $this->input->post('order_id');
		$oedid = $this->input->post('oedid');
		$this->Api_model->add_final_wallet_confirm($order_id, $oedid);
		redirect("razorpay/success_order");
	}

	public function submit_local(){
		$this->form_validation->set_rules('_to', 'To', 'trim|required');
		$this->form_validation->set_rules('_from', 'From', 'trim|required');


		if($this->form_validation->run()==FALSE){
			$data['success'] = '2';
		 $data['message'] = validation_errors();
		}
		else{
			$id = $this->customer->getId();
			if($id){
				$query = $this->Api_model->submit_local($id);
				if($query){
					$data['success'] = '1';
					$data['message'] = "Your Query submitted successfully. We will catch you as soon as possible.";
				}
				else{
					$data['success'] = '0';
					$data['message'] = "Some error Occures. Please Inform us.";
				}
		}
		else{
			$data['success'] = '2';
			$data['message'] = 'Login To Submit Request.';
			$data['code_string'] = array("_to"=>$this->input->post("_to"),
																	 "_from"=>$this->input->post("_from"),
																	 "departure_date"=>'',
																	 "return_date"=>'',
																	 "passengers"=>'',
																	 "type"=>'4',
																	 "pull_type"=>'',
																	);
		}
		}
		echo json_encode($data);
	}

	public function submit_sight(){
		$this->form_validation->set_rules('departure_date', 'Departue Date', 'trim|required');
		$this->form_validation->set_rules('sight_id', 'Sight', 'trim|required');
		$this->form_validation->set_rules('passengers', 'Passengers', 'trim|required');


		if($this->form_validation->run()==FALSE){
			$data['success'] = '0';
		 $data['message'] =  validation_errors();
		}
		else{

		$query = $this->Api_model->add_sight_razor($this->customer->getId());
		if($query){
			$data['success'] = '1';
			$data['amount'] = $query['price'];
			$data['order_id'] = $query['order_id'];
		}
		else{
			$data['success'] = '0';
			$data['message'] = "Some error Occures. Please Inform us.";
		}
		}

		echo json_encode($data);
	}
}
