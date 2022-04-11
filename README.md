<h2>Установка проекта:</h2>
<p>1. Клонировать проект</p>
<p>2. Перейдите в приложение папки. Запустите composer install на вашем cmd или терминале</p>
<p>3. Скопируйте .env.example файл в .env в корневую папку. Вы можете ввести copy .env.example .env, если используете командную строку Windows или cp .env.example .env, если используете терминал Ubuntu</p>
<p>4. Откройте файл .env и измените имя базы данных (DB_DATABASE) на то, что у вас есть, имя пользователя (DB_USERNAME) и пароль (DB_PASSWORD) соответствуют вашей конфигурации.</p>
<p>5. Создайте в файле .env параметр <b>API_KEY</b> и задайте подпись маршрутов. Т.к. <b>API_KEY</b> используется и в GET запросах, он должжен содержать только допустимые в URL символы без пробелов!</p>
<p>6. Запустить php artisan key:generate</p>
<p>7. Запустить php artisan migrate -seed</p>
<table>
<tr><td>GET|HEAD</td>        <td>api/actor</td>                   <td>- вывести список актеров</td></tr>
<tr><td>POST</td>            <td>api/actor</td>                   <td>- создать нового актера (обязательный параметр: name)</td></tr>
<tr><td>GET|HEAD</td>        <td>api/actor/{actor}</td>           <td>- вывести подробную информацию об актере (обязательный параметр: id)</td></tr>
<tr><td>PUT|PATCH</td>       <td>api/actor/{actor}</td>           <td>- обновить информацию об актере (обязательный параметр: name)</td></tr>
<tr><td>DELETE</td>          <td>api/actor/{actor}</td>           <td>- удалить записи об актере, включая сводную таблицу (обязательный параметр: id)</td></tr>
<tr><td>GET|HEAD</td>        <td>api/actorsbymovie/{movie}</td>   <td>- вывести всех актеров, которые учавствуют в фильме (обязательный параметр: id)</td></tr>
<tr><td>GET|POST|HEAD</td>   <td>api/assignactor</td>             <td>- назначить актера на роль в фильме (обязательный параметр: movie_id, actor_id, role_name)</td></tr>
<tr><td>GET|POST|HEAD</td>   <td>api/unassignactor</td>           <td>- снять актера с роли в фильме (обязательный параметр: movie_id, actor_id)</td></tr>
<tr><td>GET|HEAD</td>        <td>api/movie</td>                   <td>- вывести список фильмов</td></tr>
<tr><td>POST</td>            <td>api/movie</td>                   <td>- создать новый фильм (обязательный параметр: name)</td></tr>
<tr><td>GET|HEAD</td>        <td>api/movie/{movie}</td>           <td>- вывести подробную информацию про фильм (обязательный параметр: id)</td></tr>
<tr><td>PUT|PATCH</td>       <td>api/movie/{movie}</td>           <td>- обновить информацию про фильм (обязательный параметр: name)</td></tr>
<tr><td>DELETE</td>          <td>api/movie/{movie}</td>           <td>- удалить записи про фильм, включая сводную таблицу (обязательный параметр: id)</td></tr>
<tr><td>GET|HEAD</td>        <td>api/moviesbyactor/{actor}</td>   <td>- вывести все фильмы, в которых учавствует актер (обязательный параметр: id)</td></tr>
<tr><td>POST</td>            <td>api/result</td>                  <td>- вывести результаты в зависимости от комманды (обязательный параметр: command)
command можжет принимать 2 значения (list - вывод списка всех фильмов с актерским составом,
search - включить поиск (доп.параметры: movie - контекстный поиск по названию фильма,
actor - контекстный поиск по имени актера, возможно комбинировать доп. параметрами),
orderby - название поля, по которому будет осуществляться сортировка результатов
(id, name, created_at, updated_at)
direct - направление сортировки (по-умолчаниию asc) (asc, desc)</td></tr></table>
<p><b>Важно! Все запросы подписываются ключом apikey!</b></p>                                              
