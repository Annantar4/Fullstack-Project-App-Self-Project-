package com.proyek.demo_api.service;

import java.time.LocalDateTime;
import java.time.format.DateTimeFormatter;
import java.util.ArrayList;
import java.util.List;
import java.util.stream.Collectors;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.proyek.demo_api.entity.Lokasi;
import com.proyek.demo_api.entity.Proyek;
import com.proyek.demo_api.repository.LokasiRepository;
import com.proyek.demo_api.repository.ProyekRepository;
import com.proyek.demo_api.request.ProyekRequest;
import com.proyek.demo_api.response.LokasiRespone;
import com.proyek.demo_api.response.MessageRespone;
import com.proyek.demo_api.response.ProyekRespone;
import com.proyek.demo_api.response.ProyekResponeLokasi;

@Service
public class ProyekService {
    
    @Autowired
    private ProyekRepository proyekRepository;

    @Autowired
    private LokasiRepository lokasiRepository;

    public ProyekRespone createProyek(ProyekRequest req) {
        DateTimeFormatter formatter = DateTimeFormatter.ofPattern("yyyy-MM-dd HH:mm");
        Proyek proyek = new Proyek();
        proyek.setNamaProyek(req.getNamaProyek());
        proyek.setClient(req.getClient());
        proyek.setTglMulai(LocalDateTime.parse(req.getTglMulai(), formatter));
        proyek.setTglSelesai(LocalDateTime.parse(req.getTglSelesai(), formatter));
        proyek.setPimpro(req.getPimpro());
        proyek.setKeterangan(req.getKeterangan());

        List<Lokasi> lokasis = new ArrayList<>();
        for (Long lokasiId : req.getLokasiId()) {
            Lokasi lokasi = lokasiRepository.findById(lokasiId)
                .orElseThrow(() -> new RuntimeException("Lokasi dengan id " + lokasiId + " tidak ditemukan"));
            lokasis.add(lokasi);
        }
        proyek.setLokasi(lokasis);

        proyek = proyekRepository.save(proyek);

        ProyekRespone response = new ProyekRespone();
        response.setId(proyek.getId());
        response.setNamaProyek(proyek.getNamaProyek());
        response.setClient(proyek.getClient());
        response.setTglMulai(proyek.getTglMulai().toString());
        response.setTglSelesai(proyek.getTglSelesai().toString());
        response.setPimpro(proyek.getPimpro());
        response.setKeterangan(proyek.getKeterangan());

        List<LokasiRespone> lokasiResponses = new ArrayList<>();
        for (Lokasi lokasi : proyek.getLokasi()) {
            LokasiRespone lokasiResponse = new LokasiRespone();
            lokasiResponse.setId(lokasi.getId());
            lokasiResponse.setNamaLokasi(lokasi.getNamaLokasi());
            lokasiResponse.setNegara(lokasi.getNegara());
            lokasiResponse.setProvinsi(lokasi.getProvinsi());
            lokasiResponse.setKota(lokasi.getKota());
            lokasiResponses.add(lokasiResponse);
        }
        
        response.setLokasi(lokasiResponses);

        return response;
    }

    public List<ProyekRespone> getAllProyek(){
        List<Proyek> proyekList = proyekRepository.findAll();
        List<ProyekRespone> responseList = new ArrayList<>();
        for(Proyek proyek : proyekList){
            ProyekRespone response = new ProyekRespone();
            response.setId(proyek.getId());
            response.setNamaProyek(proyek.getNamaProyek());
            response.setClient(proyek.getClient());
            response.setTglMulai(proyek.getTglMulai().toString());
            response.setTglSelesai(proyek.getTglSelesai().toString());
            response.setPimpro(proyek.getPimpro());
            response.setKeterangan(proyek.getKeterangan());

            List<LokasiRespone> lokasiResponses = new ArrayList<>();
            for (Lokasi lokasi : proyek.getLokasi()) {
                LokasiRespone lokasiResponse = new LokasiRespone();
                lokasiResponse.setId(lokasi.getId());
                lokasiResponse.setNamaLokasi(lokasi.getNamaLokasi());
                lokasiResponse.setNegara(lokasi.getNegara());
                lokasiResponse.setProvinsi(lokasi.getProvinsi());
                lokasiResponse.setKota(lokasi.getKota());
                lokasiResponses.add(lokasiResponse);
            }
            response.setLokasi(lokasiResponses);
            responseList.add(response);

        }
        return responseList;
    }

    public MessageRespone updateProyek(ProyekRequest req){
        DateTimeFormatter formatter = DateTimeFormatter.ofPattern("yyyy-MM-dd HH:mm");
        MessageRespone res = new MessageRespone();
        try {
            Proyek proyek = proyekRepository.findByid(req.getId());
            if (proyek == null) {
                throw new Exception("Not Found");
            }
            proyek.setNamaProyek(req.getNamaProyek());
            proyek.setClient(req.getClient());
            proyek.setTglMulai(LocalDateTime.parse(req.getTglMulai(), formatter));
            proyek.setTglSelesai(LocalDateTime.parse(req.getTglSelesai(), formatter));
            proyek.setPimpro(req.getPimpro());
            proyek.setKeterangan(req.getKeterangan());

            List<Lokasi> lokasis = new ArrayList<>();
            for (Long lokasiId : req.getLokasiId()) {
                Lokasi lokasi = lokasiRepository.findById(lokasiId)
                    .orElseThrow(() -> new RuntimeException("Lokasi dengan id " + lokasiId + " tidak ditemukan"));
                lokasis.add(lokasi);
            }
            proyek.setLokasi(lokasis);
            proyekRepository.save(proyek);
            res.setMsg("Success");
        } catch (Exception ex) {
            res.setMsg("ERROR: "+ex.getMessage());
        }
        
        return res;

    }

    public MessageRespone deleteproyek(Long id){
        MessageRespone res = new MessageRespone();
        try {
            Proyek proyek = proyekRepository.findByid(id);
            if (proyek == null) {
                throw new Exception("Not Found");
            }
            proyekRepository.delete(proyek);
            res.setMsg("Success");
        } catch (Exception ex) {
            res.setMsg("ERROR: "+ex.getMessage());
        }
        return res;
    }

    public ProyekRespone getProyekById(Long id){
        ProyekRespone res = new ProyekRespone();
        try {
            Proyek proyek = proyekRepository.findByid(id);
            if (proyek == null) {
                throw new Exception("Not Found");
            }
            res.setId(proyek.getId());
            res.setNamaProyek(proyek.getNamaProyek());
            res.setClient(proyek.getClient());
            res.setPimpro(proyek.getPimpro());
            res.setTglMulai(proyek.getTglMulai().toString());
            res.setTglSelesai(proyek.getTglSelesai().toString());
            res.setKeterangan(proyek.getKeterangan());
            List<LokasiRespone> lokasiResponses = new ArrayList<>();
            for (Lokasi lokasi : proyek.getLokasi()) {
                LokasiRespone lokasiResponse = new LokasiRespone();
                lokasiResponse.setId(lokasi.getId());
                lokasiResponse.setNamaLokasi(lokasi.getNamaLokasi());
                lokasiResponse.setNegara(lokasi.getNegara());
                lokasiResponse.setProvinsi(lokasi.getProvinsi());
                lokasiResponse.setKota(lokasi.getKota());
                lokasiResponses.add(lokasiResponse);
            }
            res.setLokasi(lokasiResponses);
            
        } catch (Exception e) {
            res.setId(null);
        }
        return res;
    }


    
}
