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

        <h2><i class="fas fa-user-edit"></i>MY ACTIVITIES</h2>

        <div class="content">
            <section class="activities">

                <?php
                if(isset($user_own_activities))
                    foreach ($user_own_activities as $activity): ?>
                        <div id="activ-1" class="activity">
                            <div class="avtiv1">
                                <i class="<?= $activity->getIcon() ?>"></i>
                                <h2><?= $activity->getTitle(); ?></h2>
                            </div>
                            <p>start time</p>
                            <h2><?= $activity->getStartTime(); ?></h2>
                            <p>end time</p>
                            <h2><?= $activity->getEndtime(); ?></h2>

                        </div>
                    <?php endforeach; ?>

            </section>
        </div>
    </main>

<?php include('footer.php') ?>