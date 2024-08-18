<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ProyekController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('curl');
    }

    public function index()
    {
        
        $this->dataProyekView();
    }

    public function dataProyekView()
    {
        $url = 'http://localhost:8080/api/proyek'; 
        $response = $this->curl->get($url);
        $data['proyek'] = json_decode($response, true);

        
        $this->load->view('data_proyek_view', $data);
    }

    public function showAddForm()
    {
        
        $url = 'http://localhost:8080/api/lokasi';
        $response = $this->curl->get($url);
        $data['lokasi'] = json_decode($response, true);

        
        $this->load->view('add_proyek_view', $data);
    }

    public function processAdd()
    {
        $namaProyek = $this->input->post('namaProyek');
        $client = $this->input->post('client');
        $tglMulai = $this->input->post('tglMulai');
        $tglSelesai = $this->input->post('tglSelesai');
        $pimpro = $this->input->post('pimpro');
        $keterangan = $this->input->post('keterangan');
        $lokasiId = $this->input->post('lokasiId'); 

        
        $tglMulai = $this->convertDatetimeLocalToFormat($tglMulai);
        $tglSelesai = $this->convertDatetimeLocalToFormat($tglSelesai);

        
        $url = 'http://localhost:8080/api/proyek';

        
        $data = array(
            'namaProyek' => $namaProyek,
            'client' => $client,
            'tglMulai' => $tglMulai,
            'tglSelesai' => $tglSelesai,
            'pimpro' => $pimpro,
            'keterangan' => $keterangan,
            'lokasiId' => $lokasiId 
        );

        
        $headers = array(
            'Content-Type: application/json'
        );
        $response = $this->curl->post($url, json_encode($data), $headers);

        if ($response) {
            
            redirect('ProyekController/dataProyekView'); 
        } else {
            
            echo "Gagal menambah data";
        }
    }

    
    private function convertDatetimeLocalToFormat($datetimeLocal)
    {
        $datetime = DateTime::createFromFormat('Y-m-d\TH:i', $datetimeLocal);
        if ($datetime) {
            return $datetime->format('Y-m-d H:i');
        } else {
            
            return null;
        }
    }

    
    public function updateProyek($id)
    {
        $url = "http://localhost:8080/api/proyek/$id";
        $response = $this->curl->get($url);
        $data['proyek'] = json_decode($response, true);

        
        if (is_array($data['proyek']) && isset($data['proyek']['id'])) {
            $this->load->view('update_proyek_view', $data);
        } else {
            show_404(); 
        }
    }

    public function showUpdateForm($id)
    {
       
        $url = "http://localhost:8080/api/proyek/$id";
        $response = $this->curl->get($url);
        $data['proyek'] = json_decode($response, true);

        
        $urlLokasi = 'http://localhost:8080/api/lokasi';
        $responseLokasi = $this->curl->get($urlLokasi);
        $data['lokasi'] = json_decode($responseLokasi, true);

        
        $selectedLokasi = array();
        if (!empty($data['proyek']['lokasi'])) {
            foreach ($data['proyek']['lokasi'] as $loc) {
                $selectedLokasi[] = $loc['id'];
            }
        }
        $data['selectedLokasi'] = $selectedLokasi;

       
        $this->load->view('update_proyek_view', $data);
    }

    
    public function processUpdate()
    {
        $id = $this->input->post('id');
        $namaProyek = $this->input->post('namaProyek');
        $client = $this->input->post('client');
        $tglMulai = $this->input->post('tglMulai');
        $tglSelesai = $this->input->post('tglSelesai');
        $pimpro = $this->input->post('pimpro');
        $keterangan = $this->input->post('keterangan');
        $lokasiId = $this->input->post('lokasiId'); 

        
        $tglMulai = $this->convertDatetimeLocalToFormat($tglMulai);
        $tglSelesai = $this->convertDatetimeLocalToFormat($tglSelesai);

        
        $url = "http://localhost:8080/api/proyek";

        
        $data = array(
            'id' => $id,
            'namaProyek' => $namaProyek,
            'client' => $client,
            'tglMulai' => $tglMulai,
            'tglSelesai' => $tglSelesai,
            'pimpro' => $pimpro,
            'keterangan' => $keterangan,
            'lokasiId' => $lokasiId 
        );

        
        $headers = array(
            'Content-Type: application/json'
        );
        $response = $this->curl->put($url, json_encode($data), $headers);

        if ($response) {
            
            redirect('ProyekController/dataProyekView'); 
        } else {
            
            echo "Gagal memperbarui data";
        }
    }



    public function confirmDelete($id)
    {
        $url = "http://localhost:8080/api/proyek/$id";
        $response = $this->curl->get($url);
        $data = json_decode($response, true);
    
        
        if (is_array($data) && isset($data['id'])) {
            $data['id'] = $id;
            $data['namaProyek'] = isset($data['namaProyek']) ? $data['namaProyek'] : 'N/A';
            $this->load->view('delete_confirmation_proyek_view', $data);
        } else {
            show_404(); 
        }
    }
    
    public function processDelete()
    {
        $id = $this->input->post('id');
    
        if (!$id) {
            echo "ID not provided.";
            return;
        }
    
        $url = "http://localhost:8080/api/proyek/$id";
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
    
        if ($http_code == 200) {
            
            redirect('ProyekController/dataProyekView');
        } else {
            
            echo "Error deleting data. HTTP Code: $http_code";
        }
    }
}
