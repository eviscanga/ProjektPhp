<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function get_users(){
        $this->db->where('status', 1);
        $query = $this->db->get('users');
        return $query->result();
    }

    public function get_menu(){
        $this->db->where('status', 1);
        $query = $this->db->get('menu');
        return $query->result();
    }
    public function get_menu_items(){
        $this->db->where('status', 1);
        $query = $this->db->get('menu_items');
        return $query->result();
    }
    public function displayrecordsById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('users');

        return $query->result();
    }

    public function getmenuById($id){
        $this->db->where('id', $id);
        $query = $this->db->get('menu');
        return $query->result();
    }





    public function updaterecords(){
        $data["name"] = $this->input->post("name");
        $data["surname"] = $this->input->post("surname");
        $data["gender"] = $this->input->post("gender");
        $data["bio"] = $this->input->post("bio");
        $file_name = $_FILES["image"]["name"];
        if($file_name){
            $data["image"] = $file_name;
        }
        $data['image']=$this->input->post("filename");
        $this->db->where('id', $this->input->post('id'));
        $query = $this->db->update('users', $data);
        $this->do_upload();
        return $query;
    }

    public function do_upload(){
        $config['upload_path'] = './assets/uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|jfif';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('image')){
            $error = array('error' => $this->upload->display_errors());

            return $error;
        }
        else {
            $data = array('upload_data'=>$this->upload-> data());
            return $data;
        }
    }


    public function trash_user(){
        $user_id = $this->uri->segment(3);
        $data["status"] = 2;
        return $this->db->where('id', $user_id)->update('users', $data);

    }

    public function delete_user(){
        $user_id = $this->uri-> segment(3);
        $data["status"] = 0;
        return $this->db->where('id', $user_id)->update('users', $data);
    }
    public function trash_users_view(){
        $this->db->where('status', 2);
        $query = $this->db-> get('users');
        return $query->result();
    }

    public function restore_user(){
        $user_id = $this->uri->segment(3);
        $data["status"] = 1;
        return $this->db->where('id', $user_id)->update('users', $data);
    }

    public function addRecord(){
        $data["name"] = $this->input->post("name");
        $data["surname"] = $this->input->post("surname");
        $data["gender"] = $this->input->post("gender");
        $query = $this->db->insert('users', $data);
        return $query;
    }

    public function deleteImage()
    {
      $user_id = $this->uri->segment(3);
      $data["image"]= '';
      $query= $this->db->where('id', $user_id)->update('users', $data);
      return $query;
    }


    public function crop_image(){
       
        $input = json_decode($this->input->raw_input_stream);
        $data['image'] = $input->image;
        $data['x'] = $input->x;
        $data['y'] = $input->y;
        $data['w'] = $input->w;
        $data['h'] = $input->h;
        $data['name'] = $input->name;
        
        $image = explode(',', $data['image']);
        $image = base64_decode($image[1]);
        $file_name = time().'_'.$data['name'];
        $path = './assets/uploads/' .$file_name;
      
    
     if (file_put_contents($path, $image)>0){
        $config['image_library'] = 'gd2';
        $config['source_image'] = $path;
        $config['new_image'] = './assets/thumbnails/'.$file_name;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['width']= 50;
        $config['height']= 50;

        $this->load->library('image_lib', $config);

        
        if ( ! $this->image_lib->resize()){
        echo $this->image_lib->display_errors();
        }
        else
        {
            echo $file_name;
        }
    
        
    }

    }

    public function addmenu(){
        $menu_id = $this->input->post("id");
        
        $data["menu_items"] = $this->input->post("listItems");
        
        
        $query = $this->db->where('id', $menu_id)->update('menu', $data);
        
        return $query;

    }

    public function menu_item($id){
        $this->db->where('id', $id);
        $query = $this->db->query('SELECT name FROM menu');
        return $query;
    }
 
    
   
 }
