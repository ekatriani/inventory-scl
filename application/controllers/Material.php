<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Material extends CI_Controller
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
        $data['title'] = "Material";
        $data['material'] = $this->admin->getMaterial();
        $this->template->load('templates/dashboard', 'material/data', $data);
    }
    public function detail($id)
    {
        $data['title'] = 'material';

        //menampilkan data berdasarkan id
        $data['data'] = $this->material_model->detail_join($id, 'material')->result();

        $this->template->load('templates/dashboard', 'material/data', $data);
    }
    private function _validasi()
    {
        $this->form_validation->set_rules('nama_material', 'Nama Material', 'required|trim');
        $this->form_validation->set_rules('jenis_id', 'Type Material', 'required');
        $this->form_validation->set_rules('satuan_id', 'Satuan Material', 'required');
        $this->form_validation->set_rules('harga_material', 'Harga Material','required|trim|numeric');
        $this->form_validation->set_rules('supplier_id', 'Supplier', 'required');
    }
     private function _config()
    {
        $config['upload_path']      = "./assets/upload";
        $config['allowed_types']    = 'gif|jpg|jpeg|png';
        $config['max_size']         = '2048';
        $config['file_name']         = 'item-'.date('ymd').'-'.substr(md5(rand()),0,10);
        $this->load->library('upload', $config);
    }
    public function add()
    {
        $this->_validasi();
        $this->_config();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Inventory";
            $data['jenis'] = $this->admin->get('jenis');
            $data['satuan'] = $this->admin->get('satuan');
            $data['supplier'] = $this->admin->get('supplier');
            $data['harga_material'] = "harga_material";
            // Mengenerate ID material
            $kode_terakhir = $this->admin->getMax('material', 'id_material');
            $kode_tambah = substr($kode_terakhir, -6, 6);
            $kode_tambah++;
            $number = str_pad($kode_tambah, 6, '0', STR_PAD_LEFT);
            $data['id_material'] = 'B' . $number;

            $this->template->load('templates/dashboard', 'material/add', $data);
        } else {
            $input = $this->input->post(null, true);
            if (@$_FILES['image']['name'] != null) {
                 if ($this->upload->do_upload('image')) {
                    $input['image'] = $this->upload->data('file_name');
                    $insert = $this->admin->insert('material', $input);
                     if ($this->db->affected_rows() > 0) {
                     $this->session->set_flashdata('Succes','Data Berhasil Disimpan');
                    } 
                     redirect('material');
                    }else{
                       $error = $this->upload->display_errors();
                       $this->session->set_flashdata('error', $error);
                        redirect('material/add');
                    }

              
            }else{
                   $input['image'] = null;
                    $insert = $this->admin->insert('material', $input);
                     if ($this->db->affected_rows() > 0) {
                     $this->session->set_flashdata('Succes','Data Berhasil Disimpan');
                     redirect('material');
                    }else{
                       $error = $this->upload->display_errors();
                       $this->session->set_flashdata('error', $error);
                        redirect('material/add');
                    }
            }
           
        }
    }


    public function edit($getId)
    {  
        $id = encode_php_tags($getId);
        $this->_validasi();
        $this->_config();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Inventory";
            $data['jenis'] = $this->admin->get('jenis');
            $data['satuan'] = $this->admin->get('satuan');
            $data['supplier'] = $this->admin->get('supplier');
            $data['harga_material'] = "harga_material";
            $data['material'] = $this->admin->get('material', ['id_material' => $id]);
            $this->template->load('templates/dashboard', 'material/edit', $data);
        } else {
            $input = $this->input->post(null, true);
             if (empty($_FILES['image']['name'])) {
                $insert = $this->admin->update('material', 'id_material', $id, $input);
                if ($insert) {
                    set_pesan('perubahan berhasil disimpan.');
                    redirect('material');
                }else{
                    set_pesan('perubahan tidak disimpan.');
                }
                redirect('material/edit'.$id);
            } else {
                if ($this->upload->do_upload('image') == false) {
                    echo $this->upload->display_errors();
                    die;
                } else {
                    if ($input['image'] != null) {
                        $old_image = 'assets/upload/' . $input['image'];
                       unlink($old_image);
                    }

                    $input['image'] = $this->upload->data('file_name');
                   $update = $this->admin->update('material', 'id_material', $id, $input);
                    if ($update) {
                        set_pesan('perubahan berhasil disimpan.');
                        redirect('material');
                    } 
                    else {
                        set_pesan('gagal menyimpan perubahan');
                    }
                    redirect('material/edit'.$id);
                }
            }
        }
    }
    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('material', 'id_material', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('material');
    }

    public function getStok($getId)
    {
        $id = encode_php_tags($getId);
        $query = $this->admin->cekStokMaterial($id);
        output_json($query);
    }
}
