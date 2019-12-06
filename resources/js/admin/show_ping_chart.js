$(document).ready(function () {

    var ctx = $("#sitePings");

    if(ctx.length){
        var days = JSON.parse(ctx.attr('data-time'));
        var counts = JSON.parse(ctx.attr('data-ping'));
        //Chart.defaults.global.elements.rectangle.backgroundColor = ['rgba(94, 114, 228, 0.2)', "rgba(86, 188, 228, 0.2)"];

        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                    labels: days,
                    datasets: [{
                        label: 'Пинг сайта, мс',
                        data: counts,
                        borderWidth: 3,
                        borderColor: 'rgb(0, 160, 160)'
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
