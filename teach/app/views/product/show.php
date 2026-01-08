<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <style>
        body { font-family: Arial, Helvetica, sans-serif; margin: 2rem; line-height: 1.6; }
        .card { max-width: 640px; padding: 1.5rem; border: 1px solid #ddd; border-radius: 8px; }
        .row { margin-bottom: 0.5rem; }
        a { color: #0b66c3; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="card">
        <?php $base = rtrim(dirname($_SERVER['SCRIPT_NAME'] ?? ''), '/'); ?>
        <h1>Product details</h1>
        <div class="row"><strong>ID:</strong> <?php echo htmlspecialchars((string) $item['id'], ENT_QUOTES, 'UTF-8'); ?></div>
        <div class="row"><strong>Name:</strong> <?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?></div>
        <div class="row"><strong>Price:</strong> $<?php echo number_format((float) $item['price'], 2); ?></div>
        <p>
            <a href="<?php echo htmlspecialchars($base . '/product/edit/' . $item['id'], ENT_QUOTES, 'UTF-8'); ?>">Edit</a>
            | <a href="<?php echo htmlspecialchars($base . '/product/index', ENT_QUOTES, 'UTF-8'); ?>">Back to list</a>
        </p>
    </div>
</body>
</html>
