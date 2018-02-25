<html>
<head>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>グラフ</title>
<script>
    function getFilterValue(){
        var str = document.getElementById("dataFilter").value;
        $.ajax({
            type: "POST",
            dataType:'html',
            data: {filter: $("#dataFilter").val()},
            url: "/clients/sortGraph",
         })
        .done(function (data) {
            $("#myChart").remove();
            $('.graphArea').append('<canvas id="myChart" width="100px" height="500px"></canvas>');
            createGraph();
            console.log(data);
        })
        .fail(function (XMLHttpRequest, textStatus, errorThrown) {
            alert("グラフの表示に失敗しました。");
        });
    }
</script>
</head>
<body>
	<h1>グラフ画面</h1>
    <?= $this->Form->create("sort",['url'=>['action'=>'aggregate', 'type'=>'post']]) ?>
        <div>
            <?= $this->Form->input( "dataFilter", 
                                        ["type" => "select",
                                         "options" => ["desc"  => "得票数：降順",
                                                       "asc"  => "得票数：昇順",
                                                       "man"   => "得票数：性別(男)",
                                                       "woman" => "得票数：性別(女)"
                                                      ],
                                        "id"    => "dataFilter",
                                        "onChange" => "getFilterValue()",
                                        ])
            ?>
        </div>
    <?= $this->Form->end(); ?>
    <div class="graphArea">
       <canvas id="myChart" width="100px" height="500px"></canvas>
    </div>
</body>
<script>

    $(document).ready( function (){
        createGraph();
    });

    function createGraph(labels, graphDatas){
        var ctx = document.getElementById("myChart").getContext('2d');

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [labels],
                datasets: [{
                    data: [graphDatas],
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
                            stepSize: 5,
                        },
                    }],
                },
                animation: false
                
            }
        });
    }

</script>
</html>