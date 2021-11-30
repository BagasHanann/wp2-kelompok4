<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

<div class="row">
    <div class="col">
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">No</th>
                    <th scope="col">Menu</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach($menu as  $m) : ?>
                    <tr>
                    <th scope="row"><?= $i; ?></th>
                    <td><?= $m['menu']; ?></td>
                    <td>
                        <a href="<?= base_url()?>menu/hapus/<?= $m['id']; ?>" class="btn btn-danger tombol-hapus">Delete</a>
                    </td>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

