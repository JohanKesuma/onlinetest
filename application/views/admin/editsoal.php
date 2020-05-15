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
                Form Edit Soal
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">

                    <?php if ($question['image'] != '') : ?>
                    <div class="form-group d-flex justify-content-center">
                        <div>
                            <img class="img-fluid"
                                src="<?= base_url('assets/img/').$question['image']; ?>"
                                alt="">
                        </div>
                    </div>
                    <a
                        href="<?= base_url('question/hapusgambar/'.$question['questions_id']) ?>"><button
                            type="button" class="btn btn-outline-danger mb-4">Hapus Gambar</button></a>
                    <?php endif; ?>

                    <div class="form-group">
                        <label for="image">Pilih Gambar</label>
                        <input type="file" class="form-control-file" id="question_image" name="question_image">
                    </div>
                    <div class="form-group">
                        <label for="nama">Soal</label>
                        <textarea type="text" class="form-control" id="soal" name="soal"
                            rows="6"><?= $question['text']; ?></textarea>
                        <small class="form-text text-danger"><?= form_error('soal'); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="nama">Pilihan 1</label>
                        <input type="file" id="img1" name="answer_image" data-max-file-size="3MB">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="radio" name="is_true"
                                        aria-label="Radio button for following text input" value='pilihan1' <?php if ($answers[0]['is_true'] == '1') {
    echo('checked');
} ?>>
                                </div>
                            </div>
                            <input type="hidden" class="form-control" id="pilihan1_id" name="pilihan1_id"
                                value="<?= $answers[0]['answers_id']; ?>">
                            <input type="text" class="form-control" id="pilihan1" name="pilihan1"
                                value="<?= $answers[0]['text']; ?>">
                        </div>
                        <small class="form-text text-danger"><?= form_error('pilihan1'); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="nama">Pilihan 2</label>
                        <input type="file" id="img2" name="answer_image" data-max-file-size="3MB">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="radio" name="is_true"
                                        aria-label="Radio button for following text input" value='pilihan2' <?php if ($answers[1]['is_true'] == '1') {
    echo('checked');
} ?>>
                                </div>
                            </div>
                            <input type="hidden" class="form-control" id="pilihan2_id" name="pilihan2_id"
                                value="<?= $answers[1]['answers_id']; ?>">
                            <input type="text" class="form-control" id="pilihan2" name="pilihan2"
                                value="<?= $answers[1]['text']; ?>">
                        </div>
                        <small class="form-text text-danger"><?= form_error('pilihan2'); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="nama">Pilihan 3</label>
                        <input type="file" id="img3" name="answer_image" data-max-file-size="3MB">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="radio" name="is_true"
                                        aria-label="Radio button for following text input" value='pilihan3' <?php if ($answers[2]['is_true'] == '1') {
    echo('checked');
} ?>>
                                </div>
                            </div>
                            <input type="hidden" class="form-control" id="pilihan3_id" name="pilihan3_id"
                                value="<?= $answers[2]['answers_id']; ?>">
                            <input type="text" class="form-control" id="pilihan3" name="pilihan3"
                                value="<?= $answers[2]['text']; ?>">
                        </div>
                        <small class="form-text text-danger"><?= form_error('pilihan3'); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="nama">Pilihan 4</label>
                        <input type="file" id="img4" name="answer_image" data-max-file-size="3MB">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="radio" name="is_true"
                                        aria-label="Radio button for following text input" value='pilihan4' <?php if ($answers[3]['is_true'] == '1') {
    echo('checked');
} ?>>
                                </div>
                            </div>
                            <input type="hidden" class="form-control" id="pilihan4_id" name="pilihan4_id"
                                value="<?= $answers[3]['answers_id']; ?>">
                            <input type="text" class="form-control" id="pilihan4" name="pilihan4"
                                value="<?= $answers[3]['text']; ?>">

                        </div>
                        <small class="form-text text-danger"><?= form_error('pilihan4'); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="nama">Pilihan 5</label>
                        <input type="file" id="img5" name="answer_image" data-max-file-size="3MB">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="radio" name="is_true"
                                        aria-label="Radio button for following text input" value='pilihan5' <?php if ($answers[4]['is_true'] == '1') {
    echo('checked');
} ?>>
                                </div>
                            </div>
                            <input type="hidden" class="form-control" id="pilihan5_id" name="pilihan5_id"
                                value="<?= $answers[4]['answers_id']; ?>">
                            <input type="text" class="form-control" id="pilihan5" name="pilihan5"
                                value="<?= $answers[4]['text']; ?>">

                        </div>
                        <small class="form-text text-danger"><?= form_error('pilihan5'); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="nama">Waktu (Menit)</label>
                        <input type="number" class="form-control" id="waktu" name="waktu"
                            value='<?= $question['time']; ?>'>
                        <small class="form-text text-danger"><?= form_error('waktu'); ?></small>
                    </div>
                    <button class="btn btn-primary float-right" name="tambah" type="submit">Ubah</button>
                </form>
            </div>
        </div>

    </div>
</div>

<!-- CKEditor 4 -->
<script src="//cdn.ckeditor.com/4.14.0/full/ckeditor.js"></script>
<script>
    
    CKEDITOR.replace('soal', {
        customConfig: '<?= base_url('assets/js/ckeditor4/config.js') ?>'
    });
</script>

<script
    src="<?= base_url('assets/js/ckeditor5/') ?>ckeditor.js">
</script>
<script>
    let a = console.log(document.getElementById("pilihan1").value);

    // ClassicEditor
    //     .create(document.querySelector('#soal'), {
    //         toolbar: ['undo', 'redo', '|', 'bold', 'italic', 'underline', '|', 'subscript', 'superscript', '|',
    //             'fontcolor', 'fontfamily', 'fontsize', '|', 'bulletedList', 'numberedList', 'blockQuote'
    //         ]
    //     })
    //     .catch(error => {
    //         console.log(error);
    //     });

    createEditor();

    function createEditor() {
        let id = 'pilihan'

        for (let index = 0; index < 5; index++) {
            const currentId = id + (index + 1);
            const input = document.getElementById(currentId)
            // ClassicEditor
            //     .create(document.querySelector('#' + currentId), {
            //         toolbar: ['undo', 'redo', '|', 'bold', 'italic', 'underline', '|', 'subscript', 'superscript']
            //     })
            //     .then(editor => {
            //         editor.data.set(input.value);
            //         editor.model.document.on('change:data', () => {
            //             input.value = editor.getData();
            //         });
            //     })
            //     .catch(error => {
            //         console.log(error);
            //     });
            const editor = CKEDITOR.replace(currentId, {
                customConfig: '<?= base_url('assets/js/ckeditor4/config.js') ?>',
                height: 70
            });
            editor.setData(input.value);
            editor.on( 'change', function( evt ) {
                // getData() returns CKEditor's HTML content.
                input.value = evt.editor.getData();
                console.log( 'Total bytes: ' + evt.editor.getData() );
            });
        }
    }
</script>

<!-- Get FilePond JavaScript and its plugins from the CDN -->
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-crop/dist/filepond-plugin-image-crop.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.js">
</script>
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.js"></script>


<script>
    FilePond.registerPlugin(
        FilePondPluginImagePreview,
        FilePondPluginImageExifOrientation,
        FilePondPluginFileValidateSize,
        FilePondPluginFileValidateType
    );


    const image = ['<?= $answers[0]['image'] ?>',
        '<?= $answers[1]['image'] ?>',
        '<?= $answers[2]['image'] ?>',
        '<?= $answers[3]['image'] ?>',
        '<?= $answers[4]['image'] ?>'
    ];
    for (let index = 1; index <= 5; index++) {
        const currentId = 'img' + index;
        const currentAnswerId = document.getElementById('pilihan' + index + '_id').value;
        file = null;

        if (image[index - 1] != '') {
            file = [{
                source: '<?= base_url('assets/img/answers/') ?>' + currentAnswerId + '/' + image[index - 1],
                options: {
                    type: 'local',
                }
            }]
        }
        const inputElement = document.getElementById(currentId);
        const pond = FilePond.create(inputElement, {
            acceptedFileTypes: [
                'image/*'
            ],
            server: {
                load: (source, load, error, progress, abort, headers) => {
                    console.log('attempting to load', source);
                    if (image != '') {
                        fetch(source).then(res => {
                            console.log(res)
                            return res.blob()
                        }).then(load)
                    } else {
                        abort();
                    }
                }
            },
            forceRevert: true,
            labelIdle: '<span class="filepond--label-action"> Ungggah Gambar </span>',
            files: file
        });
        pond.setOptions({

            // maximum allowed file size
            maxFileSize: '5MB',

            // resize the image
            imageResizeTargetWidth: 200,

            // upload to this server end point
            server: {
                url: '<?= base_url() ?>',
                process: {
                    url: './admin/uploadoptionimage/' + currentAnswerId,
                    method: 'POST',
                    withCredentials: false,
                    headers: {},
                    timeout: 7000,
                    onload: (response) => {
                        console.log(response);
                    },
                    onerror: null,
                    ondata: null
                },
                onload: (response) => {
                    console.log(response);
                    return response;
                },
                revert: (uniqueFileId, load, error) => {

                    // Should remove the earlier created temp file here
                    // ...
                    // console.log("revert");
                    let xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            console.log(this.responseText);
                            load();
                        }
                    };
                    xhttp.open("GET",
                        "<?= base_url('admin/deleteOptionImage/') ?>" +
                        currentAnswerId,
                        true);
                    xhttp.send();

                    
                    return {
                        abort: () => {
                            xhttp.abort();
                            abort();
                        }
                    };


                },
                remove: (source, load, error) => {

                    // Should somehow send `source` to server so server can remove the file with this source
                    console.log("Remove");

                    let xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            console.log(this.responseText);
                            // Should call the load method when done, no parameters required
                            load();
                        }
                    };
                    xhttp.open("GET",
                        "<?= base_url('admin/deleteOptionImage/') ?>" +
                        currentAnswerId,
                        true);
                    xhttp.send();

                    // Can call the error method if something is wrong, should exit after
                    error('oh my goodness');

                    
                    return {
                        abort: () => {
                            xhttp.abort();
                            abort();
                        }
                    };
                }
            }
        });
    }


    // Register plugins
</script>