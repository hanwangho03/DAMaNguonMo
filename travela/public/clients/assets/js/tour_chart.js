document.addEventListener("DOMContentLoaded", function() {
    try {
        const tourDataJson = document.getElementById("tourDataJson");
        if (!tourDataJson) {
            console.error("Không tìm thấy thẻ chứa dữ liệu JSON.");
            return;
        }

        const tourData = JSON.parse(tourDataJson.textContent);
        console.log("Dữ liệu từ PHP:", tourData);

        if (Array.isArray(tourData) && tourData.length > 0) {
            if (!tourData[0].hasOwnProperty('titlle')) {
                console.error("Lỗi: Không tìm thấy thuộc tính 'titlle' trong dữ liệu.");
                alert("Lỗi dữ liệu: Không tìm thấy 'titlle'. Kiểm tra lại database.");
                return;
            }

            const tourNames = tourData.map(tour => tour.titlle);
            const bookingCounts = tourData.map(tour => tour.booking_count);

            const backgroundColors = tourNames.map((_, index) => `hsl(${index * 50}, 70%, 60%)`);
            const borderColors = tourNames.map((_, index) => `hsl(${index * 50}, 70%, 40%)`);

            const ctx = document.getElementById('tourBookingChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: tourNames,
                    datasets: [{
                        label: 'Số lượt đặt',
                        data: bookingCounts,
                        backgroundColor: backgroundColors,
                        borderColor: borderColors,
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Số lượt đặt'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Tên Tour'
                            },
                            ticks: {
                                font: {
                                    size: 10 
                                },
                                maxRotation: 0, 
                                minRotation: 0 
                            }
                        }
                    }
                }
            });
        } else {
            console.error("Dữ liệu tourData bị lỗi hoặc rỗng:", tourData);
            alert("Không có dữ liệu để hiển thị biểu đồ.");
        }
    } catch (error) {
        console.error("Lỗi khi xử lý dữ liệu JSON:", error);
    }
});
