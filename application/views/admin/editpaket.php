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
                Form Edit Paket
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="nama">ID Paket</label>
                        <input type="text" class="form-control" id="package_id" name="package_id"
                            value="<?= $questPackage['package_id']; ?>">
                        <small class="form-text text-danger"><?= form_error('package_id'); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Paket</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="<?= $questPackage['name']; ?>">
                        <small class="form-text text-danger"><?= form_error('name'); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="nama">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul"
                            value="<?= $questPackage['judul']; ?>">
                        <small class="form-text text-danger"><?= form_error('judul'); ?></small>
                    </div>
                    <button class="btn btn-primary float-right" name="tambah" type="submit">Ubah</button>
                </form>
            </div>
        </div>

    </div>
</div>

<script
    src="<?= base_url('assets/js/ckeditor5/') ?>ckeditor.js">
</script>

<script>
    createEditor();

    function createEditor() {
        let id = 'pilihan'
        const input = document.getElementById('judul')
        ClassicEditor
            .create(document.querySelector('#judul'), {
                toolbar: ['undo', 'redo', '|', 'bold', 'italic', 'underline', '|', 'subscript', 'superscript']
            })
            .then(editor => {
                editor.data.set(input.value);
                editor.model.document.on('change:data', () => {
                    input.value = editor.getData();
                });
            })
            .catch(error => {
                console.log(error);
            });
    }
</script>