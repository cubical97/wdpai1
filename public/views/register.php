<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <title>REGISTER PAGE</title>
</head>
<body>
    <div class="container-register">
        <div class="logo">
            <img src="public/img/logo.svg">
        </div>
        <label>Create an Account</label>
        <div class="message">
            <?php if(isset($messages)) {
                foreach ($messages as $message) {
                    echo $message;
                }
            }
            ?>
        </div>

        <form class="container-register" action="register" method="POST">
            <div class="login-regiter-container">
                <input class="register" name="name" type="text" placeholder="name">
                <input class="register" name="surname" type="text" placeholder="surname">
                <input class="register" name="email" type="text" placeholder="email@mail.com">
                <input class="register" name="password1" type="password" placeholder="password">
                <input class="register" name="password2" type="password" placeholder="password">
            </div>
            <button>REGISTER</button>
        </form>
    </div>
</body>