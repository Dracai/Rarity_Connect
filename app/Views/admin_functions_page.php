<section class="forum-section">
    <div class='container'>
        <?php if (session()->get('deletedUser')): ?>
            <div class="alert alert-danger" role="alert" style="margin-top: 1em; text-align: center;">
                <?= session()->get('deletedUser')?>
            </div>
        <?php endif; ?>
        <?php if (session()->get('deletedMod')): ?>
            <div class="alert alert-warning" role="alert" style="margin-top: 1em; text-align: center;">
                <?= session()->get('deletedMod')?>
            </div>
        <?php endif; ?>
    <h3 style="margin-top: 1em;">Users :</h3>
    <form action="<?php echo base_url();?>/viewUsers" method = "post" style="margin-top: 2em; ">
        <label for="searchID">Search by User :</label>
            <input type="text" name ="searchID" id="searchID"/>
        <input type="submit" value="Search"/>
    </form>
    <?php if($results): ?>
    <table class="table table-hover" style="margin-top: 3em;">
        <thead>
            <tr>
            <th scope="col">User ID</th>
            <th scope="col">First Name</th>
            <th scope="col">LastName</th>
            <th scope="col">Email</th>
            <th scope="col">Time Updated</th>
            </tr>
        </thead>
        <tbody>
                <tr class="table-default">
                <th scope="row"><?= $results->{'idUser'}?></th>
                <td><?= $results->{'firstName'} ?></td>
                <td><?= $results->{'lastName'} ?></td>
                <td><?= $results->{'email'} ?></td>
                <td><?= $results->{'updated_at'} ?></td>
                <td>
                <a href="<?php echo site_url('Administrator/delUser/'.$results->{'idUser'});?>" 
                onclick="return confirm('Do you want to delete this User?');">
                    <button id="button_delete">Delete</button>
                </a>
            </td>
                </tr>
        </tbody>
    </table>
    <?php endif; ?>
    
    
    <?php if($users): ?>
    <table class="table table-striped table-hover" style="margin-top: 3em;">
        <thead>
            <tr>
            <th scope="col">User ID</th>
            <th scope="col">First Name</th>
            <th scope="col">LastName</th>
            <th scope="col">Email</th>
            <th scope="col">Time Updated</th>
            <th scope="col"></th>
            <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $allUsers): ?>
            <tr class="table-default">
            <th scope="row"><?= $allUsers['idUser'] ?></th>
            <td><?= $allUsers['firstName'] ?></td>
            <td><?= $allUsers['lastName'] ?></td>
            <td><?= $allUsers['email'] ?></td>
            <td><?= $allUsers['updated_at'] ?></td>
            <td>
                <a href="<?php echo site_url('Administrator/delUser/'.$allUsers['idUser']);?>" 
                onclick="return confirm('Do you want to delete this User?');">
                    <button id="button_delete">Delete</button>
                </a>
            </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <h3 style="text-align: center;">There is no users !</h3>
        </tbody>
    </table>
    <?php endif; ?>
    </div>
</section>