<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <style>
        body { font-family: Arial, Helvetica, sans-serif; margin: 2rem; line-height: 1.6; }
        .card { max-width: 640px; padding: 1.5rem; border: 1px solid #ddd; border-radius: 8px; }
        .field { margin-bottom: 1rem; }
        label { display: block; font-weight: bold; margin-bottom: 0.25rem; }
        input { width: 100%; padding: 0.5rem; }
        .errors { background: #fff1f2; border: 1px solid #fecdd3; padding: 0.75rem; margin-bottom: 1rem; }
        a { color: #0b66c3; text-decoration: none; }
        a:hover { text-decoration: underline; }
        button { padding: 0.5rem 1rem; }
    </style>
</head>
<body>
    <div class="card">
        <?php $base = rtrim(dirname($_SERVER['SCRIPT_NAME'] ?? ''), '/'); ?>
        <h1>Edit product</h1>
        <p><a href="<?php echo htmlspecialchars($base . '/product/index', ENT_QUOTES, 'UTF-8'); ?>">Back to list</a></p>

        <?php if (!empty($errors)): ?>
            <div class="errors">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="post" action="<?php echo htmlspecialchars($base . '/product/update/' . $item['id'], ENT_QUOTES, 'UTF-8'); ?>">
            <div class="field">
                <label for="name">Name</label>
                <input id="name" name="name" type="text" value="<?php echo htmlspecialchars($values['name'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>
            <div class="field">
                <label for="price">Price</label>
                <input id="price" name="price" type="number" step="0.01" min="0" value="<?php echo htmlspecialchars($values['price'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>
            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>
