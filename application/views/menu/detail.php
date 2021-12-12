<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-3 text-gray-800"><?= $title; ?></h1>

<div class="row">
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header">
                <h4 class="card-text"><?= $mhs['nama'];?></h4>
            </div>
            <div class="card-body">
                <h5 class="card-title"><?= $mhs['nim']; ?></h5>
                <h6 class="card-text">Jurusan : <?= $mhs['jurusan']; ?></h6>
                <h6 class="card-text">Alamat : <?= $mhs['alamat']; ?></h6>
                <h6 class="card-text">No Telp : <?= $mhs['no_telp']; ?></h6>
            </div>
            <a href="<?= base_url('menu/mhs/');?>" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
