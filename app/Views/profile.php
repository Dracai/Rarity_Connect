<div class="jumbotron">
    <div class="container">
            <h3><?= $user['firstName'].' '.$user['lastName']?></h3>
    </div>
</div>

<div class="container">  
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col"></th>
            <th scope="col">Your Posts</th>
            <th scope="col">Posted</th>
        </tr>
        </thead>
        <?php if ($userPosts): ?>
        <tbody>
        <?php foreach($userPosts as $posts): ?>
        <tr class="table-light">
            <th scope="row"></th>
            <td style="width: 70%; font-size: 1.3em;"><a href="<?php echo base_url();?>/forum/<?= $posts['postID']?>"><?= $posts['title']?></a></td>
            <td style="font-size: 1.15em;"><?= date('M d Y', strtotime($posts['publishedAT']))?></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
        <p class="text-center">You have not posted anything yet</p>
    <?php endif; ?> 
<div class="col-12 col-sm8- offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper">
    <h4>Change Password:</h4>
    <form class="" action="/profile" method="post">
          <div class="row">
            <div class="col-12 col-sm-6">
              <div class="form-group">
               <label for="password">Password</label>
               <input type="password" class="form-control" name="password" id="password" value="">
             </div>
           </div>
           <div class="col-12 col-sm-6">
             <div class="form-group">
              <label for="password_confirm">Confirm Password</label>
              <input type="password" class="form-control" name="password_confirm" id="password_confirm" value="">
            </div>
          </div>
          <?php if (isset($validation)): ?>
            <div class="col-12">
              <div class="alert alert-danger" role="alert">
                <?= $validation->listErrors() ?>
              </div>
            </div>
          <?php endif; ?>
          </div><!-- row -->

          <div class="row">
            <div class="col-12 col-sm-4">
              <button type="submit" class="btn btn-primary" style="border-radius: 4px;">Update</button>
            </div>

          </div>
    </form>
</div>
</div>