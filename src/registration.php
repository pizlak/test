<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Регистрация</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.js"
            integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <h1 class="mt-5">Страница регистрации</h1>
    <div id="error-block"></div>
    <form id="registration-form" action="/registration" method="POST">
        <div class="mb-3">
            <label class="form-label">Введите Ваш логин</label>
            <input type="text" name="user_name" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Пароль</label>
            <input type="password" name="password" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary"> Зарегистрироваться</button>
    </form>
</div>
</body>
<script>
    $(document).ready(function () {
        $('#registration-form').submit(function (event) {
            event.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                method: 'POST',
                url: '/registration',
                data: formData,
                success: function (response) {
                    if (response.error === false) {
                        window.location.href = "/login";
                    } else if (response.error === true) {
                        $('#error-block').html('').append(`<div class="alert alert-danger">${response.message}</div>`).show;
                    }
                }
            });
        });
    });
</script>

</html>