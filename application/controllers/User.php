<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author ViktorPerez
 */
class User extends CI_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    public function registrar(){
        //HACER QUE NO SE PUEDAN CREAR DOS USUARIOS IGUALES CON EL MISMO EMAIL
        $post = $this->input->post();
        $data = array();
        if(count($post) > 0 ){
            if($post['clave_register'] == $post['clave_register_repeat']){
                $this->load->model('usuarios_model');
                $data_user['nombre'] = strip_tags(htmlspecialchars($post['name_register']));
                $data_user['email'] = strip_tags(htmlspecialchars($post['email_register']));
                $data_user['clave'] = strip_tags(htmlspecialchars($post['clave_register']));
                $id = $this->usuarios_model->create_user($data_user);
                if($id && $id > 0){
                    $this->session->set_userdata('user_id',$id);
                    $this->session->set_userdata('nombre',$data_user['nombre']);
                    $this->session->set_userdata('email',$data_user['email']);
                    $data['success'] = "Registro guardado";
                }else{
                    $data['error'] = "Ocurrio un error al insertar";
                }
            }else{
                $data['error'] = "Las claves no coinciden";
            }
            header('Content-type: application/json');
            echo json_encode($data);
        }
    }
}
