<?php
    include "upper.php";
    upperHTML("login", "pin-login");
?>
<body>
    <form class="login" method="post" action="">
        <h1>LOGIN</h1>
        <input type="text" placeholder="Username" name="username" required>
        <input type="password" placeholder="Password" name="password" required>
        <button type="submit">Login</button>
    </form>  
</body>
</html>