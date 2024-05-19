const api = "a6e9c069440a46539cf74ba527cece92";

// Variables
let autoComplete = document.querySelector(".autocomplete");
let searchBar = document.querySelector(".search-box");
let searchDataComponent = document.querySelector(".searchData");

var selectedTouristSites = [];
function autocomplete(input, arr) {
  // const url=`https://api.geoapify.com/v1/geocode/autocomplete?text=${input.value}&format=json&apiKey=a6e9c069440a46539cf74ba527cece92`;
  let currentFocus;

  input.addEventListener("input", function (e) {
    const val = this.value;
    closeAllLists();
    if (!val) {
      return false;
    }
    currentFocus = -1;
    const div = document.createElement("div");
    div.setAttribute("id", this.id + "-autocomplete-list");
    div.setAttribute("class", "autocomplete-items");
    this.parentNode.appendChild(div);

    arr.forEach(function (item) {
      if (item.substr(0, val.length).toUpperCase() === val.toUpperCase()) {
        const suggestion = document.createElement("div");
        suggestion.innerHTML =
          "<strong>" + item.substr(0, val.length) + "</strong>";
        suggestion.innerHTML += item.substr(val.length);
        suggestion.innerHTML += "<input type='hidden' value='" + item + "'>";
        suggestion.addEventListener("click", function (e) {
          input.value = this.getElementsByTagName("input")[0].value;
          closeAllLists();
        });
        div.appendChild(suggestion);
      }
    });
  });

  input.addEventListener("keydown", function (e) {
    let x = document.getElementById(this.id + "-autocomplete-list");
    if (x) x = x.getElementsByTagName("div");
    if (e.keyCode === 40) {
      // Down arrow key
      currentFocus++;
      addActive(x);
    } else if (e.keyCode === 38) {
      // Up arrow key
      currentFocus--;
      addActive(x);
    } else if (e.keyCode === 13) {
      // Enter key
      e.preventDefault();
      if (currentFocus > -1) {
        if (x) x[currentFocus].click();
      }
    }
  });

  function addActive(x) {
    if (!x) return false;
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = x.length - 1;
    x[currentFocus].classList.add("autocomplete-active");
  }

  function removeActive(x) {
    for (let i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }

  function closeAllLists(elmnt) {
    const items = document.getElementsByClassName("autocomplete-items");
    for (let i = 0; i < items.length; i++) {
      if (elmnt !== items[i] && elmnt !== input) {
        items[i].parentNode.removeChild(items[i]);
      }
    }
  }

  document.addEventListener("click", function (e) {
    closeAllLists(e.target);
  });
}

async function InputFunction(e) {
  e.preventDefault();
  let searchInput = e.target.value;

  if (searchInput.length) {
    await fetch(
      `https://api.geoapify.com/v1/geocode/autocomplete?text=${searchInput}&lang=en&limit=10&filter=countrycode:in&format=json&apiKey=${api}`
    )
      .then((response) => {
        return response.json();
      })
      .then((data) => {
        if (data.results.length != 0) {
          const arr = data.results.map((d) => d.formatted);
          autocomplete(e.target, arr);
        }
      })
      .catch((error) => {
        console.log("Error fetching data: ", error);
      });
  }
}

async function getPlaceId(placeName) {
  placeName = placeName.replace(" ", "%20");
  placeName = placeName.replace(",", "%2C");
  const response = await fetch(
    `https://api.geoapify.com/v1/geocode/search?text=${placeName}&lang=en&type=city&filter=countrycode:in&format=json&apiKey=${api}`
  );
  const data = await response.json();
  return data.results[0].place_id;
}

async function getImageUrlBySiteName(siteName) {
  siteName = siteName.replace(" ", "+");
  const res = await fetch(
    `https://pixabay.com/api/?key=43092251-271de13e0c08dd4d1c074ae09&q=${siteName}&image_type=photo&pretty=true`
  );
  const data = await res.json();
  return (
    data?.hits[0]?.webformatURL ||
    "https://th.bing.com/th/id/OIP.IEvuVH2kuKvCPcykUockWQHaFj?w=230&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7"
  );
}

async function getTouristSites(searchPlace) {
  try {
    searchDataComponent.innerHTML = "";
    const searchPlaceId = await getPlaceId(searchPlace);
    const res = await fetch(
      `https://api.geoapify.com/v2/places?categories=tourism&limit=20&filter=place:${searchPlaceId}&apiKey=${api}`
    );
    const data = await res.json();
    if (data.features.length > 0) {
      data.features.forEach(async function (d) {
        let obj = {
          siteName: d.properties.name,
          siteAddress: d.properties.formatted,
          imageURL: await getImageUrlBySiteName(d.properties.name),
          latitude: d.properties.lat,
          longitude: d.properties.lon,
        };
        const item = `
        <div class="data-item">
          <img class="siteImage" src=${obj.imageURL} alt=${obj.siteName}/>
          <div class="siteDetailsContainer">
              <p><b align="center">${obj.siteName}</b></p>
              <button class="addToPlanBtn" data-siteData='${JSON.stringify(
                obj
              )}' onclick="addToPlan(event)">add</button>
          </div>
        </div>
          `;

        searchDataComponent.innerHTML += item;
      });
    }
  } catch (error) {
    console.log(error.message);
  }
}
function addToPlan(e) {
  const button = e.target;
  const siteData = JSON.parse(button.getAttribute("data-siteData"));
  if (button.textContent == "remove") {
    button.textContent = "add";
    const selectedIndex = selectedTouristSites.findIndex(
      (site) => site.siteName === siteData.siteName
    );
    selectedTouristSites.splice(selectedIndex, 1);
    button.parentNode.parentNode.style.backgroundColor = "";
  } else {
    button.textContent = "remove";
    console.log(
      "before add to plan selectedTouristSites:",
      selectedTouristSites
    );
    selectedTouristSites.push(siteData);
    button.parentNode.parentNode.style.backgroundColor = "gold";
  }
  console.log("after add to plan selectedTouristSites:", selectedTouristSites);
}

function calculateDistance(lat1, lon1, lat2, lon2) {
  // Function to calculate the distance between two points using Haversine formula
  const R = 6371; // Radius of the Earth in kilometers
  const dLat = (lat2 - lat1) * (Math.PI / 180);
  const dLon = (lon2 - lon1) * (Math.PI / 180);
  const a =
    Math.sin(dLat / 2) * Math.sin(dLat / 2) +
    Math.cos(lat1 * (Math.PI / 180)) *
      Math.cos(lat2 * (Math.PI / 180)) *
      Math.sin(dLon / 2) *
      Math.sin(dLon / 2);
  const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
  const distance = R * c;
  return distance;
}

function findNearestNeighbor(currentLocation, unvisitedLocations) {
  // Function to find the nearest unvisited location to the current location
  let nearestLocation = null;
  let minDistance = Infinity;

  for (const location of unvisitedLocations) {
    const distance = calculateDistance(
      currentLocation.latitude,
      currentLocation.longitude,
      location.latitude,
      location.longitude
    );
    if (distance < minDistance) {
      minDistance = distance;
      nearestLocation = location;
    }
  }

  return nearestLocation;
}

function travelingSalesman(locations) {
  if (locations.length <= 1) {
    return locations; // If there are no or only one location, return as is
  }

  const startLocation = locations[0]; // Start from the first location
  const unvisitedLocations = [...locations.slice(1)]; // Remaining locations to visit
  const path = [startLocation]; // Initialize the path with the start location

  let currentLocation = startLocation;

  while (unvisitedLocations.length > 0) {
    const nearestLocation = findNearestNeighbor(
      currentLocation,
      unvisitedLocations
    );
    if (nearestLocation) {
      path.push(nearestLocation); // Add the nearest location to the path
      unvisitedLocations.splice(unvisitedLocations.indexOf(nearestLocation), 1); // Mark as visited
      currentLocation = nearestLocation; // Move to the nearest location
    }
  }

  path.push(startLocation); // Complete the cycle by returning to the start location

  return path;
}

function generatePlan() {
  if (selectedTouristSites.length == 0) {
    alert("select atleast one tourist sites to generate plan!!");
  } else {
    const sitesPath = travelingSalesman(selectedTouristSites);
    localStorage.setItem("sites", JSON.stringify(sitesPath));
    // window.location.href="generate.php";
    window.location.href = "demoGen.php";
  }
}

async function handleLoad() {
  console.log("handleLoad loaded");
  let placeInput = document.getElementById("userSearchPlace").textContent;
  let userLocationInput = document.getElementById(
    "userCurrentLocation"
  ).textContent;
  let res = await fetch(
    `https://api.geoapify.com/v1/geocode/autocomplete?text=${userLocationInput}&lang=en&limit=1&format=json&apiKey=${api}`
  );
  let userLocationData = await res.json();
  selectedTouristSites.push({
    siteName: userLocationInput,
    siteAddress: userLocationData.results[0].formatted,
    imageURL: "",
    latitude: userLocationData.results[0].lat,
    longitude: userLocationData.results[0].lon,
  });
  await getTouristSites(placeInput);
}

function loadGeneratedPlan() {
  // selectedTouristSites=JSON.parse(localStorage.getItem('sites'));
  // // const timeLineContainer=document.querySelector(".timeline");
  // const timeLineContainer=document.querySelector(".sites");
  // for(let i=1;i<selectedTouristSites.length-1;i++){
  //   if(i%2==1){
  //     timeLineContainer.innerHTML+=`
  //       <div class="container left">
  //         <div class="content">
  //           <h2><i class="fa-solid fa-location-dot" style="color: #ff0000;"></i><span style="margin-left: 40px;">${selectedTouristSites[i].siteName}</span></h2>
  //           <button class="completeBtn" onclick="handleComplete(event)">Completed</button>
  //         </div>
  //       </div>
  //     `
  //   }
  //   else{
  //     timeLineContainer.innerHTML+=`
  //       <div class="container right">
  //         <div class="content">
  //           <h2><i class="fa-solid fa-location-dot" style="color: #ff0000;"></i><span style="margin-left: 40px;">${selectedTouristSites[i].siteName}</span></h2>
  //           <button class="completeBtn" onclick="handleComplete(event)">Completed</button>
  //         </div>
  //       </div>
  //     `
  //   }
  // }

  selectedTouristSites = JSON.parse(localStorage.getItem("sites"));
  const timeLineContainer = document.querySelector(".timeline");
  for (let i = 1; i < selectedTouristSites.length - 1; i++) {
    let start = selectedTouristSites[i - 1].siteAddress;
    let end = selectedTouristSites[i - 1].siteAddress;
    const mapsUrl = `https://www.google.com/maps/dir/${start}/${end}`;

    // Open the URL in a new tab/window
    window.open(mapsUrl, "_blank");
    timeLineContainer.innerHTML += `
    <div class="timeline-container primary">
        <div class="timeline-icon">
            <i class="fa-solid fa-flag fa-xs"></i>
        </div>
        <div class="timeline-body">
            <div class="imageSec">
                <img src="${selectedTouristSites[i].imageURL}"  alt="${
      selectedTouristSites[i].siteName
    } image"/>
            </div>
            <div class="details">
                <h3><i class="fa-solid fa-location-dot"></i> ${
                  selectedTouristSites[i].siteName
                }</h3>
                <a href="${mapsUrl}" target="_blank">Click here for directions</a>
                <button onclick="markAsComplete(event,${i},${
      selectedTouristSites.length - 2
    })">Complete</button>
            </div>
            
        </div>
    </div>
    `;
  }
}

function markAsComplete(e, i, length) {
  console.log("i value", i);
  e.target.parentNode.parentNode.parentNode.querySelector(
    ".timeline-icon"
  ).innerHTML = '<i class="fa-solid fa-check fa-xs"></i>';
  e.target.setAttribute("disabled", "True");
  if (i == length) {
    openf();
  }
}

function handleComplete(e) {
  const itemComponent = e.target.parentNode.parentNode;
  itemComponent.style.borderColor = "blue";
  itemComponent.classList.add("highlightedContainer");
}

const plannedSiteContainer = document.querySelector(".container");
const modal = document.querySelector(".box");
const closeBtn = document.querySelector(".close");

function openf() {
  console.log("inside openf");
  window.location.href = "demoGen.php#modal";
  modal.classList.add("visible");
  // plannedSiteContainer.classList.add('hidden');
  plannedSiteContainer.style.display = "none";
  const startit = () => {
    setTimeout(function () {
      confetti.start();
    }, 1000);
  };
  // Stops
  const stopit = () => {
    setTimeout(function () {
      confetti.stop();
    }, 5000);
  };
  // playing start
  startit();
  // stoping it
  stopit();
}

function closef() {
  modal.classList.remove("visible");
  window.location.href = "search.php";
  // openbtn.classList.remove('hidden');
}
