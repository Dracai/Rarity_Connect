<section class="forum-section">
    <div class='container'>
        <?php if (session()->get('deletedUser')): ?>
            <div class="alert alert-danger" role="alert" style="margin-top: 1em; text-align: center;">
                <?= session()->get('deletedUser')?>
            </div>
        <?php endif; ?>
        <?php if (session()->get('userBanned')): ?>
            <div class="alert alert-danger" role="alert" style="margin-top: 1em; text-align: center;">
                <?= session()->get('userBanned')?>
            </div>
        <?php endif; ?>
        <h1 class="text-center" style="margin-top: 1em; font-weight: 600;">Users</h1>
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
            <th scope="col"></th>
            <th scope="col"></th>
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
                <a href="<?php echo site_url('Administrator/banUser/'.$results->{'idUser'});?>" 
                onclick="return confirm('Do you want to ban this User?');">
                    <button id="button_delete" type="button" class="btn btn-primary" style="border-radius: 4px;">Ban</button>
                </a>
                </td>
                <td>
                <a href="<?php echo site_url('Administrator/delUser/'.$results->{'idUser'});?>" 
                onclick="return confirm('Do you want to delete this User?');">
                    <button id="button_delete" type="button" class="btn btn-primary" style="border-radius: 4px;">Delete</button>
                </a>
                </td>
            </tr>
        </tbody>
    </table>
    <?php endif; ?>


    <div class="float-right"><?= $pager->links() ?></div>
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
                <a href="<?php echo site_url('Administrator/banUser/'.$allUsers['idUser']);?>" 
                onclick="return confirm('Do you want to ban this User?');">
                    <button id="button_delete" type="button" class="btn btn-primary" style="border-radius: 4px;">Ban</button>
                </a>
            </td>
            <td>
                <a href="<?php echo site_url('Administrator/delUser/'.$allUsers['idUser']);?>" 
                onclick="return confirm('Do you want to delete this User?');">
                    <button id="button_delete" type="button" class="btn btn-primary" style="border-radius: 4px;">Delete</button>
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