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

<div class="container">

    <?php $count = 1; ?>
    <?php foreach ($questions as $q): ?>
    <div class="row ml-1">
        <div class="col">
            <div class="row">
                <div class="col-sm-0">
                    <div class="dropdown">
                        <button class="mb-1 btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Edit
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item"
                                href="<?= base_url('/admin/editsoal/'.$q['questions_id']) ?>">Edit
                                Soal</a>
                            <a class="dropdown-item"
                                data-url="<?= base_url('/admin/hapussoal/'.$q['package_id'].'/'.$q['questions_id']) ?>"
                                href="#" data-target="#hapusModal" data-toggle="modal">Hapus</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-11 mb-1">

                    <?php if ($q['image'] != '') : ?>
                    <div class="mb-1" style="overflow-x: auto; white-space: nowrap;">
                        <img class="img-fluid" style="min-width: 500px;"
                            src="<?= base_url('assets/img/').$q['image']; ?>">
                    </div>
                    <?php endif; ?>
                    <div class="p-2" style="border: 1px solid rgba(0, 0, 0, .2); border-radius: 5px;min-height: 100px;">
                        <?= $count.'. '.$q['text'] ?>
                    </div>
                    <!-- <textarea rows="6" class="form-control" readonly><?= $count.'. '.$q['text'] ?></textarea> -->
                    
                    <?php foreach ($q['answers'] as $answers) : ?>
                    <div class="row ml-5 p-1 mt-1" style="border-left: 3px solid rgba(0, 0, 0, .2); border-radius: 5px;">
                        <div class="col">
                            <?php if ($answers['image'] != '') : ?>
                            <div class="row">
                                <div class="col mb-1 mr-1" style="overflow-x: auto; white-space: nowrap;">
                                    <img class="img-fluid" style="min-width: 200px;"
                                        src="<?= base_url('assets/img/answers/'.$answers['answers_id'].'/').$answers['image']; ?>">
                                </div>
                            </div>
                            
                            <?php endif; ?>
                            <div class="row">
                                <div class="col">
                                    <p><?= $answers['text']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>


        </div>

    </div>
    <?php $count++; endforeach; ?>

</div>

<!-- Hapus Modal-->
<div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">Anda yakin?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <a id="hapusButton" class="btn btn-danger" href="#">Hapus</a>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid mt-3">
    <a href="<?= base_url('admin/tambahsoal/'.$packageId); ?>"
        class="btn btn-primary mb-4">Tambah Soal</a>
</div>

<script>
    window.onload = function() {
        $('#hapusModal').on('show.bs.modal', function(e) {

            //get data-id attribute of the clicked element
            var url = $(e.relatedTarget).data('url'); // url untuk hapus siswa
            console.log(url);
            $('#hapusButton').attr('href', url); // ganti value href
        });
    }
</script>