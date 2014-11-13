<?php
$servername = "localhost";
$username = "root";
$password = "root";
$database_name = "journal";

//LINK OPEN
$link = mysql_connect($servername, $username, $password)
    or die('Не удалось соединиться: ' . mysql_error());
echo 'Соединение успешно установлено' . "\n";


//DATABASE
$sql = 'DROP DATABASE '.$database_name;
if (mysql_query($sql, $link)) {
    echo "База данных ".$database_name." была успешно удалена\n";
} else {
    echo 'Ошибка при удалении базы данных: ' . mysql_error() . "\n";
}
$sql = 'CREATE DATABASE '.$database_name.' CHARACTER SET utf8 COLLATE utf8_general_ci';
if (mysql_query($sql, $link)) {
    echo "База ".$database_name." успешно создана\n";
} else {
    echo 'Ошибка при создании базы данных: ' . mysql_error() . "\n";
}
mysql_select_db($database_name) or die('Could not select database');

mysql_query("SET NAMES 'utf8'"); 
mysql_query("SET CHARACTER SET 'utf8'");


function generateRandomUnitName() {
    
    $firstNames = array(
        "Александр",
        "Анастасия",
        "Максим",
        "Мария",
        "Иван",
        "Дарья",
        "Артём",
        "Анна",
        "Никита",
        "Елизавета",
        "Дмитрий",
        "Виктория",
        "Егор",
        "Полина",
        "Даниил",
        "Екатерина",
        "Михаил",
        "Софья",
        "Андрей",
        "Александра",
        "Алексей",
        "Ксения",
        "Илья",
        "София",
        "Кирилл",
        "Арина",
        "Сергей",
        "Алина",
        "Владислав",
        "Вероника",
        "Роман",
        "Варвара",
        "Владимир",
        "Валерия",
        "Тимофей",
        "Кристина",
        );
 
    $secondNames = array(
        "Иванов",
        "Васильев",
        "Петров",
        "Смирнов",
        "Михайлов",
        "Фёдоров",
        "Соколов",
        "Яковлев",
        "Попов",
        "Андреев",
        "Алексеев",
        "Александров",
        "Лебедев",
        "Григорьев",
        "Степанов",
        "Семёнов",
        "Павлов",
        "Богданов",
        "Николаев",
        "Дмитриев",
        "Егоров",
        "Волков",
        "Кузнецов",
        "Никитин",
        "Соловьёв",
        "Тимофеев",
        "Орлов",
        "Афанасьев",
        "Филиппов",
        "Сергеев",
        "Захаров",
        "Матвеев",
        "Виноградов",
        "Кузьмин",
        "Максимов",
        "Козлов",
        "Ильин",
        "Герасимов",
        "Марков",
        "Новиков",
        "Морозов",
        );
    
    $randomFullname = '';
    $firstNameNum = rand(1, count($firstNames)-1);
    $randomFullname .= $firstNames[$firstNameNum];
    $randomFullname .= " ";
    $randomFullname .= $secondNames[rand(1, count($secondNames)-1)];
    if($firstNameNum % 2 == 1)
        $randomFullname .= "а";
    
    return $randomFullname;
}


function getSubjectName($num) {
   
    $names = array(
        "Математика",
        "Алгебра",
        "Геометрия",
        "Информатика",
        "Природоведение",
        "История",
        "Биология",
        "Физика",
        "Химия",
        "Экология",
        "Обществознание",
        "Правоведение",
        "Русский язык",
        "Литература",
        "Иностранный язык",
        "Труд",
        "Черчение",
        "Физическая культура",
        "Изобразительное искусство",
        "Музыка",
    );
    
    $num = $num % count($names);
    return $names[$num];
}


//TABLE GRADE
$table_name = "grade";
echo $table_name.' Table:' . "\n";
$sql = "CREATE TABLE ".$table_name." (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT UNIQUE,
    level SMALLINT NOT NULL,
    prefix varchar(50))";
$retval = mysql_query( $sql, $link );
if(! $retval )
{
  die('Could not create database: ' . mysql_error());
}
echo "Database ".$table_name." created successfully\n";

for ($i = 1; $i <= 10; $i++) {
    
    $prefix = '';
    $rand = rand(1, 3);
    if($rand == 1) {$prefix = 'а';}
    if($rand == 2) {$prefix = 'б';}
    
    $sql = 'INSERT INTO '.$table_name.' (id,level, prefix) '.
       'VALUES ( '.$i.','.$i.', "'.$prefix.'" )';

    $retval = mysql_query( $sql, $link );
    if(! $retval )
    {
      die('Could not enter data: ' . mysql_error());
    }
    
    echo $i;
}
echo "\n";

//TABLE UNIT
$table_name = "unit";
echo $table_name.' Table:' . "\n";
$sql = "CREATE TABLE ".$table_name." (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT UNIQUE,
    grade_id INT NOT NULL,
    fullname varchar(50) NOT NULL)";
$retval = mysql_query( $sql, $link );
if(! $retval )
{
  die('Could not create database: ' . mysql_error());
}
echo "Database ".$table_name." created successfully\n";

for ($i = 1; $i <= 50; $i++) {

    $grade_id = rand(1, 10);
    $fullname = generateRandomUnitName();
    
    $sql = 'INSERT INTO '.$table_name.' (id,grade_id,fullname) '.
       'VALUES ( '.$i.','.$grade_id.', "'.$fullname.'" )';

    $retval = mysql_query( $sql, $link );
    if(! $retval )
    {
      die('Could not enter data: ' . mysql_error());
    }
    
    echo $i;
}
echo "\n";

//TABLE SUBJECT
$table_name = "subject";
echo $table_name.' Table:' . "\n";
$sql = "CREATE TABLE ".$table_name." (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT UNIQUE,
    name varchar(50) NOT NULL)";
$retval = mysql_query( $sql, $link );
if(! $retval )
{
  die('Could not create database: ' . mysql_error());
}
echo "Database ".$table_name." created successfully\n";

for ($i = 1; $i <= 20; $i++) {

    $name = getSubjectName($i);

    $sql = 'INSERT INTO '.$table_name.' (id,name) '.
       'VALUES ( '.$i.', "'.$name.'" )';

    $retval = mysql_query( $sql, $link );
    if(! $retval )
    {
      die('Could not enter data: ' . mysql_error());
    }            

    echo $i;
}
echo "\n";

//TABLE LESSON
$table_name = "lesson";
echo $table_name.' Table:' . "\n";
$sql = "CREATE TABLE ".$table_name." (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT UNIQUE,
    grade_id INT NOT NULL,
    subject_id INT NOT NULL,
    date DATE NOT NULL)";
$retval = mysql_query( $sql, $link );
if(! $retval )
{
  die('Could not create database: ' . mysql_error());
}
echo "Database ".$table_name." created successfully\n";

for ($grade_id = 1; $grade_id <= 10; $grade_id++) {
    
    for ($subject_id = 1; $subject_id <= 20; $subject_id++) {
        
        if(rand(1,3) != 1) {continue;}
        
        for ($day = -5; $day <= 5; $day++) {
            
            if(rand(1,3) == 1) {continue;}
            
            $date = date("Y-m-d",  strtotime($day." days",time()));
            echo $date."\n";
            
            
            $sql = 'INSERT INTO '.$table_name.' (grade_id,subject_id,date) '.
               'VALUES ( '.$grade_id.','.$subject_id.', "'.$date.'" )';

            $retval = mysql_query( $sql, $link );
            if(! $retval )
            {
              die('Could not enter data: ' . mysql_error());
            }   
            
        }
            
    }
    echo "\n";
}




//TABLE MARK
$table_name = "mark";
echo $table_name.' Table:' . "\n";
$sql = "CREATE TABLE ".$table_name." (
    unit_id INT NOT NULL,
    lesson_id INT NOT NULL,
    value SMALLINT)";
$retval = mysql_query( $sql, $link );
if(! $retval )
{
  die('Could not create database: ' . mysql_error());
}
echo "Database ".$table_name." created successfully\n";

for ($grade_id = 1; $grade_id <= 10; $grade_id++) {
    $query = 'SELECT id FROM lesson WHERE grade_id="'.$grade_id.'"';
    $result = mysql_query($query);
    if (!$result) {
        $message  = 'Неверный запрос: ' . mysql_error() . "\n";
        $message .= 'Запрос целиком: ' . $query;
        die($message);
    }
    $lessons = $result;

    $query = 'SELECT id FROM unit WHERE grade_id="'.$grade_id.'"';
    $result = mysql_query($query);
    if (!$result) {
        $message  = 'Неверный запрос: ' . mysql_error() . "\n";
        $message .= 'Запрос целиком: ' . $query;
        die($message);
    }
    $units = $result;
    
    $arrLessons = array();
    while ($lesson = mysql_fetch_assoc($lessons)) {
        $arrLessons[] = $lesson; // Inside while loop
    }

    while ($unit = mysql_fetch_assoc($units)) {
        echo "Unit ".$unit['id'].": ";
        foreach($arrLessons as $lesson) {
            if(rand(1,8) == 1) {continue;}
            
            $mark = rand(2,5);
            $sql = 'INSERT INTO '.$table_name.' (unit_id,lesson_id,value) '.
               'VALUES ( '.$unit['id'].','.$lesson['id'].', "'.$mark.'" )';

            $retval = mysql_query( $sql, $link );
            if(! $retval )
            {
              die('Could not enter data: ' . mysql_error());
            }             
            
            echo $mark;
        }
        echo "\n";
    }
}
echo "\n";


//LINK CLOSE
mysql_close($link);
