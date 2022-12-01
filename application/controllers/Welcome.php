<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{   
		$this->load->view('header');
		$this->load->view('home');
		$this->load->view('footer');
	}

	public function home()
	{   
		$this->load->view('header');
		$this->load->view('home');
		$this->load->view('footer');
	}

	public function services()
	{   
		$this->load->view('header');
		$this->load->view('services');
		$this->load->view('footer');
	}
	public function products()
	{   
		$this->load->view('header');
		$this->load->view('products');
		$this->load->view('footer');
	}

	public function covid()
	{   
		$this->load->view('header');
		$this->load->view('covid19');
		$this->load->view('footer');
	}
	public function policies()
	{   
		$this->load->view('header');
		$this->load->view('policies');
		$this->load->view('footer');
	}

	public function about()
	{   
		$this->load->view('header');
		$this->load->view('about');
		$this->load->view('footer');
	}

	public function contacts()
	{   
		$this->load->view('header');
		$this->load->view('contacts');
		$this->load->view('footer');
	}

	public function clients()
	{   
		$this->load->view('header');
		$this->load->view('clients');
		$this->load->view('footer');
	}

	public function employ()
	{   
		$this->load->view('header');
		$this->load->view('employ');
		$this->load->view('footer');
	}

	
    public function productById()

    { 
            $url = parse_url($_SERVER['REQUEST_URI']);
            parse_str($url['query'], $params);
            $id = $params['id'];
			$this->load->view('headerProduct');
            $this->load->view('productDetails', array ('id'=> $id));
            $this->load->view('footer');
		
	}
	


}
