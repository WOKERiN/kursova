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

// Отримання даних з таблиці `trips`
$query = 'SELECT * FROM startend';
$result = mysqli_query($con, $query);

if ($result) {
    // Виведення отриманих даних
    echo '<table>';
    echo '<tr><th><span style="font-size: 50px;">Start Point</span></th><th><span style="font-size: 50px;">End Point</span></th></tr>';

    
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td><span style="font-size: 50px;">' . $row['start'] . '</span></td>';
        echo '<td><span style="font-size: 50px;">' . $row['end'] . '</span></td>';
        echo '<td><button onclick="acceptOrder(this)">Прийняти замовлення</button></td>';
        echo '<td><button onclick="orderEnd(this, ' . $row['id'] . ')" disabled>завершити замовлення</button></td>';
        echo '</tr>';
    }
    
    echo '</table>';
} else {
    echo 'Помилка при отриманні даних: ' . mysqli_error($con);
}

mysqli_close($con);
?>
<script>
    function acceptOrder(button) {
        button.innerHTML = 'Замовлення прийнято';
        button.disabled = true;
        
        // Активувати кнопку "завершити замовлення"
        var orderEndButton = button.parentNode.nextSibling.firstChild;
        orderEndButton.disabled = false;
    }
</script>
<script>
function orderEnd(button, id) {
        button.innerHTML = 'Замовлення завершено';
        button.disabled = true;
        
        // Виклик функції для видалення замовлення з бази даних
        deleteOrder(id);
    }
    
    function deleteOrder(id) {
        // Відправка AJAX-запиту для видалення замовлення
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'delete_order.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                console.log(xhr.responseText);
            }
        };
        xhr.send('id=' + id);
    }
</script>