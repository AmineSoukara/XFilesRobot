<?php
$chid1 = "-1001261412448"; ايدي قناتك يجب ان يبداء ب -100
$export = json_decode(file_get_contents("https://api.telegram.org/bot".API_KEY."/getchat?chat_id=$chid1"));
$linkchannel = $export->result->invite_link;
$joinmad = file_get_contents("https://api.telegram.org/bot".API_KEY."/getChatMember?chat_id=$chid1&user_id=".$from_id);
if($message && (strpos($joinmad,'"status":"left"') or strpos($joinmad,'"Bad Request: USER_ID_INVALID"') or strpos($joinmad,'"status":"kicked"'))!== false){
bot('sendmessage',[
'chat_id'=>$chat_id,
    'text'=>"▫️ يجب عليك الإشتراك في قناة البوت أولاً ⚜️؛
▪️ $linkchannel
◼️ إشترك في القناة ثم أرسل /start ، 📛" ,
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'• قناة المطور✅' ,'url'=>$linkchannel]
]
]])
]); return false;}

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
