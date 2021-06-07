package com.challenge.demo.services;

import com.challenge.demo.models.Member;
import com.challenge.demo.repositories.MemberRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import java.util.List;
@Service
@Transactional
public class MemberService {
    @Autowired
    private MemberRepository memberRepository;
    public List<Member> listAllMember()
    {
        return memberRepository.findAll();
    }

    public void saveMember(Member member)
    {
        memberRepository.save(member);
    }

    public Member getMember(Integer id)
    {
        return memberRepository.findById(id).get();
    }

    public void deleteMember(Integer id)
    {
        memberRepository.deleteById(id);
    }
}
