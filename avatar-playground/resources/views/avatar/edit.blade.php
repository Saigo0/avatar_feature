<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laboratório de Avatares 3D</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://aframe.io/releases/1.4.2/aframe.min.js"></script>
</head>
<body class="bg-gray-100 p-10">

    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md flex gap-8">
        
        <div class="w-1/2 bg-gray-200 rounded-lg overflow-hidden border-2 border-gray-300 min-h-[500px] relative">
            <a-scene embedded vr-mode-ui="enabled: false">
                <a-light type="ambient" color="#ffffff" intensity="0.6"></a-light>
                <a-light type="directional" position="1 2 1" intensity="0.8"></a-light>

                <a-entity id="avatar-group" position="0 -1.5 -3" rotation="0 0 0" scale="1 1 1">
                    <a-entity id="part-body" gltf-model="/models/chibi1.glb"></a-entity>

                    <a-entity id="part-hair" gltf-model="/models/cabelo_chibi1.glb"></a-entity>

                    <a-entity id="part-shirt" gltf-model="/models/camisa1.glb"></a-entity>

                    <a-entity id="part-lower" gltf-model="/models/calca1.glb"></a-entity>

                    <a-entity id="part-hat" gltf-model="/models/chapeu1.glb"></a-entity>

                    <a-entity id="part-shoes" gltf-model="/models/sapato1.glb"></a-entity>

                    <a-entity id="part-accessories" gltf-model="/models/acessorios1.glb"></a-entity>

                    <a-entity id="part-expression" gltf-model="/models/expression1.glb"></a-entity>
                </a-entity>

                <a-camera position="0 0 0"></a-camera>
            </a-scene>
        </div>

        <div class="w-1/2">
            <h2 class="text-2xl font-bold mb-4">Personalizar Avatar 3D</h2>

            <div class="mb-4">
                <label class="block font-bold mb-2">Pele</label>
                <select id="skinToneSelect" class="border p-2 rounded w-full">
                    <option value="#ffffff">Branco</option>
                    <option value="#e5c158" selected>Amarelo</option>
                    <option value="#cc2222">Vermelho</option>
                </select>
            </div>
            
            <div class="mb-4">
                <label class="block font-bold mb-2">Expressão</label>
                <select id="expressionSelect" class="border p-2 rounded w-full">
                    <option value="none">Sem Expressão</option>
                    <option value="#e5c158" selected>Feliz</option>
                    <option value="#cc2222">Triste</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-bold mb-2">Chapéu</label>
                <select id="hatSelect" class="border p-2 rounded w-full">
                    <option value="none">Sem Chapéu</option>
                    <option value="#e5c158" selected>Amarelo</option>
                    <option value="#cc2222">Vermelho</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-bold mb-2">Cabelo</label>
                <select id="hairSelect" class="border p-2 rounded w-full">
                    <option value="none">Sem Cabelo</option>
                    <option value="#e5c158" selected>Loiro</option>
                    <option value="#cc2222">Vermelho</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-bold mb-2">Camisa</label>
                <select id="shirtSelect" class="border p-2 rounded w-full">
                    <option value="none">Sem Camisa</option>
                    <option value="#2255cc" selected>Azul</option>
                    <option value="#22cc55">Verde</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-bold mb-2">Sapato</label>
                <select id="shoesSelect" class="border p-2 rounded w-full">
                    <option value="none">Sem Sapato</option>
                    <option value="#e5c158" selected>Amarelo</option>
                    <option value="#cc2222">Vermelho</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-bold mb-2">Acessório</label>
                <select id="accessoriesSelect" class="border p-2 rounded w-full">
                    <option value="none">Sem Acessório</option>
                    <option value="#e5c158" selected>Amarelo</option>
                    <option value="#cc2222">Vermelho</option>
                </select>
            </div>



            <button onclick="salvarAvatar()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded mt-4 w-full">
                Salvar Avatar
            </button>
        </div>
    </div>

    <script>
        let selectedItems = {
            skinTone: document.getElementById('skinToneSelect').value,
            hair: document.getElementById('hairSelect').value,
            shirt: document.getElementById('shirtSelect').value
        };

        function aplicarCor(parteId, corHex) {
            const entidade = document.getElementById(parteId);
            const mesh = entidade.getObject3D('mesh');
            
            if (mesh) {
                mesh.traverse((node) => {
                    if (node.isMesh && node.material) {
                        node.material = node.material.clone(); 
                        node.material.color.set(corHex);
                    }
                });
            }
        }

        document.getElementById('hairSelect').addEventListener('change', (event) => {
            selectedItems.hair = event.target.value;
            const hairEntity = document.getElementById('part-hair');

            if (selectedItems.hair === 'none') {
                hairEntity.setAttribute('visible', 'false'); 
            } else {
                hairEntity.setAttribute('visible', 'true'); 
                aplicarCor('part-hair', selectedItems.hair);
            }
        });

        document.getElementById('shirtSelect').addEventListener('change', (event) => {
            selectedItems.shirt = event.target.value;
            const shirtEntity = document.getElementById('part-shirt');

            if (selectedItems.shirt === 'none') {
                shirtEntity.setAttribute('visible', 'false'); 
            } else {
                shirtEntity.setAttribute('visible', 'true');  
                aplicarCor('part-shirt', selectedItems.shirt); 
            }
        });

        document.getElementById('skinToneSelect').addEventListener('change', (event) => {
            selectedItems.skinTone = event.target.value;
            aplicarCor('part-body', selectedItems.skinTone);
        });

        document.getElementById('part-shirt').addEventListener('model-loaded', () => {
             if (selectedItems.shirt !== 'none') aplicarCor('part-shirt', selectedItems.shirt);
        });
        document.getElementById('part-hair').addEventListener('model-loaded', () => {
             if (selectedItems.hair !== 'none') aplicarCor('part-hair', selectedItems.hair);
        });
            document.getElementById('part-body').addEventListener('model-loaded', () => {
                aplicarCor('part-body', selectedItems.skinTone);
            });

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
            .then(data => alert('Salvo no banco de dados com sucesso!'))
            .catch(error => console.error('Erro ao salvar:', error));
        }
    </script>
</body>
</html>