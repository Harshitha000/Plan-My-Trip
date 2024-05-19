<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../assets/html-head.php"?>
    <!-- <link rel="stylesheet" href="../CSS/searchPage.css"> -->
    <link rel="stylesheet" href="../CSS/searchForm.css">
</head>

<body>
    <?php include "../assets/searchPageHeader.php"?>
    <section class="search-section">
        <div class="searchForm">
            <header>Lets Explore!</header>
            <form action="../PHP/searchFormDetails.php" method="post">
               <div class="field">
                  <label for="Place">Place</label>
                  <div style="background: rgba(255, 255, 255, 0.94); display:flex;">
                    <span><i class="fa-solid fa-location-dot"></i></span>
                    <input type="text" name="Place" id="place" placeholder="Search for a city to explore Tourist sites" onkeyup="InputFunction(event)"/>
                    <div class="autocomplete-items" id="autocomplete-items"></div>
                  </div>
               </div>
               <div class="field space">
                  <label for="UserLocation">Current Location</label>
                  <div style="background: rgba(255, 255, 255, 0.94); display:flex;">
                    <span><i class="fa-solid fa-location-dot"></i></span>
                    <input type="text" name="Location" id="userLocation" placeholder="Enter complete address of your current location" onkeyup="InputFunction(event)"/>
                    <div class="autocomplete-items" id="autocomplete-items"></div>
                  </div>
               </div>
               <div class="field space" style="height:45px !important">
                  <input type="submit" value="Search">
               </div>
            </form>
        </div>
        
        <!-- <div class="autocomplete">
            <div class="search-box">
                <input type="text" name="Place" id="myInput" placeholder="Search for a place in India and Explore Tourist sites" onkeyup="InputFunction(event)"/>
                
                <div class="autocomplete-items" id="autocomplete-items"></div>
                <i class="fas fa-search fa-lg search-icon" style="color: #74C0FC;" onclick="handleSearch()"></i>
            </div>    
            <input type="submit" value="Generate Path" class="generatePathBtn" onclick="generatePlan()">            
        </div> -->
        <!-- geoapify api key: a6e9c069440a46539cf74ba527cece92 -->
        <!-- <div class="searchData"></div> -->
    </section>
    
    <?php include "../assets/footer.php"?>
    <script src="../JAVASCRIPT/main.js"></script>
    <script src="../JAVASCRIPT/script.js"></script>
</body>

</html>