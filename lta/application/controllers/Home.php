<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

  public function __construct() {
   parent::__construct();
	 $this->load->library('form_validation');
   $this->load->model('Home_model');
	}

  public function index(){
    $data['result'] = $this->Home_model->getHome();
    $data['metatitle'] = "CSIR NET Life Science Coaching in Jaipur, Delhi & Varanasi";
		$data['metaother'] = '<meta name="description" content="Let\'s Talk Academy (LTA) is the best CSIR NET Life Science Institute in Jaipur, Delhi & Varanasi,  that continues to lead CSIR NET JRF Life Science coaching with best results so far that makes aspirants crack CSIR-UGC National Eligibility Test (NET) for Junior Research Fellowship and Lecturer-ship dam easy." />
		<meta name="keywords" content="net coaching in Jaipur for life science, csir net life science, csir net life science coaching in Jaipur, csir net life science coaching, net life science, net life science coaching, best net jrf life sciences coaching, csir life science, online coaching for csir net life science, best net jrf life sciences coaching, csir net jrf life science, best net jrf life sciences coaching, , jrf life science, net coaching for life science, net exam life science, net jrf life science, "/> ';
    $this->load->view("home/home", $data);
  }

  public function page(){
    $slug = ($this->uri->segment(2)) ? $this->uri->segment(2):$this->uri->segment(1);
		$data['result'] = $this->Home_model->get_page($slug)->row_array();
    if(!empty($data['result'])){
		$data['metatitle'] = (isset($data['result']['metatitle'])) ? $data['result']['metatitle']:"";
		$data['metaother'] = (isset($data['result']['metadescription'])) ? $data['result']['metadescription']:"";
		$this->load->view("home/page",$data);
		}
		else{
			redirect("/");
		}
  }

  public function course_detail(){
    $slug = $this->uri->segment(2);
		$data['result'] = $this->Front_model->get_course_detail($slug)->row_array();
		if(!empty($data['result'])){
		$data['metatitle'] = $data['result']['metatitle'];
		$data['metaother'] = $data['result']['metadescription'];
		$this->load->view("home/course_detail",$data);
		}
		else{
			redirect("/");
		}
  }

  public function course_syllabus(){
    $slug = $this->uri->segment(2);
		$data['result'] = $this->Front_model->get_course_syllabus($slug)->row_array();
		if(!empty($data['result'])){
		$data['metatitle'] = $data['result']['metatitle'];
		$data['metaother'] = $data['result']['metadescription'];
		$this->load->view("home/course_syllabus",$data);
		}
		else{
			redirect("/");
		}
  }

  public function result(){
    $search = $this->input->get('search');
		$data['cate'] = $this->Home_model->get_rescat();
		$data['result'] = $this->Home_model->get_result_cat($search);
		$metas = $this->customer->getMetas(base_url(uri_string()));
		if($metas){
			$data['metatitle'] = $metas->title;
			$data['metaother'] = $metas->other;
		}
		else{
		$data['metatitle'] = 'Life Science Exam Results and Selections - Let\'s Talk Academy';
		$data['metaother'] = '<meta name="Description" content=" Nothing compares to Let\'s Talk Academy Institute results for various life science exams.  More than 80+ students selected in CSIR/NET JRF 2016 and 55+ in June 2017 exams. 2018 results are awaited.  No other Students from any other institute from whole India has got any selections from Last many attempts. " /><meta name="keywords" content="Let\'s Talk Academy Institute results, Life Science results "/>';
		}
		$url = $this->uri->uri_string();
		$data['z'] = $this->Home_model->get_block($url)->row();
    $this->load->view("home/result",$data);
  }

  public function contact_us(){
    $this->load->view("home/contact_us");
  }

  public function send_contact(){
    $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
    $this->form_validation->set_rules('subject', 'Subject', 'trim|required|xss_clean');
    $this->form_validation->set_rules('phone', 'Phone', 'trim|xss_clean');
    $this->form_validation->set_rules('message', 'Message', 'trim|xss_clean');
    if($this->form_validation->run()==FALSE){
      $this->session->set_flashdata('info', "2--".validation_errors());
    }else{
      $query = $this->Home_model->send_contactus();

      if($query){
        $this->session->set_flashdata('info', "1--Successfully done");
      }
      else{
        $this->session->set_flashdata('info', "2--Error!!!");
      }
    }
  }

  public function batch_scedhule(){
    $data['result'] = $this->Home_model->get_batches();
		$metas = $this->customer->getMetas(base_url(uri_string()));
		if($metas){
			$data['metatitle'] = $metas->title;
			$data['metaother'] = $metas->other;
		}
		else{
		$data['metatitle'] = 'New Batches Schedule for Let\'s Talk Academy Branches';
		$data['metaother'] = '<meta name="description" content="Let\�s  Talk Academy CSIR Net Life Science regular Batches start 4-5 months before the intended date of the exam. Normally batches start in January and February for June exam and July and August for December Net exams. Fast track crash course batches starts just 2 months before Life Science exam for passed students. To view batch schedule select your centre location, life science exam and Date."/>';
		}
		$this->load->view("home/batches",$data);
  }

  public function testimonials(){
    $data['result'] = $this->Home_model->get_testimonials();
		$metas = $this->customer->getMetas(base_url(uri_string()));
		if($metas){
			$data['metatitle'] = $metas->title;
			$data['metaother'] = $metas->other;
		}
		else{
		$data['metatitle'] = 'Latest Student Reviews for Let\'s Talk Academy | Videos & Written Testimonials';
		$data['metaother'] = '<meta name="description" content="Student testimonial reviews by current and former Let\'s Talk Academy students! Prospective students, learn what current students have to say about the institute you are interested in! View our student videos having tips, experiences and advice that can help you with your carrier for various Life Science exams."/>';

		}
		$this->load->view("home/testimonial",$data);
  }

  public function set_location(){
    $this->session->set_userdata("location", $this->input->get('id'));
    echo "success";
  }



}
