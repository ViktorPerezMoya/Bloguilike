<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuarios_model
 *
 * @author ViktorPerez
 */
class Usuarios_model extends CI_Model{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    public function create_user($data = null){
        if($data == null){
            return FALSE;
        }
        
        $this->db->set('nombre',$data['nombre']);
        $this->db->set('email',$data['email']);
        $this->db->set('clave', md5($data['clave']));
        $this->db->set('created_at',date('Y-m-d H:s:i'));
        $this->db->insert('usuario');
        
        return $this->db->insert_id();
    }
    
    public function find($email, $password){
        $this->db->select('id,nombre,email,clave');
        $this->db->where('email',$email);
        $this->db->where('clave',$password);
        $query = $this->db->get('usuario');
        
        return $query->row_array();
    }
}
