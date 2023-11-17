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
        return [ 'Fecha', 'Placa', 'Material', 'SubGrupo', 'Volumen' ];
    }

    public function collection(){
        return Viaje::select('viajes.fecha', 'vehiculos.placa', 'materias.nombre as material', 'gruposubmats.nombre as submaterial', 'viajes.volumen')
            ->join('vehiculos', 'viajes.vehiculo_id', '=', 'vehiculos.id')
            ->join('materias', 'viajes.material_id', '=', 'materias.id')
            ->join('gruposubmats', 'viajes.subgrupo_id', '=', 'gruposubmats.id')
            ->where('factura_id', $this->id)
            ->where('eliminado', 0)
            ->where('viajes.activo', 1)->get();
    }
}