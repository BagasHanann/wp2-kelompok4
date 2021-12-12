<?php 

class model_admin extends CI_Model
{
    public function hitungJumlahMhs()
    {   
        $query = $this->db->get('mhs');
    
        if($query->num_rows()>0)
        {
          return $query->num_rows();
        }
        else
        {
          return 0;
        }
    }
}

