<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Типовые примеры");
?><p>В разделе <b>Типовые примеры</b> представлены следующие типовые операции:</p>

<ul>
  <li>Страница <strong>Меню</strong> создана с помощью компонента <b>Меню</b> (раздел <i>Служебные&ndash;&gt;Навигация</i>), 
который выводит меню указанного типа. Компонент содержит много предустановленных шаблонов и поэтому настройки компонента обширны, что 
позволяет создавать разные виды меню на сайте: левое меню без вложенности, 
горизонтальное многоуровневое выпадающее меню, представленные, например, на текущей странице. 
На странице <b>Меню</b> приведены примеры голубого меню в виде закладок, 
серого меню в виде закладок, древовидного меню. 
В шаблоне <i>Сайта компании</i> (<i>/site2/</i>) использовано вертикальное многоуровневое выпадающее меню.</li> 

  <li><b>Контролируемое скачивание</b>. В системе есть возможность организовать скачивание общедоступных файлов или файлов с ограниченным доступом с фиксацией этого события в модуле статистики; </li>

  <li><b>Импорт RSS</b>. Часто бывает необходимо организовать импорт RSS данных с другого сайта. 
Для публикации на сайте данных, получаемых в формате RSS, служит визуальный компонент <i>RSS новости (импорт)</i>, находящийся в разделе <i>Контент&ndash;&gt;RSS</i>. В настройках этого компонента указываются адрес сайта для импорта, порт, путь к rss файлу и др. </li>
</ul>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>