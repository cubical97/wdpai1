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

    <h2><i class="fas fa-search"></i>HOME</h2>

    <div class="content">
        <form action="home_find" method="POST">
            <header>
                <div class="search-bar">
                    <input name="find" type="text" placeholder="find activity">
                </div>
                <select class="action-type" name="type" id="a-type">

                <?php
                if(isset($activity_types))
                    foreach ($activity_types as $activity_type): ?>
                        <option value=<?= $activity_type; ?>><?= $activity_type; ?></option>
                <?php endforeach; ?>

                </select>
                <button class="find">
                    <i class="fas fa-search"></i>
                </button>
            </header>
        </form>
        <section class="activities">

            <?php
            if(isset($activities_find))
                foreach ($activities_find as $activity): ?>
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
