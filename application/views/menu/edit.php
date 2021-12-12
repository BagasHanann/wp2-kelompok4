<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <div class="row">
        <div class="col-lg-8">
            <form action="" method="post">
            <input type="hidden" name="id" value="<?= $mhs['id']; ?>">
            <!-- Form -->
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">NIM</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="nim" name="nim" value="<?= $mhs['nim']; ?>">
                    <small class="form-text text-danger"><?= form_error('nim');?></small>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Full name</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $mhs['nama']; ?>">
                    <small class="form-text text-danger"><?= form_error('nama');?></small>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Jurusan</label>
                <div class="col-sm-7">
                        <select name="jurusan" id="jurusan" class="form-control">
                            <?php foreach ($jurusan as $j) : ?>
                                <?php if ( $j == $mhs['jurusan'] ) : ?>
                                    <option value="<?= $j;?>" selected><?= $j;?></option>
                                <?php else : ?>
                                    <option value="<?= $j;?>"><?= $j;?></option>    
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $mhs['alamat']; ?>">
                    <small class="form-text text-danger"><?= form_error('alamat');?></small>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">No Telpon</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="no_telp" name="no_telp" value="<?= $mhs['no_telp']; ?>">
                    <small class="form-text text-danger"><?= form_error('no_telp');?></small>
                </div>
            </div>

            <div class="form-group row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Edit</button>
                    <a href="<?= base_url('menu/mhs/');?>" class="btn btn-success">Back</a>
                </div>
            </div>

            </form>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
 