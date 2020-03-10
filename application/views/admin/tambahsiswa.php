<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"> <a href="<?= $parentUrl; ?>"><img class="pb-1 img-fluid" src="<?= base_url('assets/img/back32.png') ?>"> </a><?= $title; ?>
    </h1>

</div>
<!-- /.container-fluid -->

<div class="row mt-3 justify-content-center">
        <div class="col-md-6">

            <div class="card">
                <div class="card-header">
                    Form Tambah Siswa
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="nama">Nomor Induk Siswa</label>
                            <input type="text" class="form-control" id="nis" name="nis" value="<?= set_value('nis'); ?>">
                            <small class="form-text text-danger"><?= form_error('nis'); ?></small>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= set_value('name'); ?>">
                            <small class="form-text text-danger"><?= form_error('name'); ?></small>
                        </div>
                        <div class="form-group">
                            <label for="nama">Password</label>
                            <input type="password" class="form-control" id="password1" name="password1">
                            <small class="form-text text-danger"><?= form_error('password1'); ?></small>
                        </div>
                        <div class="form-group">
                            <label for="nama">Masukkan Kembali Password</label>
                            <input type="password" class="form-control" id="password2" name="password2">
                        </div>

                        <button class="btn btn-primary float-right" name="tambah" type="submit">Tambah</button>
                    </form>
                </div>
            </div>

        </div>
    </div>