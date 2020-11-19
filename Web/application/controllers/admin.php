<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin extends CI_Controller {
	

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function dashboard()
	{
		$this->load->view('index1');
		$this->load->helper('url');
	}
	public function index()
	{
		$this->load->view('login');
		$this->load->helper('url');
	}
	public function pemeriksaan()
	{
		$this->load->view('vpemeriksaan');
		$this->load->helper('url');
	}
	public function datadokter()
	{
		$this->load->view('vdatadokter');
		$this->load->helper('url');
	}
}
