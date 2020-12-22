<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chat_m extends CI_Model {

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
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function pesanKeluar($dar)
	{
		$data = $this->db->query('select * from chat where send_by ="'.$dar.'"');
		$res = $data->result_array();
		$count = $data->num_rows();
		if($count>=1){
			 $data = $res;
			return $data;
		}else{
			$data='';
			return $data;
		}		
		

    }

    public function getPesan($par,$per)
	{
		$data = $this->db->query('select * from chat where (send_by ="'.$par.'" or send_to ="'.$par.'") and (send_by ="'.$per.'" or send_to ="'.$per.'") order by time asc');
		$res = $data->result_array();
		$count = $data->num_rows();
		return $res;	
		

    }
    public function listPesan(){
		$data = $this->db->query('select * from tb_registrasi where kd_role ="2"');
		$res = $data->result_array();
		$count = $data->num_rows();
		if($count>=1){
			$data = $res;
		   return $data;
	   }else{
		   $data='';
		   return $data;
	   }	
	}

    public function pesanDatang($kita){
        $data = $this->db->query('select * from chat where send_to ="'.$kita.'"');
		$res = $data->result_array();
		$count = $data->num_rows();
		if($count>=1){
			 $data = $res;
			return $data;
		}else{
			$data='';
			return $data;
		}	
    }
    public function getNama($dari){
        $data = $this->db->get_where('tb_registrasi',array('kd_regist' => $dari));
        $result = $data->row();
        $count = $data->num_rows();

        if($count>=1){
            $data = $result;
            return $data;
        }else{
            $data='';
            return $data;
		}
	}

	public function lastMessage($bb,$cc){
		$data = $this->db->query('select * from chat where (send_by ="'.$bb.'" or send_to ="'.$bb.'") and (send_by ="'.$cc.'" or send_to ="'.$cc.'") order by time desc limit 1');
		$ras = $data->row();
		return $ras;
	}
		
		public function listnama($kita,$dia){
			$data = $this->db->query('SELECT send_to, send_by,
			CASE
				WHEN send_by = '.$kita.' THEN '.$kita.'
				ELSE '.$dia.'
			END AS hasil
			FROM chat where send_by="'.$kita.'"');
			$res = $data->row();
			return $res;
		}
    
}