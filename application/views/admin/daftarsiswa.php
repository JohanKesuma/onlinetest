<?= $this->session->flashdata('message'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?>
    </h1>

</div>
<!-- /.container-fluid -->

<div class="container-fluid">
    <a href="<?= base_url('admin/tambahsiswa') ?>" class="btn btn-primary mb-4">Tambah Siswa</a>
</div>

<div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Nomor Induk Siswa</th>
                <th scope="col">Nama</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
        <?php $no = 1; ?>
        <?php foreach($daftarSiswa as $ds): ?>
            <tr>
                <th scope="row"><?= $no; ?></th>
                <td><?= $ds['identity_number']; ?></td>
                <td><?= $ds['name']; ?></td>
                <td>
                    <div>
                        <a class="btn btn-primary mr-1 btn-sm" href="<?= base_url('admin/ubahsiswa/'.$ds['identity_number']) ?>">Ubah</a>
                        <button type="button" class="btn btn-danger btn-sm">Hapus</button>
                    </div>
                </td>
            </tr>
        <?php $no++; endforeach; ?>
        </tbody>
    </table>
</div>