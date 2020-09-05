<?php
$TOKEN ="878442257:AAF-ZcEOpkFldtKVawq-LMMC1N92caNKq_U";  
if($text&&$from_id==$admin){$from_id = $message->from->id;
$join = file_get_contents("https://api.telegram.org/bot".$TOKEN."/getChatMember?chat_id=@HelpBdarija&user_id=".$from_id);
$join2 = file_get_contents("https://api.telegram.org/bot".$TOKEN."/getChatMember?chat_id=@MarsMusicTM&user_id=".$from_id);
$join3 = file_get_contents("https://api.telegram.org/bot".$TOKEN."/getChatMember?chat_id=@SeriesBdarija&user_id=".$from_id);
if($message && (strpos($join,'"status":"left"') or strpos($join2,'"status":"left"') or strpos($join3,'"status":"left"') or strpos($join,'"Bad Request: USER_ID_INVALID"') or strpos($join,'"status":"kicked"'))!== false&& $chat_id=="$admin"){
bot('sendMessage', [
'chat_id'=>$chat_id,
'text'=>"- اهلا بك عزيزي 🔱 -
- ليمكنك استخدام البوت ✅ -
- عليك الاشتراك في القناة 🔽 -
- @HelpBdarija ⚜️     
 <a href='https://t.me/HelpBdarija>اضغط للاشتراك🔕</a>
- @MarsMusicTM
 <a href='https://t.me/MarsMusicTM>اضغط للاشتراك 🔕</a>
",
'disable_web_page_preview'=> true ,
 'parse_mode'=>"HTML",
]);return false;}
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>" ",
'reply_to_message_id'=>$message->$message_id,
]);
}

require_once __DIR__ . "/config.php";
use kyle2142\PHPBot;

// Set the bot TOKEN
$bot_id = $GLOBALS["TG_BOT_TOKEN"];
$bot = new PHPBot($bot_id);
$content = file_get_contents("php://input");
$update = json_decode($content, true);

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
