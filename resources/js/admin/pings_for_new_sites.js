$(document).ready(function () {

    var ctx = $("#newSitesPings");

    if(ctx.length){
        var sites = JSON.parse(ctx.attr('data-title'));
        var ping = JSON.parse(ctx.attr('data-ping'));
        //Chart.defaults.global.elements.rectangle.backgroundColor = ['rgba(94, 114, 228, 0.2)', "rgba(86, 188, 228, 0.2)"];

        window.chartColors = [
            'rgb(255, 99, 132)',
            'rgb(255, 159, 64)',
            'rgb(255, 205, 86)',
            'rgb(75, 192, 192)',
            'rgb(54, 162, 235)',
        ];

        var datasets = [];
        var index = 0;

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: sites,
                datasets: [{
                    label: 'Результат последнего пинга сайта, мс',
                    data: ping,
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
