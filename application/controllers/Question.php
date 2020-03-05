<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Question extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model("Questions");
    }
}