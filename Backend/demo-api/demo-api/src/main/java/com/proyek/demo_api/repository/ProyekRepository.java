package com.proyek.demo_api.repository;

import org.springframework.data.jpa.repository.JpaRepository;

import com.proyek.demo_api.entity.Proyek;

public interface ProyekRepository extends JpaRepository<Proyek, Long>{
    
    Proyek findByid(Long id);
}
