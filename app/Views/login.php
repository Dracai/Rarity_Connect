<div class="container">
    <div class="row">
        <div class="col-12 col-sm8 offest-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white form-wrapper">
            <div class="container">
                <h3>Login</h3>
                <hr>
                <?php if (session()->get('success')): ?>
                    <div class="alert alert-success" role="alert">
                        <?= session()->get('success')?>
                    </div>
                <?php elseif (session()->get('failed')):?>
                    <div class="alert alert-danger" role="alert">
                        <?= session()->get('failed')?>
                    </div>
                <?php endif; ?>
                <?php if (session()->get('banned')): ?>
                    <div class="alert alert-warning" role="alert">
                        <?= session()->get('banned')?>
                    </div>
                <?php endif; ?>
                <form class="" action="<?php echo base_url();?>/login" method="post">
                    <div class="form-group">
                      <label for="email">Email:</label>
                      <input type="text" class="form-control" name="email" id="email" value="<?= set_value('email')?>">
                    </div>
                    <div class="form-group">
                      <label for="passwordHash">Password:</label>
                      <input type="password" class="form-control" name="passwordHash" id="passwordHash">
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                        <div class="col-12 col-sm-8 text-right">
                            <a href="<?php echo base_url();?>/register">Don't have an account yet?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
