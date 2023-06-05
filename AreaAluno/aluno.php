<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/GameSaber/AreaAluno/style.css">
    <script src="https://kit.fontawesome.com/5500660c81.js" crossorigin="anonymous"></script>
    <title>Aluno</title>
</head>
<body>
    <div class="container">
        
        
        <div id="perfil">
            <main>
                <a href="/GameSaber/index.php" class="sair">
                <i class="fa-solid fa-right-from-bracket fa-xl" style="color: #000000;" id="saida" ></i>
                </a>

                <div class="info-perfil" style="height: 100px; width: 100px; margin-top: -20px; margin-left: 25px;">
                <img src="/GameSaber/AreaProfessor/imgs/AvatarAluna.svg" style="height: 100%; width: 100%; border-radius:50px;"alt="">
                </div><h4 style="font-family: sans-serif; margin-left: 50px; margin-top: -10px;">Nível 2</h4> <h3 style="font-family: sans-serif; position: absolute; bottom: 120px; right: 100px">Nicolly Souza</h3> 
                <img src="/GameSaber/AreaAluno/imgs/Progress.svg" width="250" style="position: absolute; bottom: 5px; right: 10px;"alt="">
            </main> <!--Fim do main perfil-->
        </div> <!--Fim do perfil-->
        
        <div id="jogos">
        
            <div class="content">
                <div class="boxJogo">
                    <div class="jogo" style="height: 100%;  width: 100%;  border-radius: 20px;">
                    <a href="/GameSaber/AreaAluno/regras.php"> 
                    <img src="/GameSaber/AreaAluno/imgs/Labirinto Matemático.png" alt="" style="height: 100%;  width: 100%;  border-radius: 20px;"></a>
                    <h4 style="font-family: sans-serif; margin-left: 20px;">Labirinto matemático</h4>
                    </div>
                    
                </div>
                <div class="boxJogo">
                    <div class="jogo" style="height: 100%;  width: 100%;  border-radius: 20px;">
                        <img src="/GameSaber/AreaAluno/imgs/JogoAbc.png" alt="" style="height: 100%;  width: 100%;  border-radius: 20px;">
                        <h4 style="font-family: sans-serif; margin-left: 20px;">Aventura das vogais</h4>
                    </div>
                    
                </div>
                <div class="boxJogo">
                    <div class="jogo" style="height: 100%;  width: 100%;  border-radius: 20px;">
                        <img src="/GameSaber/AreaAluno/imgs/JogoSilaba.png" alt="" style="height: 100%;  width: 100%;  border-radius: 20px;">
                        <h4 style="font-family: sans-serif; margin-left: 20px;">Silabando</h4>
                    </div>
                    
                </div>  
            </div>
        </div>

        <div id="ordemJogos">
            <div class="jogorg top-left-div">
                <a href="/GameSaber/AreaAluno/matematica.php">
                <img src="/GameSaber/AreaAluno/imgs/IconMatemat.svg" alt="" style="height: 90px; width: 90px; margin-left: -10px; margin-top: 5px;"></a>
                <p style=" font-family: sans-serif; margin-left: -13px;"> Matemática</p>
            </div>
            <div class="jogorg top-right-div">
                <a href="/GameSaber/AreaAluno/letramento.php">
                <img src="/GameSaber/AreaAluno/imgs/IconAbc.svg" alt="" style="height: 90px; width: 90px; margin-left: -10px; margin-top: 5px;"></a>
                <p style=" font-family: sans-serif; margin-left: -12px;">Letramento</p>
            </div>
            <div class="jogorg bottom-left-div">
                <a href="">
                <img src="/GameSaber/AreaAluno/imgs/IconLivros.svg" alt="" style="height: 90px; width: 90px; margin-left: -10px; margin-top: 5px;"></a>
                <p style=" font-family: sans-serif; margin-left: -12px;">Português</p>
            </div>
            <div class="jogorg bottom-right-div">
                <a href="">
                <img src="/GameSaber/AreaAluno/imgs/IconDiversos.svg" alt="" style="height: 90px; width: 90px; margin-left: -10px; margin-top: 5px;"></a>
                <p style=" font-family: sans-serif; margin-left: -12px;">Diversos</p>
            </div>
        </div>


    </div> 

</body>
</html>