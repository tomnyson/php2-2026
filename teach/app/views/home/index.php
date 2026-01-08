<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple MVC</title>
    <style>
        body { font-family: Arial, Helvetica, sans-serif; margin: 2rem; line-height: 1.6; }
        .card { max-width: 640px; padding: 1.5rem; border: 1px solid #ddd; border-radius: 8px; }
        code { background: #f5f5f5; padding: 0.1rem 0.3rem; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="card">
        <h1><?php echo htmlspecialchars($message ?? 'Hello', ENT_QUOTES, 'UTF-8'); ?></h1>
        <p>Try visiting <code>/home/index</code> or create a new controller.</p>
        <?php $base = rtrim(dirname($_SERVER['SCRIPT_NAME'] ?? ''), '/'); ?>
        <p>View products at <a href="<?php echo htmlspecialchars($base . '/product/index', ENT_QUOTES, 'UTF-8'); ?>">/product/index</a>.</p>
    </div>
</body>
</html>
