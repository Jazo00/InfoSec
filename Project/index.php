<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="with=device-width", initial-scale="1.0">
    <title>John University</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <section class="header">
        <nav>
            <a href="index.php"><img src="images/logo.png"></a>
            <div class="nav-links" id="navLinks">
                <i class="fa fa-times" onclick="hideMenu()"></i>
                <ul>
                    <li><a href="">HOME</a></li>
                    <li><a href="#about-us">ABOUT</a></li>
                    <li><a href="login.php">LOGIN</a></li>
                    <li><a href="register.php">SIGN UP</a></li>
                </ul>
            </div>
            <i class="fa fa-bars" onclick="showMenu()"></i>
        </nav>

    <div class="text-box">
        <h1>Welcome to John University</h1>
        <p>A school the prepares you for your better future.</p>
        <a href="" class="hero-btn ">Visit Us To know More</a>
    </div>
    </section>

   <!---About section--->

    <section class="about" id="about-us"> <!--Pinalitan mo kagabi yung id remove nalang pag di need-->
        <h1>About Us</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>

        <div class="row">
            <div class="about-col">
                <h3>Vision</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque et tortor sit amet odio dapibus interdum. Fusce rhoncus risus eu dui tristique,
                     at pretium mauris facilisis. Nullam fringilla urna et dui mattis, et mollis nulla accumsan. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; 
                     Vivamus ullamcorper commodo quam nec porttitor.</p>
            </div>
            <div class="about-col">
                <h3>Mission</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque et tortor sit amet odio dapibus interdum. Fusce rhoncus risus eu dui tristique,
                     at pretium mauris facilisis. Nullam fringilla urna et dui mattis, et mollis nulla accumsan. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; 
                     Vivamus ullamcorper commodo quam nec porttitor.</p>
            </div>
            <div class="about-col">
                <h3>Offers</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque et tortor sit amet odio dapibus interdum. Fusce rhoncus risus eu dui tristique,
                     at pretium mauris facilisis. Nullam fringilla urna et dui mattis, et mollis nulla accumsan. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; 
                     Vivamus ullamcorper commodo quam nec porttitor.</p>
            </div>
        </div>
    </section>

   <!---Campus section--->

    <section class="campus">
        <h1>Our Branch Campuses</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>

        <div class="row">
            <div class="campus-col">
                <img src="images/campus-1.jpg">
                <div class="layer">
                    <h3>Makati</h3>
                </div>
            </div>
            <div class="campus-col">
                <img src="images/campus-2.jpg">
                <div class="layer">
                    <h3>Manila</h3>
                </div>
            </div>
            <div class="campus-col">
                <img src="images/campus-3.jpg">
                <div class="layer">
                    <h3>Taguig</h3>
                </div>
            </div>
        </div>
    </section>

    <!---Campus section--->

    <section class="facilities">
        <h1>Our Facilities</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>

        <div class="row">
            <div class="facilities-col">
                <img src="images/facility-1.jpg">
                <h3>Outdoor study space</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                    Quisque et tortor sit amet odio dapibus interdum.</p>
            </div>
            <div class="facilities-col">
                <img src="images/facility-2.jpg">
                <h3>Cafeteria</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                    Quisque et tortor sit amet odio dapibus interdum.</p>
            </div>
            <div class="facilities-col">
                <img src="images/facility-3.jpg">
                <h3>Library</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                    Quisque et tortor sit amet odio dapibus interdum.</p>
            </div>
        </div>

    </section>

    <!---Footer section--->

    <section class="footer">
        <h4>You can reach us on these websites</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
            Quisque et tortor sit amet odio dapibus interdum.</p>
        <div class="icons">
            <i class="fa fa-facebook"></i>
            <i class="fa fa-twitter"></i>
            <i class="fa fa-instagram"></i>
            <i class="fa fa-linkedin"></i>
        </div>
        <p>All Rights Reserved. John University</p>
    </section>


    <!---JS for Toggle Menu for smaller screen--->
    <script>
        var navLinks = document.getElementById("navLinks");

        function showMenu(){
            navLinks.style.right = "0";
        }
        function hideMenu(){
            navLinks.style.right = "-200px";
        }
    </script>
</body>
</html>