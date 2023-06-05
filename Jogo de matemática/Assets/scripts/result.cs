using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class result : MonoBehaviour
{
    private int totalValue;
    public int targetValue = 4;
    private bool gameEnded = false;

    private void Update()
    {
        if (gameEnded)
        {
            return;
        }

        // Verificar se o jogador pressionou a tecla "Enter"
        if (Input.GetKeyDown(KeyCode.Return))
        {
            // Encerrar o jogo e exibir o resultado final
            EndGame();
        }
    }

    // Método para atualizar o resultado do jogador
    public void UpdatePlayerResult(int value)
    {
        totalValue += value;
    }

    // Método para encerrar o jogo e exibir o resultado final
    private void EndGame()
    {
        gameEnded = true;

        // Verificar o resultado final
        if (totalValue == targetValue)
        {
            Debug.Log("Você ganhou!");
            gameController.instance.ShowWin();
        }
        else
        {
            Debug.Log("Game Over! Tente outra vez");
            gameController.instance.ShowGameOver();
        }
    }
}
