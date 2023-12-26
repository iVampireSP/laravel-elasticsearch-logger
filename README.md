# How to use

in your config/logging.php channels

```php
'elastic' => [
    'driver' => 'custom',
    'via' => \ivampiresp\LaravelElasticsearchLogger\ESLogger::class,
    'verify_ssl' => false,
    'hosts' => [env('ELASTIC_HOST', 'https://localhost:9200')],
    'user' => env('ELASTIC_USER', 'elastic'),
    'pass' => env('ELASTIC_PASS', ''),
    'index' => Str::slug(env('APP_NAME', 'laravel'), '_').'-logs'
]
```

that's all.