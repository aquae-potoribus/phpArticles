<!DOCTYPE html>
<html>
<head>
    <title>таблица статей</title>
</head>
<div class="main">
    <div class="container">
        <h1>Добро пожаловать на страницу работы Сергея Кондрашкина </h1>
        <p>Список статей: </p>

        <table id="data-table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Article title</th>
                <th>Article body</th>
            </tr>
            </thead>
            <tbody>
            <?php

            use App\Models\Blog;

            $blogs = Blog::all();
            foreach ($blogs as $blog) {
                print  "<tr>";
                print  "<td> $blog->id </td>";
                print  "<td> $blog->title </td>";
                print  "<td> $blog->body </td>";
                print  "</tr>";
            }
            ?>            </tbody>
        </table>


        <p class="form_title">
            Создать новую статью
        </p>
        <form id="myForm">
            <div class="input_wrapper">
                <p class="input_title">Заголовок статьи: </p>
                <input class="input" type="text" name="title">
            </div>
            <div class="input_wrapper">
                <p class="input_title">текст статьи: </p>
                <input class="input" type="text" name="body">
            </div>
            <button class="btn" type="submit">Отправить</button>
        </form>


        <button id="update-btn">Обновить таблицу</button>
    </div>
</div>
<style>

    body {
        min-height: 100vh;
        margin: 0;
    }

    body * {
        font-family: sans-serif;
    }

    ::-webkit-scrollbar {
        width: 8px;
        scroll-padding: 0 !important;

        }

        ::-webkit-scrollbar-thumb {
            background-color: #ff5200;
            border-radius: 10px;
            transition: background-color .4s linear;
            scroll-padding: 0 !important;

        }

        ::-webkit-scrollbar-thumb:hover {
            background-color: red;
            scroll-padding: 0 !important;

        }

        h1 {
            font-size: 20px;
        }

        .main {
            padding-top: 30px;
        }

        .container {
            max-width: 50%;
            margin: 0 auto;
        }

        body {
            background-color: #FBAB7E;
            background-image: linear-gradient(62deg, #FBAB7E 0%, #F7CE68 100%);
        }

        thead tr {
            background: #ff7600;
        }

        tbody tr:nth-child(odd) {
            background: #c1c1c1;
        }

        tbody tr:nth-child(even) {
            background: #e7e7e7;
        }

        th {
            padding: 4px 10px;
            outline: 1px solid black;
            outline-offset: 0px;
        }

        td {
            padding: 2px 6px;
            outline: 1px solid black;
            outline-offset: 0px;
        }

        #data-table {
            margin-bottom: 20px;
            overflow-x: auto;
            max-height: 293px;
            display: block;
        width: fit-content;
    }

    .form_title {
        font-size: 20px;
        text-shadow: #9d4800 0px 0 1px;
        margin: 15px 0;
    }

    #myForm {
        margin-bottom: 30px;
    }

    .input_title {
        display: inline-block;
        margin: 0 !important;

    }

    .input {
        margin-bottom: 12px;
        border: none;
        border-radius: 5px;
        outline: none;
        padding: 2px 4px;
    }

    .btn {
        cursor: pointer;
        background: #ff7600;
        outline: none;
        border: 1px solid;
        padding: 10px 25px;
        font-size: 14px;
        font-family: sans-serif;
        font-weight: 600;
        border-radius: 50px;
        transition: background .2s linear, color .2s linear, background .2s linear;
    }

    .btn:hover {
        background: #ff8e2d;
    }
    .btn:active {
        background: #ef6f00;
    }

    #update-btn {
        cursor: pointer;
        background: #ff7600;
        outline: none;
        border: 1px solid;
        padding: 10px 25px;
        font-size: 14px;
        font-family: sans-serif;
        font-weight: 600;
        border-radius: 50px;
        transition: background .2s linear, color .2s linear, background .2s linear;
    }


    #update-btn:hover {
        background: #ff8e2d;
    }
    #update-btn:active {
        background: #ef6f00;
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#update-btn').click(function () {
            $.ajax({
                url: '/get-all-data', // Маршрут для получения данных из базы данных
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    var rows = '';
                    $.each(response, function (index, data) {
                        rows += '<tr>';
                        rows += '<td>' + data.id + '</td>';
                        rows += '<td>' + data.title + '</td>';
                        rows += '<td>' + data.body + '</td>';
                        rows += '</tr>';
                    });
                    $('#data-table tbody').html(rows);
                },
                error: function (xhr, status, error) {
                    console.log(error);
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('#myForm').submit(function (e) {
            e.preventDefault(); // Предотвращаем отправку формы по умолчанию

            $.ajax({
                type: 'POST',
                url: '/api/blogs',
                data: $(this).serialize(), // Сериализуем данные формы
                success: function (response) {
                    $('#result').html(response); // Вставляем полученный результат в элемент с id="result"
                }
            });

            $.ajax({
                url: '/get-all-data', // Маршрут для получения данных из базы данных
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    var rows = '';
                    $.each(response, function (index, data) {
                        rows += '<tr>';
                        rows += '<td>' + data.id + '</td>';
                        rows += '<td>' + data.title + '</td>';
                        rows += '<td>' + data.body + '</td>';
                        rows += '</tr>';
                    });
                    $('#data-table tbody').html(rows);
                },
                error: function (xhr, status, error) {
                    console.log(error);
                }
            });
        });
    });

</script>

</body>
</html>
