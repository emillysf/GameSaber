using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class player : MonoBehaviour
{
    public float Speed = 2f;
    private Rigidbody2D rig;
    private Animator anim;

    private void Start()
    {
        rig = GetComponent<Rigidbody2D>();
        anim = GetComponent<Animator>();
    }

    private void Update()
    {
        Move();
    }

    void Move(){
        float horizontalInput = Input.GetAxis("Horizontal");
        float verticalInput = Input.GetAxis("Vertical");

        Vector3 movement = new Vector3(horizontalInput, verticalInput, 0.0f);

        transform.position += movement * Speed * Time.deltaTime;

        if(Input.GetAxis("Horizontal") > 0f){
            anim.SetBool("walk_h", true);
            transform.eulerAngles = new Vector3(0f,0f,0f);
        }

        if(Input.GetAxis("Horizontal") < 0f){
            anim.SetBool("walk_h", true);
            transform.eulerAngles = new Vector3(0f,180f,0f);
        }

        if(Input.GetAxis("Horizontal") == 0f){
            anim.SetBool("walk_h", false);
        }

        if(Input.GetAxis("Vertical") > 0f){
            anim.SetBool("walk_v", true);
        }

        if(Input.GetAxis("Vertical") < 0f){
            anim.SetBool("walk_v", true);
        }

        if(Input.GetAxis("Vertical") == 0f){
            anim.SetBool("walk_v", false);
        }
    }
}
