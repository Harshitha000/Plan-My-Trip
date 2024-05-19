<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../assets/html-head.php"?>
    <link rel="stylesheet" href="../CSS/sitePage.css">
</head>

<body onload="handleLoad()">
    <?php include "../assets/searchPageHeader.php"?>
    <section class="search-section">
        <div class="sitePageContainer">
            <div class="searchDetails" style="font-size: 1.3rem;">
                <p>Searched for <b id="userSearchPlace" class="php-content"><?php echo($_SESSION["SearchPlace"]); ?></b> </p>
                <p>You are at <b id="userCurrentLocation"class="php-content"><?php echo($_SESSION["UserLocation"]); ?></b> </p>
                <a href="../HTML/search.php" id="modify-link">&#8592;Modify Your Search</a>
            </div>

            <div class="searchData"></div>
            
            <div class="generatePlanBtnContainer">
                <button class="generatePlanBtn" onclick="generatePlan()">Generate Plan</button>
            </div>

        </div>
    </section>
    
    <?php include "../assets/footer.php"?>
    <script src="../JAVASCRIPT/main.js"></script>
    <script src="../JAVASCRIPT/script.js"></script>
</body>

</html>