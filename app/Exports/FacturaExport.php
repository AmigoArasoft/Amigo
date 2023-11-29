<?php

namespace App\Exports;

use App\Models\Viaje;
use App\Models\Factura;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithBackgroundColor;

class FacturaExport implements FromView, WithBackgroundColor, WithStyles, WithEvents{
	private $id;

	public function __construct(int $id) {
        $this->id = $id;
    }

    public function view(): View
    {

        $viajes = Viaje::join('vehiculos', 'viajes.vehiculo_id', '=', 'vehiculos.id')
        ->join('materias', 'viajes.material_id', '=', 'materias.id')
        ->join('gruposubmats', 'viajes.subgrupo_id', '=', 'gruposubmats.id')
        ->where('factura_id', $this->id)
        ->where('eliminado', 0)
        ->where('viajes.activo', 1)
        ->get();

        return view('mina.empresa.factura.excel', [
            'factura' => Factura::find($this->id),
            'viajes' => $viajes
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                ],
            ],
            2 => [
                'alignment' => [
                    'wrapText' => true, // Asegurarse de que el texto se ajuste automáticamente
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ],
            7 => [
                'alignment' => [
                    'wrapText' => true, // Asegurarse de que el texto se ajuste automáticamente
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->mergeCells('A1:D1');
                $event->sheet->getDelegate()->mergeCells('A2:D2');
                $event->sheet->getDelegate()->mergeCells('A7:D7');

                // Autoajustar el tamaño de todas las columnas después de haber definido los datos
                foreach(range('A', 'Z') as $column) {
                    $event->sheet->getDelegate()->getColumnDimension($column)->setAutoSize(true);
                }
            },
        ];
    }

    public function backgroundColor()
    {
        // Return RGB color code.
        return 'ffffff';
    }
}