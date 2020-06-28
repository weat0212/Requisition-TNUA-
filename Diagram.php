<html>
<head>
    <script type="text/javascript" src="diagram.js"></script>
    <script src=https://d3js.org/d3.v3.min.js charset="utf-8"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>國立臺北藝術大學 分析報表</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>


<body id="wrapper">
    <div id="header">
        <a href="HomePage.html"><img class=title src="images/title.png"/><br/></a>
        <p class="copy">分析報表</p>
        <ul id="navi">
            <!-- 導覽列從此開始 -->
                <li id="navi_01">
                    <a href="#">新增資料</a>
                    <ul id="a1">
                        <li><a href="#">意見回饋</a>
                        </li>
                        <li><a href="InsertPage.html">訂單申請</a>
                        </li>
                        <li><a href="#">新增客戶</a>
                        </li>
                    </ul>
                </li>
                <li id="navi_02"><a href="QueryPage.html">查詢資料</a></li>
                <li id="navi_03"><a href="UpdatePage.html">修改資料</a></li>
                <li id="navi_04"><a href="Diagram.php">分析報表</a></li>
                <li id="navi_05"><a href="Manual.html">系統手冊</a></li>
            <!-- 導覽列到此為止 -->
        </ul>
    </div>

        </style>

        <?php
            $serverName = "DESKTOP-PGTDFJ7";
            $connectionInfo = array( "Database"=>"FinalProject", "UID"=>"andywang", "PWD"=>"andy0212", "CharacterSet" => "UTF-8");
            $conn=sqlsrv_connect($serverName,$connectionInfo);
            $sql="SELECT participant FROM dbo.Ordering";
            $quer=sqlsrv_query($conn, $sql) or die("sql error".sqlsrv_errors());
            while($row=sqlsrv_fetch_array($quer)){
                $dataset=$row;
            }
            foreach($dataset as $val){
                echo $val;
            }
           
        ?>

</script>
      <title>D3.js Demo </title>
      <style>
      .wrap{
          position:  relative;
          overflow:  hidden;
          margin-bottom:  1em;
      }
      .bar{
          background-color: navy;
          width: 2em;
          height: auto;
          margin-right:  5px;
          float: left;
          position:  relative;
          color: #fff;
          text-align:  center;
          padding-top:  5px;
      }
      button{
          font-size:  1.5em; float: left;
          margin-right:  10px;
          float: right;
      }
      </style>
  </head>
  <body>
      <script>
          var data =  [1, 1, 2, 60, 1];
          var height  = 250, width = 300;

          // body 與 容器
          var body =  d3.select('body');
          var wrap =  body.append('div')
                         .style({
                             'height': height + 'px'
                         })
                         .classed('wrap', true);

          // render & update
          var render  = function () {
               wrap.selectAll('.bar')
               .data(data)
               .enter()
               .append('div')
               .classed('bar', true)
               .text(function (d) {
                   return d;
              })
               .style({
                   'height': function (d) {
                      return d * 25 + 'px';
                  },
                   'top': function (d) {
                       return (height - d * 25) + 'px';
                  }
              });
          };

          // remove
          var remove  = function () {
               wrap.selectAll('.bar')
               .data(data)
               .text(function (d) {
                   return d;
              })
               .style({
                   'height': function (d) {
                       return d * 25 + 'px';
                  },
                   'top': function (d) {
                       return (height - d * 25) + 'px';
                  }
              })
              .exit()
               .remove();
          };
          // 繪製原始資料
          render();
          // 兩顆按鈕
           body.append('button')
             .classed('add', true)
             .text('add');
           body.append('button')
             .classed('remove', true)
             .text('remove');
           d3.select('.add').on('click', function () {
               data.push(Math.floor(Math.random() * 10 + 1));
               render();
          });
           d3.select('.remove').on('click', function () {
               data.pop();
               remove();
          });
      </script>

<footer id="footer">
    <p>112 台北市北投區學園路一號 國立台北藝術大學 展演藝術中心</p>
    <p>Tel:(02)2893-8163</p>
</footer>

</body>
</html>
