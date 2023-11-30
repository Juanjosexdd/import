<?php

namespace App\Exports;

use Illuminate\Contracts\Support\Responsable;
use App\Models\Invoice;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

/**Interface para mapear los datos a mostrar se debe agregar el metodo map($invoice) :array*/
use Maatwebsite\Excel\Concerns\WithMapping;

/**Interface Para formatear la fecha en el excel se debe agregar el metodo columnFormats(): array */
use PhpOffice\PhpSpreadsheet\Shared\Date;

/**Interface para formatear los campos en este caso formatear la fecha se debe agregar el metodo columnFormats(): array*/
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

/**Interface para agregar la cabezera de los campos del reporte se debe agregar el metodo headings(): array */
use Maatwebsite\Excel\Concerns\WithHeadings;

/**Interface para dar tamaño en automaticon,
 * 
 * Nota: No requiere un metodo, ajusta eltamaño
 *       de las celdas segun el contenido.
*/
// use Maatwebsite\Excel\Concerns\ShouldAutoSize;

/**Interface para dar un ramaño fijo se debe agregar el metodo columnWidths(): array */
use Maatwebsite\Excel\Concerns\WithColumnWidths;

/**Interface para agregar logo en la cabecera del reporte  se debe agregar el metodo drawings() */
use Maatwebsite\Excel\Concerns\WithDrawings;


use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class InvoiceExport implements FromCollection, WithCustomStartCell, Responsable, WithMapping,WithColumnFormatting,WithHeadings,WithColumnWidths,WithDrawings,WithStyles
{
    use Exportable;
    private $filters;

    private $fileName = 'invoices.xlsx';

    private $writerType = Excel::XLSX;
    
    public function __construct($filters)
    {
        $this->filters = $filters;
    }


    public function collection()
    {
        return Invoice::filter($this->filters)->get();
    }

    public function startCell(): string
    {
        return 'A10';
    }

    /**
     * use Maatwebsite\Excel\Concerns\WithMapping;
     */
    public function map($invoice) :array
    {
        return [
            $invoice->serie,
            $invoice->correlative,
            $invoice->base,
            $invoice->iva,
            $invoice->total,
            $invoice->user->name,

            /**
             * PhpOffice\PhpSpreadsheet\Shared\Date; 
             */
            Date::dateTimeToExcel($invoice->created_at),
        ];
    }

    /**
     * use Maatwebsite\Excel\Concerns\WithHeadings;
     */
    public function headings(): array
    {
        return [
            'SERIE',
            'CORRELATIVO',
            'BASE',
            'IVA',
            'TOTAL',
            'USUARIO',
            'FECHA',
        ];
    }

    
    /**
     * Maatwebsite\Excel\Concerns\WithColumnFormatting;
     */
    public function columnFormats(): array
    {
        return [
            'G' => 'dd/mm/yyyy',
        ];
    }

    /**
     * Maatwebsite\Excel\Concerns\WithColumnWidths
     */
    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 16,
            'C' => 12,
            'D' => 12,
            'E' => 15,
            'F' => 30,
            'G' => 22,
        ];
    }

    /**
     * Maatwebsite\Excel\Concerns\WithDrawings
     */
    public function drawings()
    {
        $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('Logo');
        $drawing->setPath(public_path('img/logos/logo.png'));
        $drawing->setHeight(110);
        $drawing->setCoordinates('B3');
        
        return $drawing;
    }

    public function styles(Worksheet $sheet)
    {
        $startRow = 11;
        $endRow = $startRow + 1;
        $sheet->setTitle('Facturas');
        $sheet->mergeCells('A1:G9');
        //$sheet->setCellValue("E113", "=SUM(E11:E111)");
        $sheet->getStyle('A10:G10')->applyFromArray([
            'font' => [
                'bold' => true,
                'name' => 'Arial',
            ],
            'alignment' => [
                'horizontal' => 'center'
            ],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => [
                    'argb' => 'fff'
                ],
            ],
        ]);

        $sheet->getStyle('A10:G' . $sheet->getHighestRow() )->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => 'thin',
                ],
            ],
        ]);
    
    }

}
