<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grab my Garbage</title>
    <!-- <link rel="stylesheet" href="https://unpkg.com/mvp.css">  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <!--MAIN MENU-->

    <nav class="navbar custom-navbar sticky-top">
      <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="index.php">
          <img src="assets/logo.png" width="45" height="45" class="d-inline-block align-middle me-2">
          Grab my Garbage
        </a>
        <ul class="navbar-nav flex-row flex-wrap bd-navbar-nav">
          <li nav-item col-6 col-lg-auto>
            <a class="navbar-brand d-flex align-items-center" href="#request">Request Pickup</a>
          </li>
          <li nav-item col-6 col-lg-auto>
            <a class="navbar-brand d-flex align-items-center" href="login.php">Volunteer Menu</a>
          </li>
      </div>
    </nav>    

    <!-- <div class="mainheader">
      <img src="assets/mainheader.png" alt="assets/mainheader2.png" class="img-fluid w-100 h-100 mb-4" >
    </div> -->

    <div id="carouselExample" class="carousel slide">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="assets/mainheader.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="assets/mainheader2.png" class="d-block w-100" alt="...">
        </div>
      </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

    <!-- INTRODUCTION -->
    <div class="container p-5 mt-3 mb-3">
      <h2 class="display-1 text-center mb-5">Welcome to Grab my Garbage! <br></h2>
      <p class="lead text-center mb-4">Tired of the hassle of hauling your garbage? Grab My Garbage is here to revolutionize waste management. Our innovative system simplifies the process of garbage pickup, saving you time and effort.<br></p>
      <p class="lead text-center">Join us and simplify your lives with Grab My Garbage. Let us transform your waste management routine into a stress-free experience.<br></p>
    </div>

    <!-- SERVICES -->
    <h1 class="display-1 text-center mb-3" id="services">Our Services:</h1>
    <div class="card-group p-5">
      <div class="card mx-3">
        <img class="card-img-top" src="assets/card1.png" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">Request Pickup</h5>
          <p class="card-text">You can arrange garbage collection at your convenience by using our pickup request area. All you need to do is provide your address, chosen time and date, and any specific pickup instructions in the form. Regardless of whether you have bulk items, recyclables, or ordinary household garbage, this service guarantees quick and easy collection that fulfills your demands.</p>
           <!--<p class="card-text"> <small class="text-muted">SUBTEXT</small></p> ADD SUBTEXT -->
        </div>
        <a href="#request" class="btn btn-primary">Request Pickup</a>
      </div>

      <div class="card mx-3">
        <img class="card-img-top" src="assets/card2.png" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">Volunteer</h5>
          <p class="card-text">Become a part of our mission to keep our community clean by volunteering to pick up trash and separate the waste in our neighborhood, you can help us maintain a clean community. You may reduce waste, encourage sustainability, and directly affect the environment with this practical opportunity. Everyone may enjoy a cleaner, healthier environment.</p>
        </div>
        <a href="adminmenu.php" class="btn btn-primary">Volunteer Today!</a>
      </div>

      <div class="card mx-3">
        <img class="card-img-top" src="assets/card3.png" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">Our Mission</h5>
          <p class="card-text">Our platform provides a comprehensive solution to environmental sustainability and waste management, which directly supports SDG 11. Our system promotes garbage pickup easier, encouraging cleaner streets and lessening the impact of garbage dumps. Our platform contributes to waste reduction, assisting cities in becoming more resource-efficient and sustainable.</p>
        </div>
        <a href="#additional-content" class="btn btn-primary">Check our Mission</a>
      </div>

      <div class="card mx-3">
        <img class="card-img-top" src="assets/card4.png" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">Project Information</h5>
          <p class="card-text mb-3">Our project is based on creative concepts intended to tackle certain sustainability and community well-being challenges. To learn more about the methods and implements we used to develop an effective, significant, and user-friendly system, click here.</p>
        </div>
        <a href="" class="btn btn-primary">Project Information</a>
      </div>
    </div>

    

    <!--FORM REQUEST-->
    <div class="container p-5 bg-primary mb-5 w-75 mt-5" id="request">
      <h1 class="display-2 text-center text-white mt-5 mb-3">Request Garbage Pickup</h1>
      <!-- GUIDELINES -->
      <h2 class="lead text-white mt-5 mb-3">Guidelines:   <br></h2>
      <p class="lead text-white mb-4">Our user-friendly GRAB GARBAGE SYSTEM makes scheduling garbage pickups quick and easy. Follow these steps to request your pickup:<br></p>

        <ul>
          <li class="lead text-white">1. Access the Grab Garbage System and go to the "Request Pickup" section. <br></li>
          <li class="lead text-white">2. Provide your essential information such as:
            <ul class = "mt-3">
              <li>Your full name </li>
              <li>Your address </li>
              <li>Your phone number</li>
              <li>Garbage type</li>
              <li>Collection date</li>
            <br></ul>
          <li class="lead text-white">3. Double check the details and submit your request. You'll receive a confirmation in your email. <br></li>
        </ul>
        <br>

          <!-- REQUEST FORM -->
          <form action="process.php" method="post">
              <label class="form-label text-white">Full Name:</label>
                <input type="text" class="form-control mb-3" name="fullname" id="" placeholder="Enter Full Name:" required> 
              <label class="form-label text-white">Address:</label>
                <input type="text" class="form-control mb-3" name="address" id="" placeholder="Enter Address:" required>
              <label class="form-label text-white">Phone Number:</label>
              <input type="text" class="form-control mb-3" name="phonenumber" id="" placeholder="Enter Phone Number:" required>
              <label class="form-label text-white">Garbage Type:</label>
                <input type="text" class="form-control mb-3" name="garbagetype" id="" placeholder="Describe Garbage Type:" required>
              <label class="form-label text-white">Collection Date:</label> 
                <input type="date" class="form-control" name="collectiondate" id="" placeholder="Collection Date:" required aria-describedby="helpdate">
                  <div id="helpdate" class="text-white mb-3">
                    <small>Collection dates are closed on Saturday and Sunday.</small>
                  </div> 

              <?php
              // UPDATE MESSAGE
                  if(isset($_GET['update_msgform'])){
                      echo "<h6 class='text-white'>".$_GET['update_msgform']."</h6>";
                  }
              ?>

              <?php
              // ERROR MESSAGE
                  if(isset($_GET['error_msgform'])){
                      echo "<h6 class='text-white>".$_GET['error_msgform']."</h6>";
                  }
              ?>

            <input type="submit" class="btn btn-primary mb-3" value="Send" name="submit">
          </form>
        </div>
                
        <!-- ADD CONTENT -->
        <div class="container p-5 bg-primary mb-5 w-75 mt-5" id="additional-content">
        <div id= "additional-content" class="container p-5 mb-5">
          <h2 class="display-1 text-center text-white mb-5"> Our Mission <br></h2>
          <p class="lead text-center lead text-white mb-4"> In our community, garbage collectors often face challenges with timely waste collection due to accessibility issues. When garbage accumulates on the roads, it becomes difficult for trucks to navigate and collect waste efficiently, leading to delays, unsanitary conditions, and a negative impact on the environment and public health. </p>
          <p class="lead text-center lead text-white mb-4"> To address this, our team developed an innovative system that allows users to schedule pickups and input their location directly into our platform. This feature provides garbage collectors with a clear, updated guide on where and when to collect waste, streamlining the process and ensuring timely pickup. </p>
          <p class="lead text-center lead text-white mb-4"> By improving route efficiency and communication, our system helps keep streets clean, enhances community hygiene, and reduces the likelihood of garbage piling up in public spaces.Our goal is to make waste collection more accessible, organized, and sustainable for everyone in the community.<br></p>
        </div>
    <footer class="bg-primary text-center text-black">
        
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>       
</html>