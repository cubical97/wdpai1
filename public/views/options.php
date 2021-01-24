<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/homestyle.css">
    <script src="https://kit.fontawesome.com/e9889f5f85.js" crossorigin="anonymous"></script>
    <title>OPTIONS PAGE</title>
</head>
<body>
<div class="base-container">
    <nav>
        <div class="logo">
            <img src="public/img/logo.svg">
        </div>
        <label class="username">USUERNAME</label>
        <form action="home" method="GET">
            <button class="menubutton"><i class="fas fa-search"></i>HOME</button>
        </form>
        <form action="myactivities" method="GET">
            <button class="menubutton"><i class="fas fa-user-edit"></i>MY ACTIVITIES</button>
        </form>
        <form action="activity_create" method="GET">
            <button class="menubutton"><i class="fas fa-plus"></i>ADD ACTIVITIES</button>
        </form>
        <form action="options" method="GET">
            <button class="menubutton"><i class="fas fa-cog"></i>OPTIONS</button>
        </form>
        <form action="index" method="GET">
            <button class="menubutton"><i class="fas fa-sign-out-alt"></i>LOGOUT</button>
        </form>
    </nav>
    <main>
        <section class="activities_list">
            <button class="activity-block">project 1</button>
            <button class="activity-block">project 2</button>
            <button class="activity-block">project 3</button>
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
</div>
</body>