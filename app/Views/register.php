<div class="container">
    <div class="row">
        <div class="col-12 col-sm8 offest-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white form-wrapper">
            <div class="container">
            <?php if (session()->get('banned')): ?>
                <div class="alert alert-warning" role="alert">
                    <?= session()->get('banned')?>
                </div>
            <?php endif; ?>
                <h3>Register</h3>
                <hr>
                <form class="" action="<?php echo base_url();?>/register" method="post">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                              <label for="firstName">First Name:</label>
                              <input type="text" class="form-control" name="firstName" id="firstName" value="<?= set_value('firstName')?>">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                              <label for="lastName">Last Name:</label>
                              <input type="text" class="form-control" name="lastName" id="lastName" value="<?= set_value('lastName')?>">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="text" class="form-control" name="email" id="email" value="<?= set_value('email')?>">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="passwordHash">Password:</label>
                                <input type="password" class="form-control" name="passwordHash" id="passwordHash" value="">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="passwordHash_confirm">Confirm Password:</label>
                                <input type="password" class="form-control" name="passwordHash_confirm" id="passwordHash_confirm" value="">
                            </div>
                        </div>
                        <?php if (isset($validation)): ?>
                            <div class="col-12">
                                <div class="alert alert-danger" role="alert">
                                    <?= $validation->listErrors()?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <button type="submit" class="btn btn-primary" style="border-radius:4px;">Register</button>
                        </div>
                        <div class="col-12 col-sm-8 text-right">
                            <a href="<?php echo base_url();?>/login">Already have an account?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>