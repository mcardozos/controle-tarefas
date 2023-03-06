<?php

namespace App\Exports;

use App\Models\Tarefa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TarefasExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return Tarefa::all();
        return auth()->user()->tarefas()->get();
        
    }

    public function headings():array{
        
        $headings = array(
            'Id tarefa',
            // 'Id usuário',
            'Tarefa',
            'Data limite',
            // 'Data criação',
            // 'Data atualização'
        );

        return $headings;
    }

    public function map($linha):array{

        $export_data = array(
            $linha->id,
            $linha->tarefa,
            date('d/m/Y', strtotime($linha->data_limite)) 
        );

        return $export_data;
    }
}
