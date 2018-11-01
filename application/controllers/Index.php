<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Index
 *
 * @author ViktorPerez
 */
class Index extends CI_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        
        setlocale(LC_TIME, 'es_ES');
        $this->load->helper('date');
        $data['titulo_hr'] = "Boguilike";
        $data['subtitulo_hr'] = "Publica tus opiniones libre de sensura";
        
        $this->load->model('post_model');
        $data_view['posts'] = $this->post_model->all();
        
        $this->load->view('themplate/head');
        $this->load->view('themplate/menu');
        $this->load->view('themplate/header',$data);
        $this->load->view('home/index',$data_view);
        $this->load->view('themplate/footer');
    }
    
    public function about(){
        $this->load->view('themplate/head');
        $this->load->view('themplate/menu');
        $this->load->view('themplate/header');
        $this->load->view('about');
        $this->load->view('themplate/footer');
    }
    
    public function contact(){
        $this->load->view('themplate/head');
        $this->load->view('themplate/menu');
        $this->load->view('themplate/header');
        $this->load->view('contact');
        $this->load->view('themplate/footer');
    }
}
