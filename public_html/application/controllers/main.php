<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	/**
		Constructor	
	**/
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('Link_model');
		$this->load->helper('url');
	}

	/**
	 * Index Page for this controller, show url input.
	 */
	public function index()
	{
		$this->load->view('header');
		$this->load->view('link_input');
		$this->load->view('footer');
	}
	
	/**
		new link
		create a new link for a url, response via JSON
	**/
	public function new_link()
	{
		$this->form_validation->set_rules('url', 'URL', 'trim|required|prep_url');
		
		if($this->form_validation->run())
		{
			$url= $this->input->post('url');
			
			$short_url = $this->Link_model->AddLink($url);
			
			if($short_url != null)
			{
				$data['response'] = "success";			
				$data['short_url'] = base_url()."r/".$short_url;
			}
			else
			{
				$data['response'] = "error";
				$data['error_message'] = "could not add link, please try again.";
			}
		}
		else
		{
				$data['response'] = "error";
				$data['error_message'] = "could not add link, please try again.";
		}
		
		//return the json object
		echo json_encode($data);		
	}
	
	/**
	 * Redirect to a url give a short url
	 */
	public function r($short_url)
	{		
		if($this->Link_model->IsLink($short_url))
		{
			$link = $this->Link_model->GetLink($short_url);
			$this->Link_model->IncrementClickCount($link->id);
			redirect($link->redirect_link);	
		}
		else
		{
			$data['error_message'] = "your url doesn't seem valid, you might want to check it again: " . $short_url;
			$this->load->view('header');
			$this->load->view('link_error', $data);
			$this->load->view('footer');
		}
	}
}

