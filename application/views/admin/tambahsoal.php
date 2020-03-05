<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?>
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
                <form action="" method="post">
                    <input type="hidden" class="form-control" id="package_id" name="package_id" value="<?= $packageId; ?>">
                    <div class="form-group">
                        <label for="nama">Soal</label>
                        <textarea type="text" class="form-control" id="soal" name="soal" rows="3"></textarea>

                    </div>
                    <div class="form-group">
                        <label for="nama">Pilihan 1</label>
                        <input type="text" class="form-control" id="pilihan1" name="pilihan1">

                    </div>
                    <div class="form-group">
                        <label for="nama">Pilihan 2</label>
                        <input type="text" class="form-control" id="pilihan2" name="pilihan2">
                    </div>
                    <div class="form-group">
                        <label for="nama">Pilihan 3</label>
                        <input type="text" class="form-control" id="pilihan3" name="pilihan3">
                    </div>
                    <div class="form-group">
                        <label for="nama">Pilihan 4</label>
                        <input type="text" class="form-control" id="pilihan4" name="pilihan4">
                    </div>
                    <div class="form-group">
                        <label for="nama">Waktu (Menit)</label>
                        <input type="number" class="form-control" id="waktu" name="waktu">
                    </div>


                    <button class="btn btn-primary float-right" name="tambah" type="submit">Tambah</button>
                </form>
            </div>
        </div>

    </div>
</div>