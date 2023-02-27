<?php error_reporting(0); ?>
<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Data Material
                </h4>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('material/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="icon">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">
                        Tambah Data Material
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped w-100 dt-responsive " id="dataTable">
            <thead>
                <tr>
                    <th>No. </th>
                    <th>ID material</th>
                    <th>Nama material</th>
                    <th>Type</th>
                    <th>Satuan</th>
                    <th>Supplier</th>
                       <?php if (is_admin()) : ?>
                    <th>Aksi</th><?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $tot_bayar = 0;
                if ($material) :
                    foreach ($material as $b) :
                        $total = $b['harga_material'] * $b['stok'];
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $b['id_material']; ?></td>
                            <td><?= $b['nama_material']; ?></td>
                            <td><?= $b['nama_jenis']; ?></td>
                            <td><?= $b['nama_satuan']; ?></td>
                             <td><?= $b['nama_supplier']; ?></td>
                              <?php if (is_admin()) : ?>
                            <td>
                                <a href="<?= base_url('material/edit/') . $b['id_material'] ?>" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-edit"></i></a>
                                 
                                    <a onclick="return confirm('Yakin ingin hapus?')" href="<?= base_url('material/delete/') . $b['id_material'] ?>" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a>  <?php endif; ?>
                            </td>
                        </tr>
                        
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="7" class="text-center">
                            Data Kosong
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>