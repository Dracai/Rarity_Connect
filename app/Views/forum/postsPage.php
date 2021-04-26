
  <div class='container'>
    <?php if (session()->get('posted')): ?>
        <div class="alert alert-success" role="alert" style="margin-top: 1em; text-align: center;">
            <?= session()->get('posted')?>
        </div>
    <?php endif; ?>
    
    <?php if (session()->get('deletedPost')): ?>
        <div class="alert alert-danger" role="alert" style="margin-top: 1em; text-align: center;">
            <?= session()->get('deletedPost')?>
        </div>
    <?php endif; ?>

    <?php if (session()->get('postReported')): ?>
        <div class="alert alert-danger" role="alert" style="margin-top: 1em; text-align: center;">
            <?= session()->get('postReported')?>
        </div>
    <?php endif; ?>

    <h1 class="text-center" style="margin-top: 1em; font-weight: 600;">Forum Posts</h1>

    <p class="lead" style="margin-top: 1em;">
      <a class="btn btn-primary btn-lg" href="createPost" role="button" style="border-radius: 4px;">Create Post</a>
    </p>
  </div>

<div class="container">
<div class="float-right"><?= $pager->links() ?></div>
<?php if ($news): ?>
  <table class="table table-hover">
    <thead>
      <tr>
        <th scope="col"></th>
        <th scope="col">All Posts</th>
        <th scope="col">Posted</th>
        <th scope="col">User</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
    <?php foreach($news as $newsItem): ?>
      <tr class="table-light">
        <th scope="row"></th>
        <td style="width: 70%; font-size: 1.3em;"><a href="<?php echo base_url();?>/forum/<?= $newsItem['postID']?>"><?= $newsItem['title']?></a></td>
        <td style="font-size: 1.15em;"><?= date('M d Y', strtotime($newsItem['publishedAT']))?></td>
        <td style="font-size: 1.15em;"><?= $newsItem['authorName']?></td>
        <?php if(session()->get('isLoggedInAdmin')): ?>
        <td>
          <a href="<?php echo site_url('Administrator/delPost/'.$newsItem['postID']);?>" 
              onclick="return confirm('Do you want to delete this post?');">
                <button id="button_delete" class="btn btn-primary">Delete</button>
          </a>
        </td>
        <?php endif; ?>
        <?php if(session()->get('isLoggedInUser')): ?>
        <td>
          <a href="<?php echo site_url('Users/reportPost/'.$newsItem['postID']);?>" 
              onclick="return confirm('Do you want to report this post?');">
                <button id="button_delete" class="btn btn-primary">Report</button>
          </a>
        </td>
        <?php endif; ?>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php else: ?>
    <p class="text-center">No post have been found</p>
    <?php endif; ?>
</div>


