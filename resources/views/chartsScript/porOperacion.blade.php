
const ctx = document.getElementById('porOperacion').getContext('2d');

const myChart = new Chart(ctx, {
    data: {
        labels: {!! json_encode($porOperacionLabels) !!},
        datasets: [{
            type: 'bar',
            label: 'Meses',
            data: {!! json_encode($porOperacionFecha) !!},
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1,
            order: 2,
        },{
            type: 'line',
            label: 'Operacion',
            data: {!! json_encode($porOperacionData) !!},
            fill: false,
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            order: 1,
        }]
    },
    options: {
        scales: {

           yAxes: [{
                ticks: {
                    beginAtZero: true,
                    callback: function(value, index, values) {
                        if(parseInt(value) >= 1000){
                            return 'Q' + parseInt(value).toLocaleString();
                        } else {
                            return 'Q' + value;
                        }
                    }
                }
            }],
            xAxes: [{

            }],

        },
        tooltips: {
            callbacks: {
                label: function(context){
                    return 'Q' + parseInt(context.value).toLocaleString();
                }
            }
        }
    }
});
