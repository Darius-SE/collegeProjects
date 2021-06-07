package com.challenge.demo.repositories;

import com.challenge.demo.models.Member;
import org.springframework.data.jpa.repository.JpaRepository;

public interface MemberRepository
extends JpaRepository<Member, Integer>{
}
