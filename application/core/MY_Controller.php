<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Controller extends CI_Controller
{
  public $title = ' Tirta Musi';
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
	}

	public function template($data, $template = '')
	{
		$data['module'] = $template;
		if(strlen($template) <=0)
		{
			return $this->load->view('includes/template', $data);
		}
		else
		{
			return $this->load->view($template . '/includes/template', $data);
		}
	}

	public function POST($name)
	{
		return $this->input->post($name);
	}

	public function GET($name, $clean = false)
	{
		return $this->input->get($name, $clean);
	}

	public function flashmsg($msg, $type = 'success',$name='msg')
	{
		return $this->session->set_flashdata($name, '<div class="alert alert-'.$type.' alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$msg.'</div>');
	}

	public function upload($id, $directory, $tag_name = 'userfile')
	{
		if ($_FILES[$tag_name])
		{
			$upload_path = realpath(APPPATH . '../assets/' . $directory . '/');
			@unlink($upload_path . '/' . $id . '.pdf');
			$config = [
				'file_name' 		=> $id . '.pdf',
				'allowed_types'		=> 'pdf',
				'upload_path'		=> $upload_path
			];
			$this->load->library('upload');
			$this->upload->initialize($config);
			return $this->upload->do_upload($tag_name);
		}
		return FALSE;
	}

	public function upload_img($name, $directory, $tag_name = 'userfile')
	{
		if (isset($_FILES[$tag_name]) && strlen($_FILES[$tag_name]['name']) > 0)
		{
			$upload_path = realpath(APPPATH . '../assets/' . $directory . '/');
			@unlink($upload_path . '/' . $name . '.jpg');
			$config = [
				'file_name' 		=> $name . '.jpg',
				'allowed_types'		=> 'jpg|png|bmp|jpeg',
				'upload_path'		=> $upload_path
			];
			$this->load->library('upload');
			$this->upload->initialize($config);
			return $this->upload->do_upload($tag_name);
		}
		return FALSE;
	}

	public function dump($var)
	{
		echo '<pre>';
		var_dump($var);
		echo '</pre>';
	}
}
