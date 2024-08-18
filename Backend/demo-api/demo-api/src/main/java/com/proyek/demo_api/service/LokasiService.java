package com.proyek.demo_api.service;

import java.util.ArrayList;
import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.proyek.demo_api.entity.Lokasi;
import com.proyek.demo_api.entity.Proyek;
import com.proyek.demo_api.repository.LokasiRepository;
import com.proyek.demo_api.request.LokasiRequest;
import com.proyek.demo_api.response.LokasiRespone;
import com.proyek.demo_api.response.LokasiResponeProyek;
import com.proyek.demo_api.response.MessageRespone;
import com.proyek.demo_api.response.ProyekRespone;
import com.proyek.demo_api.response.ProyekResponeLokasi;

@Service
public class LokasiService {
    
    @Autowired
    private LokasiRepository lokasiRepository;

    public MessageRespone updateLokasi(LokasiRequest req){

        MessageRespone res = new MessageRespone();

        try {
            Lokasi lokasi = lokasiRepository.findByid(req.getId());
            if (lokasi == null) {
                throw new Exception("Not found");
            }
            lokasi.setKota(req.getKota());
            lokasi.setNamaLokasi(req.getNamaLokasi());
            lokasi.setNegara(req.getNegara());
            lokasi.setProvinsi(req.getProvinsi());
            lokasiRepository.save(lokasi);
            res.setMsg("Success");
        } catch (Exception ex) {
            res.setMsg("ERROR: "+ex.getMessage());
        }
        return res;
    }

    public MessageRespone deleteLokasi(Long id){
        MessageRespone res = new MessageRespone();
        try {
            Lokasi lokasi = lokasiRepository.findByid(id);
            if (lokasi == null) {
                throw new Exception("Not found");
            }
            lokasiRepository.delete(lokasi);  
            res.setMsg("Success");
        } catch (Exception ex) {
            res.setMsg("ERROR: "+ex.getMessage());
        }
        return res;
    }

    public List<LokasiResponeProyek> getAllLokasi(){
        List<Lokasi> lokasiList = lokasiRepository.findAll();
        List<LokasiResponeProyek> responseList = new ArrayList<>();

        for(Lokasi lokasi : lokasiList){
            LokasiResponeProyek response = new LokasiResponeProyek();
            response.setId(lokasi.getId());
            response.setNamaLokasi(lokasi.getNamaLokasi());
            response.setNegara(lokasi.getNegara());
            response.setProvinsi(lokasi.getProvinsi());
            response.setKota(lokasi.getKota());

            List<ProyekResponeLokasi> proyekLokasiRes = new ArrayList<>();
            for(Proyek proyek : lokasi.getProyek()){
                ProyekResponeLokasi proyekresponses = new ProyekResponeLokasi();
                proyekresponses.setId(proyek.getId());
                proyekresponses.setNamaProyek(proyek.getNamaProyek());
                proyekresponses.setClient(proyek.getClient());
                proyekresponses.setTglMulai(proyek.getTglMulai().toString());
                proyekresponses.setTglSelesai(proyek.getTglSelesai().toString());
                proyekresponses.setPimpro(proyek.getPimpro());
                proyekresponses.setKeterangan(proyek.getKeterangan());
                proyekLokasiRes.add(proyekresponses);
            }
            response.setProyek(proyekLokasiRes);
            responseList.add(response);
        }
        return responseList;
    }

    public LokasiResponeProyek getLokasiById(Long id){
        LokasiResponeProyek res = new LokasiResponeProyek();
        try {
            Lokasi lokasi = lokasiRepository.findByid(id);
            if (lokasi == null) {
                throw new Exception("Not Found");
            }
            res.setId(lokasi.getId());
            res.setNamaLokasi(lokasi.getNamaLokasi());
            res.setNegara(lokasi.getNegara());
            res.setProvinsi(lokasi.getProvinsi());
            res.setKota(lokasi.getKota());
            List<ProyekResponeLokasi> proyekLokasiRes = new ArrayList<>();
            for(Proyek proyek : lokasi.getProyek()){
                ProyekResponeLokasi proyekresponses = new ProyekResponeLokasi();
                proyekresponses.setId(proyek.getId());
                proyekresponses.setNamaProyek(proyek.getNamaProyek());
                proyekresponses.setClient(proyek.getClient());
                proyekresponses.setTglMulai(proyek.getTglMulai().toString());
                proyekresponses.setTglSelesai(proyek.getTglSelesai().toString());
                proyekresponses.setPimpro(proyek.getPimpro());
                proyekresponses.setKeterangan(proyek.getKeterangan());
                proyekLokasiRes.add(proyekresponses);
            }
            res.setProyek(proyekLokasiRes);

        } catch (Exception ex) {
            res.setId(null);
        }
        return res;
    }
    



}
