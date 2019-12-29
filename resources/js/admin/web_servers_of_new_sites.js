$(document).ready(function () {

    var ctx = $("#newSitesWebServers");

    if(ctx.length){
        var servers = JSON.parse(ctx.attr('data-server'));
        var counts = JSON.parse(ctx.attr('data-count'));
        //Chart.defaults.global.elements.rectangle.backgroundColor = ['rgba(94, 114, 228, 0.2)', "rgba(86, 188, 228, 0.2)"];
        window.chartColors = [
            'rgb(255, 99, 132)',
            'rgb(255, 159, 64)',
            'rgb(255, 205, 86)',
            'rgb(75, 192, 192)',
            'rgb(54, 162, 235)',
        ];

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: servers,
                datasets: [{
                    label: 'Статистика используемых версий для последних добавленных 5 web серверов, шт',
                    data: counts,
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                    ],
                    borderWidth: 1,
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    }





});
