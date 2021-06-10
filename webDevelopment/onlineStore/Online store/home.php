<?php
if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}
$_SESSION['nav'] = "home";
require "header.php";
?>


<div class="container">
  <div class="main">
    <div class="spacing"></div>



    <!-- First Image of Necklaces -->

    <div class= "picture_one">
    <img src="Images/photo5b.jpg" alt="Three Necklaces" style="width:450px;height:450px;" />
    </div>


    <div class="spacing"></div>

    <div class ="text_one">
    Give
    </div>
    <div class ="text_line_two">
    	the gift of gold.
    </div>
    <div class="spacing_two"></div>


    <!-- Second Image of Rings-->
    <div class= "picture_two">
    <img src="Images/photo10.jpg" alt="Three Rings" style="width:450px;height:450px;" />
    </div>

    <div class="spacing"></div>

    <div class ="text_two">
    Surprise
    </div>
    <div class ="text_line_two">
    that special someone.
    </div>

    <div class="spacing_two"></div>



    <!-- Third Image of Earrings-->

    <div class= "picture_three">
    <img src="Images/photo3.jpg" alt="Three Earrings" style="width:450px;height:450px;" />
    </div>


    <div class="spacing"></div>

    <div class ="text_one">
    Explore
    </div>
    <div class ="text3_line_two">
    	our newest earrings.
    </div>


    <div class="spacing_two"></div>
    <div class="spacing"></div>




    <div class="color"><h1>Excellence Is Our Guarantee</h1></div>

    <div class="spacing"></div>

    <div class="home-pics">

    <div class="contain">
    <div class= "picture_four">
    <img src="Images/photo9b.jpg" alt="Watch" style="width:400px;height:400px" >
    <div class="overlay-home">
    	<div class="text"><a class = "home-link" href="productDetails.php?id=56565">On Time $140</a></div>
    </div>
    </div>
    </div>

    <div class="contain">
    <div class= "picture_five">
    <img src="Images/photo3b.jpg" alt="Rose Necklace" style="width:400px;height:400px" >
    <div class="overlay-home">
    	<div class="text"><a class = "home-link" href="productDetails.php?id=23443">Roses Are Gold $30</a></div>
    </div>
    </div>
    </div>

    <div class="contain">
    <div class= "picture_six">
    <img src="Images/photo1b.jpg" alt="Yellow Jewel Ring" style="width:400px;height:400px" >
    <div class="overlay-home">
    	<div class="text"> <a class = "home-link" href="productDetails.php?id=23454">Eye of The Tiger $30</a></div>
    </div>
    </div>
    </div>

        </div>



    <div class="spacing_two"></div>
    <div class="spacing"></div>
    <div class="spacing"></div>
    <div class="spacing"></div>
    <div class="spacing"></div>



</div>
</div>
<?php require "footer.php" ?>
</body>

</html>
