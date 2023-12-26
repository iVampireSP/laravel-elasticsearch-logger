<?php

namespace ivampiresp\LaravelElasticsearchLogger;

use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;

class LaravelElasticsearchLoggerServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton("elasticsearch-log-handler", function (Application $app, array $config = []) {
            unset($app);
            $builder = ClientBuilder::create()->setHosts($config['hosts'])
                ->setSSLVerification($config['verify_ssl']);


            if ($config['pass']) {
                $builder->setBasicAuthentication($config['user'], $config['pass']);
            }

            $builder = $builder->build();


            if (!$builder->indices()->exists(['index' => $config['index']])) {
                $builder->indices()->create([
                    'index' => $config['index'],
                ]);
            }

            return $builder;
        });
    }
}
