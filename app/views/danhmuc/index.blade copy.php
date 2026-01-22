<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <br>
    <a href="/danhmuc/them" class="btn btn-sm btn-light border text-succes">Them danh muc</a>
    <table class="table">
        <tr>
            <th> id </th>
            <th> name </th>
            <th> image </th>
            <th>action</th>
        </tr>
        <?php foreach ($danhmuc as $data): ?>
            <tr>
                <td><?= $data['id']; ?></td>
                <td><?= $data['name']; ?></td>
                <td><?= $data['image']; ?></td>

                <td>
                    <a href="/danhmuc/delete/<?= $data['id'] ?>" class="btn btn-sm btn-light border text-danger"
                     >Delete
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>
</body>

</html>