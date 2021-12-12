<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-3 text-gray-800"><?= $title; ?></h1>

<div class="row">
    <div class="col">

        <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message');?>"></div> 

            <a href="" class="btn btn-primary mb-3"  data-toggle="modal" data-target="#newSubMenu">Add New Sub Menu</a>
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">No</th>
                    <th scope="col">Title</th>
                    <th scope="col">Menu</th>
                    <th scope="col">Url</th>
                    <th scope="col">Icon</th>
                    <th scope="col">Active</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach($subMenu as  $sm) : ?>
                    <tr>
                    <th scope="row"><?= $i; ?></th>
                    <td><?= $sm['title']; ?></td>
                    <td><?= $sm['menu']; ?></td>
                    <td><?= $sm['url']; ?></td>
                    <td><?= $sm['icon']; ?></td>
                    <td><?= $sm['is_active']; ?></td>
                    <td>
                        <a href="<?= base_url()?>menu/editSubmenu/<?= $sm['id']; ?>" class="btn btn-success">Edit</a>
                        <a href="<?= base_url()?>menu/hapusSubMenu/<?= $sm['id']; ?>" class="btn btn-danger tombol-hapus">Delete</a>
                    </td>
                    </tr>
                    <?php $i++; ?>
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
<div class="modal fade" id="newSubMenu" tabindex="-1" role="dialog" aria-labelledby="newSubMenuLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="newSubMenuLabel">Add New Sub Menu</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<form action="<?= base_url('menu/submenu'); ?>" method="post">
<div class="modal-body">
<div class="form-group">
<input type="text" class="form-control" id="title" name="title" placeholder="Sub Menu Title">
<small class="form-text text-danger"><?= form_error('title');?></small>
</div>
<div class="form-group">
    <select name="menu_id" id="menu_id" class="form-control">
        <option value="">Select Menu</option>
        <?php foreach ($menu as $m): ?>
            <option value="<?= $m['id'];?>"><?= $m['menu']; ?></option>
            <?php endforeach; ?> 
    </select>
</div>
<div class="form-group">
<input type="text" class="form-control" id="url" name="url" placeholder="Url">
<small class="form-text text-danger"><?= form_error('url');?></small>
</div>
<div class="form-group">
    <input type="text" class="form-control" id="icon" name="icon" placeholder="Icon">
    <small class="form-text text-danger"><?= form_error('icon');?></small>
</div>
<div class="form-group">
<div class="form-check">
    <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
    <label class="form-check-label" for="is_active">
        Active?
    </label>
</div>
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
