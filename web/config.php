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
