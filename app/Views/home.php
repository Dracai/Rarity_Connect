<section>
<div class="jumbotron">
      <div class='container'>
      <?php if (session()->get('success')): ?>
        <div class="alert alert-success" role="alert">
          <?= session()->get('success')?>
        </div>
      <?php endif; ?>
      
    <h1 class="display-4">Rarity Connect</h1>
    <p class="lead">Here you can connect with people all around the globe.</p>
    <hr class="my-4">
    <p>I hope you have a great day !</p>
    <p class="lead">
      <a class="btn btn-primary btn-lg" href="/register" role="button">Register</a>
    </p>
  </div>
</div>
</section>