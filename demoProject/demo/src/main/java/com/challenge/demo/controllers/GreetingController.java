package com.challenge.demo.controllers;

import com.challenge.demo.models.Member;
import com.challenge.demo.services.MemberService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;
import java.util.NoSuchElementException;

@RestController
@RequestMapping("/members")
public class GreetingController {
    @Autowired
    MemberService memberService;

    @GetMapping("")
    public List<Member> list(){
        return memberService.listAllMember();
    }

    @GetMapping("/{id}")
    public ResponseEntity<Member>get(@PathVariable Integer id){
        try{
            Member member = memberService.getMember(id);
            return new ResponseEntity<Member>(member, HttpStatus.OK);
        }catch (NoSuchElementException e){
            return new ResponseEntity<Member>(HttpStatus.NOT_FOUND);
        }
    }

    @PostMapping("/")
    public void add(@RequestBody Member member){
        memberService.saveMember(member);
    }

    @PutMapping("/{id}")
    public ResponseEntity<?>update(@RequestBody Member member, @PathVariable Integer id){
        try{
           // Member existMember = memberService.getMember(id);
            member.setId(id);
            memberService.saveMember(member);
            return new ResponseEntity<>(HttpStatus.OK);
        }catch (NoSuchElementException e){
            return new ResponseEntity<>(HttpStatus.NOT_FOUND);
        }
    }

    @DeleteMapping("/{id}")
    public void delete(@PathVariable Integer id){
        memberService.deleteMember(id);
    }
}
