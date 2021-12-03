<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

<!-- memunculkan pesan dari controller edit -->
<div class="row">
    <div class="col-lg-6">
        
        <!-- pesan jika diubah -->
        <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message');?>"></div>

    </div>
</div>

<div class="card mb-3" style="max-width: 540px;">
<div class="row no-gutters">
    <div class="col-md-4">
    <img src="<?= base_url('assets/img/profile/') .$user['image'] ?>" class="card-img">
    </div>
    <div class="col-md-8">
    <div class="card-header">
        <h5 class="card-text"><?= $user['name']; ?></h5>
    </div>
    <div class="card-body">
    <h6 class="card-title"><?= $user['email'];?></h6>
        <p class="card-text"><small class="text-muted">Member since <?= date('d F Y', $user['date_created']); ?></small></p>
    </div>
    </div>
</div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->