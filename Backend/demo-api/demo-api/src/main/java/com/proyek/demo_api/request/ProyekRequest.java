package com.proyek.demo_api.request;

import java.time.LocalDateTime;
import java.util.List;


import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;

@Data
@NoArgsConstructor
@AllArgsConstructor
public class ProyekRequest {
    private Long id;

    
    private String namaProyek;

    private String client;

   
    private String tglMulai;

  
    private String tglSelesai;

    private String pimpro;

    private String keterangan;

    private List<Long> lokasiId;
}
