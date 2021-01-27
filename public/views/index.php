<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <title>LOGIN PAGE</title>
</head>
<body>
    <div class="container-login">
        <div class="logo">
            <img src="public/img/logo.svg">
        </div>
        <div class="login-regiter-container">
            <form class="login" action="login" method="POST">

                <div class="message">
                    <?php if(isset($messages)) {
                        foreach ($messages as $message) {
                        echo $message;
                        }
                    }
                    ?>
                </div>

                <input name="email" type="text" placeholder="email@email.com">
                <input name="password" type="password" placeholder="password">
                <button type="submit">LOGIN</button>
            </form>
            <form action="register" method="GET">
                <button>REGISTER</button>
            </form>
        </div>
    </div>
</body>