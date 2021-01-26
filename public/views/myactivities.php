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
            <section class="activities">
                <div id="activ-1" class="activity">
                    <div class="avtiv1">
                        <i class="fas fa-plus"></i>
                        <h2>rower</h2>
                        <h2>35 min</h2>
                    </div>
                    <div class="activ2">
                        <p>przykładowy opis</p>
                    </div>
                    <div class="activ1">
                        <div class="activ-time">
                            <h2>21 wtorek</h2>
                            <h2>11:00 - 12:00</h2>
                        </div>
                        <h2>4 uczestników</h2>
                    </div>
                </div>
                <div id="activ-2" class="activity">
                    <div class="avtiv1">
                        <i class="fas fa-plus"></i>
                        <h2>rower</h2>
                        <h2>35 min</h2>
                    </div>
                    <div class="activ2">
                        <p>przykładowy opis</p>
                    </div>
                    <div class="activ1">
                        <div class="activ-time">
                            <h2>21 wtorek</h2>
                            <h2>11:00 - 12:00</h2>
                        </div>
                        <h2>4 uczestników</h2>
                    </div>
                </div>
            </section>
        </div>
    </main>

<?php include('footer.php') ?>