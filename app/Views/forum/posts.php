<section>
    <div class="container">
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
        <div class="card border-secondary mb-3" style="max-width: 100%; margin-top: 1em;">
            <div class="card-header col-sm-12 d-flex justify-content-between">
            <p><span style="font-size: 2em;"><?= $item['authorName']?></span>
            <p>Posted on: <?= date('M d Y', strtotime($item['publishedAT']))?></p>
            </div>
                <div class="card-body">
                    <p class="card-text" style="font-size: 1.3em;"><?= $item['content']?></p>
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