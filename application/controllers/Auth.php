<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Auth
 *
 * @author ViktorPerez
 */
class Auth extends CI_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    public function login(){
        header('Content-type: application/json');
        $post = $this->input->post();
        if(count($post) > 0){
            $email = strip_tags(htmlspecialchars($post['email']));
            $password = md5($post['clave']);
            if($email == "" || $password == ""){
                echo json_encode(array('error'=>'Usuario y contraseña no pueden ser vacios'));
                return;
            }
            $this->load->model('usuarios_model');
            $usuario = $this->usuarios_model->find($email,$password);
            if(count($usuario) > 0){
                $this->session->set_userdata('user_id',$usuario['id']);
                $this->session->set_userdata('nombre',$usuario['nombre']);
                $this->session->set_userdata('email',$usuario['email']);
                echo json_encode(array('success'=>'logueado!'));
                return;
            }else{
                echo json_encode(array('error'=>'Usuario o contraseña incorrectos'));
                return;
            }
        }
    }
    
    public function logout(){
        if(!empty($this->session->userdata('nombre'))){
           session_destroy();
        }
        redirect(base_url());
    }
}
