package com.proyek.demo_api.response;

import java.util.List;

import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;

@Data
@NoArgsConstructor
@AllArgsConstructor
public class LokasiRespone {

    private Long id;
    private String namaLokasi;
    private String negara;
    private String provinsi;
    private String kota;
    private List<ProyekRespone> proyek;
    
}
