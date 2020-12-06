<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * @package Razorpay :  CodeIgniter Razorpay Gateway
 *
 * @author TechArise Team
 *
 * @email  info@techarise.com
 *
 * Description of Razorpay Controller
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Razorpay extends CI_Controller {
    // construct
    public function __construct() {
        parent::__construct();
       $this->load->model('api/Api_model');
    }
    // index page
    public function index() {
        $data['title'] = 'Razorpay | Razorpay';
        $this->load->view('front/razorpay/index');
    }

    // checkout page
    public function checkout() {
        $data['title'] = 'Checkout payment | Razorpay';
        $data['amount'] = $this->input->post('amount');
        $data['total'] = $this->input->post('amount') * 100;

		$query = $this->db->query("SELECT first_name, last_name, email, mobile FROM customer WHERE id = '" . (int)$this->customer->getId() . "'")->row();

		$data['name'] = $query->first_name . " " . $query->last_name;
		$data['email'] = $query->email;
		$data['mobile'] = $query->mobile;

        $data['return_url'] = site_url().'razorpay/callback';
        $data['surl'] = site_url().'razorpay/success';
        $data['furl'] = site_url().'razorpay/failed';
        $data['currency_code'] = 'INR';
        $this->load->view('front/razorpay/checkout', $data);
    }

    // initialized cURL Request
    private function get_curl_handle($payment_id, $amount)  {
        $url = 'https://api.razorpay.com/v1/payments/'.$payment_id.'/capture';
        $key_id = 'rzp_live_fvzMeQrzobo4m4';
        $key_secret = 'IvLBNSwX37CRpanf1YcMIvsJ';
        $fields_string = "amount=$amount";
        //cURL Request
        $ch = curl_init();
        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERPWD, $key_id.':'.$key_secret);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        //curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__).'/ca-bundle.crt');
        return $ch;
    }

    function getab(){
      $razorpay_payment_id = 'pay_CIDsklTTjIgpP5';
      $amount = 100;
      $ch = $this->get_curl_handle($razorpay_payment_id, $amount);
      //execute post
      $result = curl_exec($ch);
      $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
      echo $http_status . '<br/><pre>';print_r($result);
    }

    // callback method
    public function callback() {
        if (!empty($this->input->post('razorpay_payment_id')) && !empty($this->input->post('merchant_order_id'))) {
            $razorpay_payment_id = $this->input->post('razorpay_payment_id');
            $merchant_order_id = $this->input->post('merchant_order_id');
            $currency_code = 'INR';
            $amount = $this->input->post('merchant_total');
            $success = false;
            $error = '';
            try {
                $ch = $this->get_curl_handle($razorpay_payment_id, $amount);
                //execute post
                $result = curl_exec($ch);
                $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                if ($result === false) {
                    $success = false;
                    $error = 'Curl error: '.curl_error($ch);
                } else {
                    $response_array = json_decode($result, true);
                   // echo "<pre>";print_r($response_array);exit;
                        //Check success response
                        if ($http_status === 200 and isset($response_array['error']) === false) {
                            $success = true;
							              $this->db->query("INSERT INTO transaction SET customer_id = '" . (int)$this->customer->getId() . "', amount = '" . (float)$amount/100 . "', detail = '" . json_encode($response_array) . "', created = NOW()");
							              $this->db->query("UPDATE customer SET wallet = wallet + " . $amount/100 . " WHERE id = '" . (int)$this->customer->getId() . "'");
                        } else {
                            $success = false;
                            $this->db->query("INSERT INTO transaction SET customer_id = '" . (int)$this->customer->getId() . "', amount = '" . (float)$amount/100 . "', detail = '" . json_encode($response_array) . "', created = NOW()");
                            if (!empty($response_array['error']['code'])) {
                                $error = $response_array['error']['code'].':'.$response_array['error']['description'];
                            } else {
                                $error = 'RAZORPAY_ERROR:Invalid Response <br/>'.$result;
                            }
                        }
                }
                //close connection
                curl_close($ch);
            } catch (Exception $e) {
                $success = false;
                $error = 'OPENCART_ERROR:Request to Razorpay Failed';
            }
            if ($success === true) {
                if(!empty($this->session->userdata('ci_subscription_keys'))) {
                    $this->session->unset_userdata('ci_subscription_keys');
                 }
                if (!$order_info['order_status_id']) {
                    redirect($this->input->post('merchant_surl_id'));
                } else {
                    redirect($this->input->post('merchant_surl_id'));
                }

            } else {
                redirect($this->input->post('merchant_furl_id'));
            }
        } else {
            echo 'An error occured. Contact site administrator, please!';
        }
    }

    public function success() {
        $data['title'] = 'Razorpay Success | Zcabs';
        $this->load->view('front/razorpay/success', $data);
    }

    public function failed() {
        $data['title'] = 'Razorpay Failed | Zcabs';
        $this->load->view('front/razorpay/error', $data);
    }

	// checkout page
    public function ch() {
        $data['title'] = 'Checkout payment | Razorpay';
        $data['order_id'] = $this->input->post('order_id');
        $data['amount'] = $this->input->post('amount') * ($this->input->post('payment_type')/100);
        $data['total'] = $data['amount'] * 100;

		$query = $this->db->query("SELECT first_name, last_name, email, mobile FROM customer WHERE id = '" . (int)$this->customer->getId() . "'")->row();
		
		$this->db->query("UPDATE outstation SET percent = '" . (int)$this->input->post('payment_type') . "' WHERE id = '" . (int)$data['order_id'] . "'");

		$data['name'] = $query->first_name . " " . $query->last_name;
		$data['email'] = $query->email;
		$data['mobile'] = $query->mobile;

        $data['return_url'] = site_url().'razorpay/callback_order';
        $data['surl'] = site_url().'razorpay/success_order';
        $data['furl'] = site_url().'razorpay/failed';
        $data['currency_code'] = 'INR';
        $this->load->view('front/razorpay/checkout_order', $data);
    }

	// callback method
    public function callback_order() {
        if (!empty($this->input->post('razorpay_payment_id')) && !empty($this->input->post('merchant_order_id'))) {
            $razorpay_payment_id = $this->input->post('razorpay_payment_id');
            $merchant_order_id = $this->input->post('merchant_order_id');
            $currency_code = 'INR';
            $amount = $this->input->post('merchant_total');
            $success = false;
            $error = '';
            try {
                $ch = $this->get_curl_handle($razorpay_payment_id, $amount);
                //execute post
                $result = curl_exec($ch);
                $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                if ($result === false) {
                    $success = false;
                    $error = 'Curl error: '.curl_error($ch);
                } else {
                    $response_array = json_decode($result, true);
                   // echo "<pre>";print_r($response_array);exit;
                        //Check success response
                        if ($http_status === 200 and isset($response_array['error']) === false) {
                            $success = true;
							                     $this->Api_model->confirm_sight_razor($merchant_order_id, json_encode($response_array));
                        } else {
                            $success = false;
                            //$this->db->query("INSERT INTO transaction SET customer_id = '" . (int)$this->customer->getId() . "', amount = '" . (float)$amount/100 . "', detail = '" . json_encode($response_array) . "', created = NOW()");
                            if (!empty($response_array['error']['code'])) {
                                $error = $response_array['error']['code'].':'.$response_array['error']['description'];
                            } else {
                                $error = 'RAZORPAY_ERROR:Invalid Response <br/>'.$result;
                            }
                        }
                }
                //close connection
                curl_close($ch);
            } catch (Exception $e) {
                $success = false;
                $error = 'OPENCART_ERROR:Request to Razorpay Failed';
            }
            if ($success === true) {
                if(!empty($this->session->userdata('ci_subscription_keys'))) {
                    $this->session->unset_userdata('ci_subscription_keys');
                 }
                if (!$order_info['order_status_id']) {
                    redirect($this->input->post('merchant_surl_id'));
                } else {
                    redirect($this->input->post('merchant_surl_id'));
                }

            } else {
                redirect($this->input->post('merchant_furl_id'));
            }
        } else {
            echo 'An error occured. Contact site administrator, please!';
        }
    }

	 public function callback_final() {
        if (!empty($this->input->post('razorpay_payment_id')) && !empty($this->input->post('merchant_order_id'))) {
            $razorpay_payment_id = $this->input->post('razorpay_payment_id');
            $merchant_order_id = $this->input->post('merchant_order_id');

            $currency_code = 'INR';
            $amount = $this->input->post('merchant_total');
            $success = false;
            $error = '';
            try {
                $ch = $this->get_curl_handle($razorpay_payment_id, $amount);
                //execute post
                $result = curl_exec($ch);
                $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                if ($result === false) {
                    $success = false;
                    $error = 'Curl error: '.curl_error($ch);
                } else {
                    $response_array = json_decode($result, true);
                   // echo "<pre>";print_r($response_array);exit;
                        //Check success response
                        if ($http_status === 200 and isset($response_array['error']) === false) {
                            $success = true;
							              $this->Api_model->add_final_confirm($merchant_order_id, json_encode($response_array));
                        } else {
                            $success = false;
                            //$this->db->query("INSERT INTO transaction SET customer_id = '" . (int)$this->customer->getId() . "', amount = '" . (float)$amount/100 . "', detail = '" . json_encode($response_array) . "', created = NOW()");
                            if (!empty($response_array['error']['code'])) {
                                $error = $response_array['error']['code'].':'.$response_array['error']['description'];
                            } else {
                                $error = 'RAZORPAY_ERROR:Invalid Response <br/>'.$result;
                            }
                        }
                }
                //close connection
                curl_close($ch);
            } catch (Exception $e) {
                $success = false;
                $error = 'OPENCART_ERROR:Request to Razorpay Failed';
            }
            if ($success === true) {
                if(!empty($this->session->userdata('ci_subscription_keys'))) {
                    $this->session->unset_userdata('ci_subscription_keys');
                 }
                    redirect($this->input->post('merchant_surl_id'));
                

            } else {
                redirect($this->input->post('merchant_furl_id'));
            }
        } else {
            echo 'An error occured. Contact site administrator, please!';
        }
    }


	public function success_order() {
        $data['title'] = 'Razorpay Success | Zcabs';
        $this->load->view('front/razorpay/success_order', $data);
    }

}
?>
