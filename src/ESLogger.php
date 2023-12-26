<?php

namespace ivampiresp\LaravelElasticsearchLogger;

use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;
use Monolog\Formatter\ElasticsearchFormatter;
use Monolog\Handler\ElasticsearchHandler;

class ESLogger extends AbstractProcessingHandler
{
    public function __invoke(array $config)
    {
        $type = "_doc";
        $es = app("elasticsearch-log-handler", $config);
        $handler = new ElasticsearchHandler($es, [
            'index'        => $config["index"],
            'type'         => $type,
            'ignore_error' => false,
        ]);
        $handler->setFormatter(new ElasticsearchFormatter($config["index"], $type));


        return new Logger(
            $config["index"],
            [
                $handler
            ]
        );
    }

    protected function write(mixed $record): void
    {
    }
}
