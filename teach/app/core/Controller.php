<?php
declare(strict_types=1);

class Controller
{
    protected function view(string $view, array $data = []): void
    {
        $viewFile = VIEW_PATH . '/' . $view . '.php';
        if (!file_exists($viewFile)) {
            throw new RuntimeException('View not found: ' . $view);
        }

        extract($data, EXTR_SKIP);
        require $viewFile;
    }

    protected function model(string $name): object
    {
        $class = ucfirst($name);
        if (!class_exists($class)) {
            throw new RuntimeException('Model not found: ' . $class);
        }

        return new $class();
    }

    protected function redirect(string $path): void
    {
        $base = rtrim(dirname($_SERVER['SCRIPT_NAME'] ?? ''), '/');
        $target = $base . '/' . ltrim($path, '/');
        header('Location: ' . $target);
        exit;
    }

    protected function notFound(string $message = 'Not Found'): void
    {
        http_response_code(404);
        echo '404 Not Found - ' . $message;
    }
}
