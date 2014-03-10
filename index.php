<?php

require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

// GET route
$app->get(
'/',
function () {
    echo 'Hello Slim';
}
);

// GET /leds
$app->get('/leds', function () use ($app) { 
    
    // 设置分页
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $rows = isset($_GET['rows']) ? intval($_GET['rows']) : 10;
    $offset = ($page-1)*$rows;
    $result = array();
    
    // 连接数据库
    include 'conn.php';
    
    // 获得记录总数
    $rs = mysql_query("select count(*) from leds");
    $row = mysql_fetch_row($rs); 
    
    // var_dump($row);
    $result["total"] = $row[0];
    
    // 获得每条记录
    $sql = "select * from leds limit $offset,$rows ";
    $rs = mysql_query($sql);
    $items = array();
    while($row = mysql_fetch_object($rs)){
      array_push($items, $row);
    }
    // var_dump($items);
    $result["rows"] = $items;
  
    // var_dump($result);
    
    // JSON 输出
    $app->response()->header('Content-Type', 'application/json');
    echo json_encode($result, JSON_NUMERIC_CHECK);

});

// GET /leds/:id 返回所有信息
$app->get('/leds/:id', function ($id) use ($app) { 

    // 连接数据库
    include 'conn.php';
    
    // 以下两句sql语句效果相同
    // $sql = 'select * from leds where id =' . $id;
    $sql = "select * from leds where id = '$id' limit 1";
    $rs = mysql_query($sql);
    
    if($row = mysql_fetch_object($rs)){
      $app->response()->header('Content-Type', 'application/json');
      // JSON格式输出
      echo json_encode( $row, JSON_NUMERIC_CHECK);
    } else {
      $app->response()->status(404);
    }
});

// GET /leds/:id/status 仅返回status
$app->get('/leds/:id/status', function ($id) use ($app) { 

  // 连接数据库
  include 'conn.php';
  
  // 以下两句sql语句效果相同
  //$sql = 'select * from leds where id =' . $id;
  $sql = "select status from leds where id = '$id' limit 1";
  $rs = mysql_query($sql);
  
  if($row = mysql_fetch_object($rs)){
    $app->response()->header('Content-Type', 'application/json');
    // JSON格式输出
    echo json_encode( $row, JSON_NUMERIC_CHECK);
  } else {
    $app->response()->status(404);
  }
});

// POST /leds 创建一个LED设备
$app->post('/leds', function () use ($app) {    

  // 获得并解析获得的JSON数据包
  $request = $app->request();
  $body = $request->getBody();
  $input = json_decode($body); 
  
  $description = (string)$input->description;
  $status = (string)$input->status;
  
  // 连接数据库
  include 'conn.php';
  
  // 组装SQL语句
  $sql = "insert into leds(description,status) values('$description','$status')";
  
  // 查询数据库
  $result = @mysql_query($sql);
  if ($result){
    $app->response()->header('Content-Type', 'application/json');
    echo json_encode(array('success'=>true));
  } else {
    $app->response()->status(404);
    echo json_encode(array('success'=>false));
  }
});

// PUT /leds/:id 更新内容
$app->put('/leds/:id', function ($id) use ($app) {  
  
  // 获得HTTP请求中的JSON数据包
  $request = $app->request();
  $body = $request->getBody();
  $input = json_decode($body);   
  
  $description = (string)$input->description;
  $status = (string)$input->status;
  
  // 连接数据库
  include 'conn.php';
  
  // 组装SQL语句
  $sql = "update leds set description='$description',status='$status' where id='$id'";
  
  // 查询数据库
  $result = @mysql_query($sql);
  if ($result){
    echo json_encode(array('success'=>true));
  } else {
    echo json_encode(array('success'=>false));
  }
});

// PUT /leds/:id/status 更新内容
$app->put('/leds/:id/status', function ($id) use ($app) {  
  
  // 获得HTTP请求中的JSON数据包
  $request = $app->request();
  $body = $request->getBody();
  $input = json_decode($body);   
  
  // $description = (string)$input->description;
  $status = (string)$input->status;
  
  // 连接数据库
  include 'conn.php';
  
  // 组装SQL语句
  $sql = "update leds set status='$status' where id='$id'";
  
  // 查询数据库
  $result = @mysql_query($sql);
  if ($result){
    echo json_encode(array('success'=>true));
  } else {
    echo json_encode(array('success'=>false));
  }
});

// Delect /leds/:id   删除内容
$app->delete('/leds/:id', function ($id) use ($app) {  
  
  // 连接数据库
  include 'conn.php';
  
  // 组装SQL语句
  $sql = "delete from leds where id='$id'";
  
  // 查询数据库
  $result = @mysql_query($sql);
  if ($result){
    echo json_encode(array('success'=>true));
  } else {
    echo json_encode(array('success'=>false));
  }
});

$app->run();
