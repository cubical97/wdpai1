<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/homestyle.css">
    <script src="https://kit.fontawesome.com/e9889f5f85.js" crossorigin="anonymous"></script>
    <title>ADD ACTIVITY PAGE</title>
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
            <form action="add_activity" method="POST">
                <div class="content_section">
                    <div class="message">
                        <?php if(isset($messages)) {
                            foreach ($messages as $message) {
                                echo $message;
                            }
                        }
                        ?>
                    </div>
                    <div>
                        <label>type</label>
                        <select class="create-activity" name="type" id="a-type">
                            <option value="cycling">cycling</option>
                            <option value="jogging">jogging</option>
                            <option value="gym">gym</option>
                            <option value="swimming">swimming</option>
                            <option value="yoga">yoga</option>
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
</div>
</body>