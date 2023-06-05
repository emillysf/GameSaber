using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.SceneManagement;

public class gameController : MonoBehaviour
{

    public int totalValue;

    public GameObject gameOver;

    public GameObject win;

    public static gameController instance;

    // Start is called before the first frame update
    void Start()
    {
        instance = this;
    }

    public void ShowGameOver()
    {
        gameOver.SetActive(true);
    }

    public void RestarGame(string lvlName)
    {
        SceneManager.LoadScene(lvlName);
    }

    public void ShowWin()
    {
        win.SetActive(true);
    }
}
