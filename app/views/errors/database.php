<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error Database</title>
</head>

<body>
    <div style="margin-top:100px; text-align: center;color: green;">
        <h1 style="text-transform: uppercase;color: red;">Lỗi liên quan đến cơ sở dữ liệu</h1>
        <hr>
        <h3><?= $message ?? '' ?></h3>
    </div>
</body>

</html>