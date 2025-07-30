<?php 
include 'connect.php';
session_start();
if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Responsive Website</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

  <link rel="stylesheet" href="style.css">

</head>
<body>
  <header>
    <div class="logo">  QUANTUM  <BR>  COACHING</div>
    <nav>
      <ul>
        <li><a href="#">Home</a></li>
        <!-- <li><a href="admission.php">Admission</a></li> -->
        <li><a href="#gallery">Gallery</a></li>
        <li><a href="#programs">Programs</a></li>
        <!-- <li><a href="#batch">Course</a></li> -->
        <li><a href="#my-team">Team</a></li>
        <li><a href="#contact">Contact</a></li>
        <?php
        $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
        $select_profile->execute([$user_id]);
        if($select_profile->rowCount() > 0){
           $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
     ?>
        <li><a href="profile.php" id="profile">👤<?= $fetch_profile['name']; ?></a></li>

         <?php
            }else{
         ?>
         <li>   <a href="login.php">login</a></li>
  
      <?php } ?>
      </ul>
      </nav>
  
  </header>

    <section class="static-img">
      <div class="img">
        <span id="c1"> QUANTUM </span><BR><span id="c2">COACHING</span> 
      </div>
    </section>
    <section class="intro">
      <div class="content">
        <div class="info">
          <h1 align="center"> Coding Mastery Begins at Quantum </h1>
          <p> 
            Welcome to our coaching institute! We're passionate about coding, delivering top-notch education, and empowering individuals to thrive in the digital world. Our comprehensive courses cater to beginners, enthusiasts, and professionals, providing personalized attention and practical learning experiences. Join our supportive community, explore coding, and unlock endless possibilities for your future success.
          </p>
          <p>
            We pride ourselves on offering hands-on, practical learning experiences that go beyond theory. From mastering programming languages to delving into web and software development frameworks, our courses are designed to equip students with the skills and confidence they need to thrive in today's competitive environment
          </p>
        </div>
      </div>
    </section>
    <section id="gallery">
        <h1 align="center" style="font-style: italic; margin-bottom: 5%;font-size:2.5rem;"> GALLERY </h1>
        <div class="slideshow-container">

            <div class="mySlides fade">
              <div class="numbertext">1 / 5</div>
              <img src="g1.jpeg" style="width:100%">
              <div class="text">Caption Text</div>
            </div>
            
            <div class="mySlides fade">
              <div class="numbertext">2 / 5</div>
              <img src="g2.jpeg" style="width:100%">
              <div class="text">Caption Two</div>
            </div>
            
            <div class="mySlides fade">
              <div class="numbertext">3 / 5</div>
              <img src="g3.jpeg" style="width:100%">
              <div class="text">Caption Three</div>
            </div>
            
            
            <div class="mySlides fade">
                <div class="numbertext">4 / 5</div>
                <img src="g4.jpeg" style="width:100%">
                <div class="text">Caption Three</div>
              </div>
            
              
            <div class="mySlides fade">
                <div class="numbertext">5 / 5</div>
                <img src="g5.jpeg" style="width:100%">
                <div class="text">Caption Three</div>
              </div>
            
            </div>
            <br>
            
            <div style="text-align:center">
              <span class="dot"></span> 
              <span class="dot"></span> 
              <span class="dot"></span> 
              <span class="dot"></span> 
              <span class="dot"></span> 
            </div>
            
            <script>
            let slideIndex = 0;
            showSlides();
            
            function showSlides() {
              let i;
              let slides = document.getElementsByClassName("mySlides");
              let dots = document.getElementsByClassName("dot");
              for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";  
              }
              slideIndex++;
              if (slideIndex > slides.length) {slideIndex = 1}    
              for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
              }
              slides[slideIndex-1].style.display = "block";  
              dots[slideIndex-1].className += " active";
              setTimeout(showSlides, 2000); // Change image every 2 seconds
            }
            </script>
    </section>
    <section id="programs">
      <h1 align="center" class="h1" style="font-size:2.5rem; margin-bottom:-2rem">PROGRAMS</h1>
      <div class="mainp">
          <div class="block">
              <img src="prog.jpeg">
              <h1 class="h1">Programming<br> Languages</h1>
              <p class="contentp">
                  Programming languages are tools used to write instructions for computers to perform tasks. 
              </p>
              <button class="Btn">
                  <a href="programs.php">know us</a>
              </button>
          </div>

          <div class="block">
              <img src="web_dev.jpeg">
              <h1 class="h1">Web<br> Development</h1>
              <p class="contentp">
                  Web development involves building and maintaining websites and web applications. 
              </p>
              <button class="Btn">
                  <a href="web_dev.php">know us</a>
              </button>
          </div>

          <div class="block">
              <img src="soft_dev.jpeg">
              <h1 class="h1">Software<br> Development</h1>
              <p class="contentp">
                  Software development focuses on creating applications and systems that meet specific user needs. 
              </p>
              <button class="Btn">
                  <a href="soft_dev.php">know us</a>
              </button>
          </div>
      </div>
  </section>

   
  <!-- <section id="batch">
    <h1 class="h1">SPECIAL COURSE</h1>
    <div id="Bcontainer">
        <div class="Bimg">
            <img src="SQAUD.jpg">
        </div>
        <div class="Bcont">
            <h1 class="h1">👺 AKATSUKI 👺</h1>
            Akatsuki course offers a unique fusion of coding education and Naruto's Akatsuki universe, providing a dynamic learning experience like no other. Dive into a curriculum intricately woven with Akatsuki themes and characters, mastering both fundamental and advanced coding techniques while honing problem-solving skills through immersive exercises. Guided by passionate instructors and supported by a vibrant community of fellow learners, CodeAkatsuki is the perfect environment to unleash your coding potential and become a true coding ninja. Join us today and embark on a journey where coding meets anime in the most epic way imaginable.
        </div>
    </div>
    <button class="Btn">
        <a href="asform.php">Enroll Now</a>
    </button>
</section> -->


     <section id="my-team" style="margin-bottom: 15%;">

      <h1 align="center" style="font-size: 34px; font-style: italic; margin-bottom: 5%;"> OUR TEAM </h1>
      <!-- <div class="team-member">
        <div id="t1">
            <img src="tm4.jpg" alt="Team Member 1">
            <div>
                <h3>Rushi shinde </h3>
                <p>M.tech</p>
                <p>10 years of experience</p>
                <p>Skills: Python, Java, JavaScript</p>
            </div>
        </div>
       
        <div id="t3">
            <img src="tm.jpg" alt="Team Member 2">
            <div>
                <h3>paul zayn</h3>
                <p>Msc computer science</p>
                <p>5 years of experience</p>
                <p>Skills: c++,python & DSA</p>
            </div>
        </div>

        <div id="t2">
          <img src="tm2.jpg" alt="Team Member 2">
          <div>
              <h3>aniket gurav</h3>
              <p>MCA</p>
              <p>7 years of experience</p>
              <p>Skills: DSA & cloud computing</p>
          </div>
      </div>

        <div id="t3">
            <img src="tm3.jpg" alt="Team Member 2">
            <div>
                <h3>parth salunkhe</h3>
                <p>MSC </p>
                <p>5 years of experience</p>
                <p>Skills: Python,node js</p>
            </div>
        </div>

        <div id="t3">
            <img src="tm4.jpg" alt="Team Member 2">
            <div>
                <h3>shreekant patil</h3>
                <p>M tech</p>
                <p>6 years of experience</p>
                <p>Skills: networking, DSA,web dev</p>
            </div>
        </div>

        <div id="t3">
            <img src="tm5.jpg" alt="Team Member 2">
            <div>
                <h3>Ram pawar</h3>
                <p>Msc</p>
                <p>7 years of experience</p>
                <p>Skills: software dev, PHP,react</p>
            </div>
        </div>
       
    </div>
      -->
<div class="mainp" style="margin-top:-5rem; margin-bottom:-8rem;grid-template-columns: repeat(auto-fit, minmax(20rem, 1fr));">

<?php
   $show_facultys = $conn->prepare("SELECT * FROM `faculty`");
   $show_facultys->execute();
   if($show_facultys->rowCount() > 0){
      while($fetch_facultys = $show_facultys->fetch(PDO::FETCH_ASSOC)){  
?>
<div class="block" style="border:0.1rem solid black;border-radius:6%; padding-bottom:1rem; width:100%;   ">
   <img src="<?= $fetch_facultys['image']; ?>" alt="" style="height:20rem; width:85%; border-radius:6%; border:0.1rem solid black">
   <div class="fle">
   <div class="name"><h5 align="center">Name : <?= $fetch_facultys['name']; ?></div>
   <div class="category"><h5 align="center">Skills : <?= $fetch_facultys['skills']; ?></div>
   <div class="category"> <h5 align="center">Degree : <?= $fetch_facultys['degree']; ?></div>
 </div>
 <div class="name"><h5 align="center">Experience : <?= $fetch_facultys['experience']; ?></h5></div>
</div>
<?php
      }
   }else{
      echo '<p class="empty">no faculty added yet!</p>';
   }
?>

</div>
     </section>
     
     <section id="contact">
      <div style="display: flex; justify-content: space-around; background-color:black; text-align: center; font-size: 18px; padding-top: 1%; text-decoration: none; "><a href="#" style="text-decoration: none; color: white;" ><h5 style="color: grey;">BACK TO TOP</h5></a></div>
      <div class="footer-clean">
          <footer>
              <div class="containerf">
                  <div class="row justify-content-center">
                      <div class="col-sm-4 col-md-3 item">
                          <h3>Services</h3>
                          <ul>
                              <li><a href="#">Web design</a></li>
                              <li><a href="#">Development</a></li>
                              <li><a href="#">Hosting</a></li>
                          </ul>
                      </div>
                      <div class="col-sm-4 col-md-3 item">
                          <h3>About</h3>
                          <ul>
                              <li><a href="#">Company</a></li>
                              <li><a href="#">Team</a></li>
                              <li><a href="#">Legacy</a></li>
                          </ul>
                      </div>
                      <div class="col-sm-4 col-md-3 item">
                          <h3>Careers</h3>
                          <ul>
                              <li><a href="#">Job openings</a></li>
                              <li><a href="#">Employee success</a></li>
                              <li><a href="#">Benefits</a></li>
                          </ul>
                      </div>
                      <div class="col-lg-3 item social"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-instagram"></i></a>
                          <p class="copyright">Quantum Coaching © 2025</p>
                      </div>
                  </div>
              </div>
          </footer>
      </div>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js">
          
      </script>
      <script src="js/script.js">
     </section>
      
</body>
</html>