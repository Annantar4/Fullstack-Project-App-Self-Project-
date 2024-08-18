package com.proyek.demo_api.repository;

import org.springframework.data.jpa.repository.JpaRepository;

import com.proyek.demo_api.entity.Lokasi;

public interface LokasiRepository extends JpaRepository<Lokasi, Long>{
    
    Lokasi findByid(Long id);
}
