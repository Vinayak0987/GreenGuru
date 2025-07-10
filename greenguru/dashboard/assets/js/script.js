import { Chart } from "@/components/ui/chart"
// Wait for the DOM to be fully loaded
document.addEventListener("DOMContentLoaded", () => {
  // Initialize charts if they exist on the page
  initializeCharts()

  // Initialize form validation
  initializeFormValidation()

  // Initialize alerts
  initializeAlerts()
})

// Function to initialize charts
function initializeCharts() {
  const overviewChart = document.getElementById("overviewChart")

  if (overviewChart) {
    const ctx = overviewChart.getContext("2d")
    const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
    const data = months.map(() => Math.floor(Math.random() * 5000) + 1000)

    new Chart(ctx, {
      type: "bar",
      data: {
        labels: months,
        datasets: [
          {
            label: "Monthly Sales",
            data: data,
            backgroundColor: "#2470dc",
            borderRadius: 4,
          },
        ],
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              callback: (value) => "$" + value,
            },
          },
        },
      },
    })
  }
}

// Function to initialize form validation
function initializeFormValidation() {
  const forms = document.querySelectorAll(".needs-validation")

  Array.from(forms).forEach((form) => {
    form.addEventListener(
      "submit",
      (event) => {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add("was-validated")
      },
      false,
    )
  })
}

// Function to initialize alerts
function initializeAlerts() {
  const alerts = document.querySelectorAll(".alert-dismissible")

  alerts.forEach((alert) => {
    // Check if Bootstrap is available
    if (typeof bootstrap !== "undefined") {
      const bsAlert = new bootstrap.Alert(alert)
      setTimeout(() => {
        bsAlert.close()
      }, 5000)
    } else {
      // Fallback for vanilla JS
      setTimeout(() => {
        alert.classList.remove("show")
        setTimeout(() => {
          alert.remove()
        }, 150)
      }, 5000)
    }
  })
}

// Function to confirm deletion
function confirmDelete(event, itemType) {
  if (!confirm(`Are you sure you want to delete this ${itemType}?`)) {
    event.preventDefault()
  }
}

// Function to preview image before upload
function previewImage(input) {
  if (input.files && input.files[0]) {
    const reader = new FileReader()

    reader.onload = (e) => {
      document.getElementById("imagePreview").src = e.target.result
      document.getElementById("imagePreview").style.display = "block"
    }

    reader.readAsDataURL(input.files[0])
  }
}

