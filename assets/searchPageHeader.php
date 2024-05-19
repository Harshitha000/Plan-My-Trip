<?php
session_start();
?>
<header>
      <div class="nav_container">
        <a href="#" class="logo">PlanMyTrip</a>
        <div class="nav_menu" id="nav_menu">
          <ul class="nav_list">
               <li class="nav_item">
                  <i><?php echo $_SESSION["User"];?></i>
              </li>
              <li class="nav_item">
                  <a href="#" class="nav_link active" onclick="setActive(event)">Home</a>
              </li>
              <li class="nav_item">
                  <a href="#footer" class="nav_link " onclick="setActive(event)">Contact Us</a>
              </li>
              <li class="nav_item">
                  <a href="../HTML/index.php" class="nav_link " onclick="setActive(event)">SignOut</a>
              </li>
          </ul>
        </div>
</header>