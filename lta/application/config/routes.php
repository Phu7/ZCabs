<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home';
$route['student-testimonials-reviews'] = 'home/testimonials';
$route['lta-clasroom-results'] = 'home/result';
$route['about-lets-talk-academy'] = 'home/page/about-lets-talk-academy';
$route['director-desk-suraj-prakash-sir-life-science-teacher'] = 'home/page/director-desk-suraj-prakash-sir-life-science-teacher';
$route['city/:any'] = 'home/page/:any';
$route['course-detail/(:any)'] = 'front/course_detail';
$route['course-syllabus/(:any)'] = 'front/course_syllabus';
$route['blogs'] = 'home/blogs';
$route['blog/:any'] = 'home/blog/:any';
$route['announcement'] = 'home/announcements';
$route['announcement/:any'] = 'home/announcement/:any';
$route['batches-schedule'] = 'front/batches';

$route['admin'] = 'admin/common';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
