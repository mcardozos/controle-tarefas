<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        
        .page-break{
            page-break-after: always;
        }
        
        
        
        .titulo {
            border: 1px;
            background-color: #c2c2c2;
            text-align: center;
            width: 100%;
            text-transform: uppercase;
            font-weight: bold;
            margin-bottom: 25px;

        }

        .tabela {
            width: 100%;
        }

        table th{
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="titulo">
        Lista de tarefas
    </div>


    <table class="tabela">
        <thead>
            <tr>
                <td>Id</td>
                <td>Tarefa</td>
                <td>Data limite</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($tarefas as $tarefa)
                <tr>
                    <td>{{ $tarefa->id }}</td>
                    <td>{{ $tarefa->tarefa }}</td>
                    <td>{{ date('d/m/Y', strtotime($tarefa->data_limite)) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="page-break"></div>
    <h2>Pagina 2</h2>
    <div class="page-break"></div>
    <h2>Pagina 3</h2>
    <div class="page-break"></div>
    <h2>Pagina 4</h2>
</body>

</html>
