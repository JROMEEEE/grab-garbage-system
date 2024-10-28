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
            <a class="navbar-brand d-flex align-items-center" href="login.php">Admin Menu</a>
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
    <div class="container p-5 mb-5">
      <h2 class="display-1 text-center mb-5">Welcome to Grab my Garbage! <br></h2>
      <p class="lead text-center mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi blanditiis ratione deleniti, nulla laboriosam esse numquam minus sequi error porro voluptas quia inventore vel quos facere, obcaecati natus ipsa fugit?<br></p>
      <p class="lead text-center mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa rerum nobis deserunt natus officia hic magni quo tempore itaque repellat non voluptatem, reprehenderit vitae beatae in minus architecto cum sequi?<br></p>
    </div>

    <!-- CARD SELECT -->

  

    <!--FORM REQUEST-->
    <div class="container p-5 bg-primary mb-5 w-75  " id="request">
      <h1 class="display-2 text-center text-white mt-5 mb-3">Request Garbage Pickup</h1>
      <!-- GUIDELINES -->
      <h2 class="lead text-white mt-5 mb-3">Guidelines:   <br></h2>
      <p class="lead text-white mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi blanditiis ratione deleniti, nulla laboriosam esse numquam minus sequi error porro voluptas quia inventore vel quos facere, obcaecati natus ipsa fugit?<br></p>

      <p class="lead text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit. <br></p>
      <ul>
        <li class="lead text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit. <br></li>
        <li class="lead text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit. <br></li>
        <li class="lead text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit. <br></li>
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
        <div class="container p-5 mb-5">
          <h2 class="display-1 text-center mb-5">Additional Content!<br></h2>
          <p class="lead text-center mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi blanditiis ratione deleniti, nulla laboriosam esse numquam minus sequi error porro voluptas quia inventore vel quos facere, obcaecati natus ipsa fugit?<br></p>
          <p class="lead text-center mb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa rerum nobis deserunt natus officia hic magni quo tempore itaque repellat non voluptatem, reprehenderit vitae beatae in minus architecto cum sequi?<br></p>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>       
</html>