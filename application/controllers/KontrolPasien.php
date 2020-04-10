<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class KontrolPasien extends CI_Controller {
        function __construct()
        {
            parent::__construct();
            $this->load->model('MahasiswaModel');
            $this->load->helper('url');
        }

        function index() {
            $data['dosen'] = $this->MahasiswaModel->tampil_data()->result();

            $this->load->view('header');		
            $this->load->view('MahasiswaView', $data);	 
		    $this->load->view('footer');
        }

        function form_input() {
            $this->load->view('header');		
            $this->load->view('FormMahasiswaView');	 
		    $this->load->view('footer');
        }

        function insert() {
            $data = array(
                'nap' => $this->input->post('nap'),
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'alamat' => $this->input->post('alamat'),
                'poli' => $this->input->post('poli'),
                'nama_kk' => $this->input->post('nama_kk'),
                'no_telp' => $this->input->post('no_telp')
            );

            $this->MahasiswaModel->insert($data);
            redirect(base_url() . "KontrolPasien", 'refresh');
        }

        function form_update($id) {
            $where = array('nap' => $id);
            $data['dosen'] = $this->MahasiswaModel->edit_data($where, 'dosen')->result();

            //tampilkan form update
            $this->load->view('header');		
            $this->load->view('FormEditMahasiswaView', $data);	 
		    $this->load->view('footer');
        }

        function update() {
            $data = array(
                'nap' => $this->input->post('nap'),
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'alamat' => $this->input->post('alamat'),
                'poli' => $this->input->post('poli'),
                'nama_kk' => $this->input->post('nama_kk'),
                'no_telp' => $this->input->post('no_telp')
            );

            $where = array('nap' => $this->input->post('nap'));

            //proses/lakukan update
            $this->MahasiswaModel->update_data($where, $data, 'dosen');
            redirect(base_url() . "KontrolPasien", 'refresh');
        }

        function hapus($id) {
            $where = array('nap' => $id);

            //lakukan hapus data
            $this->MahasiswaModel->hapus_data($where, 'dosen');
            redirect(base_url() . "KontrolPasien", 'refresh');
        }
    }