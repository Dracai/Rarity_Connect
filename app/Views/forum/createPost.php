<div class="container" style="margin-top: 1em;">
    <h1>Create new Post</h1>
    <?php if (isset($validation)): ?>
        <div class="col-12">
            <div class="alert alert-danger" role="alert">
                <?= $validation->listErrors()?>
            </div>
        </div>
    <?php endif; ?>
    <form class="" action="<?php echo base_url();?>/forum/createPost" method="post">
        <div class="form-group">
            <label for="title"><strong>Title:</strong></label>
            <input type="text" class="form-control" name="title" id="title" value="<?= set_value('title')?>">
        </div>
        <div class="form-group">
            <label for="content"><strong>Content:</strong></label>
            <textarea class="form-control" name="content" id="content" value="<?= set_value('content')?>"></textarea>
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </form>
</div>