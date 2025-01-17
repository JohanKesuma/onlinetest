<?= $this->session->flashdata('message'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><a
            href="<?= $parentUrl; ?>"><img class="pb-1 img-fluid"
                src="<?= base_url('assets/img/back32.png') ?>">
        </a><?= $title; ?>
    </h1>

</div>
<!-- /.container-fluid -->

<div class="row mt-3 justify-content-center">
    <div class="col-md-6">

        <div class="card">
            <div class="card-header">
                Form Ubah Siswa
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="nama">Nomor Induk Siswa</label>
                        <input type="text" class="form-control" id="nis" name="nis"
                            value="<?= $siswa['identity_number']; ?>">
                        <small class="form-text text-danger"><?= form_error('nis'); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="<?= $siswa['name']; ?>">
                        <small class="form-text text-danger"><?= form_error('name'); ?></small>
                    </div>
                    <button class="btn btn-primary float-right" name="tambah" type="submit">Ubah</button>
                    <a class="btn btn-primary float-right mr-2 text-white" href="<?= base_url('admin/resetpassword/'.$siswa['identity_number']) ?>">Reset Password</a>
                </form>
            </div>
        </div>

    </div>
</div>