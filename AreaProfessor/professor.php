<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/GameSaber/AreaProfessor/style.css">
    <script src="https://kit.fontawesome.com/5500660c81.js" crossorigin="anonymous"></script>
    <title>Meu Perfil</title>
</head>
<body>
    <div class="container">
        <a href="/GameSaber/index.php" class="sair">
        <i class="fa-solid fa-right-from-bracket fa-xl" id="saida" ></i>
        </a>
        <div class="info-perfil" style="height: 85px; width: 85px; margin-top: 10px;">
			<img src="/GameSaber/AreaProfessor/imgs/avatarprof.jpg" style="height: 100%; width: 100%; border-radius:50px;"alt="">
        </div>
		<h3 style="font-family: sans-serif;">professora@gmail.com</h3>
        
        <div id="perfil">
            <main>
				<div class="head-title">
					<div class="left">
						<h1>Turmas</h1>
					</div>
				</div>
				<div id="box-info" class="boxinfo"></div>
                <div id="container"></div>
                <button class="add-button" onclick="adicionarDiv()">Adicionar Turma</button>

                <style>
                    
                </style>

                <script>
                    var divCount = 0;
                    var container = document.getElementById("container");

                    // Verificar se existem divs armazenadas no localStorage
                    if (localStorage.getItem("divs")) {
                        container.innerHTML = localStorage.getItem("divs");
                        adicionarEventosDivs();
                    }

                    function adicionarDiv() {
                        divCount++;

                        var div = document.createElement("div");
                        div.className = "box-info";
                        var divId = "div" + divCount;
                        div.setAttribute("data-id", divId);

                        var deleteButton = document.createElement("button");
                        deleteButton.innerHTML = "Excluir";
                        deleteButton.className = "delete-button";
                        deleteButton.onclick = function() {
                            excluirDiv(divId);
                        };

                        var renameButton = document.createElement("button");
                        renameButton.textContent = "Edit";
                        renameButton.className = "rename-button";
                        renameButton.onclick = function() {
                            abrirCaixaTexto(divId);
                        };

                        var h3 = document.createElement("h3");
                        h3.textContent = " ";
                        h3.className = "h3-title";

                        var input = document.createElement("input");
                        input.type = "text";
                        input.className = "rename-input";
                        input.placeholder = "Nome da turma";

                        var button = document.createElement("button");
                        button.textContent = "Ok";
                        button.className = "save-button";
                        button.onclick = function() {
                            salvarDiv(divId, input.value);
                        };

                        var redirectButton = document.createElement("button");
                        redirectButton.textContent = ">";
						redirectButton.style.position = "absolute";
                        redirectButton.style.bottom = "20px"; 
                        redirectButton.style.right = "10px";
                        redirectButton.className = "redirect-button";
                        redirectButton.onclick = function(event) {
                            event.stopPropagation();
                            redirecionarPagina(divId);
                        };

                        div.appendChild(h3);
                        div.appendChild(deleteButton);
                        div.appendChild(renameButton);
                        div.appendChild(input);
                        div.appendChild(button);
                        div.appendChild(redirectButton);

                        container.appendChild(div);

                        adicionarEventosDivs();

                        // Armazenar divs no localStorage
                        localStorage.setItem("divs", container.innerHTML);
                    }

                    function adicionarEventosDivs() {
                        var divs = document.getElementsByClassName("box-info");

                        for (var i = 0; i < divs.length; i++) {
                            var div = divs[i];
                            var divId = div.getAttribute("data-id");

                            div.querySelector(".delete-button").onclick = function() {
                                excluirDiv(divId);
                            };

                            div.querySelector(".rename-button").onclick = function() {
                                abrirCaixaTexto(divId);
                            };

                            div.querySelector(".save-button").onclick = function() {
                                salvarDiv(divId, div.querySelector(".rename-input").value);
                            };
                        }
                    }

                    function redirecionarPagina(divId) {
                         // Defina a URL de destino para a página desejada
                        var url = "/GameSaber/AreaProfessor/alunos.php";

                        // Redirecione para a página de destino
                        window.location.href = url;
                    }

                    function excluirDiv(divId) {
                        var div = document.querySelector('[data-id="' + divId + '"]');
                        div.parentNode.removeChild(div);

                        // Atualizar divs armazenadas no localStorage
                        localStorage.setItem("divs", container.innerHTML);
                    }

                    function abrirCaixaTexto(divId) {
                        var div = document.querySelector('[data-id="' + divId + '"]');
                        var h3 = div.querySelector("h3");
                        var input = div.querySelector(".rename-input");
                        var button = div.querySelector(".save-button");

                        h3.style.display = "none";
                        input.style.display = "block";
                        input.value = h3.textContent;
                        button.style.display = "block";
                    }

                    function salvarDiv(divId, nome) {
                        var div = document.querySelector('[data-id="' + divId + '"]');
                        var h3 = div.querySelector("h3");
                        var input = div.querySelector(".rename-input");
                        var button = div.querySelector(".save-button");

                        // Fazer requisição AJAX para o servidor PHP
                        var xhr = new XMLHttpRequest();
                        xhr.open("POST", "salvar_div.php", true);
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === 4 && xhr.status === 200) {
                                console.log(xhr.responseText);
                                // Atualizar divs armazenadas no localStorage
                                localStorage.setItem("divs", container.innerHTML);
                            }
                        };
                        xhr.send("divId=" + encodeURIComponent(divId) + "&nome=" + encodeURIComponent(nome));

                        h3.textContent = nome;

                        h3.style.display = "block";
                        input.style.display = "none";
                        button.style.display = "none";
                    }

                </script>

            </main> <!--Fim do main perfil-->
            <div class="config">
                    <button class="bntAjuste" >Ajuste</button>
                    <button class="bntHome">Home</button>
                    <button class="bntCorrecao" >Correções</button>
            </div>
        </div> <!--Fim do perfil-->
    </div> <!--Fim do Container-->

</body>
</html>