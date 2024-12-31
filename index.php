<?php
// ملف الاتصال بقاعدة البيانات
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "farmers_platform";

// إنشاء الاتصال
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

// تسجيل الدخول
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $login_username = htmlspecialchars($_POST['username']);
    $login_password = htmlspecialchars($_POST['password']);

    $sql = "SELECT * FROM users WHERE username = '$login_username' AND password = '$login_password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<script>alert('تم تسجيل الدخول بنجاح!');</script>";
    } else {
        echo "<script>alert('اسم المستخدم أو كلمة المرور غير صحيحة.');</script>";
    }
}

// إنشاء الحساب
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $register_username = $_POST['username'];
    $register_password = $_POST['password'];

    $hashed_password = password_hash($register_password, PASSWORD_DEFAULT); // تشفير كلمة المرور

    $sql = "INSERT INTO users (username, password) VALUES ('$register_username', '$hashed_password')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('تم إنشاء الحساب بنجاح!');</script>";
    } else {
        echo "<script>alert('حدث خطأ أثناء إنشاء الحساب.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>منصة المزارعين</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <!-- نموذج تسجيل الدخول -->
                <div id="login-form" class="form-container">
                    <h2 class="text-center">تسجيل الدخول</h2>
                    <form method="POST">
                        <div class="form-group">
                            <label for="username">اسم المستخدم</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">كلمة المرور</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" name="login">تسجيل الدخول</button>
                    </form>
                    <div class="text-center mt-3">
                        <p>ليس لديك حساب؟ <a href="javascript:void(0);" onclick="toggleForms()">إنشاء حساب جديد</a></p>
                    </div>
                </div>

                <!-- نموذج إنشاء الحساب -->
                <div id="register-form" class="form-container" style="display: none;">
                    <h2 class="text-center">إنشاء حساب جديد</h2>
                    <form method="POST">
                        <div class="form-group">
                            <label for="username">اسم المستخدم</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">كلمة المرور</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-success btn-block" name="register">إنشاء الحساب</button>
                    </form>
                    <div class="text-center mt-3">
                        <p>لديك حساب بالفعل؟ <a href="javascript:void(0);" onclick="toggleForms()">تسجيل الدخول</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript للتبديل بين النماذج -->
    <script>
        function toggleForms() {
            var loginForm = document.getElementById('login-form');
            var registerForm = document.getElementById('register-form');

            if (loginForm.style.display === "none") {
                loginForm.style.display = "block";
                registerForm.style.display = "none";
            } else {
                loginForm.style.display = "none";
                registerForm.style.display = "block";
            }
        }
    </script>
</body>
</html>
