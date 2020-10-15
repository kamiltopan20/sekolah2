<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Produk extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Produk_model');
        $this->load->model('No_urut');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'produk/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'produk/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'produk/index.html';
            $config['first_url'] = base_url() . 'produk/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Produk_model->total_rows($q);
        $produk = $this->Produk_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'produk_data' => $produk,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'konten' => 'produk/produk_list',
            'judul' => 'Data Produk',
        );
        $this->load->view('v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->Produk_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_produk' => $row->id_produk,
		'nama_produk' => $row->nama_produk,
		'warna' => $row->warna,
	    );
            $this->load->view('produk/produk_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('produk'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('produk/create_action'),
	    'id_produk' => set_value('id_Produk'),
	    'nama_produk' => set_value('nama_produk'),
        'warna' => set_value('warna'),
        'kategory' => set_value('kategory'),
        'konten' => 'produk/produk_form',
        'judul' => 'Data Produk',
	);
        $this->load->view('v_index', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {

        $nmfile = "Produk_".time();
        $config['upload_path'] = './image/produk';
        $config['allowed_types'] = 'jpg|png';
        $config['max_size'] = '20000';
        $config['file_name'] = $nmfile;
        // load library upload
        $this->load->library('upload', $config);
        // upload gambar 1
        $this->upload->do_upload('foto_Produk');
        $result1 = $this->upload->data();
        $result = array('gambar'=>$result1);
        $dfile = $result['gambar']['file_name'];

            $data = array(

		'nama_produk' => $this->input->post('nama_produk',TRUE),
		'warna' => $this->input->post('warna',TRUE),
	    );

            $this->Produk_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('produk'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Produk_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('produk/update_action'),
                'id_produk' => set_value('id_produk', $row->id_produk),
                'nama_produk' => set_value('nama_produk', $row->nama_produk),
                'warna' => set_value('warna', $row->warna),
                'kategory' => set_value('kategory', $row->kategory),
                'konten' => 'produk/produk_form',
                'judul' => 'Data Produk',
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('produk'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_produk', TRUE));
        } else {
        if ($_FILES == '') {
            
            $data = array(
        'nama_produk' => $this->input->post('nama_produk',TRUE),
        'warna' => $this->input->post('warna',TRUE),
        'kategory' => set_value('kategory', $row->kategory),
        );

            $this->Produk_model->update($this->input->post('id_produk', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('produk'));

        } else {

             $data = array(
        
        'nama_produk' => $this->input->post('nama_produk',TRUE),
        'warna' => $this->input->post('warna',TRUE),
        'kategory' => $this->input->post('kategory',TRUE),

        
        );

            $this->Produk_model->update($this->input->post('id_produk', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('produk'));
        }

           
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Produk_model->get_by_id($id);

        if ($row) {
            $this->Produk_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('produk'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('produk'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_produk', 'nama produk', 'trim|required');
	$this->form_validation->set_rules('warna', 'warna', 'trim|required');
	$this->form_validation->set_rules('kategory', 'kategory', 'trim|required');
    

	$this->form_validation->set_rules('id_produk', 'id_produk', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

