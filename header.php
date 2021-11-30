<header>
    <div class="container-menu-desktop">
        <div class="wrap-menu-desktop">
            <nav class="limiter-menu-desktop container">

                <a href="#" class="logo">
                    <img src="images/outfit-logo.png" alt="IMG-LOGO">
                </a>

                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li>
                            <a href="index.php">Home</a>
                        </li>

                        <?php
                            if($_SESSION['login'] === true){
                                ?>
                                <li>
                                    <a href="mojioutfiti.php">Moji outfiti</a>
                                </li>
                                <li>
                                    <a href="logout.php">LogOut</a>
                                </li>
                        <?php
                            }else{
                                ?>
                                <li>
                                    <a href="login.php">LogIn</a>
                                </li>
                                <li>
                                    <a href="registracija.php">Registracija</a>
                                </li>
                        <?php
                            }

                        ?>
                    </ul>
                </div>
            </nav>
        </div>
    </div>

    <div class="wrap-header-mobile">
        <div class="logo-mobile">
            <a href="index.php"><img src="images/outfit-logo.png" alt="IMG-LOGO"></a>
        </div>

        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
        </div>
    </div>

    <div class="menu-mobile">
        <ul class="main-menu-m">

            <li>
                <a href="index.php">Home</a>
            </li>

            <?php
            if($_SESSION['login'] === true){
                ?>
                <li>
                    <a href="mojioutfiti.php">Moji outfiti</a>
                </li>
                <li>
                    <a href="logout.php">LogOut</a>
                </li>
                <?php
            }else{
                ?>
                <li>
                    <a href="login.php">LogIn</a>
                </li>
                <li>
                    <a href="registracija.php">Registracija</a>
                </li>
                <?php
            }

            ?>
        </ul>
    </div>
</header>