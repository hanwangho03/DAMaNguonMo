@include('admin.blocks.adminheader')

    <div class="container-fluid mt-4">
        <h2 class="text-center text-primary">Thống kê Doanh thu theo tháng</h2>
   
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
// Kết nối database
$conn = new mysqli("localhost", "root", "", "travela");
$conn->set_charset("utf8");

// Truy vấn tổng doanh thu theo tháng
$sql = "SELECT 
            DATE_FORMAT(dateIssued, '%Y-%m') AS month,
            SUM(amount) AS total_revenue
        FROM invoice
        GROUP BY month
        ORDER BY month ASC";

$result = $conn->query($sql);

// Tạo mảng dữ liệu
$months = [];
$revenues = [];

while ($row = $result->fetch_assoc()) {
    $months[] = $row['month'];
    $revenues[] = $row['total_revenue'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        #revenueChartContainer {
            max-width: 1000px;
            max-height: 600px;
            width: 100%;
            margin: 0 auto;
        }

        #revenueChart {
            width: 100%;
            height: auto;
        }

        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>
<body>
   
    <div id="revenueChartContainer">
        <canvas id="revenueChart"></canvas>
    </div>

    <script>
        const ctx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($months) ?>,
                datasets: [{
                    label: 'Doanh thu (VNĐ)',
                    data: <?= json_encode($revenues) ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString('vi-VN') + '₫';
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                }
            }
        });
    </script>
</body>
</html>
