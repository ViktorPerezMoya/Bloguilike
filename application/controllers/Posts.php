<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PostController
 *
 * @author ViktorPerez
 */
class Posts  extends CI_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        
    }
    
    public function post($id = 0){
        setlocale(LC_TIME, 'es_ES');
        $this->load->model('post_model');
        $this->load->helper('date');
        
        $post = $this->post_model->find($id);
        $data['titulo_hr'] = $post['titulo'];
        $data['subtitulo_hr'] = $post['subtitulo'];
        $data['detalle_hr'] = "Posteado por ".$post['autor'].", ". strftime('%d de %B de %Y',strtotime($post['created_at']));
        
        $data_view['post'] = $post;
        $this->load->view('themplate/head');
        $this->load->view('themplate/menu');
        $this->load->view('themplate/header',$data);
        $this->load->view('posts/post',$data_view);
        $this->load->view('themplate/footer');
    }
    
    public function create(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('titulo', 'Titulo','trim|required|min_length[5]|max_length[255]');
        $this->form_validation->set_rules('subtitulo', 'Subtitulo', 'trim|required|min_length[5]|max_length[255]');
        $this->form_validation->set_rules('contenido', 'Contenido', 'trim|required');
        
        if ($this->form_validation->run() == FALSE)
        {
            
            $data['titulo_hr'] = "Nuevo Post";
            $this->load->view('themplate/head');
            $this->load->view('themplate/menu');
            $this->load->view('themplate/header',$data);
            $this->load->view('posts/create');
            $this->load->view('themplate/footer');
        }
        else
        {
            $post = $this->input->post();
            $this->load->model('post_model');
            $data['titulo_post'] = strip_tags(htmlspecialchars($post['titulo']));
            $data['subtitulo_post'] = strip_tags(htmlspecialchars($post['subtitulo']));
            $data['contenido_post'] = $post['contenido'];
            $data['user_id_post'] = $this->session->userdata('user_id');
            $id = $this->post_model->create_post($data);
            if($id){
                redirect(base_url('posts/my_posts'));
            }else{
                $this->load->view('themplate/head');
                $this->load->view('themplate/menu');
                $this->load->view('themplate/header',$data);
                $this->load->view('errors/html/error_general');
                $this->load->view('themplate/footer');
            }
        }
    }
    
    public function my_posts(){
        setlocale(LC_TIME, 'es_ES');
        $this->load->helper('date');
        $data['titulo_hr'] = "Mis Posts";
        
        $this->load->model('post_model');
        $data_view['posts'] = $this->post_model->all_my_posts($this->session->userdata('user_id'));
        
        $this->load->view('themplate/head');
        $this->load->view('themplate/menu');
        $this->load->view('themplate/header',$data);
        $this->load->view('posts/list',$data_view);
        $this->load->view('themplate/footer');
    }
    
    public function like(){
        $post = $this->input->post();
        if(!empty($post) && count($post) > 0){
            $this->load->model('post_model');
            if($this->post_model->user_like($post['post_id'],$this->session->userdata('user_id'))){
                $this->post_model->like_update($post['post_id'],$this->session->userdata('user_id'),$post['accion']);
            }else{
                $this->post_model->like_insert($post['post_id'],$this->session->userdata('user_id'),$post['accion']);
            }
            $data = array(
                'cant_like' => $this->post_model->all_likes($post['post_id']),
                'cant_dislike' => $this->post_model->all_dislikes($post['post_id'])
            );
            
            
            header('Content-type: application/json');
            echo json_encode($data);
        }
        echo '';
    }
}
