<?php

namespace App\Exports;

use App\Models\Viaje;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FacturaExport implements FromCollection, WithHeadings{
	private $id;

	public function __construct(int $id) {
        $this->id = $id;
    }

    public function headings(): array{
        return [ 'Fecha', 'Placa', 'Material', 'Submaterial', 'Volumen' ];
    }

    public function collection(){
        return Viaje::select('viajes.fecha', 'vehiculos.placa', 'materials.nombre as material', 'parametros.nombre as submaterial', 'viajes.volumen')
            ->join('vehiculos', 'viajes.vehiculo_id', '=', 'vehiculos.id')
            ->join('materials', 'viajes.material_id', '=', 'materials.id')
            ->join('parametros', 'viajes.submaterial_id', '=', 'parametros.id')
            ->where('factura_id', $this->id)
            ->where('eliminado', 0)
            ->where('viajes.activo', 1)->get();
    }
}