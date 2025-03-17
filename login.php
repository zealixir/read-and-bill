<?php
    include "upper.php";
    require "user_login.php";
    upperHTML("login", "pin-login");
?>
<body>
    <form class="login" method="post" action="">
        <h1>LOGIN</h1>
        <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
        <input type="text" placeholder="Username" name="username" required>
        <input type="password" placeholder="Password" name="password" required>
        <button type="submit">Login</button>
    </form>  
</body>
</html>