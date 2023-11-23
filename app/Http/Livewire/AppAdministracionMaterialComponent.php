<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Tarifa;
use App\Models\Grupomat;
use App\Models\Gruposubmat;
use App\Models\Materia;
use App\Models\Especificacion;
use App\Models\Parametro;
use App\Models\Grupo;

class AppAdministracionMaterialComponent extends Component{
    public $tab = 5;
    public $especificacion_id, $nombreEspecificacion, $actionEspecificacion, $searchEspecificacion, $normas, $norma, $nombreNorma;
    public $material_id, $nombreMaterial, $actionMaterial, $searchMaterial, $especificacionesLista, $especificacion;
    public $subgrupo_id, $nombreSubgrupo, $actionSubgrupo, $searchSubgrupo, $materialesLista, $material;
    public $grupo_id, $nombreGrupo, $actionGrupo, $searchGrupo, $subgruposLista, $subgrupo;
    public $tarifa_id, $nombreTarifa, $actionTarifa, $searchTarifa, $subgruposListaTarifa, $materialesTarifa, $materialesListaTarifa, $subgrupoTarifa;

    public function render(){
        return view('livewire.mina.administracion.material.index', [
            'especificaciones' => Especificacion::orderBy('nombre')
            ->when(!empty($this->searchEspecificacion),
                function($q){
                    return $q->where('nombre', 'like', '%'.$this->searchEspecificacion.'%');
                })
            ->get(),
            'materiales' => Materia::orderBy('nombre')
            ->when(!empty($this->searchMaterial),
                function($q){
                    return $q->where('nombre', 'like', '%'.$this->searchMaterial.'%');
                })
            ->get(),
            'subgrupos' => Gruposubmat::orderBy('nombre')
            ->when(!empty($this->searchSubgrupo),
                function($q){
                    return $q->where('nombre', 'like', '%'.$this->searchSubgrupo.'%');
                })
            ->get(),
            'grupos' => Grupomat::orderBy('nombre')
            ->when(!empty($this->searchGrupo),
                function($q){
                    return $q->where('nombre', 'like', '%'.$this->searchGrupo.'%');
                })
            ->get(),
            'tarifas' => Tarifa::orderBy('nombre')
            ->when(!empty($this->searchTarifa),
                function($q){
                    return $q->where('nombre', 'like', '%'.$this->searchTarifa.'%');
                })
            ->get()
        ]);
    }

    public function createEspecificacion(){
        $this->tab = 1;
        $this->nombreEspecificacion = '';
        $this->nombreNorma = '';
        $this->norma = [];
        $this->normas = Grupo::findOrFail(9)->parametros()->orderBy('nombre')->get();
        $this->actionEspecificacion = 'Nueva';
    }

    public function createMaterial(){
        $this->tab = 2;
        $this->nombreMaterial = '';
        $this->especificacion = [];
        $this->especificacionesLista = Especificacion::where('activo', 1)->orderBy('nombre')->get();
        $this->actionMaterial = 'Nuevo';
    }

    public function createSubgrupo(){
        $this->tab = 3;
        $this->nombreSubgrupo = '';
        $this->material = [];
        $this->materialesLista = Materia::where('activo', 1)->orderBy('nombre')->get();
        $this->actionSubgrupo = 'Nuevo';
    }

    public function createGrupo(){
        $this->tab = 4;
        $this->nombreGrupo = '';
        $this->subgrupo = [];
        $this->subgruposLista = Gruposubmat::where('activo', 1)->orderBy('nombre')->get();
        $this->actionGrupo = 'Nuevo';
    }

    public function createTarifa(){
        $this->tab = 5;
        $this->nombreTarifa = '';
        $this->materialesTarifa = [];
        $this->materialesListaTarifa = Materia::where('activo', 1)->orderBy('nombre')->get();
        $this->actionTarifa = 'Nueva';
    }

    public function storeEspecificacion(){
        $this->validate(['nombreEspecificacion' => 'required|max:100|unique:especificacions,nombre', 'norma' => 'nullable|array']);
        $dato = Especificacion::Create(['nombre' => $this->nombreEspecificacion]);
        $dato->normas()->attach($this->norma);
        $this->emit('alert', ['type' => 'success', 'message' => 'Especificación creada con éxito']);
        $this->defaultEspecificacion();
    }

    public function storeMaterial(){
        $this->validate(['nombreMaterial' => 'required|max:100|unique:materias,nombre', 'especificacion' => 'nullable|array']);
        $dato = Materia::Create(['nombre' => $this->nombreMaterial]);
        $dato->especificaciones()->attach($this->especificacion);
        $this->emit('alert', ['type' => 'success', 'message' => 'Material creado con éxito']);
        $this->defaultMaterial();
    }

    public function storeSubgrupo(){
        $this->validate(['nombreSubgrupo' => 'required|max:100|unique:gruposubmats,nombre', 'material' => 'required|array']);
        $dato = Gruposubmat::Create(['nombre' => $this->nombreSubgrupo]);
        $dato->materiales()->attach($this->material);
        $this->emit('alert', ['type' => 'success', 'message' => 'Sub grupo creado con éxito']);
        $this->defaultSubgrupo();
    }

    public function storeTarifa(){
        $this->validate(['nombreTarifa' => 'required|max:100|unique:tarifas,nombre', 'materialesTarifa' => 'required|array']);
        $dato = Tarifa::Create(['nombre' => $this->nombreTarifa]);
        $dato->materiales()->attach($this->materialesTarifa);
        $this->emit('alert', ['type' => 'success', 'message' => 'Tarifa creado con éxito']);
        $this->defaultTarifa();
    }

    public function storeGrupo(){
        $this->validate(['nombreGrupo' => 'required|max:100|unique:grupomats,nombre', 'subgrupo' => 'required|array']);
        $dato = Grupomat::Create(['nombre' => $this->nombreGrupo]);
        $dato->subgrupos()->attach($this->subgrupo);
        $this->emit('alert', ['type' => 'success', 'message' => 'Grupo creado con éxito']);
        $this->defaultGrupo();
    }

    public function storeNorma(){
        $this->validate(['nombreNorma' => 'required|max:180']);
        $parametro = Parametro::firstOrCreate(['nombre' => $this->nombreNorma]);
        Grupo::findOrFail(9)->parametros()->syncWithoutDetaching($parametro->id);
        if($this->actionEspecificacion == 'Nueva') {
            $this->createEspecificacion();
        } else {
            $this->editEspecificacion($this->especificacion_id, 'Editar');
        }
        $this->emit('alert', ['type' => 'success', 'message' => 'Norma adicionada con éxito']);
    }

    public function editEspecificacion($id, $act){
        $especificacion = Especificacion::findOrFail($id);
        $this->tab = 1;
        $this->especificacion_id = $especificacion->id;
        $this->nombreEspecificacion = $especificacion->nombre;
        $this->nombreNorma = '';
        $this->norma = [];
        foreach ($especificacion->normas as $e) {
            $this->norma[] = "$e->id";
        }
        $this->normas = Grupo::findOrFail(9)->parametros()->orderBy('nombre')->get();
        $this->actionEspecificacion = $act;
    }

    public function editMaterial($id, $act){
        $material = Materia::findOrFail($id);
        $this->tab = 2;
        $this->material_id = $material->id;
        $this->nombreMaterial = $material->nombre;
        $this->especificacion = [];
        foreach ($material->especificaciones as $e) {
            $this->especificacion[] = "$e->id";
        }
        $this->especificacionesLista = Especificacion::where('activo', 1)->orderBy('nombre')->get();
        $this->actionMaterial = $act;
    }

    public function editSubgrupo($id, $act){
        $subgrupo = Gruposubmat::findOrFail($id);
        $this->tab = 3;
        $this->subgrupo_id = $subgrupo->id;
        $this->nombreSubgrupo = $subgrupo->nombre;
        $this->material = [];
        foreach ($subgrupo->materiales as $e) {
            $this->material[] = "$e->id";
        }
        $this->materialesLista = Materia::where('activo', 1)->orderBy('nombre')->get();
        $this->actionSubgrupo = $act;
    }

    public function editGrupo($id, $act){
        $grupo = Grupomat::findOrFail($id);
        $this->tab = 4;
        $this->grupo_id = $grupo->id;
        $this->nombreGrupo = $grupo->nombre;
        $this->subgrupo = [];
        foreach ($grupo->subgrupos as $e) {
            $this->subgrupo[] = "$e->id";
        }
        $this->subgruposLista = Gruposubmat::where('activo', 1)->orderBy('nombre')->get();
        $this->actionGrupo = $act;
    }

    public function editTarifa($id, $act){
        $tarifa = Tarifa::findOrFail($id);
        $this->tab = 5;
        $this->tarifa_id = $tarifa->id;
        $this->nombreTarifa = $tarifa->nombre;
        $this->materialesTarifa = [];
        foreach ($tarifa->materiales as $e) {
            $this->materialesTarifa[] = "$e->id";
        }
        $this->materialesListaTarifa = Materia::where('activo', 1)->orderBy('nombre')->get();
        $this->actionTarifa = $act;
    }

    public function updateEspecificacion(){
        $this->validate(['nombreEspecificacion' => 'required|max:100|unique:especificacions,nombre,'.$this->especificacion_id, 'norma' => 'nullable|array']);
        $dato = Especificacion::findOrFail($this->especificacion_id);
        $dato->update(['nombre' => $this->nombreEspecificacion]);
        $dato->normas()->detach();
        $dato->normas()->sync($this->norma);
        $this->defaultEspecificacion();
    }

    public function updateMaterial(){
        $this->validate(['nombreMaterial' => 'required|max:100|unique:materias,nombre,'.$this->material_id, 'especificacion' => 'nullable|array']);
        $dato = Materia::findOrFail($this->material_id);
        $dato->update(['nombre' => $this->nombreMaterial]);
        $dato->especificaciones()->detach();
        $dato->especificaciones()->sync($this->especificacion);
        $this->defaultMaterial();
    }

    public function updateSubgrupo(){
        $this->validate(['nombreSubgrupo' => 'required|max:100|unique:gruposubmats,nombre,'.$this->subgrupo_id, 'material' => 'required|array']);
        $dato = Gruposubmat::findOrFail($this->subgrupo_id);
        $dato->update(['nombre' => $this->nombreSubgrupo]);
        $dato->materiales()->detach();
        $dato->materiales()->sync($this->material);
        $this->defaultSubgrupo();
    }

    public function updateGrupo(){
        $this->validate(['nombreGrupo' => 'required|max:100|unique:grupomats,nombre,'.$this->grupo_id, 'subgrupo' => 'required|array']);
        $dato = Grupomat::findOrFail($this->grupo_id);
        $dato->update(['nombre' => $this->nombreGrupo]);
        $dato->subgrupos()->detach();
        $dato->subgrupos()->sync($this->subgrupo);
        $this->defaultGrupo();
    }

    public function updateTarifa(){
        $this->validate(['nombreTarifa' => 'required|max:100|unique:tarifas,nombre,'.$this->tarifa_id, 'materialesTarifa' => 'required|array']);
        $dato = Tarifa::findOrFail($this->tarifa_id);
        $dato->update(['nombre' => $this->nombreTarifa]);
        $dato->materiales()->detach();
        $dato->materiales()->sync($this->materialesTarifa);
        $this->defaultTarifa();
    }

    public function destroyEspecificacion(){
        $dato = Especificacion::findOrFail($this->especificacion_id);
        $dato->activo = ($dato->activo == 1) ? 0 : 1;
        $dato->save();
        $this->defaultEspecificacion();
    }

    public function destroyMaterial(){
        $dato = Materia::findOrFail($this->material_id);
        $dato->activo = ($dato->activo == 1) ? 0 : 1;
        $dato->save();
        $this->defaultMaterial();
    }

    public function destroySubgrupo(){
        $dato = Gruposubmat::findOrFail($this->subgrupo_id);
        $dato->activo = ($dato->activo == 1) ? 0 : 1;
        $dato->save();
        $this->defaultSubgrupo();
    }

    public function destroyGrupo(){
        $dato = Grupomat::findOrFail($this->grupo_id);
        $dato->activo = ($dato->activo == 1) ? 0 : 1;
        $dato->save();
        $this->defaultGrupo();
    }

    public function destroyTarifa(){
        $dato = Tarifa::findOrFail($this->tarifa_id);
        $dato->activo = ($dato->activo == 1) ? 0 : 1;
        $dato->save();
        $this->defaultTarifa();
    }

    public function defaultEspecificacion(){
        $this->defaultMaterial();
        $this->tab = 1;
        $this->nombreEspecificacion = '';
        $this->nombreNorma = '';
        $this->normas = '';
        $this->norma = [];
        $this->actionEspecificacion = '';
    }

    public function defaultMaterial(){
        $this->defaultSubgrupo();
        $this->tab = 2;
        $this->nombreMaterial = '';
        $this->especificacionLista = '';
        $this->especificacion = [];
        $this->actionMaterial = '';
    }

    public function defaultSubgrupo(){
        $this->defaultGrupo();
        $this->defaultTarifa();
        $this->tab = 3;
        $this->nombreSubgrupo = '';
        $this->materialLista = '';
        $this->material = [];
        $this->actionSubgrupo = '';
    }

    public function defaultGrupo(){
        $this->tab = 4;
        $this->nombreGrupo = '';
        $this->subgrupoLista = '';
        $this->subgrupo = [];
        $this->actionGrupo = '';
    }

    public function defaultTarifa(){
        $this->tab = 5;
        $this->nombreTarifa = '';
        $this->materialesListaTarifa = '';
        $this->materialesTarifa = [];
        $this->actionTarifa = '';
    }
}
