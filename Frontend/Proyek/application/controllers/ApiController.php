<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ApiController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('curl');
    }

    public function getData()
    {
        $url = 'http://localhost:8080/api/lokasi'; 
        $response = $this->curl->get($url); 
        $data = json_decode($response, true);

        if (is_array($data) && !empty($data)) {
            $locations = $data;
        } else {
            $locations = array();
        }

        $this->load->view('data_view', array('locations' => $locations));
    }

    public function showForm()
    {
        $this->load->view('form_view');
    }

    public function createLocation()
{
    $url = 'http://localhost:8080/api/lokasi'; 

    $postData = array(
        'namaLokasi' => $this->input->post('namaLokasi'),
        'negara' => $this->input->post('negara'),
        'provinsi' => $this->input->post('provinsi'),
        'kota' => $this->input->post('kota')
    );


    $jsonData = json_encode($postData);

    
    $headers = array(
        'Content-Type: application/json'
    );

    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    
    $response = curl_exec($ch);

   
    $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    
    curl_close($ch);

    
    log_message('debug', 'HTTP Status Code: ' . $statusCode);
    log_message('debug', 'API Response: ' . $response);

    
    $responseDecoded = json_decode($response, true);

    // Check if the response is successful
    if ($statusCode == 200 || $statusCode == 201) {
        redirect('apicontroller/getData');
    } else {
        show_error('Gagal menambahkan data lokasi. Status Code: ' . $statusCode . ' - Response: ' . $response);
    }
}

public function updateLocation($id)
{
    
    $url = "http://localhost:8080/api/lokasi/$id";
    
    // Mendapatkan data dari API
    $response = $this->curl->get($url);
    $data = json_decode($response, true);

    
    if (is_array($data) && isset($data['id'])) {
        $this->load->view('update_form_view', $data);
    } else {
        show_404(); 
    }
}



public function processUpdate()
{
    $id = $this->input->post('id');
    $namaLokasi = $this->input->post('namaLokasi');
    $negara = $this->input->post('negara');
    $provinsi = $this->input->post('provinsi');
    $kota = $this->input->post('kota');

    
    $url = "http://localhost:8080/api/lokasi";
    
    
    $data = array(
        'id' => $id,
        'namaLokasi' => $namaLokasi,
        'negara' => $negara,
        'provinsi' => $provinsi,
        'kota' => $kota
    );
    
    
    $jsonData = json_encode($data);
    
    
    $headers = array(
        'Content-Type: application/json'
    );
    
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    
    $response = curl_exec($ch);
    
    
    $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    
    curl_close($ch);
    
    
    log_message('debug', 'HTTP Status Code: ' . $statusCode);
    log_message('debug', 'API Response: ' . $response);
    
    
    if ($statusCode == 200 || $statusCode == 204) {
        redirect('apicontroller/getData'); 
    } else {
        
        show_error('Gagal mengupdate data. Status Code: ' . $statusCode . ' - Response: ' . $response);
    }
}

    
    

    
    public function confirmDelete($id)
    {
        $url = "http://localhost:8080/api/lokasi/$id";
        $response = $this->curl->get($url);
        $data = json_decode($response, true);
        $data['id'] = $id;

        $this->load->view('delete_confirmation_view', $data);
    }

    
    public function processDelete()
    {
        $id = $this->input->post('id');
        $url = "http://localhost:8080/api/lokasi/$id";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        $response = curl_exec($ch);
        curl_close($ch);
        
        if ($response) {
            redirect('Apicontroller/getData');
        } else {
            echo "Error deleting data.";
        }
    }

}
    
    
