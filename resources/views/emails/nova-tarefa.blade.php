<x-mail::message>
# {{ $tarefa }}

Data limite da tarefa: {{ $data_limite }}

{{-- <x-mail::button :url= "''">
Clique aqui para ver a tarefa
</x-mail::button> --}}

Atenciosamente,<br>
{{ config('app.name') }}
</x-mail::message>
