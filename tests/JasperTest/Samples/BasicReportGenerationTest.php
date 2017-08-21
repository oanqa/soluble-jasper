<?php

declare(strict_types=1);

namespace JasperTest\Samples;

use Soluble\Jasper\DataSource\JdbcDataSource;
use Soluble\Jasper\Report;
use Soluble\Jasper\ReportParams;
use PHPUnit\Framework\TestCase;
use Soluble\Japha\Bridge\Adapter as BridgeAdapter;
use Soluble\Jasper\ReportRunnerFactory;
use JasperTest\Util\PDFUtils;

class BasicReportGenerationTest extends TestCase
{
    /**
     * @var BridgeAdapter
     */
    protected $ba;

    public function setUp()
    {
        $this->ba = \JasperTestsFactories::getJavaBridgeAdapter();
    }

    public function testDefaultReport()
    {
        $reportFile = \JasperTestsFactories::getDefaultReportFile();

        $reportRunner = ReportRunnerFactory::getBridgedReportRunner($this->ba);

        $report = new Report(
                    $reportFile,
                    new ReportParams([
                        'BookTitle'    => 'Soluble Jasper',
                        'BookSubTitle' => 'Generated from unit tests'
                    ]),
            new JdbcDataSource(\JasperTestsFactories::getJdbcDsn(), 'com.mysql.jdbc.Driver')
        );

        $exportManager = $reportRunner->getExportManager($report);

        $output_pdf = \JasperTestsFactories::getOutputDir() . '/test.pdf';
        if (file_exists($output_pdf)) {
            unlink($output_pdf);
        }

        $exportManager->savePdf($output_pdf);

        // open the pdf and check for text

        $pdfUtils = new PDFUtils();
        $text = $pdfUtils->getPDFText($output_pdf);

        $this->assertContains('Soluble Jasper', $text);
        $this->assertContains('Generated from unit tests', $text);
    }
}
