<section>
    <div class="container">
        <div class="card border-primary mb-3" style="max-width: 100%; margin-top: 1em;">
            <div class="card-header col-sm-12 d-flex justify-content-between">
                <h4 class="card-title" style='font-size: 2em;'><?= $post['title'] ?></h4>
                <p>Posted on: <?= date('M d Y', strtotime($post['publishedAT']))?></p>
            </div>
                <div class="card-body">
                    <p class="card-text" style="font-size: 1.3em;"><?= $post['content']?></p>
                </div>
            </div>
        </div>
    </div>
</section>