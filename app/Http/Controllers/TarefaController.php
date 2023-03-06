<?php

namespace App\Http\Controllers;

use App\Exports\TarefasExport;
use App\Mail\NovaTarefaMail;
use App\Models\Tarefa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Facades\Excel as FacadesExcel;

class TarefaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = auth()->user()->id;

        $tarefas = Tarefa::where('user_id', $user_id)->paginate(10);

        $output = array(
            'tarefas' => $tarefas,
        );

        return view('tarefa.index', $output);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tarefa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->all('tarefa', 'data_limite');
        $data['user_id'] = auth()->user()->id;

        $tarefa = Tarefa::create($data);
        $destinatario = auth()->user()->email;

        Mail::to($destinatario)->send(new NovaTarefaMail($tarefa));

        return redirect()->route('tarefa.show', ['tarefa' => $tarefa->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tarefa $tarefa)
    {
        return view('tarefa.show', ['tarefa' => $tarefa]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tarefa $tarefa)
    {

        $user_id = auth()->user()->id;
        $tarefa_user_id = $tarefa->user_id;

        if ($user_id == $tarefa_user_id) {

            $output = array(
                'tarefa' => $tarefa,
            );


            return view('tarefa.edit', $output);
        } else {
            return view('acesso-negado');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tarefa $tarefa)
    {
        $tarefa->update($request->all());
        return redirect()->route('tarefa.show', ['tarefa' => $tarefa->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarefa $tarefa)
    {
        if ($tarefa->user_id != auth()->user()->id) {
            return view('acesso-negado');
        } else {

            $tarefa->delete();
            return redirect()->route('tarefa.index');
        }
    }

    public function exportacao($extensao)
    {
        if(!in_array($extensao, ['xlsx', 'csv', 'pdf'])) {
            return redirect()->route('tarefa.index');

        } else {

            $nome_arquivo = 'lista_de_tarefas' . '.' . $extensao;
            return FacadesExcel::download(new TarefasExport, $nome_arquivo);
        }
        
    }
}
