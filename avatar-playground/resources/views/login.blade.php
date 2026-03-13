<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <form method="POST" action="{{ route('auth-login') }}">
        @csrf
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
        <label for="senha">Senha</label>
        <input type="password" name="senha" id="senha">
        <button type="submit">Entrar</button>
    </form>
</body>
</html>