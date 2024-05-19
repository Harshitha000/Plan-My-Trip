function setActive(event) {
  const navLinks = document.getElementsByClassName("nav_link");
  for (const l of navLinks) {
    l.classList.remove("active");
  }
  event.target.classList.add("active");
}
