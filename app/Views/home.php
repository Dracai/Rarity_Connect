<section>
  <div class="jumbotron" style="background-color: #efeff5;">
    <div class='container'>
      <?php if (session()->get('success')): ?>
        <div class="alert alert-success" role="alert">
          <?= session()->get('success')?>
        </div>
      <?php endif; ?>
      
    <h1 class="display-4">Rarity Connect</h1>
    <p class="lead">Here you can connect with people all around the globe.</p>
    <hr class="my-4">
    <p>I hope you join the community of great people !</p>
    <p class="lead">
      <a class="btn btn-primary btn-lg" href="<?php echo base_url();?>/register" role="button" style="border-radius: 4px;">Register</a>
    </p>
      </div>
  </div>
</div>  
</section>