<div class="mt-5 row justify-content-center">
    <div class="col-sm-8">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-center">
                    <h2><?= $questPackage['name']; ?>
                    </h2>
                </div>


                <div class="d-flex justify-content-center" style="text-align: center;">
                    <h3><?= $questPackage['judul']; ?>
                    </h3>
                </div>

                <div>
                    <?= $content['content']; ?>
                </div>
                <div class="row w-100 justify-content-center">
                    <form action="" method="post">
                        <button id="mulai" name="mulai" type="submit" class="btn btn-outline-primary">Mulai
                            Kuis</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>