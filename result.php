<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result</title>
</head>
<body>
<style>
        /* Styles for the modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 1;
        }

        .modal-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }
    </style>
  
    <h1>Your Result: 63</h1>
    <h3>INTERPRETING THE BECK DEPRESSION INVENTORY</h3>
    <p>Now that you have completed the questionnaire, add up the score for each
        of the twenty-one questions by counting the number to the right of each
        question you marked. The highest possible total for the whole test would
        be sixty-three. This would mean you circled number three on all twenty-one
        questions. Since the lowest possible score for each question is zero, the
        lowest possible score for the test would be zero. This would mean you
        circles zero on each question.
        
        You can evaluate your depression according to the Table below. 
    </p>

    <table>
      <tr>
        <th>Total Score</th>
          <th>Levels of Depression</th>
        </tr>
      <tr>
        <td>1-10</td>
        <td>These ups and downs are considered normal</td>
      </tr>
      <tr>
        <td>11-16</td>
        <td>Mild mood disturbance</td>
      </tr>
      <tr>
        <td>17-20</td>
        <td>Borderline clinical depression</td>
      </tr>
      <tr>
        <td>21-30</td>
        <td>Moderate depression</td>
      </tr>
      <tr>
        <td>31-40</td>
        <td>Severe depression</td>
      </tr>
      <tr>
        <td>over 40</td>
        <td>Extreme depression</td>
      </tr>
    </table>

    <button id="viewResultsBtn">View Past Results</button>

    <!-- The modal -->
    <div id="resultsModal" class="modal">
        <div class="modal-content">
            <span class="close-btn" id="closeModalBtn">&times;</span>
            <!-- Content to display past results goes here -->
            <!-- You can load the past results dynamically using JavaScript -->
        </div>
    </div>

    <form action="">
      <button>Go Back Home</button>
      <button>Print</button>
      <button>Download as PDF</button>
    </form>

    <!-- JavaScript to handle the modal -->
<script>
    // Get the modal and button elements
    var modal = document.getElementById("resultsModal");
    var viewResultsBtn = document.getElementById("viewResultsBtn");
    var closeModalBtn = document.getElementById("closeModalBtn");
    var modalContent = document.querySelector(".modal-content");

    // Function to load and display past results
    function loadPastResults() {
        // You can use AJAX to fetch the past results from user-result.php
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "user-result.php", true);

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Update the modal content with the fetched results
                modalContent.innerHTML = xhr.responseText;
            }
        };

        xhr.send();
    }

    // Open the modal and load past results when the button is clicked
    viewResultsBtn.onclick = function() {
        modal.style.display = "block";
        loadPastResults(); // Load past results when the modal is opened
    }

    // Close the modal when the close button is clicked
    closeModalBtn.onclick = function() {
        modal.style.display = "none";
    }

    // Close the modal if the user clicks outside the modal content
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

</body>
</html>
