using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class item : MonoBehaviour
{
    public int value;

    // Start is called before the first frame update
    void Start()
    {
        
    }

    // Update is called once per frame
    void Update()
    {
        
    }

    void OnTriggerEnter2D(Collider2D collider)
    {
        if(collider.gameObject.tag == "Player")
        {
            result resultScript = FindObjectOfType<result>();
            if (resultScript != null)
            {
                resultScript.UpdatePlayerResult(value);
            }

            Destroy(gameObject);
        }
    }
}
