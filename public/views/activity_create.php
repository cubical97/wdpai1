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
        <form action="friends" method="GET">
            <button class="menubutton"><i class="fas fa-user-friends"></i>FRIENDS</button>
        </form>
        <form action="options" method="GET">
            <button class="menubutton"><i class="fas fa-cog"></i>OPTIONS</button>
        </form>
        <form action="login" method="GET">
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
            no content yet
        </div>
    </main>
</div>
</body>