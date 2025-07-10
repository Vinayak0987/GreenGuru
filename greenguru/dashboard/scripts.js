// Charts
const ctxUsers = document.getElementById('userChart').getContext('2d');
new Chart(ctxUsers, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        datasets: [{
            label: 'Users',
            data: [200, 400, 600, 800, 1000, 1200],
            borderColor: '#1abc9c',
            tension: 0.4,
            fill: false
        }]
    }
});

const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
new Chart(ctxRevenue, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        datasets: [{
            label: 'Revenue ($)',
            data: [5000, 8000, 12000, 15000, 18000, 20000],
            backgroundColor: '#1abc9c'
        }]
    }
});

// Leaflet Map
const map = L.map('map').setView([19.076, 72.8777], 12); // Mumbai
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
}).addTo(map);

L.marker([19.076, 72.8777]).addTo(map)
    .bindPopup('Factory in Mumbai')
    .openPopup();
    // Sidebar Toggle
const sidebar = document.getElementById('sidebar');
document.getElementById('toggleSidebar').addEventListener('click', () => {
    sidebar.classList.toggle('collapsed');
});

// Task Tracker Toggle
const taskTracker = document.getElementById('taskTracker');
document.getElementById('taskTrackerToggle').addEventListener('click', () => {
    taskTracker.classList.toggle('hidden');
});

// Add Task Functionality
document.getElementById('addTask').addEventListener('click', () => {
    const taskInput = document.getElementById('taskInput');
    if (taskInput.value.trim()) {
        const li = document.createElement('li');
        li.textContent = taskInput.value;
        document.getElementById('taskList').appendChild(li);
        taskInput.value = '';
    }
});

// Add Activity Log Example
setInterval(() => {
    const activityList = document.getElementById('activityList');
    const activity = document.createElement('li');
    const now = new Date();
    activity.textContent = `Activity at ${now.getHours()}:${now.getMinutes()}`;
    activityList.appendChild(activity);
}, 5000);

// Fetch Real-Time Data
function fetchRealTimeData() {
    fetch('getStats.php')
        .then(response => response.json())
        .then(data => {
            if (!data.error) {
                // Update Total Users, Revenue, and Orders in the dashboard
                document.querySelector('.overview .card:nth-child(1) p').textContent = data.total_users;
                document.querySelector('.overview .card:nth-child(2) p').textContent = `$${data.revenue}`;
                document.querySelector('.overview .card:nth-child(3) p').textContent = data.orders;

                // Update charts dynamically
                updateCharts(data);
            } else {
                console.error(data.error);
            }
        })
        .catch(error => console.error('Error fetching data:', error));
}

// Update Charts with Real-Time Data
function updateCharts(data) {
    userChart.data.datasets[0].data.push(data.total_users);
    revenueChart.data.datasets[0].data.push(data.revenue);

    // Keep only the last 10 data points
    if (userChart.data.datasets[0].data.length > 10) userChart.data.datasets[0].data.shift();
    if (revenueChart.data.datasets[0].data.length > 10) revenueChart.data.datasets[0].data.shift();

    userChart.update();
    revenueChart.update();
}

// Initial Setup for Charts
const userChartCtx = document.getElementById('userChart').getContext('2d');
const revenueChartCtx = document.getElementById('revenueChart').getContext('2d');

const userChart = new Chart(userChartCtx, {
    type: 'line',
    data: {
        labels: [], // Dynamic labels
        datasets: [{
            label: 'Users',
            data: [], // Dynamic data
            borderColor: '#1abc9c',
            tension: 0.4,
            fill: false
        }]
    }
});

const revenueChart = new Chart(revenueChartCtx, {
    type: 'bar',
    data: {
        labels: [], // Dynamic labels
        datasets: [{
            label: 'Revenue ($)',
            data: [], // Dynamic data
            backgroundColor: '#1abc9c'
        }]
    }
});

// Fetch data every 5 seconds
setInterval(fetchRealTimeData, 5000);

// Fetch data on page load
fetchRealTimeData();
