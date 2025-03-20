<?php namespace FlatFilesBooster;

/**
 *
 * ```php
    // Get value
    echo $env->get('APP_ENV') . PHP_EOL;

    // Set new value
    $env->set('DB_HOST', '127.0.0.1');
    $env->set('DB_PORT', '3306');

    // Save changes to file
    $env->save();
 *  ```
 */

class EnvManager
{
    private string $filePath;
    private array $data = [];

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;

        if (!file_exists($filePath)) {
            throw new \Exception("The .env file does not exist: {$filePath}");
        }

        $this->load();
    }

    private function load(): void
    {
        $lines = file($this->filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            if (str_starts_with(trim($line), '#') || !str_contains($line, '=')) {
                continue; // Skip comments and invalid lines
            }

            [$key, $value] = explode('=', $line, 2);

            // Normalize data types
            $value = $this->normalizeValue(trim($value));
            $this->data[trim($key)] = $value;
        }
    }

    private function normalizeValue(string $value)
    {
        if (strtolower($value) === 'true') {
            return true;
        }

        if (strtolower($value) === 'false') {
            return false;
        }

        if (is_numeric($value)) {
            return (int)$value;
        }

        return $value;
    }

    private function stringifyValue($value): string
    {
        if (is_bool($value)) {
            return $value ? 'true' : 'false';
        }

        return (string)$value;
    }

    public function get(string $key): mixed
    {
        return $this->data[$key] ?? null;
    }

    public function set(string $key, mixed $value): void
    {
        $this->data[$key] = $value;
    }

    public function save(): void
    {
        $content = '';

        foreach ($this->data as $key => $value) {
            $content .= "{$key}=" . $this->stringifyValue($value) . PHP_EOL;
        }

        file_put_contents($this->filePath, $content);
    }
}
