<?php
/**
 * Created by PhpStorm.
 * User: bizremy
 * Date: 26.09.16
 * Time: 14:20
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Well extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Well_model'));
        $this->load->helper('help');
    }

    public function index(){

        $data['points'] = 'qwddwqdwqdwsssss';
        $budget=$this->Well_model->getName();
        $data['budget'] = $budget;
        $data['helper'] = come();
        $this->_view('well/main',$data);
    }

}