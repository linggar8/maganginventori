<?php 
	class inv_model extends CI_Model
	{
		public function get_data($table)
		{
			return $this->db->get($table);
		}

		public function get_where($where, $table)
		{
			return $this->db->get_where($where, $table);
		}

		public function cek_login()
		{
			$username = set_value('username');
			$password = set_value('password');

			$result = $this->db
							->where('username', $username)
							->where('password', $password)
							->limit(1)
							->get('admin');

			if($result->num_rows() > 0)
			{
				return $result->row();
			}else{
				return false;
			}
		}
	}
 ?>