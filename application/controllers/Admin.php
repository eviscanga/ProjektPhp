<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	var $menu;

	public function __construct()
	{
			parent::__construct();
			$this->menu = $this->admin_model->get_menu();
			
	}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */



	public function index(){
		$data["msg"] = $this->session->flashdata('msg');
		$data["action"] = $this->session->flashdata('action');
		$data["users"] = $this->admin_model->get_users();
		$data["menu"] = $this->menu;
		$data["temp"] = "admin/dashboard";
		$this->load->view('admin/includes/main', $data);
	}
	public function edit_view(){
		$user_id = $this->uri->segment(3);
		$data['users'] = $this->admin_model->displayrecordsById($user_id);
		$data["temp"] = "admin/edit-user";
		$this ->load->view('admin/includes/main', $data);
	}

	public function edit_items_view(){
		$menu_id = $this->uri->segment(3);
		$data["menu"] = $this->admin_model->get_menu();
		$data["menu"] = $this->admin_model->getmenuById($menu_id);
		$data["menu_items"] = $this->admin_model->get_menu_items();
		$data["temp"] = "admin/edit-menu";
		$this ->load->view('admin/includes/main', $data);
	}
	public function add_view(){
		$data["temp"] = "admin/add-user";
		$data["menu"] = $this->menu;
		
		$this->load->view('admin/includes/main', $data);
	}

	public function menu_view(){
		$data["menu"] = $this->menu;
		
		$data["temp"] = "admin/menu";
		$this ->load->view('admin/includes/main', $data);
	}


	public function edit(){
		$this->load->library('image_lib');
		$response = $this->admin_model->updaterecords();

		if ($response):
			$this->session->set_flashdata('msg', 'U ndryshua me sukses');
		else:
		$this->session ->set_flashdata('msg', 'Nuk u ndryshua');
		endif;

		redirect("admin/index");


	}
	public function trash(){
		$response = $this->admin_model->trash_user();
		if ($response):
			$this->session->set_flashdata('msg', 'Record deleted successfully');
		else:
		$this->session->set_flashdata('msg', 'record delete failed');
		endif;
		redirect("admin/index");

	}
	public function trash_view(){
		$data['users'] = $this->admin_model->trash_users_view();
		$data["menu"] = $this->menu;
		$data["temp"] = "admin/trash";
		$this ->load->view('admin/includes/main', $data);
	}

	public function restore() {
		$response = $this->admin_model->restore_user();
		if ($response):
			$this->session->set_flashdata('msg', 'Rekordi u rikthye me sukses');
		else:
		$this->session->set_flashdata('msg', 'Rekordi nuk u rikthye');
		endif;
		redirect("admin/index");
	}

	public function add(){
		$response = $this->admin_model->addRecord();

		if ($response):
			$this->session->set_flashdata('msg', 'U shtua me sukses');
		else:
		$this->session->set_flashdata('msg', 'Nuk u shtua');
		endif;

		redirect("admin/index");
	}

	public function delete(){
		$response = $this->admin_model->delete_user();


		if ($response):

			$this->session->set_flashdata('msg', 'U fshi me sukses');

		else:
		$this->session->set_flashdata('msg', 'Nuk u fshi');
		endif;

		redirect("admin/index");
	}
	public function deleteImg(){
		$response = $this->admin_model->deleteImage();


		if ($response):

		$this->session->set_flashdata('msg', 'U fshi me sukses');

		else:
		$this->session->set_flashdata('msg', 'Nuk u fshi');
		endif;

		redirect("admin/index");
	}

	public function cropImg(){
		$this->admin_model->crop_image();
	}
	

	public function addMenu(){
		$response =$this->admin_model->addmenu();
		

		if ($response):

			$this->session->set_flashdata('msg', 'U ndryshua');
	
			else:
			$this->session->set_flashdata('msg', 'Nuk u ndryshua');
			endif;
	
			redirect("admin/menu_view");
		
		
		}

	public function menuitem(){
		$this->admin_model->menu_item();
	}
}