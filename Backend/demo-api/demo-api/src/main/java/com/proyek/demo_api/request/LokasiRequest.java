package com.proyek.demo_api.request;

import java.time.LocalDateTime;
import java.util.List;


import com.proyek.demo_api.entity.Proyek;


import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;

@Data
@AllArgsConstructor
@NoArgsConstructor
public class LokasiRequest {
    private Long id;

    
    private String namaLokasi;

    private String negara;

    private String provinsi;

    private String kota;


    private LocalDateTime createdAt;


    
}
