<?php

function mergeSortDivs(&$divs) {
    $count = count($divs);

    if ($count <= 1) {
        return;
    }

    $mid = (int) ($count / 2);
    $left = array_slice($divs, 0, $mid);
    $right = array_slice($divs, $mid);

    mergeSortDivs($left);
    mergeSortDivs($right);

    $i = $j = $k = 0;

    while ($i < count($left) && $j < count($right)) {
        $leftName = $left[$i]['name'];
        $rightName = $right[$j]['name'];

        if (strcasecmp($leftName, $rightName) <= 0) {
            $divs[$k] = $left[$i];
            $i++;
        } else {
            $divs[$k] = $right[$j];
            $j++;
        }

        $k++;
    }

    while ($i < count($left)) {
        $divs[$k] = $left[$i];
        $i++;
        $k++;
    }

    while ($j < count($right)) {
        $divs[$k] = $right[$j];
        $j++;
        $k++;
    }
}

if (isset($_POST['divs'])) {
    $divs = json_decode($_POST['divs'], true);
    mergeSortDivs($divs);
    echo json_encode($divs);
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/GameSaber/AreaProfessor/style.css">
    <script src="https://kit.fontawesome.com/5500660c81.js" crossorigin="anonymous"></script>
    <title>Alunos</title>
</head>
<body>
    <div class="container">
        <a href="/GameSaber/AreaProfessor/professor.php" class="sair">
        <i class="fa-solid fa-angles-left fa-2xl" style="color: #000000;" id="saida" ></i>
        </a>
        
        <div class="info-perfil">
            <h1 style="font-family: sans-serif;">Turma <br> Nova Escola</h1>
            <h3 style="font-family: sans-serif;">1º Série</h3>
        </div>
        <div id="perfil">
            <button class="add-button" onclick="adicionarDiv()" style="margin-left:95px; margin-top: -10px;">Adicionar Aluno</button>
            <main>
            
                <div id="box-info" class="boxinfo"></div>
                <div id="container"></div>
                
                <button class="order-button" onclick="ordenarDivs()">A-Z</button>
                            
                <script>
                    
                    var divCount = 0;
                    var containerAlunos = document.getElementById("container");

                    // Verificar se existem divs armazenadas no localStorage
                    if (localStorage.getItem("divs_alunos")) {
                        containerAlunos.innerHTML = localStorage.getItem("divs_alunos");
                        adicionarEventosDivs();
                    }

                    function adicionarDiv() {
                        divCount++;

                        var div = document.createElement("div");
                        div.className = "box-info";
                        var divId = "div" + divCount;
                        div.setAttribute("data-id", divId);

                        var profileIcon = document.createElement("i");
                        profileIcon.className = "fa-solid fa-user fa-2xl" ; // Defina a URL da imagem de perfil aqui
                        profileIcon.style.color = "#5d1ff2";
                        profileIcon.style.position = "absolute";
                        profileIcon.style.top = "50px";
                        profileIcon.style.left = "25px"

                        var deleteButton = document.createElement("button");
                        deleteButton.innerHTML = "Excluir";
                        deleteButton.className = "delete-button";
                        deleteButton.onclick = function () {
                            excluirDiv(divId);
                        };

                        var renameButton = document.createElement("button");
                        renameButton.textContent = "Edit";
                        renameButton.className = "rename-button";
                        renameButton.onclick = function () {
                            abrirCaixaTexto(divId);
                        };

                        var h3 = document.createElement("h3");
                        h3.textContent = " ";
                        h3.className = "h3-title";
                        h3.style.position = "absolute";
                        h3.style.top = "35px";
                        h3.style.left = "70px"

                        var input = document.createElement("input");
                        input.type = "text";
                        input.className = "rename-input";
                        input.placeholder = "Nome do Aluno";
                        input.style.position = "absolute";
                        input.style.top = "35px";
                        input.style.left = "70px"

                        var button = document.createElement("button");
                        button.style.position = "absolute";
                        button.style.right = "35px"
                        button.textContent = "Ok";
                        button.className = "save-button";
                        button.onclick = function () {
                            salvarDiv(divId, input.value);
                        };

                        var redirectButton = document.createElement("button");
                        redirectButton.textContent = ">";
                        redirectButton.style.position = "absolute";
                        redirectButton.style.bottom = "20px"; 
                        redirectButton.style.right = "10px"; 
                        redirectButton.className = "redirect-button";
                        redirectButton.onclick = function (event) {
                            event.stopPropagation();
                            redirecionarPagina(divId);
                        };

                        div.appendChild(profileIcon);
                        div.appendChild(h3);
                        div.appendChild(deleteButton);
                        div.appendChild(renameButton);
                        div.appendChild(input);
                        div.appendChild(button);
                        div.appendChild(redirectButton);

                        containerAlunos.appendChild(div);

                        adicionarEventosDivs();

                        // Armazenar divs no localStorage
                        localStorage.setItem("divs_alunos", containerAlunos.innerHTML);
                    }

                    function adicionarEventosDivs(){
                        var divs = document.getElementsByClassName("box-info");

                        for (var i = 0; i < divs.length; i++) {
                            var div = divs[i];
                            var divId = div.getAttribute("data-id");

                            div.querySelector(".delete-button").onclick = function () {
                                excluirDiv(divId);
                            };

                            div.querySelector(".rename-button").onclick = function () {
                                abrirCaixaTexto(divId);
                            };

                            div.querySelector(".save-button").onclick = function () {
                                salvarDiv(divId, div.querySelector(".rename-input").value);
                            };
                        }
                    }

                    function redirecionarPagina(divId) {
                    var url = "/GameSaber/AreaProfessor/perfilAluno.php";
                    localStorage.setItem("divs_alunos", containerAlunos.innerHTML); // Armazena as divs dos alunos no localStorage
                    container.innerHTML = ""; // Limpa o conteúdo do containerProfessor
                    window.location.href = url;
                    }


                    function excluirDiv(divId) {
                        var div = document.querySelector('[data-id="' + divId + '"]');
                        div.parentNode.removeChild(div);
                        localStorage.setItem("divs_alunos", containerAlunos.innerHTML);
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
                        var xhr = new XMLHttpRequest();
                        xhr.open("POST", "", true);
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xhr.onreadystatechange = function () {
                            if (xhr.readyState === 4 && xhr.status === 200) {
                                console.log(xhr.responseText);
                                localStorage.setItem("divs_alunos", containerAlunos.innerHTML);
                            }
                        };
                        xhr.send("divId=" + encodeURIComponent(divId) + "&nome=" + encodeURIComponent(nome));

                        h3.textContent = nome;

                        h3.style.display = "block";
                        input.style.display = "none";
                        button.style.display = "none";
                    }

                    function ordenarDivs() {
                        var divs = Array.from(document.getElementsByClassName("box-info"));
                        var divsData = [];

                        divs.forEach(function (div) {
                            var divId = div.getAttribute("data-id");
                            var h3 = div.querySelector("h3");
                            var name = h3.textContent;

                            divsData.push({
                                id: divId,
                                name: name
                            });
                        });

                        // Enviar pro PHP
                        var xhr = new XMLHttpRequest();
                        xhr.open("POST", "", true);
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === 4 && xhr.status === 200) {
                                var sortedDivs = JSON.parse(xhr.responseText);
                                reorganizarDivs(sortedDivs);
                            }
                        };
                        xhr.send("divs=" + encodeURIComponent(JSON.stringify(divsData)));
                    }

                    function reorganizarDivs(sortedDivs) {
                        var containerAlunos = document.getElementById("container");
                        sortedDivs.forEach(function (divData) {
                            var div = document.querySelector('[data-id="' + divData.id + '"]');
                            containerAlunos.appendChild(div);
                        });
                        adicionarEventosDivs();
                        localStorage.setItem("divs_alunos", containerAlunos.innerHTML);
                    }
                </script>
            </main>
        </div>
    </div>
</body>
</html>