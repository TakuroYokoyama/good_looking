    function createGraph(labels, graphData){
        $("#myChart").remove();
        $('.graphArea').append('<canvas id="myChart"></canvas>');
        
        var ctx = document.getElementById("myChart").getContext('2d');
        ctx.canvas.height = 500;

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    data: graphData,
                    backgroundColor: [
                        'rgba(255,  99, 132, 1)',
                        'rgba( 54, 162, 235, 1)',
                        'rgba(255, 206,  86, 1)',
                        'rgba( 75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159,  64, 1)'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {                          //凡例設定
                    display: false                 //表示設定
                },
                scales: {
                    yAxes: [{
                        ticks: {                      //最大値最小値設定
                            min: 0,
                            fontSize: 18,             //フォントサイズ
                        },
                    }],
                    xAxes: [{                         //x軸設定
                        display: true,                //表示設定
                        barPercentage: 0.7,           //棒グラフ幅
                        ticks: {
                            fontSize: 18,
                        },
                    }],
                },
                layout: {                             //レイアウト
                    padding: {                          //余白設定
                        left: 100,
                        right: 50,
                        top: 0,
                        bottom: 0
                    }
                },
                animation: false
                
            }
        });
    }
