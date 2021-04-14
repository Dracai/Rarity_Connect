
  <div class='container'>
    <?php if (session()->get('posted')): ?>
        <div class="alert alert-success" role="alert">
            <?= session()->get('posted')?>
        </div>
    <?php endif; ?>

    <p class="lead" style="margin-top: 1em;">
      <a class="btn btn-primary btn-lg" href="createPost" role="button" style="border-radius: 4px;">Create Post</a>
    </p>
  </div>

<div class="container">
<?php if ($news): ?>
  <table class="table table-hover">
    <thead>
      <tr>
        <th scope="col"></th>
        <th scope="col">All Posts</th>
        <th scope="col">Posted</th>
        <th scope="col">User</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach($news as $newsItem): ?>
      <tr class="table-light">
        <th scope="row"></th>
        <td style="width: 70%; font-size: 1.3em;"><a href="<?php echo base_url();?>/forum/<?= $newsItem['postID']?>"><?= $newsItem['title']?></a></td>
        <td style="font-size: 1.15em;"><?= date('M d Y', strtotime($newsItem['publishedAT']))?></td>
        <td style="font-size: 1.15em;"><?= $newsItem['authorName']?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php else: ?>
    <p class="text-center">No post have been found</p>
    <?php endif; ?>
</div>


