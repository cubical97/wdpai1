<!DOCTYPE html>

<?php include('header1.php'); ?>

<label class="username">
    <?php
    if(isset($user_name)) echo $user_name;
    else echo 'Na'.$_SESSION['userid'];
    ?>
</label>

<?php include('header2.php'); ?>

    <main>
        <section class="activities_list">

            <?php
            if(isset($activities_assigned))
                foreach ($activities_assigned as $activity): ?>
                    <a id="activ-1" class="activity-block">
                        <div class="avtiv1">
                            <i class="<?= $activity->getIcon() ?>"></i>
                            <h2><?= $activity->getTitle(); ?></h2>
                        </div>
                        <h2><?= $activity->getStartTime(); ?></h2>
                    </a>
                <?php endforeach; ?>

        </section>
        <div class="content">
            <div class="content_section">
                <div class="message">
                    <?php if(isset($messages)) {
                        foreach ($messages as $message) {
                            echo $message;
                        }
                    }
                    ?>
                </div>
            </div>
            <form action="options_update_info" method="POST">
                <div class="content_section">
                    <div>
                        <label>name</label>
                        <input class="create-activity" name="name" type="text" placeholder="Name">
                    </div>
                    <div>
                        <label>surname</label>
                        <input class="create-activity" name="surname" type="text" placeholder="Surname">
                    </div>
                    <button class="menubutton"><i class="fas fa-wrench"></i>UPDATE</button>
                </div>
            </form>
            <form action="options_update_password" method="POST">
                <div class="content_section">
                    <div>
                        <label>old password</label>
                        <input class="create-activity" name="password1" type="password" placeholder="***">
                    </div>
                    <div>
                        <label>new password</label>
                        <input class="create-activity" name="password2" type="password" placeholder="***">
                    </div>
                    <div>
                        <label>new password</label>
                        <input class="create-activity" name="password3" type="password" placeholder="***">
                    </div>
                    <button class="menubutton"><i class="fas fa-wrench"></i>CHANGE PASSWORD</button>
                </div>
            </form>
        </div>
    </main>

<?php include('footer.php') ?>