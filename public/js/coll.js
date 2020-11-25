var coll = document.getElementsByClassName("text-collapsible");
var i;
/* On the collection of elements I listen the event click*/
  for (i = 0; i < coll.length; i++) {
    /* Onclick I listen the event click on the collection of elements*/
    coll[i].addEventListener("click", function () {
      /* Toggles between a class name for the element */
      this.classList.toggle("text-active");
      /* The nextElementSibling property returns the element immediately following the specified element*/
      var content = this.nextElementSibling;
      if (content.style.display === "block") {
        content.style.display = "none";
      } else {
        content.style.display = "block";
      }
    });
  }
