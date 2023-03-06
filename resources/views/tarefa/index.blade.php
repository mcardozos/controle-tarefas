@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                Tarefas
                            </div>
                            <div class="float-end">
                                <div class="col-6">
                                    <a href="{{ route('tarefa.create') }}" class="mr-3">Novo</a>
                                    <a href="{{ route('tarefa.exportacao', ['extensao' => 'xlsx']) }}">XLSX</a>
                                    <a href="{{ route('tarefa.exportacao', ['extensao' => 'csv']) }}">CSV</a>
                                    <a href="{{ route('tarefa.exportacao', ['extensao' => 'pdf']) }}">PDF</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Tarefa</th>
                                    <th>Data Limite</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tarefas as $tarefa)
                                    <tr>
                                        <td>{{ $tarefa->id }}</td>
                                        <td>{{ $tarefa->tarefa }}</td>
                                        <td>{{ date('d/m/Y', strtotime($tarefa->data_limite)) }}</td>
                                        <td><a href="{{ route('tarefa.edit', $tarefa->id) }}">Editar</a></td>
                                        <td>
                                            <form action="{{ route('tarefa.destroy', ['tarefa' => $tarefa->id]) }}"
                                                id="form_{{ $tarefa->id }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                            </form>
                                            <a href="#"
                                                onclick="document.getElementById('form_{{ $tarefa->id }}').submit()">Excluir</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link"
                                        href="{{ $tarefas->previousPageUrl() }}">Voltar</a>
                                </li>

                                @for ($i = 1; $i <= $tarefas->lastPage(); $i++)
                                    <li class="page-item {{ $tarefas->currentPage() == $i ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $tarefas->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                                <li class="page-item"><a class="page-link" href="{{ $tarefas->nextPageUrl() }}">Avançar</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
