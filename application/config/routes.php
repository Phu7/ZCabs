<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'home';
$route['sights'] = 'home/sight_areas';
$route['sight/:any'] = 'home/sight_area/:any';
$route['package/:any'] = 'home/package_detail/:any';
$route['about-us'] = 'home/cms/about-us';
$route['privacy-policy'] = 'home/cms/privacy-policy';
$route['cancellation-policy'] = 'home/cms/cancellation-policy';
$route['terms-and-condition'] = 'home/cms/terms-and-condition';
$route['utility-service'] = 'home/cms/utility-service';
$route['offers'] = 'home/offers';
$route['contact-us'] = 'home/contact_us';
$route['login'] = 'account/login_home';
$route['thank-you'] = 'account/thanks';
$route['agent/register'] = 'account/agent_start';
$route['driver/register'] = 'account/driver_start';
$route['admin'] = 'admin/common';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
