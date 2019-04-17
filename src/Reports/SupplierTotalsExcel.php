<?php

namespace App\Reports;


use App\Entity\Product;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\IWriter;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class SupplierTotalsExcel
{

    /**
     * @var SupplierTotalsReport
     */
    protected $reportData;

    /**
     * @var Product[]
     */
    protected $products;

    /**
     * SupplierTotalsExcel constructor.
     * @param SupplierTotalsReport $reportData
     * @param Product[] $products
     */
    public function __construct(SupplierTotalsReport $reportData, array $products)
    {
        $this->reportData = $reportData;
        $this->products = $products;
    }

    /**
     * @return \PhpOffice\PhpSpreadsheet\Writer\IWriter
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function buildExcel() : IWriter
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        // Headers
        $sheet->fromArray($this->buildHeaders());

        $dataArr = [];
        foreach ($this->reportData->getRows() as $rowData) {
            $rowArr = [];
            $rowArr[] = $rowData->getSupplier()->getId();
            $rowArr[] = $rowData->getSupplier()->getTitle();
            $rowArr[] = $rowData->getSupplier()->getSupplierType();

            foreach ($this->products as $product) {
                $rowArr[] = $rowData->getProductTotal($product);
            }

            $rowArr[] = $rowData->getTotal();

            $dataArr[] = $rowArr;
        }
        $sheet->fromArray($dataArr, null, 'A2');

        return IOFactory::createWriter($spreadsheet, 'Xlsx');
    }

    private function buildHeaders()
    {
        $headers = [
            'Supplier Id',
            'Supplier',
            'Supplier Type',
        ];

        foreach ($this->products as $product) {
            $headers[] = $product->getName();
        }

        $headers[] = 'Total Supplied';

        return $headers;
    }
}