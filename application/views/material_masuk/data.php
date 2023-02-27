<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Data Material Masuk
                </h4>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('materialmasuk/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="icon">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">
                        Input Material Masuk
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
                    <th>Tanggal Masuk</th>
                    <th>Nama Material</th>
                    <th>Jenis</th>
                    <th>Jumlah Masuk</th>
                    <th>Jumlah Keluar</th>
                    <th>Part</th>
                    <th>Konversi Part</th>
                    <th>User</th>
                    <?php if (is_admin()) : ?><th>Hapus</th><?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $total = 0;
                if ($materialmasuk) :
                    foreach ($materialmasuk as $mm) :
                        $total += $mm['jumlah_material_masuk'];
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $mm['tanggal_masuk']; ?></td>
                            <td><?= $mm['nama_material']; ?></td>
                            <td><?= $mm['nama_jenism']; ?></td>
                            <td><?= $mm['jumlah_material_masuk'] . ' ' . $mm['nama_satuan']; ?></td>
                            <td><?= $mm['jml_material_keluar']; ?></td>
                            <td><?= $mm['nama_barang']; ?></td>
                            <td><?= $mm['konversi']; ?></td>
                            <td><?= $mm['nama']; ?></td>
                              <?php if (is_admin()) : ?><td>
                                <a onclick="return confirm('Yakin ingin hapus?')" href="<?= base_url('materialmasuk/delete/') . $mm['id_material_masuk'] ?>" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a>
                            </td><?php endif; ?>
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