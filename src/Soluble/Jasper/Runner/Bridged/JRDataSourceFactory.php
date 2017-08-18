<?php

declare(strict_types=1);

namespace Soluble\Jasper\Runner\Bridged;

use Soluble\Japha\Bridge\Adapter as BridgeAdapter;
use Soluble\Japha\Db\DriverManager;
use Soluble\Japha\Interfaces\JavaObject;
use Soluble\Jasper\DataSource\DataSourceInterface;
use Soluble\Jasper\DataSource\JDBCDataSource;
use Soluble\Jasper\Exception\UnsupportedDataSourceException;
use Soluble\Jasper\Runner\Bridged\Proxy\JRDataSourceInterface;

class JRDataSourceFactory
{
    /**
     * @var BridgeAdapter
     */
    protected $ba;

    public function __construct(BridgeAdapter $bridgeAdapter)
    {
        $this->ba = $bridgeAdapter;
    }

    /**
     * @param DataSourceInterface $dataSource
     *
     * @return JavaObject
     */
    public function __invoke(DataSourceInterface $dataSource): JRDataSourceInterface
    {
        $jrDataSource = null;

        if ($dataSource instanceof JDBCDataSource) {
            $connection = (new DriverManager($this->ba))->createConnection(
                $dataSource->getJdbcDsn(),
                $dataSource->getDriverClass()
            );
            $jrDataSource = new JRDataSourceConnection($connection);
        }

        if ($jrDataSource === null) {
            throw new UnsupportedDataSourceException(sprintf(
                'Unsupported datasource class: "%s"',
                get_class($dataSource)
            ));
        }

        return $jrDataSource;
    }
}
