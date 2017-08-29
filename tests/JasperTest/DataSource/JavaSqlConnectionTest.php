<?php

declare(strict_types=1);

namespace JasperTest\DataSource;

use PHPUnit\Framework\TestCase;
use Soluble\Jasper\DataSource\JavaSqlConnection;
use Soluble\Jasper\Exception\JavaProxiedException;
use Soluble\Japha\Bridge\Adapter as BridgeAdapter;

class JavaSqlConnectionTest extends TestCase
{
    /**
     * @var BridgeAdapter
     */
    protected $bridgeAdapter;

    public function setUp()
    {
        $this->bridgeAdapter = \JasperTestsFactories::getJavaBridgeAdapter();
    }

    public function testProperties()
    {
        $dsn = 'jdbc:mysql://host/db?user=user&password=password';
        $driver = 'com.mysql.jdbc.Driver';
        $ds = new JavaSqlConnection($dsn, $driver);
        $this->assertEquals($dsn, $ds->getJdbcDsn());
        $this->assertEquals($driver, $ds->getDriverClass());
    }

    public function testGetJasperReportSqlConnectionThrowsException()
    {
        $this->expectException(JavaProxiedException::class);

        $dsn = 'jdbc:mysql://host/db?user=notauser&password=notapassword';
        $driver = 'com.mysql.jdbc.Driver';
        $ds = new JavaSqlConnection($dsn, $driver);
        $ds->getJasperReportSqlConnection($this->bridgeAdapter);
    }
}
