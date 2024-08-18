package com.proyek.demo_api.response;

import java.util.List;

import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;

@Data
@NoArgsConstructor
@AllArgsConstructor
public class ProyekRespone {
    private Long id;
    private String namaProyek;
    private String client;
    private String tglMulai;
    private String tglSelesai;
    private String pimpro;
    private String keterangan;
    private List<LokasiRespone> lokasi;
}
