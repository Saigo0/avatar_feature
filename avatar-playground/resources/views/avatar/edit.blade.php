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
        
        <div class="w-1/2 bg-white rounded-lg border-2 border-gray-300 flex items-center justify-center min-h-[400px]">
            <canvas id="avatarCanvas" width="400" height="400"></canvas>
        </div>

        <div class="w-1/2">
            <h2 class="text-2xl font-bold mb-4">Personalizar Avatar 2D</h2>
            
            <div class="mb-4">
                <label class="block font-bold mb-2">Cabelo</label>
                <select id="hairSelect" class="border p-2 rounded">
                    <option value="loiro">Loiro</option>
                    <option value="vermelho">Vermelho</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-bold mb-2">Cor da Camisa</label>
                <select id="shirtSelect" class="border p-2 rounded">
                    <option value="azul">Azul</option>
                    <option value="verde">Verde</option>
                </select>
            </div>

            <button onclick="salvarAvatar()" class="bg-blue-600 text-white px-4 py-2 rounded mt-4">
                Salvar Avatar
            </button>
        </div>
    </div>

    <script>


        let selectedItems = {
            hair: document.getElementById('hairSelect').value,
            shirt: document.getElementById('shirtSelect').value
        };

        function drawAvatar(){
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            const bodyImg = new Image();
            bodyImg.src = 'imagens/body.png';
            bodyImg.onload = () => {
                ctx.drawImage(bodyImg, 0, 0, canvas.width, canvas.height);
                const hairImg = new Image();
                hairImg.src = 'imagens/' + selectedItems.hair + '.png';
                hairImg.onload = () => {
                    ctx.drawImage(hairImg, 0, 0, canvas.width, canvas.height);
                    const shirtImg = new Image();
                    shirtImg.src = 'imagens/' + selectedItems.shirt + '.png';
                    shirtImg.onload = () => {
                        ctx.drawImage(shirtImg, 0, 0, canvas.width, canvas.height);
                    };
                };
            };
        }

        document.getElementById('hairSelect').addEventListener('change', (event) => {
            selectedItems.hair = event.target.value;
            drawAvatar();
        });

        document.getElementById('shirtSelect').addEventListener('change', (event) => {
            selectedItems.shirt = event.target.value;
            drawAvatar();
        });

        drawAvatar();

        function salvarAvatar(){
            const features = {
                hairSelect: document.getElementById('hairSelect').value,
                shirtSelect: document.getElementById('shirtSelect').value
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