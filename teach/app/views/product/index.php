<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <style>
        body { font-family: Arial, Helvetica, sans-serif; margin: 2rem; line-height: 1.6; }
        .card { max-width: 720px; padding: 1.5rem; border: 1px solid #ddd; border-radius: 8px; }
        .actions { display: flex; gap: 1rem; align-items: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        th, td { text-align: left; padding: 0.5rem; border-bottom: 1px solid #eee; }
        th { background: #f7f7f7; }
        a { color: #0b66c3; text-decoration: none; }
        a:hover { text-decoration: underline; }
        .inline-form { display: inline; }
        .danger { color: #b91c1c; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Product list</h1>
        <?php $base = rtrim(dirname($_SERVER['SCRIPT_NAME'] ?? ''), '/'); ?>
        <div class="actions">
            <a href="<?php echo htmlspecialchars($base . '/product/create', ENT_QUOTES, 'UTF-8'); ?>">Create Product</a>
            <a href="<?php echo htmlspecialchars($base . '/home/index', ENT_QUOTES, 'UTF-8'); ?>">Back to Home</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($items)): ?>
                    <tr>
                        <td colspan="4">No products found.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($items as $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars((string) $item['id'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>$<?php echo number_format((float) $item['price'], 2); ?></td>
                            <td>
                                <a href="<?php echo htmlspecialchars($base . '/product/show/' . $item['id'], ENT_QUOTES, 'UTF-8'); ?>">View</a>
                                |
                                <a href="<?php echo htmlspecialchars($base . '/product/edit/' . $item['id'], ENT_QUOTES, 'UTF-8'); ?>">Edit</a>
                                |
                                <form class="inline-form" method="post" action="<?php echo htmlspecialchars($base . '/product/delete/' . $item['id'], ENT_QUOTES, 'UTF-8'); ?>" onsubmit="return confirm('Delete this product?');">
                                    <button class="danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
