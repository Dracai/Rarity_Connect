<div class='container'>
    <?php if (session()->get('postReported')): ?>
        <div class="alert alert-success" role="alert" style="margin-top: 1em; text-align: center;">
            <?= session()->get('postReported')?>
        </div>
    <?php endif; ?>
    <?php if (session()->get('deletedPost')): ?>
        <div class="alert alert-danger" role="alert" style="margin-top: 1em; text-align: center;">
            <?= session()->get('deletedPost')?>
        </div>
    <?php endif; ?>
</div>

<div class="container">
<h3 style="text-align: center; margin-top: 1em;">Reported Posts</h3>
<?php if ($news): ?>
  <table class="table table-hover">
    <thead>
      <tr>
        <th scope="col"></th>
        <th scope="col">All Posts</th>
        <th scope="col">Posted</th>
        <th scope="col">User</th>
        <th scope="col"></th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
    <?php foreach($news as $newsItem): ?>
      <tr class="table-light">
        <th scope="row"></th>
        <td style="width: 70%; font-size: 1.3em;"><a href="<?php echo base_url();?>/forum/<?= $newsItem['postID']?>"><?= $newsItem['title']?></a></td>
        <td style="font-size: 1.15em;"><?= date('M d Y', strtotime($newsItem['published_at']))?></td>
        <td style="font-size: 1.15em;"><?= $newsItem['authorName']?></td>
          <td>
          <a href="<?php echo site_url('Administrator/leavePost/'.$newsItem['postID']);?>" 
              onclick="return confirm('Do you want to delete this post?');">
                <button id="button_delete">Leave</button>
          </a>
        </td>
        <td>
          <a href="<?php echo site_url('Administrator/delPost/'.$newsItem['postID']);?>" 
              onclick="return confirm('Do you want to delete this post?');">
                <button id="button_delete">Delete</button>
          </a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php else: ?>
    <p class="text-center">No post have been found</p>
    <?php endif; ?>
</div>