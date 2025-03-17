<?php 
    include "upper.php"; 
    require "user-pin-login.php";
    upperHTML("pin-login", "pin-login");      
?>
<body>
    <div id="pin-container">
        <h1 class="app-title">Read N' Bill</h1>
        <h2 class="login-title"><?php echo $register_mode ? 'Register PIN' : 'Enter PIN'; ?></h2>
        <?php if (isset($error) && !empty($error)) { echo "<p class='error'>$error</p>"; } ?>
        <div id="dots-container">
        
        </div>
        <div id="keys-container">
        
        </div>
    </div>
</body>
</html>