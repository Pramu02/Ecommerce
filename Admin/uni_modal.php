<!-- Modal container -->
<div id="modalContainer">
  <div class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h2 id="modalTitle"></h2>
      <div id="modalContent"></div>
    </div>
  </div>
</div>

<script>
  // JavaScript code to handle the modal

  // Function to open the modal
  function openModal(title, url) {
    // Set the modal title
    document.getElementById("modalTitle").innerHTML = title;

    // Load the content into the modal
    var modalContent = document.getElementById("modalContent");
    modalContent.innerHTML = "Loading...";

    // Send AJAX request to load content
    var xhr = new XMLHttpRequest();
    xhr.open("GET", url, true);

    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          modalContent.innerHTML = xhr.responseText;
        } else {
          modalContent.innerHTML = "Error loading content.";
        }
      }
    };

    xhr.send();

    // Show the modal
    var modalContainer = document.getElementById("modalContainer");
    modalContainer.style.display = "block";
  }

  // Function to close the modal
  function closeModal() {
    var modalContainer = document.getElementById("modalContainer");
    modalContainer.style.display = "none";
  }

  // Attach click event listener to the close button
  document.querySelector(".close").addEventListener("click", function() {
    closeModal();
  });

  // Close the modal when the user clicks outside of it
  window.addEventListener("click", function(event) {
    var modalContainer = document.getElementById("modalContainer");
    if (event.target == modalContainer) {
      closeModal();
    }
  });
</script>
