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

<div class="container row mt-3 justify-content-center">
    <div class="col-sm-12">
        <form action="" method="post">
            <textarea name="content_form" id="content_form">
                <?= $content['content']; ?>
            </textarea>
            <small class="form-text text-danger"><?= form_error('content_form'); ?></small>
            <button class="mt-2 btn btn-primary float-right" name="tambah" type="submit">Simpan</button>
        </form>
    </div>
</div>

<script
    src="<?= base_url('assets/js/ckeditor5/') ?>ckeditor.js">
</script>
<script>
    ClassicEditor
        .create(document.querySelector('#content_form'), {
            toolbar: ['undo', 'redo', '|', 'bold', 'italic', 'underline', '|', 'subscript', 'superscript', '|',
                'fontcolor', 'fontfamily', 'fontsize', '|', 'bulletedList', 'numberedList', 'blockQuote'
            ]
        })
        .catch(error => {
            console.log(error);
        });
</script>