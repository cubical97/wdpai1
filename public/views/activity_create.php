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
            <button class="activity-block">project 1</button>
            <button class="activity-block">project 2</button>
            <button class="activity-block">project 3</button>
        </section>
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
                        <select class="create-activity" name="type" id="a-type">
                            <?php
                            if(isset($activity_types))
                            foreach ($activity_types as $activity_type): ?>
                                <option value=<?= $activity_type; ?>><?= $activity_type; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label>name</label>
                        <input class="create-activity" name="name" type="text" placeholder="-name-">
                    </div>
                    <div>
                        <label>start time</label>
                        <div>
                            <input class="create-activity" name="time1h" type="text" placeholder="hh">
                            <input class="create-activity" name="time1m" type="text" placeholder="mm">
                        </div>
                    </div>
                    <div>
                        <label>end time</label>
                        <div>
                            <input class="create-activity" name="time2h" type="text" placeholder="hh">
                            <input class="create-activity" name="time2m" type="text" placeholder="mm">
                        </div>
                    </div>
                    <div>
                        <label>date "12.05.2099"</label>
                        <div>
                            <input class="create-activity" name="date1" type="text" placeholder="DD">
                            <input class="create-activity" name="date2" type="text" placeholder="MM">
                            <input class="create-activity" name="date3" type="text" placeholder="YYYY">
                        </div>
                    </div>
                    <div>
                        <label>max members "8"</label>
                        <input class="create-activity" name="maxmembers" type="text" placeholder="-max_members-">
                    </div>
                    <div>
                        <label>location</label>
                        <div>
                            <input class="create-activity" name="location_nr" type="text" placeholder="nr">
                            <input class="create-activity" name="location_street" type="text" placeholder="Street">
                            <input class="create-activity" name="location_city" type="text" placeholder="City">
                        </div>
                    </div>
                    <div>
                        <label>description</label>
                        <textarea class="create-activity" name="description" cols="40" rows="10" placeholder="-description-"></textarea>
                    </div>
                    <button class="menubutton"><i class="fas fa-plus"></i>CREATE</button>
                </div>
            </form>
        </div>
    </main>

<?php include('footer.php') ?>