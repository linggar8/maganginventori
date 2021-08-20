<?php 
	class auth extends CI_Controller
	{
		public function login()
		{
			$this->_rules();

			if($this->form_validation->run() == FALSE)
			{
				$this->load->view('templates_admin/header');
				$this->load->view('form_login');
			}else{
				$username = $this->input->post('username');
				$password = $this->input->post('password');

				$cek = $this->inv_model->cek_login($username, $password);

				if($cek == false)
				{
					$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
					  Username atau Password Salah !.
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>');
					redirect('auth/login');
				}else{
					$this->session->set_userdata('username',$cek->username);
					$this->session->set_userdata('nama',$cek->nama);
					$this->session->set_userdata('id',$cek->id);

					switch ($cek->id) {
						case 1 : 	redirect('admin/dashboard');
									break;
						default:	break;
					}
				}
			}

		}

		public function _rules()
		{
			$this->form_validation->set_rules('username','Username','required');
			$this->form_validation->set_rules('password','Password','required');
		}
	}
 ?>