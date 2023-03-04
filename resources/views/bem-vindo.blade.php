SITE DA APLICAÇÃO
<br>
@auth()
    <h1>Usuario autenticado</h1>
    <p>Id: {{ Auth::user()->id }}</p>
    <p>Nome: {{ Auth::user()->name }}</p>
    <p>Email: {{ Auth::user()->email }}</p>


@endauth

@guest()
    <p>Olá visitante, tudo bem?</p>
@endguest