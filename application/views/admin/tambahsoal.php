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
                Form Tambah Soal
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" class="form-control" id="package_id" name="package_id"
                        value="<?= $packageId; ?>">
                    <div class="form-group">
                        <label for="image">Pilih Gambar</label>
                        <input type="file" class="form-control-file" id="question_image" name="question_image">
                    </div>
                    <div class="form-group">
                        <label for="nama">Soal</label>
                        <textarea type="text" class="form-control" id="soal" name="soal"
                            rows="6"><?= set_value('soal'); ?></textarea>
                        <small class="form-text text-danger"><?= form_error('soal'); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="nama">Pilihan 1</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="radio" name="is_true"
                                        aria-label="Radio button for following text input" value='pilihan1' checked>
                                </div>
                            </div>
                            <input type="text" class="form-control" id="pilihan1" name="pilihan1"
                                value="<?= set_value('pilihan1'); ?>">
                        </div>
                        <small class="form-text text-danger"><?= form_error('pilihan1'); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="nama">Pilihan 2</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="radio" name="is_true"
                                        aria-label="Radio button for following text input" value='pilihan2'>
                                </div>
                            </div>
                            <input type="text" class="form-control" id="pilihan2" name="pilihan2"
                                value="<?= set_value('pilihan2'); ?>">
                        </div>
                        <small class="form-text text-danger"><?= form_error('pilihan2'); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="nama">Pilihan 3</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="radio" name="is_true"
                                        aria-label="Radio button for following text input" value='pilihan3'>
                                </div>
                            </div>
                            <input type="text" class="form-control" id="pilihan3" name="pilihan3"
                                value="<?= set_value('pilihan3'); ?>">
                        </div>
                        <small class="form-text text-danger"><?= form_error('pilihan3'); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="nama">Pilihan 4</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="radio" name="is_true"
                                        aria-label="Radio button for following text input" value='pilihan4'>
                                </div>
                            </div>
                            <input type="text" class="form-control" id="pilihan4" name="pilihan4"
                                value="<?= set_value('pilihan4'); ?>">

                        </div>
                        <small class="form-text text-danger"><?= form_error('pilihan4'); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="nama">Pilihan 5</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="radio" name="is_true"
                                        aria-label="Radio button for following text input" value='pilihan5'>
                                </div>
                            </div>
                            <input type="text" class="form-control" id="pilihan5" name="pilihan5"
                                value="<?= set_value('pilihan5'); ?>">

                        </div>
                        <small class="form-text text-danger"><?= form_error('pilihan5'); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="nama">Waktu (Menit)</label>
                        <input type="number" class="form-control" id="waktu" name="waktu">
                        <small class="form-text text-danger"><?= form_error('waktu'); ?></small>
                    </div>



                    <button class="btn btn-primary float-right" name="tambah" type="submit">Tambah</button>
                </form>
            </div>
        </div>

    </div>
</div>