window.onload = function () {
  if (window.location.pathname.includes("appointment.php")) {
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (() => {
      "use strict";
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      const forms = document.querySelectorAll(".needs-validation");
      // Loop over them and prevent submission
      Array.from(forms).forEach((form) => {
        form.addEventListener(
          "submit",
          (event) => {
            if (!form.checkValidity()) {
              event.preventDefault();
              event.stopPropagation();
            }

            form.classList.add("was-validated");
          },
          false
        );
      });
    })();

    let ageSelect = document.getElementById("age-select");
    for (var i = 0; i <= 100; i++) {
      var option = document.createElement("option");
      option.value = i;
      option.textContent = i;
      ageSelect.appendChild(option);
    }

    const submitButton = document.getElementById("submit-button");
    const inputs = Array.from(document.getElementsByClassName("written"));

        inputs.forEach(input => {
            input.addEventListener("input", () => {
                const isFormValid = inputs.every(input => input.value.trim() !== "");
                submitButton.disabled = !isFormValid;
                submitButton.style.backgroundColor = isFormValid ? "#5BC0DE" : "";
                submitButton.style.color = isFormValid ? "#000" : "";
            });
        });

        const urlParams = new URLSearchParams(window.location.search);
        const success = urlParams.get('success');
        const date = urlParams.get('date');
        const time = urlParams.get('time');
    
        if (success === 'true') {
            $(document).ready(function() {
                $('#successModal').modal('show');
                $('#appointment-modal-calendar').after('<span>' + date + '</span>');
                $('#appointment-modal-clock').after('<span>' + time + '</span>');
            });
        }

        
    } else if (window.location.pathname.includes('/patientProfile.php')) {
        //check
        const saveButton = document.getElementById('save-info-profile-changes');
        const messageOverlay = document.getElementById('message-overlay');
        const messageText = document.getElementById('message-text');

    saveButton.addEventListener("click", function () {
      // Show the message overlay
      messageOverlay.style.display = "block";

      // Set the message text
      messageText.textContent = "נשמר בהצלחה";

      // Hide the message overlay after a delay (e.g., 3 seconds)
      setTimeout(function () {
        messageOverlay.style.display = "none";
      }, 2000);
    });
  } else if (window.location.pathname.includes("/list.php")) {

    // Get all delete buttons
        var deleteButtons = document.querySelectorAll('button[data-bs-target="#deleteModal"]');

        // Attach onclick event handler to each delete button
        deleteButtons.forEach(function (button) {
            button.onclick = function () {
                var deleteId = this.getAttribute("data-person-id");
                document.getElementById("delete_id").value = deleteId;
            };
        });




    // dashboard page
  } else if (window.location.pathname.includes("/dashboard.php")) {
    // chart!
    const ctx = document.getElementById("myChart");
    const chartcol = document.getElementById("chart-col");

    new Chart(ctx, {
      type: "doughnut",
      data: {
        labels: [
          "CT - ממתינים ל ",
          "MRI - ממתינים ל ",
          "ממתינים לרנגטן",
          "ממתינים לאולטרסאונד",
        ],
        datasets: [
          {
            label: "ממתינים",
            data: [12, 19, 3, 5],
            backgroundColor: [
              "rgb(134, 185, 206)",
              "rgb(156, 203, 225)",
              "rgb(217, 147, 227)",
              "rgb(164, 138, 207)",
            ],

            borderWidth: 1,
          },
        ],
      },
      options: {
        responsive: true,
      },
    });

    new Chart(chartcol, {
      type: "bar",
      data: {
        labels: ["ציוד סטרילי", "מחטים", "חומר ניגוד", "כפפות", "גל", "מסיכות"],
        datasets: [
          {
            label: "מחלקת דימות",
            data: [15, 25, 50, 75, 100, 90],
            borderWidth: 1,
          },
        ],
      },
      options: {
        responsive: true,
      },
    });


const chartload = document.getElementById("myChartload");
new Chart(chartload, {
  type: "line",
  data: {
    labels: [" 6:00", "7:00","8:00", "9:00","10:00","11:00", "12:00", "13:00","14:00","15:00", "16:00","17:00", "18:00"], 
    datasets: [
  {
        label: "מחלקת דימות",
        data: [15, 25, 50, 75, 100, 90,100,100,100,85,70,60,90],
        borderWidth: 2,
      },{
              label: " עומס כבד  ",

              data: [85,85,85,85,85,85,85,85,85,85,85,85,85],
              borderWidth: 2,
            },{
              label: " עומס קל  ",

              data: [60,60,60,60,60,60,60,60,60,60,60,60,60],
              borderWidth: 2,
              
            }  
          ]
  },
  options: {
    responsive: true,
  },
});

///


//////////////////////////////////
    //calander
    function generateCalendarDays(year, month) {
      const daysContainer = document.getElementById("calendar-days");
      const currentMonthElement = document.getElementById("current-month");

      const firstDayOfMonth = new Date(year, month, 1).getDay();
      const totalDaysInMonth = new Date(year, month + 1, 0).getDate();

      // Clear the previous days
      daysContainer.innerHTML = "";

      // Update the current month in the title
      currentMonthElement.textContent = new Date(year, month).toLocaleString(
        "default",
        { month: "long", year: "numeric" }
      );

      // Create empty cells for days of the week before the first day of the month
      for (let i = 0; i < firstDayOfMonth; i++) {
        const emptyCell = document.createElement("div");
        emptyCell.classList.add("empty-cell");
        daysContainer.appendChild(emptyCell);
      }

      // Create cells for each day of the month
      for (let day = 1; day <= totalDaysInMonth; day++) {
        const dayCell = document.createElement("div");
        dayCell.textContent = day;
        dayCell.classList.add("day-cell");
        daysContainer.appendChild(dayCell);
      }
    }

    // Example: Generate calendar for the current month
    const currentDate = new Date();
    generateCalendarDays(currentDate.getFullYear(), currentDate.getMonth());

    // Navigation buttons to switch between months
    document.getElementById("prevBtn").addEventListener("click", () => {
      const currentMonth = currentDate.getMonth();
      const currentYear = currentDate.getFullYear();

      currentDate.setMonth(currentMonth - 1);

      // Check if we need to switch years
      if (currentMonth === 0) {
        currentDate.setFullYear(currentYear - 1);
      }

      generateCalendarDays(currentDate.getFullYear(), currentDate.getMonth());
    });

    document.getElementById("nextBtn").addEventListener("click", () => {
      const currentMonth = currentDate.getMonth();
      const currentYear = currentDate.getFullYear();

      currentDate.setMonth(currentMonth + 1);

      // Check if we need to switch years
      if (currentMonth === 11) {
        currentDate.setFullYear(currentYear + 1);
      }

      generateCalendarDays(currentDate.getFullYear(), currentDate.getMonth());
    });



// task

const taskInput = document.getElementById("taskInput");
const addButton = document.getElementById("addButton");
const taskList = document.getElementById("taskList");

// Add event listener to the button
addButton.addEventListener("click", addTask);

function addTask() {
    if (taskInput.value.trim() !== "") {
        const taskItemWrapper = document.createElement("div");
        taskItemWrapper.classList.add("task-item-wrapper");

        const taskItem = document.createElement("li");
        taskItem.innerHTML = `<span>${taskInput.value}</span> `;
        const deleteButton = document.createElement("button");
        deleteButton.innerText = "מחיקה";
        deleteButton.classList.add("delete-button");

        taskItemWrapper.appendChild(taskItem);
        taskItemWrapper.appendChild(deleteButton);
        taskList.appendChild(taskItemWrapper);

        taskInput.value = "";
        addDeleteEventListener(taskItemWrapper);
    }
}

function deleteTask() {
    const taskItemWrapper = this.parentNode;
    taskItemWrapper.parentNode.removeChild(taskItemWrapper);
}

function addDeleteEventListener(taskItemWrapper) {
    const deleteButton = taskItemWrapper.querySelector(".delete-button");
    deleteButton.addEventListener("click", deleteTask);
}



 









  }
};
