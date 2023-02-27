<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Data Material Keluar
                </h4><br>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('materialkeluar/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="icon">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">
                        Input Material Keluar
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
                    <th>Tanggal</th>
                    <th>Material</th>
                    <th>Jenis</th>
                    <th>Jumlah Keluar</th>
                    <th>Part</th>
                    <th>Konversi Part</th>
                    <th>User</th>
                    <?php if (is_admin()) : ?>
                    <th>Aksi</th><?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $totalpo = 0;
                if ($materialkeluar) :
                    foreach ($materialkeluar as $mk) :
                        $totalpo += $mk['jumlah_po'];
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $mk['tanggal_keluar']; ?></td>
                            <td><?= $mk['nama_material']; ?></td>
                            <td><?= $mk['nama_jenism']; ?></td>
                            <td><?= $mk['jumlah_material_keluar'] . ' ' . $mk['nama_satuan']; ?></td>
                            <td><?= $mk['nama_barang']; ?></td>
                            <td><?= $mk['konfersi'] . ' ' . $mk['nama_satuan']; ?></td>
                            <td><?= $mk['nama']; ?></td>
                              <?php if (is_admin()) : ?>
                                <td>                    
                                    <a onclick="return confirm('Yakin ingin hapus?')" href="<?= base_url('material_keluar/delete/') . $mk['id_material_keluar'] ?>" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a>  <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="8" class="text-center">
                            Data Kosong
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>