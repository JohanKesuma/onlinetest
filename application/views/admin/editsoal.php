<?= $this->session->flashdata('message'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><a href="<?= $parentUrl; ?>"><img class="pb-1 img-fluid" src="<?= base_url('assets/img/back32.png') ?>"> </a><?= $title; ?>
    </h1>

</div>
<!-- /.container-fluid -->

<div class="row mt-3 justify-content-center">
    <div class="col-md-6">

        <div class="card">
            <div class="card-header">
                Form Edit Soal
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                
                    <?php if($question['image'] != '') : ?>
                    <div class="form-group d-flex justify-content-center">
                        <div>
                            <img class="img-fluid" src="<?= base_url('assets/img/').$question['image']; ?>" alt="">
                        </div>
                    </div>
                    <?php endif; ?>
                    
                    <div class="form-group">
                        <label for="image">Pilih Gambar</label>
                        <input type="file" class="form-control-file" id="question_image" name="question_image">
                    </div>
                    <div class="form-group">
                        <label for="nama">Soal</label>
                        <textarea type="text" class="form-control" id="soal" name="soal" rows="6"><?= $question['text']; ?></textarea>
                        <small class="form-text text-danger"><?= form_error('soal'); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="nama">Pilihan 1</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="radio" name="is_true" aria-label="Radio button for following text input"  value='pilihan1' <?php if($answers[0]['is_true'] == '1') {echo('checked');} ?>>
                                </div>
                            </div>
                            <input type="hidden" class="form-control" id="pilihan1_id" name="pilihan1_id" value="<?= $answers[0]['answers_id']; ?>">
                            <input type="text" class="form-control" id="pilihan1" name="pilihan1" value="<?= $answers[0]['text']; ?>">
                        </div>
                        <small class="form-text text-danger"><?= form_error('pilihan1'); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="nama">Pilihan 2</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="radio" name="is_true" aria-label="Radio button for following text input" value='pilihan2' <?php if($answers[1]['is_true'] == '1') {echo('checked');} ?>>
                                </div>
                            </div>
                            <input type="hidden" class="form-control" id="pilihan2_id" name="pilihan2_id" value="<?= $answers[1]['answers_id']; ?>">
                            <input type="text" class="form-control" id="pilihan2" name="pilihan2" value="<?= $answers[1]['text']; ?>">
                        </div>
                        <small class="form-text text-danger"><?= form_error('pilihan2'); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="nama">Pilihan 3</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="radio" name="is_true" aria-label="Radio button for following text input" value='pilihan3' <?php if($answers[2]['is_true'] == '1') {echo('checked');} ?>>
                                </div>
                            </div>
                            <input type="hidden" class="form-control" id="pilihan3_id" name="pilihan3_id" value="<?= $answers[2]['answers_id']; ?>">
                            <input type="text" class="form-control" id="pilihan3" name="pilihan3" value="<?= $answers[2]['text']; ?>">
                        </div>
                        <small class="form-text text-danger"><?= form_error('pilihan3'); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="nama">Pilihan 4</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="radio" name="is_true" aria-label="Radio button for following text input" value='pilihan4' <?php if($answers[3]['is_true'] == '1') {echo('checked');} ?>>
                                </div>
                            </div>
                            <input type="hidden" class="form-control" id="pilihan4_id" name="pilihan4_id" value="<?= $answers[3]['answers_id']; ?>">
                            <input type="text" class="form-control" id="pilihan4" name="pilihan4" value="<?= $answers[3]['text']; ?>">
                           
                        </div>
                        <small class="form-text text-danger"><?= form_error('pilihan4'); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="nama">Pilihan 5</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="radio" name="is_true" aria-label="Radio button for following text input" value='pilihan5' <?php if($answers[4]['is_true'] == '1') {echo('checked');} ?>>
                                </div>
                            </div>
                            <input type="hidden" class="form-control" id="pilihan5_id" name="pilihan5_id" value="<?= $answers[4]['answers_id']; ?>">
                            <input type="text" class="form-control" id="pilihan5" name="pilihan5" value="<?= $answers[4]['text']; ?>">
                           
                        </div>
                        <small class="form-text text-danger"><?= form_error('pilihan5'); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="nama">Waktu (Menit)</label>
                        <input type="number" class="form-control" id="waktu" name="waktu" value='<?= $question['time']; ?>'>
                        <small class="form-text text-danger"><?= form_error('waktu'); ?></small>
                    </div>
                    <button class="btn btn-primary float-right" name="tambah" type="submit">Ubah</button>
                </form>
            </div>
        </div>

    </div>
</div>