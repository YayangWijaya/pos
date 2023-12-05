<?php

namespace App\Exports;

use App\Models\CheckResult;
use App\Models\Transaction;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class TransactionExport implements FromView, ShouldAutoSize, WithEvents
{
    protected $from, $to, $data, $length, $headerLength;
    /**
    * @return \Illuminate\Support\Collection
    */

    public function alphToNum($num)
    {
        $alphs = range('A', 'Z');
        return $alphs[$num-1];
    }

    public function __construct($from, $to) {
        $this->data = Transaction::with(['items.product'])->when($from && $to, function ($q) use ($from, $to) {
            $q->when($from === $to, function ($r) use ($from, $to) {
                $r->whereDate('created_at', $from);
            })->when($from !== $to, function ($r) use ($from, $to) {
                $r->whereBetween('created_at', [$from, $to]);
            });
        })->get()->toArray();
        $this->length = count($this->data) + 4;
        $this->headerLength = count(max($this->data)) + 1;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $styleArray = [
                    'font' => [
                        'bold' => true,
                        'color' => array('rgb' => 'FFFFFF'),
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => [
                            'argb' => '833C0C'
                        ]
                    ],
                ];

                $event->sheet->getDelegate()->getStyle('B4:I' . '4')->applyFromArray($styleArray);

                $setBorder = "B4:I" . $this->length;

                $event->sheet->getDelegate()->getStyle($setBorder)->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                $event->sheet->getDelegate()->getStyle($setBorder)->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                $event->sheet->getDelegate()->getStyle($setBorder)->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                $event->sheet->getDelegate()->getStyle($setBorder)->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                $event->sheet->getDelegate()->getStyle($setBorder)->getBorders()->getHorizontal()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                $event->sheet->getDelegate()->getStyle($setBorder)->getBorders()->getVertical()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

                $event->sheet->mergeCells('B2:I2');
                $event->sheet->mergeCells('B3:I3');

                $event->sheet->setCellValue('B2', 'LAPORAN TRANSAKSI PT JATIASIH DISTRIBUSIDO RAYA');
                $event->sheet->setCellValue('B3', "TANGGAL : " . date('d-M-Y', strtotime(isset($this->from) ? $this->from : now())) . " - " . date('d-M-Y', strtotime(isset($this->to) ? $this->to : now())));
                $event->sheet->getDelegate()->getStyle('B2:B3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('C5:F' . $this->length)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('I5:I' . $this->length)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('B5:I' . $this->length)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
            },
        ];
    }

    public function view(): View
    {
        return view('exports.transaction', [
            'transactions' => $this->data
        ]);
    }
}
