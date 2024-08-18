package com.proyek.demo_api.controller;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import com.proyek.demo_api.entity.Lokasi;
import com.proyek.demo_api.repository.LokasiRepository;
import com.proyek.demo_api.request.LokasiRequest;
import com.proyek.demo_api.response.LokasiRespone;
import com.proyek.demo_api.response.LokasiResponeProyek;
import com.proyek.demo_api.response.MessageRespone;
import com.proyek.demo_api.service.LokasiService;

import static com.proyek.demo_api.response.Message.SUCCESS_MESSAGE;

@RestController
@RequestMapping("api")
public class LokasiController {
    
    @Autowired
    private LokasiRepository lokasiRepository;

    @Autowired
    private LokasiService lokasiService;

    @GetMapping("/lokasi")
    public ResponseEntity<List<LokasiResponeProyek>> getAllLokasi(){
        List<LokasiResponeProyek> response = lokasiService.getAllLokasi();
        return ResponseEntity.ok(response);  
    }

    @PostMapping("/lokasi")
    public Lokasi createLokasi(@RequestBody Lokasi lokasi){
        return lokasiRepository.save(lokasi);
    }


    @PutMapping("/lokasi")
    public ResponseEntity<MessageRespone> updateLokasi(@RequestBody LokasiRequest req){

        MessageRespone response = lokasiService.updateLokasi(req);   
        if(response.getMsg().equalsIgnoreCase(SUCCESS_MESSAGE)) {
            return ResponseEntity.status(HttpStatus.OK).body(response);
        }
        else{
            return ResponseEntity.status(HttpStatus.NOT_FOUND).body(response);
        }
    }

    @DeleteMapping("/lokasi/{id}")
    public ResponseEntity<MessageRespone> deleteLokasi(@PathVariable Long id){
        MessageRespone response = lokasiService.deleteLokasi(id);
        if(response.getMsg().equalsIgnoreCase(SUCCESS_MESSAGE)) {
            return ResponseEntity.status(HttpStatus.OK).body(response);
        }
        else{
            return ResponseEntity.status(HttpStatus.NOT_FOUND).body(response);
        }
    }

    @GetMapping("/lokasi/{id}")
    public ResponseEntity<LokasiResponeProyek> getLokasiById(@PathVariable Long id){
        LokasiResponeProyek response = lokasiService.getLokasiById(id);
        return ResponseEntity.ok(response);
    }



    
    
}
