<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/GameSaber/TelaCadastro/style.css">
    <script src="https://kit.fontawesome.com/5500660c81.js" crossorigin="anonymous"></script>
    <title>Cadastro - Game Do Saber </title>
</head>
<body>
    <div class="container">
        <div id="concolor"></div> 
        <div class="buttonsForm">
            <div class="bntColor" id="tipo_cadastro" name="tipo_cadastro"></div>
            <button id="aluno" name="tipo_cadastro" value="aluno">Aluno</button>
            <button id="professor" name="tipo_cadastro" value="professor">Professor</button>
        </div>
        <form id="cadaluno" action="cadastro.php" method="post">
            <input type="text" id="nome_aluno" name="nome" placeholder="Nome" required>
            <input type="text" id="idade_aluno" name="idade" placeholder="Idade">
            <input type="text" id="escola_aluno" name="escola" placeholder="Escola" required>
            <input type="email" id="email_responsavel_aluno" class="email" name="email_responsavel" placeholder="Email" required>
            <input type="password" id="senha_aluno" name="senha" placeholder="Senha" required>
            <input type="password" id="confirmar_senha_aluno" name="confirmar_senha" placeholder="Confirmar senha" required>
            <button type="submit" name="submit" value="aluno">Cadastrar</button>
        </form>

        <form id="cadprofessor" action="cadastro.php" method="post">
            <input type="text" id="nome_professor" name="nome" placeholder="Nome" required>
            <input type="text" id="cpf_professor" name="cpf" placeholder="CPF">
            <input type="text" id="escola_professor" name="escola" placeholder="Escola" required>
            <input type="email" id="email_responsavel_professor" class="email" name="email_responsavel" placeholder="Email" required>
            <div class="senhas">
            <input type="password" id="senha_professor" name="senha" placeholder="Senha" required>
            <input type="password" id="confirmar_senha_professor" name="confirmar_senha" placeholder="Confirmar" required>
            </div>
            <input type="text" id="codigo_verif" name="codigo_verif" placeholder="Codigo de verificação" required>
            <button type="submit" name="submit" value="professor" class="btncadprof">Cadastrar</button>
        </form>
    </div>

    <style>
        .container{
            background-color: #6AFF8B;
            width: 350px;
            height: 600px;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 0 20px 0 darkgrey;
        }
        body{
            background: linear-gradient(to bottom left, #e9e6a8, #f1eda0);
        }
        
        .senhas input{
            width: 140px;
        }
    </style>
    <script>
        var formcadaluno = document.querySelector('#cadaluno');
        var formcadprofessor = document.querySelector('#cadprofessor');
        var tipo_cadastro = document.querySelector('#tipo_cadastro');
        var bntColor = document.querySelector('.bntColor');
        var concolor = document.querySelector('#concolor');
        
        document.querySelector('#aluno').addEventListener('click', () => {
            formcadaluno.style.left = '25px';
            formcadprofessor.style.left = '450px';
            bntColor.style.left = '0px';
            concolor.style.left = '0px';
            tipo_cadastro.value = 'aluno';
        });

        document.querySelector('#professor').addEventListener('click', () => {
            formcadaluno.style.left = '-450px';
            formcadprofessor.style.left = '25px';
            bntColor.style.left = '110px';
            concolor.style.left = '-450px';
            tipo_cadastro.value = 'professor';
        });
</script>


</body>
</html>