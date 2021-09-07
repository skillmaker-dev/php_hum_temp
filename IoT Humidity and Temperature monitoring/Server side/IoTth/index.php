<?php

require_once("main_processing.php");

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temperature & Humidity</title>
    <link rel="stylesheet" href="css/style.css">
    </link>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

    <div class="charts_div">
        <div class="charts"><canvas id="temperature" width="400" height="400"></canvas></div>
        <div class="charts"><canvas id="humidity" width="400" height="400"></canvas></div>
    </div>
    <div>
        <h3 class="copyright">Made by Anas Chahid</h3>
    </div>
</body>


<script>
    Chart.defaults.font.size = 30; //set default font size to 30
    var temperature_dom = document.getElementById('temperature');
    var myChart = new Chart(temperature_dom, {
        type: 'line',
        data: {
            labels: [<?php echo $date_string ?>], //adding date on X axis
            datasets: [{
                label: 'Temperature °C',
                data: [<?php echo $temperature_string ?>], //adding temperature on Y axis
                backgroundColor: "#ffb1c1",
                borderColor: "#ff6384",
                borderWidth: 4,
                pointRadius: 6,
                pointHoverRadius: 10

            }]
        },
        options: {
            maintainAspectRatio: false,
            responsive: true,
            scales: {
                y: {
                    beginAtZero: false
                }
            },
            plugins: {
                legend: {
                    labels: {
                        color: "red",

                        font: {
                            size: 30
                        }
                    }
                }
            }
        }
    });


    var humidity_dom = document.getElementById('humidity');
    var myChart = new Chart(humidity_dom, {
        type: 'line',
        data: {
            labels: [<?php echo $date_string ?>], //adding date on X axis
            datasets: [{
                label: 'Humidity %',
                data: [<?php echo $humidity_string ?>], //adding humidity on Y axis
                borderColor: "#36a2eb",
                backgroundColor: "#9ad0f5",
                borderWidth: 4,
                pointRadius: 6,
                pointHoverRadius: 10

            }]
        },
        options: {
            maintainAspectRatio: false,
            responsive: true,
            scales: {
                y: {
                    beginAtZero: false
                }
            },
            plugins: {
                legend: {
                    labels: {
                        color: "blue",

                        font: {
                            size: 30
                        }
                    }
                }
            }
        }
    });
</script>

</html>