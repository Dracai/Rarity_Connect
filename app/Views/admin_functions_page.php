<section class="forum-section">
    <div class='container'>
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
        <?php if($users): ?>
            <?php foreach ($users as $allUsers): ?>
            <tr class="table-default">
            <th scope="row"><?= $allUsers['idUser'] ?></th>
            <td><?= $allUsers['firstName'] ?></td>
            <td><?= $allUsers['lastName'] ?></td>
            <td><?= $allUsers['email'] ?></td>
            <td><?= $allUsers['updated_at'] ?></td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
        

            
    </div>
</section>