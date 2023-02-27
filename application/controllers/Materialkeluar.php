<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Materialkeluar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Material Keluar";
        $data['materialkeluar'] = $this->admin->getMaterialkeluar();
        $this->template->load('templates/dashboard', 'material_keluar/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required|trim');
        $this->form_validation->set_rules('material_id', 'Material', 'required');
        $this->form_validation->set_rules('jenism_id', 'Jenis Material', 'required');
        $this->form_validation->set_rules('barang_id', 'Barang', 'required');
        $this->form_validation->set_rules('jumlah_material_keluar', 'Jumlah Permintaan', 'required|trim|numeric|greater_than[0]');
        $this->form_validation->set_rules('konfersi', 'Konversi', 'required|trim|numeric|greater_than[0]');
    }

    public function add()
    {
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Material Keluar";
            $data['material'] = $this->admin->get('material');
            $data['barang'] = $this->admin->get('barang');
            $data['jenism'] = $this->admin->get('jenism');

            // Mendapatkan dan men-generate kode transaksi barang masuk
            $kode = 'T-MK-' . date('ymd');
            $kode_terakhir = $this->admin->getMax('material_keluar', 'id_material_keluar', $kode);
            $kode_tambah = substr($kode_terakhir, -5, 5);
            $kode_tambah++;
            $number = str_pad($kode_tambah, 5, '0', STR_PAD_LEFT);
            $data['id_material_keluar'] = $kode . $number;

            $this->template->load('templates/dashboard', 'material_keluar/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('material_keluar', $input);

            if ($insert) {
                set_pesan('data berhasil disimpan.');
                redirect('materialkeluar');
            } else {
                set_pesan('Opps ada kesalahan!');
                redirect('materialkeluar/add');
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('material_keluar', 'id_material_keluar', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('materialkeluar');
    }
}
