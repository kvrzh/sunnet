<?php

/**
 * Created by PhpStorm.
 * User: bizremy
 * Date: 26.09.16
 * Time: 15:31
 */
class Well_model extends CI_Model
{
    public function __construct(){
        parent::__construct();
    }

    public function getName(){
        $data['lol'] = 'eblanishe';
        return $data;
    }

}