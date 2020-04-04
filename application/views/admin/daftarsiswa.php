<?= $this->session->flashdata('message'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?>
    </h1>

</div>
<!-- /.container-fluid -->

<div class="container-fluid">
    <a href="<?= base_url('admin/tambahsiswa') ?>"
        class="btn btn-primary mb-4">Tambah Siswa</a>
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
            <?php foreach ($daftarSiswa as $ds): ?>
            <tr>
                <th scope="row"><?= $no; ?>
                </th>
                <td><?= $ds['identity_number']; ?>
                </td>
                <td><?= $ds['name']; ?>
                </td>
                <td>
                    <div>
                        <a class="btn btn-primary mr-1 btn-sm"
                            href="<?= base_url('admin/ubahsiswa/'.$ds['identity_number']) ?>">Ubah</a>
                        <a class="btn btn-danger mr-1 btn-sm"
                            data-url="<?= base_url('admin/hapussiswa/'.$ds['identity_number']) ?>"
                            data-target="#hapusModal" data-toggle="modal" href="#">Hapus</a>
                    </div>
                </td>
            </tr>
            <?php $no++; endforeach; ?>
        </tbody>
    </table>
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