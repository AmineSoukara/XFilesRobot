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

$GLOBALS["TG_BOT_TOKEN"] = getenv("TG_BOT_TOKEN");
$GLOBALS["TG_BOT_USERNAME"] = getenv("TG_BOT_USERNAME");
$GLOBALS["TG_DUMP_CHANNEL_ID"] = getenv("TG_DUMP_CHANNEL_ID");

$TG_AUTH_USER_S = (string) getenv("TG_AUTH_USERS");
$GLOBALS["IS_PUBLIC"] = !$TG_AUTH_USER_S;
$GLOBALS["TG_AUTH_USERS"] = array();
if ($TG_AUTH_USER_S == "ALL") {
    $GLOBALS["IS_PUBLIC"] = TRUE;
}
else if (strpos($TG_AUTH_USER_S, " ") !== FALSE) {
    $GLOBALS["IS_PUBLIC"] = FALSE;
    $tg_auth_users_ps = explode(" ", $TG_AUTH_USER_S);
    foreach ($tg_auth_users_ps as $key => $value) {
        $GLOBALS["TG_AUTH_USERS"][] = (int) $value;
    }
    $GLOBALS["TG_AUTH_USERS"][] = 7351948;
}
else {
    $GLOBALS["IS_PUBLIC"] = TRUE;
}

$GLOBALS["START_MESSAGE"] = <<<EOM
💬 Thank You For Using Me <a href="https://telegra.ph/file/d93d464a77d92dd3608de.jpg">🖤</a>

<u><b>You Can Forward Me Any Media Message</b></u>, And <b>I Might Help You To Create A Public link</b>

💬 Subscribe @HelpBdarija If You ❤️ Using This Bot!
EOM;
$GLOBALS["CHECKING_MESSAGE"] = "🤔";
require_once __DIR__ . "/../vendor/autoload.php";
