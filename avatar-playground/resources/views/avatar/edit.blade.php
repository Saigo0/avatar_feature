<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laboratório de Avatares</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class = "bg-gray-100 p-10">

    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md flex gap-8">
        <div class="w-1/2 bg-gray-200 rounded-lg flex items-center justify-center min-h-[400px]" id="avatar-preview">
            <p>Avatar aqui</p>
        </div>
        <div>
            <h2>Personalizar Avatar</h2>
            <div>

            </div>
            <div>

            </div>
            <button></button>
        </div>
    </div>

    <script>
        function salvarAvatar(){
            const features = {
                skin_color: document.getElementById('skinColor').value,
                shirt_color: document.getElementById('shirtColor').value
            };

            fetch('/avatar', {
                method:'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({features: features})
            })
            .then(response => response.json())
            .then(data => alert('Salvo no banco de dados com sucesso!'));
        }
    </script>
</body>
</html>