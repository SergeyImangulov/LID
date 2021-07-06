<!DOCTYPE html>
<html lang = "ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Форма заявления</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <? require_once "WriteToLog.php"?>
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
