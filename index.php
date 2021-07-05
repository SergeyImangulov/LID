<!DOCTYPE html>
<html lang = "ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Форма заявления</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">

</head>
<body>
  <h1>Форма заявления</h1>
     <form method="post" action="">
            <input type="text" name="first_name" size="15" placeholder="Введите имя" value="<?=$defaults['first_name']?>" required><br>
            <input type="text" name="last_name" size="15" placeholder="Введите фамилию" value="<?=$defaults['last_name']?>"><br>
            <input type="email" name="email" placeholder="Введите Email" value="<?=$defaults['email']?>"><br>
            <textarea name="comments" placeholder="Введите сообщение" cols="40" rows="3" value="<?=$defaults['comments']?>"></textarea><br>
            <input type="hidden" name="saved" value="yes">
            <input type="submit" value="Отправить">
    </form>
</body>
</html>
<?
/**
 * Write data to log file.
 *
 * @param mixed $data
 * @param string $title
 *
 * @return bool
 */
function writeToLog($data, $title = '') {
 $log = "\n------------------------\n";
 $log .= date("Y.m.d G:i:s") . "\n";
 $log .= (strlen($title) > 0 ? $title : 'DEBUG') . "\n";
 $log .= print_r($data, 1);
 $log .= "\n------------------------\n";
 file_put_contents(getcwd() . '/hook.log', $log, FILE_APPEND);
 return true;
}

$defaults = array('first_name' => '', 'last_name' => '', 'phone' => '', 'email' => '');

if (array_key_exists('saved', $_REQUEST)) {
 $defaults = $_REQUEST;
 writeToLog($_REQUEST, 'webform');

 $queryUrl = '...'; // Here is the url of your incoming webhook using the generated crm.lead.add method
 $queryData = http_build_query(array(
 'fields' => array(
 "TITLE" => 'Заявка от'.' '.$_REQUEST['first_name'].' '.$_REQUEST['last_name'],
 "NAME" => $_REQUEST['first_name'],
 "LAST_NAME" => $_REQUEST['last_name'],
 "COMMENTS" => $_REQUEST['comments'],
 "SOURCE_ID" => "CRM",
 "STATUS_ID" => "NEW",
 "OPENED" => "Y",
 "ASSIGNED_BY_ID" => 1,
 "PHONE" => array(array("VALUE" => $_REQUEST['phone'], "VALUE_TYPE" => "WORK" )),
 "EMAIL" => array(array("VALUE" => $_REQUEST['email'], "VALUE_TYPE" => "WORK" )),
 ),
 'params' => array("REGISTER_SONET_EVENT" => "Y")
 ));

 $curl = curl_init();
 curl_setopt_array($curl, array(
 CURLOPT_SSL_VERIFYPEER => 0,
 CURLOPT_POST => 1,
 CURLOPT_HEADER => 0,
 CURLOPT_RETURNTRANSFER => 1,
 CURLOPT_URL => $queryUrl,
 CURLOPT_POSTFIELDS => $queryData,
 ));

 $result = curl_exec($curl);
 curl_close($curl);

 $result = json_decode($result, 1);
 writeToLog($result, 'webform result');

 if (array_key_exists('error', $result)) echo "Ошибка при сохранении лида: ".$result['error_description']."<br/>";
}

?>
