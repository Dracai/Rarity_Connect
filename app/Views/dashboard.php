<div class="jumbotron">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="display-4">Welcome, <?= session()->get('firstName')?></h1>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-3 g-4" style="text-align: center; margin-top: 2em;" >
            <div class="col-3">
                <button type="button" class="btn btn-secondary">Under Construction</button>
            </div>
            <div class="col-3">
                <button type="button" class="btn btn-secondary">Under Construction</button>
            </div>
            <div class="col-3">
                <button type="button" class="btn btn-secondary">Under Construction</button>
            </div>
        </div>
    </div>
</div>

<div class="container">
<?php if ($newest): ?>
  <table class="table table-hover">
    <thead>
      <tr>
        <th scope="col"></th>
        <th scope="col">Newest Posts</th>
        <th scope="col">Posted</th>
        <th scope="col">User</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach($newest as $newsItem): ?>
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
