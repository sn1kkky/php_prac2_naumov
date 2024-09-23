<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<style>
    body {
        font-family: Arial, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #f4f4f4;
    }
    form {
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    label, input {
        display: block;
        margin-bottom: 10px;
        width: 100%;
    }
    input {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }
    button {
        padding: 10px 15px;
        background-color: #3498db;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    button:hover {
        background-color: #2980b9;
    }
    .error {
        color: red;
        margin-bottom: 10px;
    }
    .success {
        color: green;
        margin-bottom: 10px;
    }
</style>

<?php
    $nameErr = $emailErr = $phoneErr = "";
    $name = $email = $phone = "";
    $formValid = true;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $nameErr = "Имя обязательно для заполнения";
            $formValid = false;
        } elseif (strlen($_POST["name"]) < 2) {
            $nameErr = "Имя должно быть не короче 2 символов";
            $formValid = false;
        } else {
            $name = test_input($_POST["name"]);
        }

        if (empty($_POST["email"])) {
            $emailErr = "Email обязателен для заполнения";
            $formValid = false;
        } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Неверный формат email";
            $formValid = false;
        } else {
            $email = test_input($_POST["email"]);
        }

        if (empty($_POST["phone"])) {
            $phoneErr = "Телефон обязателен для заполнения";
            $formValid = false;
        } elseif (strlen($_POST["phone"]) != 10) {
            $phoneErr = "Телефон должен содержать 10 цифр";
            $formValid = false;
        } else {
            $phone = test_input($_POST["phone"]);
        }

        if ($formValid) {
            echo "<p class='success'>Форма успешно отправлена!</p>";
        }
    }
    
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="name">Имя:</label>
        <input type="text" id="name" name="name" value="<?php echo $name;?>">
        <span class="error"><?php echo $nameErr;?></span>

        <label for="email">Email:</label>
        <input type="text" id="email" name="email" value="<?php echo $email;?>">
        <span class="error"><?php echo $emailErr;?></span>

        <label for="phone">Телефон:</label>
        <input type="text" id="phone" name="phone" value="<?php echo $phone;?>">
        <span class="error"><?php echo $phoneErr;?></span>

        <button type="submit">Отправить</button>
    </form>

</body>
</html>
