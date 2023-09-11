<?php

namespace LightSpeak\LaravelScoutElasticsearch;

use Elastic\Elasticsearch\ClientBuilder;
use Elastic\Elasticsearch\Exception\AuthenticationException;
use Elastic\Elasticsearch\Client;

trait ElasticsearchClientTrait
{
    /**
     * Get ElasticSearch Client
     *
     * @return Client
     * @throws AuthenticationException
     */
    public function getElasticsearchClient(): Client
    {
        $hosts = [
            'host'   => config('scout.elasticsearch.host'),
            'port'   => config('scout.elasticsearch.port'),
            'scheme' => config('scout.elasticsearch.scheme'),
        ];
        $user  = config('scout.elasticsearch.user');
        $pass  = config('scout.elasticsearch.pass');

        if ($user !== null) {
            $hosts['user'] = $user;
        }

        if ($pass !== null) {
            $hosts['pass'] = $pass;
        }

        return ClientBuilder::create()
            ->setHosts([$hosts])
            ->build();
    }
}
