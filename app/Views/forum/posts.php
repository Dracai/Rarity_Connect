<section>
    <div class="container">

    <?php if (session()->get('deletedComment')): ?>
            <div class="alert alert-danger" role="alert" style="margin-top: 1em; text-align: center;">
                <?= session()->get('deletedComment')?>
            </div>
    <?php endif; ?>

        <div class="card border-primary mb-3" style="max-width: 100%; margin-top: 1em;">
            <div class="card-header col-sm-12 d-flex justify-content-between">
                <p><span style="font-size: 2em;"><?= $post['title']?></span><span>&nbsp; | Author: <?= $post['authorName']?></span></p>
                <p>Posted on: <?= date('M d Y', strtotime($post['publishedAT']))?></p>
            </div>
                <div class="card-body">
                    <p class="card-text" style="font-size: 1.3em;"><?= $post['content']?></p>
                </div>
            
        </div>

        <h2 style="margin-top: 1.5em;">Comments:</h2>
        <?php if ($comment): ?>
            <?php foreach($comment as $item): ?>
                <div class="col">
                    <div class="card" style="margin-bottom: 1em;">
                    <div class="card-body">
                        <h5 class="card-header col-sm-12 d-flex justify-content-between"><?= $item['authorName']?>
                        <p>Posted on: <?= date('M d Y', strtotime($item['publishedAT']))?></p>
                        <?php if(session()->get('isLoggedInAdmin')):?>
                        <a href="<?php echo site_url('Administrator/deleteComment/'.$item['commentID']);?>" 
                            onclick="return confirm('Do you want to delete this User?');">
                                <button id="button_delete" type="button" class="btn btn-primary" style="border-radius: 4px;">Delete</button>
                        </a>
                        <?php endif; ?>
                        </h5>
                        <p class="card-text" style="margin-top: 1em;">
                            <?= $item['content']?>
                        </p>
                    </div>
                    </div>
                </div>
        <?php endforeach; ?>

        <?php else: ?>
            <p class="text-center">No comments have been found !</p>
            <?php endif; ?>

        <hr class="my-4">

        <div class="col-12 col-sm8 offest-sm-2 col-md-6 offset-md-3 pt-3 pb-3 bg-white form-wrapper">
            <form class="" action="<?php echo base_url();?>/forum/<?= $post['postID']?>" method="post">
                <div class="form-group">
                    <label for="comment"><strong>Comment :</strong></label>
                    <textarea class="form-control" name="comment" id="comment" value="" style="border-radius: 4px;"></textarea>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary" style="border-radius:4px;">Create</button>
                </div>
            </form>
        </div>
    </div>
</section>