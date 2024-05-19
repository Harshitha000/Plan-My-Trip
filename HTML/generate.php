<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../assets/html-head.php"?>
    <link rel="stylesheet" href="../CSS/generatePage.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"> -->
</head>
<body onload="loadGeneratedPlan()">
    <?php include "../assets/searchPageHeader.php"?>
    <section class="generate-section">
      <div class="timeline">
        <div class="start">
          <div class="content">
            <h2><i class="fa-solid fa-location-dot" style="color: #ff0000;"></i><span style="margin-left: 40px;"><?php echo $_SESSION["UserLocation"];?></span></h2>  
          </div>
        </div>
        <div class="sites"></div>
        <!-- <div class="end"> -->
          <div class="content" style="text-align=center;">
            <button class="completeBtn" onclick="handleComplete(event)">Completed</button>
          </div>
        <!-- </div> -->
    </div>
    </section>
    <?php include "../assets/footer.php"?>
    <script src="../JAVASCRIPT/main.js"></script>
    <script src="../JAVASCRIPT/script.js"></script>
</body>