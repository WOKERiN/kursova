<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'phplocation';

// З'єднання з базою даних MySQL
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// Перевірка, чи передано ідентифікатор замовлення
if (isset($_POST['id'])) {
    $orderId = $_POST['id'];

    // Виконання запиту на видалення замовлення
    $query = "DELETE FROM startend WHERE id = $orderId";
    if (mysqli_query($con, $query)) {
        echo 'Замовлення успішно видалено!';
    } else {
        echo 'Помилка при видаленні замовлення: ' . mysqli_error($con);
    }
} else {
    echo 'Не передано ідентифікатор замовлення!';
}

mysqli_close($con);
?>
