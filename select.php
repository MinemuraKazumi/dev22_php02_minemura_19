<?php
// funcs.phpの内容を使用できるようにする
require_once('funcs.php');

//1.  DB接続します

$pdo = db_conn();


//２．データ取得SQL作成 SELECT * FROM gs_book_tableで全データを取得する事ができる
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
$status = $stmt->execute();

//３．データ表示
$view="";
if ($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php resultの中に1行毎のデータを取得する $view.に追記していくイメージ
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= '<table align="center">';    
    $view .= '<td>'.h($result['id']) . '</td>'. '<td>'. h($result['name']) . '</td>' . '<td>'. h($result['url']). '</td>'  .'<td>'. h($result['comment']).  '</td>' . '<td>'.h($result['indate']);
    $view .= '</table>';

    // $view .= '<p>';
    // $view .= h($result['id']) . '/' . h($result['name']) . '/' . h($result['url']). '/' . h($result['comment']). '/' . h($result['indate']);
    // $view .= '</p>';
  }

}

?>






<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>フリーアンケート表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">

<style>
    table,tr,td,th{
        border: solid 1px black; border-collapse: collapse;
    }
    tr,td,th{
        width: 300px;
        max-width: 300px;
        height: 100px;
        word-wrap: break-word
    }
    th{
        background: silver;
    }
    p{
        text-align: center;
    }
</style>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">データ登録</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
  <!--  -->
    <div class="container jumbotron"><?= $view ?></div>
</div>
<!-- Main[End] -->

</body>
</html>
