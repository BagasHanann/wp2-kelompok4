<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-3 text-gray-800"><?= $title; ?></h1>

<div class="row">
    <div class="col">
        <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message');?>"></div>
        
        <div class="flash" data-flash="<?= empty($mhs)?>"></div>                    
        
        <a href="" class="btn btn-primary"  data-toggle="modal" data-target="#newMhs">Add Data Mahasiswa</a>
            <div class="row d-flex justify-content-end">
                <div class="col-md-4">
                    <form action="" method="post">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Search" name="keyword">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit" name="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">No</th>
                    <th scope="col">NIM</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Jurusan</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">No Telp</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php foreach($mhs as  $m) : ?>
                    <tr>
                    <th scope="row"><?= ++$start; ?></th>
                    <td><?= $m['nim']; ?></td>
                    <td><?= $m['nama']; ?></td>
                    <td><?= $m['jurusan']; ?></td>
                    <td><?= $m['alamat']; ?></td>
                    <td><?= $m['no_telp']; ?></td>
                    <td>
                        <a href="<?= base_url()?>menu/edit/<?= $m['id'];?>" class="btn btn-success">Edit</a>
                        <a href="<?= base_url()?>menu/detail/<?= $m['id']; ?>" class="btn btn-primary">Detail</a>
                        <a href="<?= base_url()?>menu/delete/<?= $m['id']; ?>" class="btn btn-danger tombol-hapus">Delete</a>
                    </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <?= $this->pagination->create_links(); ?>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="newMhs" tabindex="-1" role="dialog" aria-labelledby="newMhsLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="newMhsLabel">Add New Data Mahasiswa</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<form action="<?= base_url('menu/mhs'); ?>" method="post">
<div class="modal-body">
<div class="form-group">
    <input type="text" class="form-control" id="nim" name="nim" placeholder="Nomer Induk Mahasiswa">
    <small class="form-text text-danger"><?= form_error('nim');?></small>
</div>
<div class="form-group">
    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Mahasiswa">
    <small class="form-text text-danger"><?= form_error('nama');?></small>
</div>
<div class="form-group">
    <select name="jurusan" id="jurusan" class="form-control">
        <option value="">--Jurusan--</option>
        <option value="Sistem Informasi">Sistem Informasi</option>
        <option value="Teknik Informatika">Teknik Informatika</option>
        <option value="Ilmu Komunikasi">Ilmu Komunikasi</option>
        <option value="Sastra Inggris">Sastra Inggris</option>
        <option value="Manajemen">Manajemen</option>
        <option value="Akuntansi">Akuntansi</option>
    </select>
</div>
<div class="form-group">
<input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat">
<small class="form-text text-danger"><?= form_error('alamat');?></small>
</div>
<div class="form-group">
    <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="No Telpon">
    <small class="form-text text-danger"><?= form_error('no_telp');?></small>
</div>
<div class="form-group">
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary">Add</button>
</div>
</form>
</div>
</div>
</div>