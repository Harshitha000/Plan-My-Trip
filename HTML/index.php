<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include "../assets/html-head.php";?>
    <link rel="stylesheet" href="../CSS/form.css">
  </head>
  <body>
    <?php include "../assets/header.php"?>
    <main>
      <section class="home" id="home">
        <div class="form">
          <div class="content loginForm">
            <header>Login Form</header>
            <form action="../PHP/login.php" method="post">
               <div class="field">
                  <span class="fa fa-envelope"></span>
                  <input type="text" required placeholder="Email" name="email" value="">
               </div>
               <div class="field space">
                  <span class="fa fa-lock"></span>
                  <input type="password" class="pass-key" required placeholder="Password" name="password" value="">
               </div>
               <!-- <div class="pass">
                  <a href="#">Forgot Password?</a>
               </div> -->
               <div class="field space">
                  <input type="submit" value="LOGIN">
               </div>
            </form>
            <br>
            <div class="signup">
               Don't have account?
               <a href="#" onclick="openSignInForm()">Signup Now</a>
            </div>
          </div>
          <div class="content SignUpForm">
            <header>SignUp Form</header>
            <form action="../PHP/signup.php" method="post">
               <div class="field">
                  <span class="fa fa-user"></span>
                  <input type="text" required placeholder="Full Name" name="fname" value="">
               </div>
               <div class="field space">
                <span class="fa fa-envelope"></span>
                <input type="text" required placeholder="Email" name="email" id="email" value="">
               </div>
               <div class="field space">
                  <span class="fa fa-lock"></span>
                  <input type="password" class="pass-key" required placeholder="Password" name="password" value="">
               </div>
               <div class="field space otp-container">
                  <span class="fa fa-key"></span>
                  <input type="number" class="otpInput" required placeholder="Enter OTP" name="otp" id="otp" class="otpInput" value="">
                  <button type="button" id="sendOtpBtn" class="otpButton">Send OTP</button>
               </div>
               <div class="field space">
                  <input type="submit" value="SIGNUP">
               </div>
            </form>
            <br>
            <div class="signup">
               Already a user?
               <a href="#" onclick="openLoginForm()">Login Now</a>
            </div>
         </div>
        </div>
        <!-- <div class="home_container">
            <div class="home_data">
                <h1 class="home_data-title">Explore The  Best Beautiful Places</h1>
            </div>
            
        </div> -->
      </section>
      <section class="AboutUs" id="about-us">
        <div class="about-us-content">
          <!-- <h1 align="center">About US</h1> -->
          <!-- <br> -->
          <p style="font-size:1.5rem;">At <b>TravelTour</b>, we are passionate about making travel planning a seamless and delightful experience for every traveler. We're here to help you discover new destinations, plan memorable trips, and create unforgettable memories.</p>
          <br>
          <h2>Our Mission:</h2><br>
            
          <p style="font-size:1.2rem;">Our mission is to empower travelers like you to explore the place with confidence and ease. </p><br>
            
          <h2>What We Offer:</h2><br>
            
            <p style="font-size:1.2rem;"><b>Destination Exploration: </b>With our intuitive search feature, you can discover a wide range of destinations in India. Simply enter the name of a city, and unlock a treasure trove of information about its top tourist sites</p>
            
            <p style="font-size:1.2rem;"><b>Trip Planning Made Easy: </b>Planning your dream itinerary has never been simpler. Browse through our curated lists of attractions to your personalized travel plan. Our user-friendly interface ensures that every aspect of your trip is organized and accessible at your fingertips.</p>
            
            <p style="font-size:1.2rem;"><b>Optimized Routes: </b>Say goodbye to travel hassles! Our advanced algorithms calculate the most efficient routes between your selected destinations. Enjoy a stress-free journey knowing that your itinerary is optimized for maximum enjoyment.</p>
        </div>
      </section>
    </main>
    <?php include "../assets/footer.php"; ?>
    <script>
      document.getElementById("sendOtpBtn").addEventListener("click", function () {
         const email = document.getElementById("email").value;

         fetch('../PHP/sendOtp.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ email })
         })
         .then(response => {
            if (!response.ok) {
               throw new Error('Network response was not ok');
            }
            return response.json(); // Parse JSON
         })
         .then(data => {
            if (data.success) {
               alert('OTP sent to your email!');
            } else {
               alert('Failed to send OTP. Please try again.');
            }
         })
         .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
         });

      });
    </script>
    <script src="../Javascript/script.js"></script>
    <script src="../Javascript/form.js"></script>
  </body>
</html>
