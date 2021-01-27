<!DOCTYPE html>

<?php include('header1.php'); ?>

<label>
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
                        <div>
                            <i class="<?= $activity->getIcon() ?>"></i>
                            <h2><?= $activity->getTitle(); ?></h2>
                        </div>
                        <h2><?= $activity->getStartTime(); ?></h2>
                    </div>
                <?php endforeach; ?>

        </section>

        <h2><i class="fas fa-plus"></i>CREATE ACTIVITY</h2>

        <div class="content">
            <form action="add_activity" method="POST">
                <div class="content_section">
                    <div class="message">
                        <?php
                        if(isset($messages)){
                            foreach($messages as $message) {
                                echo $message;
                            }
                        }
                        ?>
                    </div>
                    <div>
                        <label>type</label>
                        <div>
                            <select name="type" id="a-type">
                            <?php
                            if(isset($activity_types))
                            foreach ($activity_types as $activity_type): ?>
                                <option value=<?= $activity_type; ?>><?= $activity_type; ?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label>name</label>
                        <input name="name" type="text" placeholder="-name-">
                    </div>
                    <div>
                        <label>start time</label>
                        <div>
                            <input name="time1h" type="text" placeholder="hh">
                            <input name="time1m" type="text" placeholder="mm">
                        </div>
                    </div>
                    <div>
                        <label>end time</label>
                        <div>
                            <input name="time2h" type="text" placeholder="hh">
                            <input name="time2m" type="text" placeholder="mm">
                        </div>
                    </div>
                    <div>
                        <label>date "12.05.2099"</label>
                        <div>
                            <input name="date1" type="text" placeholder="DD">
                            <input name="date2" type="text" placeholder="MM">
                            <input name="date3" type="text" placeholder="YYYY">
                        </div>
                    </div>
                    <div>
                        <label>location</label>
                        <div>
                            <input name="location_nr" type="text" placeholder="nr">
                            <input name="location_street" type="text" placeholder="Street">
                            <input name="location_city" type="text" placeholder="City">
                        </div>
                    </div>
                    <div>
                        <label>description</label>
                        <textarea name="description" cols="40" rows="10" placeholder="-description-"></textarea>
                    </div>
                    <button class="menubutton"><i class="fas fa-plus"></i>CREATE</button>
                </div>
            </form>
        </div>
    </main>

<?php include('footer.php') ?>