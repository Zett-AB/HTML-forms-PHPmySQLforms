<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Передача данных из HTML-форм в БД MySQL</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="normalize.css">
</head>
<body>
    <header class="title">
        <h1>Пишем код для передачи данных из HTML-форм в базу данных MySQL</h1>
        
            <?php
                $nickname=" Александр!";
                $hello="Привет, ";
                $hellow="Продолжаем изучение кода на PHP  и работы My SQL";
                echo "<h2>".$hello.$nickname."<br>".$hellow."</h2>";
            ?>
        
    </header>
    <div class="descr">
        <h2 class="subtitle">Создадим разметку и форму HTML</h2>
            <div class="forms">
                <form method="POST" action="">
                    <input name="name" type="text" placeholder="Имя"/>
                    <input name="text" type="text" placeholder="Текст"/>
                    <input type="submit" value="Отправить"/>
                </form>
            </div>
        <h2 class="subtitle">Теперь пишем код на PHP</h2>
            <?php
                if (isset($_POST['name']) && isset($_POST['text'])){
                    // Переменные с формы
                    $name = $_POST['name'];
                    $text = $_POST['text'];
                    
                    // Параметры для подключения
                    $db_host = "localhost"; 
                    $db_user = "root"; // Логин БД
                    $db_password = ""; // Пароль БД
                    $db_base = 'mybd'; // Имя БД
                    $db_table = "mytb"; // Имя Таблицы БД
                    
                    try {
                        // Подключение к базе данных
                        $db = new PDO("mysql:host=$db_host;dbname=$db_base", $db_user, $db_password);
                        // Устанавливаем корректную кодировку
                        $db->exec("set names utf8");
                        // Собираем данные для запроса
                        $data = array( 'name' => $name, 'text' => $text ); 
                        // Подготавливаем SQL-запрос
                        $query = $db->prepare("INSERT INTO $db_table (name, text) values (:name, :text)");
                        // Выполняем запрос с данными
                        $query->execute($data);
                        // Запишим в переменую, что запрос отрабтал
                        $result = true;
                    } catch (PDOException $e) {
                        // Если есть ошибка соединения или выполнения запроса, выводим её
                        print "Ошибка!: " . $e->getMessage() . "<br/>";
                    }
                    
                    if ($result) {
                        echo "Успех. Информация занесена в базу данных";
                    }
                }
            ?>
            <div class="descr">
                <p>На PHP пишем следующий код в стиле ООП:</p>
                <p>
                    <ul>
                        <li>//Первым пишем условие о проверке - есть ли в HTML-форме значение</li>
                        <li>if (isset($_POST['name']) && isset($_POST['text'])){</li>
                        <li>далее создаем переменные с формы</li>
                        <li>// Переменные с формы</li>
                        <li>$name = $_POST['name'];</li>
                        <li>$text = $_POST['text'];</li>
                        <li>Затем параметры для подключения нашей БД</li>
                        <li>// Параметры для подключения</li>
                        <li>$db_host = "localhost";</li>
                        <li>$db_user = "root"; // Логин БД</li>
                        <li>$db_password = ""; // Пароль БД</li>
                        <li>$db_base = 'mybd'; // Имя БД</li>
                        <li>$db_table = "mytb"; // Имя Таблицы БД</li>
                        <li>Далее пишем подключение к БД, устанавливаем корректную кодировку БД, собираем данные с запроса(т.е. форм), подготавливаем(формируем) SQL-запрос, выполняем запрос с данными(т.е. помещаем данные в БД).<br>Проводим проверку выполнения/отработки запроса/помещения данных в БД.</li>
                        <li>try {</li>
                        <li>// Подключение к базе данных</li>
                        <li>$db = new PDO("mysql:host=$db_host;dbname=$db_base", $db_user, $db_password);</li>
                        <li>// Устанавливаем корректную кодировку</li>
                        <li>$db->exec("set names utf8");</li>
                        <li>// Собираем данные для запроса</li>
                        <li>$data = array( 'name' => $name, 'text' => $text );</li>
                        <li>// Подготавливаем SQL-запрос</li>
                        <li> $query = $db->prepare("INSERT INTO $db_table (name, text) values (:name, :text)");</li>
                        <li>// Выполняем запрос с данными</li>
                        <li>$query->execute($data);</li>
                        <li>// Запишим в переменую, что запрос отрабтал</li>
                        <li>$result = true;</li>
                        <li>} catch (PDOException $e) {</li>
                        <li> // Если есть ошибка соединения или выполнения запроса, выводим её
                        print "Ошибка!: " . $e->getMessage() . "br/>";</li>
                        <li>}</li>
                        <li>if ($result) {</li>
                        <li>echo "Успех. Информация занесена в базу данных";</li>
                        <li>}</li>
                        <li>}</li>
                    </ul>
                </p>
                <p></p>
                <p></p>
            </div>
    </div>
    
</body>
</html>