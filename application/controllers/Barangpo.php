<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barangpo extends CI_Controller
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
        $data['title'] = "Incoming Goods";
        $data['barangpo'] = $this->admin->getBarangPo();
        $this->template->load('templates/dashboard', 'barang_po/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required|trim');
        $this->form_validation->set_rules('supplier_id', 'Supplier', 'required');
        $this->form_validation->set_rules('barang_id', 'Barang', 'required');
        $this->form_validation->set_rules('jumlah_po', 'Jumlah Permintaan', 'required|trim|numeric|greater_than[0]');
    }

    public function add()
    {
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Incoming Goods";
            $data['supplier'] = $this->admin->get('supplier');
            $data['barang'] = $this->admin->get('barang');

            // Mendapatkan dan men-generate kode transaksi barang masuk
            $kode = 'T-PO-' . date('ymd');
            $kode_terakhir = $this->admin->getMax('barang_po', 'id_po_masuk', $kode);
            $kode_tambah = substr($kode_terakhir, -5, 5);
            $kode_tambah++;
            $number = str_pad($kode_tambah, 5, '0', STR_PAD_LEFT);
            $data['id_po_masuk'] = $kode . $number;

            $this->template->load('templates/dashboard', 'barang_po/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('barang_po', $input);

            if ($insert) {
                set_pesan('data berhasil disimpan.');
                redirect('barangpo');
            } else {
                set_pesan('Opps ada kesalahan!');
                redirect('barangpo/add');
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('barang_po', 'id_po_masuk', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('barangpo');
    }
}
