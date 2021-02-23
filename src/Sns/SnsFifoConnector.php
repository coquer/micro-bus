<?php

namespace Amranidev\MicroBus\Sns;

use Aws\Sns\SnsClient;
use Illuminate\Support\Arr;

class SnsFifoConnector
{
    /**
     * Establish an SNS Connection.
     *
     * @param array $config
     *
     * @return \Amranidev\MicroBus\Sns\PublisherFifo
     */
    public function connect($config)
    {
        $config = $this->getDefaultConfiguration($config);

        $config['credentials'] = Arr::only($config, ['key', 'secret']);

        return new PublisherFifo(new SnsClient($config));
    }

    /**
     * Get the default configuration.
     *
     * @param array $config
     *
     * @return array
     */
    public function getDefaultConfiguration($config)
    {
        return array_merge(
            [
                'version' => 'latest',
            ],
            $config
        );
    }
}
