package com.challenge.demo.models;

import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.*;

@Entity
@Table(name = "members")
public class Member {
    private int id;
    private String message;

    public Member(){
    }

    public Member(int id, String message){
        this.id = id;
        this.message = message;
    }

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    public int getId(){
        return id;
    }
    
    public String getMessage(){
        return message;
    }

    public int setId(int id)
    {
        this.id = id;
        return id;
    }
}

