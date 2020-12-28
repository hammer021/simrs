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
		return $res;	
		

	}

	public function getPesanApi($par)
	{
		$data = $this->db->query('select * from chat where (send_by ="'.$par.'" or send_to ="'.$par.'")order by time asc');
		$res = $data->result_array();
		return $res;	
		

	}
	public function getDataPasien($per , $har)
	{
		date_default_timezone_set("Asia/Jakarta");
    
		$date_now = date('H:i:s');
		
		$data = $this->db->query('SELECT 
		tb_keluhan.tgl_kunjungan,
		tb_keluhan.buktikeluhan,
		tb_keluhan.jenis_kasus,
		tb_keluhan.keluhan,
		tb_keluhan.harga,
		tb_keluhan.status,
		tb_keluhan.kd_pasien, 
		tb_dokter.no_praktek,
		tb_dokter_poli.senin,
		tb_dokter_poli.selasa,
		tb_dokter_poli.rabu,
		tb_dokter_poli.kamis,
		tb_dokter_poli.jumat,
		tb_dokter_poli.sabtu,
		tb_dokter_poli.minggu,
		tb_registrasi.kd_regist,
		tb_registrasi.name, 
		tb_registrasi.image,
		tb_registrasi.no_hp,
		tb_poli.klinik,
        chat.chat_id,
        chat.send_to,
        chat.message,
        chat.time,
        chat.status,
		tb_keluhan.no_rm

		FROM tb_dokter_poli
		
		JOIN tb_dokter ON tb_dokter_poli.no_praktek = tb_dokter.no_praktek 
		
		JOIN tb_registrasi ON tb_dokter.kd_regist = tb_registrasi.kd_regist 
		
		JOIN tb_poli ON tb_poli.kd_poli = tb_dokter_poli.kd_poli 
		
		JOIN tb_keluhan ON tb_dokter_poli.kd_dok_pol = tb_keluhan.kd_dok_pol
        
        JOIN chat ON chat.send_to=tb_keluhan.no_rm
		
		
		WHERE tb_keluhan.no_rm ="'.$per.'" AND tb_dokter.no_praktek=
        (select no_praktek from tb_keluhan join tb_dokter_poli on tb_dokter_poli.kd_dok_pol = tb_keluhan.kd_dok_pol where tb_keluhan.no_rm="'.$per.'")
		AND, tb_dokter_poli.'.$har.' = 1 AND TIME("'.$date_now.'") BETWEEN tb_dokter_poli.startwaktu AND tb_dokter_poli.endwaktu');
		$res = $data->result_array();
		
		if(empty($res)){
			$data1 = $this->db->query('SELECT 
			tb_keluhan.tgl_kunjungan,
			tb_keluhan.buktikeluhan,
			tb_keluhan.jenis_kasus,
			tb_keluhan.keluhan,
			tb_keluhan.harga,
			tb_keluhan.status,
			tb_keluhan.kd_pasien, 
			tb_dokter.no_praktek,
			tb_dokter_poli.senin,
			tb_dokter_poli.selasa,
			tb_dokter_poli.rabu,
			tb_dokter_poli.kamis,
			tb_dokter_poli.jumat,
			tb_dokter_poli.sabtu,
			tb_dokter_poli.minggu,
			tb_registrasi.kd_regist,
			tb_registrasi.name, 
			tb_registrasi.image,
			tb_registrasi.no_hp,
			tb_poli.klinik,
			chat.chat_id,
			chat.send_to,
			chat.time,
			chat.status,
			tb_keluhan.no_rm

			FROM tb_dokter_poli
			
			JOIN tb_dokter ON tb_dokter_poli.no_praktek = tb_dokter.no_praktek 
			
			JOIN tb_registrasi ON tb_dokter.kd_regist = tb_registrasi.kd_regist 
			
			JOIN tb_poli ON tb_poli.kd_poli = tb_dokter_poli.kd_poli 
			
			JOIN tb_keluhan ON tb_dokter_poli.kd_dok_pol = tb_keluhan.kd_dok_pol
			
			JOIN chat ON chat.send_to=tb_keluhan.no_rm
			
			
			WHERE tb_keluhan.no_rm ="'.$per.'"');
			$res1 = $data1->result_array();
			return $res1;
			
		}else{
			return $res;
			}	
		
		
		

	}
	
	public function gethari()
	{	
		$daftar_hari = array(
			'Sunday' => 'minggu',
			'Monday' => 'senin',
			'Tuesday' => 'selasa',
			'Wednesday' => 'rabu',
			'Thursday' => 'kamis',
			'Friday' => 'jumat',
			'Saturday' => 'sabtu'
		   );

		   $date= date('Y-m-d');
		   $namahari = date('l', strtotime($date));
		   return $daftar_hari[$namahari];;
    }
    public function listPesan($role){
		$data = $this->db->query('select * from tb_registrasi where kd_role !="'.$role.'" and kd_role !="3"');
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