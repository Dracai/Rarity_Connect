<div class="jumbotron">
    <div class="container">
            <h3><?= $user['firstName'].' '.$user['lastName']?></h3>
    </div>
</div>

<div class="container">
  <?php if (session()->get('success')): ?>
    <div class="alert alert-success" role="alert" style="text-align: center;">
      <?= session()->get('success')?>
    </div>
  <?php elseif (session()->get('failed')):?>
    <div class="alert alert-danger" role="alert" style="text-align: center;">
      <?= session()->get('failed')?>
    </div>
  <?php endif; ?>

  <?php if (session()->get('deletedOwnPost')): ?>
    <div class="alert alert-warning" role="alert" style="text-align: center;">
      <?= session()->get('deletedOwnPost')?>
    </div>
  <?php endif; ?>

  <h3 style="text-align: center; margin-bottom: 0.5em;">Your Posts</h3>
  <?php if ($userPosts): ?>
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col"></th>
            <th scope="col">Title</th>
            <th scope="col">Posted</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($userPosts as $posts): ?>
        <tr class="table-light">
            <th scope="row"></th>
            <td style="width: 70%; font-size: 1.3em;"><a href="<?php echo base_url();?>/forum/<?= $posts['postID']?>"><?= $posts['title']?></a></td>
            <td style="font-size: 1.15em;"><?= date('M d Y', strtotime($posts['publishedAT']))?></td>
            <td>
                <a href="<?php echo site_url('Users/deleteOwnPost/'.$posts['postID']);?>" 
                onclick="return confirm('Do you want to delete this Post?');">
                    <button id="button_delete">Delete</button>
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
  <?php else: ?>
        <p class="text-center">You have not posted anything yet</p>
  <?php endif; ?> 
</div>
<div class="container">
<hr style="margin-top: 2em;">
<div class="col-12 col-sm8- offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper">
    <h4>Change Password:</h4>
    <form class="" action="<?php echo base_url();?>/profile" method="post">
          <div class="row">
            <div class="col-12 col-sm-6">
              <div class="form-group">
               <label for="oldPassword">Old Password: </label>
               <input type="password" class="form-control" name="oldPassword" id="oldPassword" value="">
             </div>
           </div>
           <div class="col-12 col-sm-6">
             <div class="form-group">
              <label for="newPassword">New Password: </label>
              <input type="password" class="form-control" name="newPassword" id="newPassword" value="">
            </div>
          </div>
          <?php if (isset($validation)): ?>
            <div class="col-12">
              <div class="alert alert-danger" role="alert">
                <?= $validation->listErrors() ?>
              </div>
            </div>
          <?php endif; ?>
          </div>

          <div class="row">
            <div class="col-12 col-sm-4">
              <button type="submit" class="btn btn-primary" style="border-radius: 4px;">Update</button>
            </div>

          </div>
    </form>
</div>
</div>