<?php
// З'єднання з базою даних MySQL
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'phplocation';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// Перевірка, чи були передані дані з форми
if (isset($_POST['start'], $_POST['end'])) {
    $start = $_POST['start'];
    $end = $_POST['end'];

    // Вставка даних у таблицю `trips`
    $stmt = $con->prepare('INSERT INTO startend (start, end) VALUES (?, ?)');
    $stmt->bind_param('ss', $start, $end);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header('Location: 7.html');
    } else {
        echo 'Помилка при збереженні даних: ' . $stmt->error;
    }

    $stmt->close();
}

mysqli_close($con);
?>
