<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">
            <form action="" method="post">
            <input type="hidden" name="id" value="<?= $user_sub_menu['id']; ?>">
            <!-- Form -->
            <div class="form-group row">
                <label for="title" class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="title" name="title" value="<?= $user_sub_menu['title']; ?>">
                    <small class="form-text text-danger"><?= form_error('title');?></small>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Url</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="url" name="url" value="<?= $user_sub_menu['url']; ?>">
                    <small class="form-text text-danger"><?= form_error('url');?></small>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Icon</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="icon" name="icon" value="<?= $user_sub_menu['icon']; ?>">
                    <small class="form-text text-danger"><?= form_error('icon');?></small>
                </div>
            </div>

            <div class="form-group row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Edit</button>
                    <a href="<?= base_url('menu/submenu/');?>" class="btn btn-success">Back</a>
                </div>
            </div>

            </form>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content --> 
