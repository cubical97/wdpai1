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
            no content yet
        </div>
    </main>

<?php include('footer.php') ?>