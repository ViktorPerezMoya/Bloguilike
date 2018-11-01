<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Post
 *
 * @author ViktorPerez
 */
class Post_model extends CI_Model{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    public function create_post($data = null){
        if(empty($data)){
            return false;
        }
        
        $this->db->set('titulo',$data['titulo_post']);
        $this->db->set('subtitulo',$data['subtitulo_post']);
        $this->db->set('contenido',$data['contenido_post']);
        $this->db->set('usuario_id',$data['user_id_post']);
        $this->db->insert('posts');
        
        return $this->db->insert_id();
    }
    
    public function all(){
        $this->db->select('p.id,p.titulo,p.subtitulo,p.created_at,u.nombre as autor,'
                . '(select count(l.liked) from likes l where l.liked = 1 and post_id = p.id) as liked,'
                . '(select count(l.disliked) from likes l where l.disliked = 1 and post_id = p.id) as disliked');
        $this->db->join('usuario u','u.id = p.usuario_id');
        $query = $this->db->get('posts p');
        
        return $query->result_array();
    }
    
    
    public function all_my_posts($id_user){
        $this->db->select('p.id,p.titulo,p.subtitulo,p.created_at,u.nombre as autor,'
                . '(select count(l.liked) from likes l where l.liked = 1 and post_id = p.id) as liked,'
                . '(select count(l.disliked) from likes l where l.disliked = 1 and post_id = p.id) as disliked');
        $this->db->join('usuario u','u.id = p.usuario_id');
        $this->db->where('p.usuario_id',$id_user);
        $query = $this->db->get('posts p');
        
        return $query->result_array();
    }
    
    public function find($id = 0){
        if($id == 0){
            return null;
        }
        
        $this->db->select('p.id,p.titulo,p.subtitulo,p.created_at,u.nombre as autor,p.contenido, p.usuario_id,'
                . '(select count(l.liked) from likes l where l.liked = 1 and post_id = p.id) as liked,'
                . '(select count(l.disliked) from likes l where l.disliked = 1 and post_id = p.id) as disliked');
        $this->db->join('usuario u','u.id = p.usuario_id');
        $this->db->where('p.id', $id);
        $query = $this->db->get('posts p');
        
        return $query->row_array();
    }
    
    /* LIKES*/
    public function user_like($post_id, $user_id){
        $this->db->select('post_id,usuario_id,liked,disliked');
        $this->db->where('post_id',$post_id);
        $this->db->where('usuario_id', $user_id);
        $query = $this->db->get('likes');
        
        $result = $query->row_array();
        if(!empty($result) && sizeof($result) > 0){
            return true;
        }
        return false;
    } 


    public function like_update($post_id,$user_id,$action){
        switch ($action){
            case 'liked':
                $this->db->set('liked',1);
                $this->db->set('disliked',0);
                break;
            case 'disliked':
                $this->db->set('liked',0);
                $this->db->set('disliked',1);
                break;
        }
        
        $this->db->where('post_id',$post_id);
        $this->db->where('usuario_id',$user_id);
        $this->db->update('likes');
    }
    
    public function like_insert($post_id,$user_id,$action){
        //generamos un like
        $this->db->set('post_id',$post_id);
        $this->db->set('usuario_id',$user_id);
        switch ($action){
            case 'liked':
                $this->db->set('liked',1);
                $this->db->set('disliked',0);
                break;
            case 'disliked':
                $this->db->set('liked',0);
                $this->db->set('disliked',1);
                break;
        }
        $this->db->insert('likes');
        return $this->db->insert_id();
        
    }
    
    public function all_likes($post_id){
        $this->db->select('count(liked) as cant_likes');
        $this->db->where('liked',1);
        
        $this->db->where('post_id',$post_id);
        $query = $this->db->get('likes');
        return $query->row_array()['cant_likes'];
    }
    
    public function all_dislikes($post_id){
        $this->db->select('count(disliked) as cant_dislikes');
        $this->db->where('disliked',1);
        
        $this->db->where('post_id',$post_id);
        $query = $this->db->get('likes');
        return $query->row_array()['cant_dislikes'];
    }
}
