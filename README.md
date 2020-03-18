# Mediasoft PHP
Академия разработки MediaSoft курс PHP
# Линкевич Константин. группа 1.
## Итоговое задание. Сервис загрузки изображений

<p>При разрабоке использовался фреймворк Laravel, точка входа /public/index.php</p>
<p>Авторизация пользователя производится встроенным в фреймворк модулем Auth</p>

### Добавленные мной компоненты - 
<p> Контроллеры:</p>
<ul>
  <li>PictureController</li>
  <li>TagController</li>
  <li>FileController</li>
 </ul> 
  <p> Модели </p>
<ul>
  <li>Picture</li>
  <li>Tag</li>  
 </ul> 
  
  <p> Представления </p>
<ul>
   <li>app.blade.php - основной шаблон</li> 
  <li>upload.blade.php шаблон для загрузки</li>
  <li>edit.blade.php шаблон для редактироания </li>
  <li>index.blade.php шаблон списка изображений</li>
  <li>show.blade.php просмотр отдельного изображения</li>
 </ul> 
 <p>добавлена локализация lang/ru/validation</p>
 Изменены роуты: web.php
 <p>добавлен javascript для поиска по тегам(search.js)
  и отображения множественного выбора файлов (main.js )</p>
 
  <p>Таблицы базы данных: pictures, tags, picture_tag. (структура таблиц в файле finaltask.sql)
 Отношение многие к многим поддерживается в приложении </p>
 
  
  Работу сервиса можно посмотреть [здесь](http://mytestkvl.c1.biz/)
<hr>  
