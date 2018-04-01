<html>
<head>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
<script src="/js/createGraph.js"></script>
<script src="/js/bootstrap.min.js"></script>
<link href="/css/bootstrap.min.css" rel="stylesheet">
<link href="/css/nomalize.css" rel="stylesheet">
<link href="/css/aggregate.css" rel="stylesheet">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>管理画面：グラフ</title>
<script>
    function getFilterValue(){
        var str = document.getElementById("dataFilter").value;
        $.ajax({
            type: "POST",
            dataType:'json',
            data: {filter: $("#dataFilter").val()},
            url: "/clients/sortGraph",
         })
        .done(function (data) {
            var labels = [];
            var graphData = [];

            for(var i in data) {
                labels.push(data[i]["name_initial"]);
                graphData.push(data[i]["vote"]);
            };

            createGraph(labels, graphData);
        })
        .fail(function (XMLHttpRequest, textStatus, errorThrown) {
            alert("グラフの表示に失敗しました。");
        });
    }
</script>
</head>
<body>
    <div class="footerArea">
	   <h1>管理画面：グラフ画面</h1>
    </div>
        <div class="filterArea col-xs-2">
            <?= $this->Form->input( "dataFilter", 
                                        ["type" => "select",
                                         "options" => ["desc"  => "得票数：降順",
                                                       "asc"  => "得票数：昇順",
                                                       "man"   => "得票数：性別(男)",
                                                       "woman" => "得票数：性別(女)"
                                                      ],
                                        "id"    => "dataFilter",
                                        "onChange" => "getFilterValue()",
                                        "class" => "form-control"
                                        ]);
            ?>
        </div>
    <div class="graphArea">
    </div>
    <div class="editArea ol-xs-2">
        <ul>
            <?= $this->Form->create("detail",['url'=>['action'=>'detail', 'type'=>'post']]) ?>
            <li>
                <?= $this->Form->select( "person_no", $employeeData,["class" => "form-control"]);?>
            </li>
            <li>
                <?= $this->Form->button('詳細', array('class'=>'btn btn-primary center-block'));?>
            </li>
            <?= $this->Form->end(); ?>
            <li>
                <?= $this->Form->create("regist",['url'=>['action'=>'regist', 'type'=>'post']]) ?>
                <?= $this->Form->button('新規登録', array('class'=>'btn btn-primary center-block'));?>
                <?= $this->Form->end(); ?>
            </li>
        </ul>
    </div>

<script>
    createGraph([<?= $labels ?>], [<?= $graphData ?>]);
</script>
</body>
</html>