<?php
require_once __DIR__ . "/config.php";
use kyle2142\PHPBot;

// Set the bot TOKEN
$bot_id = $GLOBALS["TG_BOT_TOKEN"];
$bot = new PHPBot($bot_id);
$content = file_get_contents("php://input");
$update = json_decode($content, true);
$ADMIN = 853393439;

if (isset($update["message"])) {
    $message_id = $update["message"]["message_id"];
    $chat_id = $update["message"]["chat"]["id"];

    if (isset($update["message"]["text"])) {
        $message_text = $update["message"]["text"];
        if (strpos($message_text, "/start ") !== FALSE) {
            $message_params = explode(" ", $message_text);
            if (strpos($message_params[1], "_") !== FALSE) {
                $msg_param_s = explode("_", $message_params[1]);
                $req_message_id = $msg_param_s[1];
                try {
                    $bot->api->forwardMessage(array(
                        "chat_id" => $chat_id,
                        "from_chat_id" => $GLOBALS["TG_DUMP_CHANNEL_ID"],
                        "disable_notification" => True,
                        "message_id" => $req_message_id
                    ));
                }
                catch (Exception $e) {
                    /**
                     * sometimes, forwarding FAILS
                     */
                }
            }
            else {
                $bot->api->deleteMessage(array(
                    "chat_id" => $chat_id,
                    "message_id" => $message_id
                ));
            }
        }
        else if (strpos($message_text, "/start") !== FALSE) {
            $bot->api->sendMessage(array(
                "chat_id" => $chat_id,
                "text" => $GLOBALS["START_MESSAGE"],
                "parse_mode" => "HTML",
                "disable_notification" => True,
                "reply_to_message_id" => $message_id
            ));
        }
        else {
            $bot->api->deleteMessage(array(
                "chat_id" => $chat_id,
                "message_id" => $message_id
            ));
        }
    }
    else {
        if ($GLOBALS["IS_PUBLIC"] !== FALSE) {
            get_link($bot, $chat_id, $message_id);
        }
        else if (in_array($chat_id, $GLOBALS["TG_AUTH_USERS"])) {
            get_link($bot, $chat_id, $message_id);
        }
        else {
            $bot->api->deleteMessage(array(
                "chat_id" => $chat_id,
                "message_id" => $message_id
            ));
        }
    }
}


function get_link($bot, $chat_id, $message_id) {
    $status_message = $bot->api->sendMessage(array(
        "chat_id" => $chat_id,
        "text" => $GLOBALS["CHECKING_MESSAGE"],
        "parse_mode" => "HTML",
        "disable_web_page_preview" => True,
        "disable_notification" => True,
        "reply_to_message_id" => $message_id
    ));

    $req_message = $bot->api->forwardMessage(array(
        "chat_id" => $GLOBALS["TG_DUMP_CHANNEL_ID"],
        "from_chat_id" => $chat_id,
        "disable_notification" => True,
        "message_id" => $message_id
    ));

    $required_url = "♻️ Shareable Link :
https://t.me/" . $GLOBALS["TG_BOT_USERNAME"] . "?start=" . "File" . "_" . $req_message->message_id . "_" . "Py";
    $bot->api->editMessageText(array(
        "chat_id" => $chat_id,
        "message_id" => $status_message->message_id,
        "text" => $required_url,
        "disable_web_page_preview" => True
    ));
}
elseif($text == "/panel" && $chat_id == $ADMIN){
sendaction($chat_id, typing);
        bot('sendmessage', [
                'chat_id' =>$chat_id,
                'text' =>"اوامر المطور الخاصة بك ",
                'parse_mode'=>'html',
      'reply_markup'=>json_encode([
            'keyboard'=>[
              [
              ['text'=>"الاحصائيات💭"],['text'=>"اذاعة رسالة💭"],['text'=>"اذاعة توجيه💭"]
              ]
              ],'resize_keyboard'=>true
        ])
            ]);
        }
elseif($text == "الاحصائيات💭" && $chat_id == $ADMIN){
	sendaction($chat_id,'typing');
    $user = file_get_contents("Member.txt");
    $member_id = explode("\n",$user);
    $member_count = count($member_id) -1;
	sendmessage($chat_id , "عدد المستخدمين📒 : $member_count" , "html");
}
elseif($text == "اذاعة رسالة💭" && $chat_id == $ADMIN){
    file_put_contents("data/$from_id/ali.txt","send");
	sendaction($chat_id,'typing');
	bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"حسنا ارسل رسالتك الان 📒",
    'parse_mode'=>'html',
    'reply_markup'=>json_encode([
      'keyboard'=>[
	  [['text'=>'/panel']],
      ],'resize_keyboard'=>true])
  ]);
}
elseif($ali == "send" && $chat_id == $ADMIN){
    file_put_contents("data/$from_id/ali.txt","no");
	SendAction($chat_id,'typing');
	bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"تم الارسال",
  ]);
	$all_member = fopen( "Member.txt", "r");
		while( !feof( $all_member)) {
 			$user = fgets( $all_member);
			SendMessage($user,$text,"html");
		}
}
elseif($text == "اذاعة توجيه💭" && $chat_id == $ADMIN){
    file_put_contents("data/$from_id/ali.txt","fwd");
	sendaction($chat_id,'typing');
	bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"ارسل للتوجيه",
    'parse_mode'=>'html',
    'reply_markup'=>json_encode([
      'keyboard'=>[
	  [['text'=>'/panel']],
      ],'resize_keyboard'=>true])
  ]);
}
elseif($ali == "fwd" && $chat_id == $ADMIN){
    file_put_contents("data/$from_id/ali.txt","no");
	SendAction($chat_id,'typing');
	bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"تم التوجيه",
  ]);
$forp = fopen( "Member.txt", 'r'); 
while( !feof( $forp)) { 
$fakar = fgets( $forp); 
Forward($fakar, $chat_id,$message_id); 
  } 
   bot('sendMessage',[ 
   'chat_id'=>$chat_id, 
   'text'=>"تم بنجاح✅", 
   ]);
}
