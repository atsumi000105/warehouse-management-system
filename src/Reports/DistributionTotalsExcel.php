<?php

namespace App\Reports;

use App\Entity\Product;
use Doctrine\Common\Collections\ArrayCollection;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\IWriter;

class DistributionTotalsExcel
{

    /**
     * @var DistributionTotalsReport
     */
    protected $reportData;

    /**
     * @var Product[]|ArrayCollection
     */
    protected $products;

    private $manualKeys = ['id', 'name', 'type'];

    /**
     * PartnerTotalsExcel constructor.
     * @param array $reportData
     * @param Product[]|ArrayCollection $products
     */
    public function __construct(array $reportData, $products)
    {
        $this->reportData = $reportData;
        $this->products = $products;
    }

    /**
     * @return \PhpOffice\PhpSpreadsheet\Writer\IWriter
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function buildExcel(): IWriter
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->fromArray($this->buildHeaders());

        $dataArr = [];

        foreach ($this->reportData as $values) {
            $rowArr = [];

            foreach ($this->manualKeys as $key) {
                $rowArr[] = $values[$key];
            }

            foreach ($values as $key => $value) {
                if (! in_array($key, $this->manualKeys)) {
                    $rowArr[] = $value;
                }
            }

            $dataArr[] = $rowArr;
        }

        $sheet->fromArray($dataArr, null, 'A2');

        return IOFactory::createWriter($spreadsheet, 'Xlsx');
    }

    private function buildHeaders()
    {
        $headers = [
            'Partner Id',
            'Partner',
            'Partner Type',
        ];

        foreach ($this->reportData as $values) {
            foreach ($values as $key => $data) {
                if (! in_array($key, $headers) && !in_array($key, $this->manualKeys)) {
                    $headers[] = $key;
                }
            }

        }

        return $headers;
    }
}
