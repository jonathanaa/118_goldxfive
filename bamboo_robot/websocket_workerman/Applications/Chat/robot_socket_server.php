<?php
use Workerman\Worker;
use \Workerman\Lib\Timer;
require_once __DIR__ . '/../../vendor/autoload.php';

$worker = new Worker("websocket://0.0.0.0:9999");

// 只能設定一個進程，因為需要向特定用戶發送訊息
$worker->count = 1;

//用戶的UID資料
$worker->uidConnections = array();




// 当收到客户端发来的数据后返回hello $data给客户端
$worker->onMessage = function($connection, $message){
    //宣告全域變數
    global $worker;
    //將資料做成JSON
    $message_data = json_decode($message, true);

    

    if(!$message_data){
        return ;
    }

    // 判断当前客户端是否已经验证,即是否设置了uid
    if(!isset($connection->uid))
    {
       // 没验证的话把第一个包当做uid（这里为了方便演示，没做真正的验证）
       $connection->uid = $message_data['name'];
       /* 保存uid到connection的映射，这样可以方便的通过uid查找connection，
        * 实现针对特定uid推送数据
        */
       $worker->uidConnections[$connection->uid] = $connection;
       $message = "connect success!!!";
       $connection->send($message);
    }

    // 客户端登录 message格式: {type:xx, dialogue:xx,status:xx} 
    switch($message_data['type']){
        case 'nlp':
            echo "get nlp \n";
            $new_message = array(
                "type"=>"nlp",
                "dialogue"=>$message_data['dialogue']
                );
            sendMessageByUid('nlp',json_encode($new_message));
            break;
        case 'nlp_done':
            echo "get nlp_done \n";
            $new_message = array(
                "type"=>"nlp_done",
                "data"=>$message_data['data']
                );
            sendMessageByUid('web',json_encode($new_message));
            break;
    	case 'pong':
            echo (string)$message_data['name'];
            echo "is alive \n";
            break;
        case 'login':
            echo (string)$message_data['name'];
            echo "is connecting \n";
    		$new_message = array('type'=>$message_data['type'],'dialogue'=>'connect success');
    		sendMessageByUid($connection->uid,json_encode($new_message));
    		break;
    	case 'come':
            echo "\n someone come";
    		$new_message = array('type'=>$message_data['type'],'dialogue'=>'有甚麼需要幫忙的嗎');
    		sendMessageByUid('web',json_encode($new_message));
    		return;
        case 'leave':
            echo "\npeople leave";
            $new_message = array('type'=>'run');
            sendMessageByUid('camera',json_encode($new_message));
            return;
        case 'camera':
            echo $message_data['status'];
            $new_message = array('type'=>'come','dialogue'=>'有甚麼需要幫忙的嗎');
            sendMessageByUid('web',json_encode($new_message));
            return;
        case 'picuture':
            echo "picture";
            $test = shell_exec("C:\\xampp\\htdocs\\118\\bamboo_robot\\img\\bamboo_computer_picture\\upload.bat");
            echo"upload success!!!";
            $new_message = array('type'=>'upload_picture');
            sendMessageByUid('web',json_encode($new_message));
            return;
    }

};

// 进程启动后设置一个每秒运行一次的定时器


$worker->onClose = function($connection){
    //宣告全域變數
    global $worker;

    if(isset($connection->uid))
    {
        // 连接断开时删除映射
        unset($worker->uidConnections[$connection->uid]);
    }
    //sendMessageByUid($connection->uid,'shutdown');
    echo "someone shutdown";
};

$worker->onWorkerStart = function($worker)
{
    // 每3秒执行一次=>心跳很重要，不能刪
    
    Timer::add(3, function()
    {
        echo "pong\n";
        $new_message=array('type'=>'pong');
        $new_message_nlp=array('type'=>'pong','status'=>'run','dialogue'=>'initial');
        
        sendMessageByUid('web',json_encode($new_message));
        sendMessageByUid('camera',json_encode($new_message));
        sendMessageByUid('nlp',json_encode($new_message_nlp));
    });
};


function sendMessageByUid($uid, $message){
    //宣告全域變數
    global $worker;

    if(isset($worker->uidConnections[$uid]))
    {
        $connection = $worker->uidConnections[$uid];
        $connection->send($message);
    }
}


// 运行worker
Worker::runAll();