<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../assets/html-head.php"?>
    <link rel="stylesheet" href="../CSS/demo.css">
</head>
<body onload="loadGeneratedPlan()">
    <?php include "../assets/searchPageHeader.php"?>
    <section class="generate-section">
        <div class="container">
            <div class="timeline">
            </div>
        </div>
        <div class="modal" id="modal">
            <!-- <button class="open" onclick="openf()">Claim Your Reward</button> -->
            <div class="box">
                <div class="imgBox">
                <img src="../IMAGES/partyLogo.png" alt="" />
                </div>
                <h2 class="title">Congratulations! 🌟</h2>
                <p>
                You have successfully completed your tour as planned.Hope you had a great experience!
                </p>
                <p>Keep Visiting Us</p>
                <div class="btnContainer">
                <button class="close" onclick="closef()">Search tourist sites!</button>
                </div>
            </div>
        </div>
        
    </section>
    <?php include "../assets/footer.php"?>
    <script src="../JAVASCRIPT/confetti.min.js"></script>
    <script src="../JAVASCRIPT/main.js"></script>
    <script src="../JAVASCRIPT/script.js"></script>
</body>