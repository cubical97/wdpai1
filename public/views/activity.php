<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="./../public/css/homestyle.css">
    <script src="https://kit.fontawesome.com/e9889f5f85.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./../public/js/activity_manage.js" defer></script>
    <title>HOME PAGE</title>
</head>
<body>
<div class="base-container">
    <nav>
        <div class="logo">
            <img src="./../public/img/logo.svg">
        </div>

        <label>
            <?php
            if(isset($user_name)) echo $user_name;
            else echo 'Na'.$_SESSION['userid'];
            ?>
        </label>
        <div>
        <div action="home" method="GET">
            <button id="home" class="menubutton"><i class="fas fa-search"></i>HOME</button>
        </div>
        <div action="myactivities" method="GET">
            <button id="myactivities" class="menubutton"><i class="fas fa-user-edit"></i>MY ACTIVITIES</button>
        </div>
        <div action="activity_create" method="GET">
            <button id="activity_create" class="menubutton"><i class="fas fa-plus"></i>ADD ACTIVITIES</button>
        </div>
        <div action="options" method="GET">
            <button id="options" class="menubutton"><i class="fas fa-cog"></i>OPTIONS</button>
        </div>
        <div action="logout" method="GET">
            <button id="logout" class="menubutton"><i class="fas fa-sign-out-alt"></i>LOGOUT</button>
        </div>
        </div>
    </nav>

    <main>

        <h2><i class="fas fa-cubes"></i>ACTIVITY</h2>
        <div class="content">

            <?php
            if(isset($activities_assigned)): ?>
            <div id="<?= $activities_assigned->getIdA(); ?>">
                <div class="activ_header">
                    <button id="activ-join" class="menubutton">JOIN</button>
                    <button id="activ-left" class="menubutton">LEFT</button>
                </div>
                <div class="activ_info">
                    <div class="activ_header">
                        <i class="<?= $activities_assigned->getIcon() ?>"></i>
                    </div>
                    <h2><?= $activities_assigned->getTitle(); ?></h2>
                    <div><?= $activities_assigned->getDescription(); ?></div>
                    <div>
                        <h2>Start time:</h2>
                        <h2><?= $activities_assigned->getStartTime(); ?></h2>
                    </div>
                    <div>
                        <h2>End time:</h2>
                        <h2><?= $activities_assigned->getEndtime(); ?></h2>
                    </div>
                    <div>
                        <h2>Place:</h2>
                        <h2><?= $activities_assigned->getAddress(); ?></h2>
                    </div>
                </div>
            </div>
            <?php endif ?>

        </div>

    </main>

<?php include('footer.php') ?>