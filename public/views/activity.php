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
                    <div id="<?= $activity->getIdA(); ?>" class="activity-block">
                        <div class="avtiv1">
                            <i class="<?= $activity->getIcon() ?>"></i>
                            <h2><?= $activity->getTitle(); ?></h2>
                        </div>
                        <h2><?= $activity->getStartTime(); ?></h2>
                    </div>
                <?php endforeach; ?>

        </section>

        <h2><i class="fas fa-cubes"></i>ACTIVITY</h2>

        <div class="content">

            <div class="activ_header">
                <h2>no member</h2>
                <a id="activ-1" class="menubutton">JOIN</a>
                <a id="activ-1" class="menubutton">LEFT</a>
                <a id="activ-1" class="menubutton">DELETE</a>
            </div>

            <div class="activ_info">
                <div class="activ_header">
                    <i class="fas fa-cog"></i>
                    <h1>gym</h1>
                </div>
                <h2>Title</h2>
                <div>description description description description description </div>
                <div>
                    <h2>Start time:</h2>
                    <h2>2021-01-01 12:13:14</h2>
                </div>
                <div>
                    <h2>End time:</h2>
                    <h2>2021-01-01 12:13:14</h2>
                </div>
                <div>
                    <h2>Place:</h2>
                    <h2>number Street City</h2>
                </div>

            </div>


            </div>

        </div>
    </main>

<?php include('footer.php') ?>