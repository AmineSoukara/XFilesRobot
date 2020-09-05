<?php
$SAIED0 = "Helpbdarija"; //معرف القناة الاولى او ايدي القناة للقنوات الخاص
$SAIED1 = "MarsMusicTM"; //معرف القناة الثانية او ايدي القنا للقنوات الخاصة
$Token = "878442257:AAF-ZcEOpkFldtKVawq-LMMC1N92caNKq_U"; // توكن بوتك
$SAIED20 = json_decode(file_get_contents('php://input'));
$SAIED18 = $SAIED20->message;
$SAIED13 = $SAIED18->chat->id;
$SAIED9 = file_get_contents("https://api.telegram.org/bot".$Token."/getChatMember?chat_id=$SAIED0&user_id=".$SAIED13);
$SAIED10 = file_get_contents("https://api.telegram.org/bot".$Token."/getChatMember?chat_id=$SAIED1&user_id=".$SAIED13);
if($SAIED18 && (strpos($SAIED9,'"status":"left"') or strpos($SAIED9,'"Bad Request: USER_ID_INVALID"') or strpos($SAIED9,'"status":"kicked"') or strpos($SAIED10,'"status":"left"') or strpos($SAIED10,'"Bad Request: USER_ID_INVALID"') or strpos($SAIED10,'"status":"kicked"'))!== false){
bot('sendMessage', [
'chat_id'=>$SAIED13,
'text'=>'- اشترك في قنوات البوت أولا لتتمكن من إستخدامه 🤖".

'.$SAIED0.'
'.$SAIED1,
]);return false;}

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
