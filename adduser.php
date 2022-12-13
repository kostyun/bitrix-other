Создаем файл:

<?php

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$newlogin = 'newadmin';
$newemail = 'newadmin@myorg.ru';
$newpassword = 'newpassword';
$group = array(1);
$user = new CUser;
$arFields = array(
  "EMAIL"             => $newemail,
  "LOGIN"             => $newlogin,
  "LID"               => "ru",
  "ACTIVE"            => "Y",
  "GROUP_ID"          => $group,
  "PASSWORD"          => $newpassword,
  "CONFIRM_PASSWORD"  => $newpassword
);

$ID = $user->Add($arFields);

if(intval($ID) > 0) echo 'New admin user is created';
else echo $user->LAST_ERROR;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");

?>

В файле add_admin.php не забудьте отредактировать значения переменных $newlogin,$newemail и $newpassword на свои.
Далее открываем файл в браузере http://mybitrix.ru/bitrix/add_admin.php, должно выдать «New admin user is created», после заходим в http://mybitrix.ru/bitrix/admin/ с данными anewadmin/newpassword

P.S. Если разработчики сайта внесли в профиль создаваемых пользователей новое обязательное для регистрации поле, то ищем его название и значение и прописываем в массив $arFields, например было создано новое обязательное свойство у пользователя UF_USER_TYPE, тогда $arFields будет выглядеть так:
просмотреть источник
распечатать
?
$arFields = array(
  "EMAIL"             => $newemail,
  "LOGIN"             => $newlogin,
  "LID"               => "ru",
  "ACTIVE"            => "Y",
  "GROUP_ID"          => $group,
  "PASSWORD"          => $newpassword,
  "CONFIRM_PASSWORD"  => $newpassword,
  "UF_USER_TYPE"      => "0"
);
