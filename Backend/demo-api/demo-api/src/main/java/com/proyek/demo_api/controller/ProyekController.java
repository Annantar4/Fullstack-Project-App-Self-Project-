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

import com.proyek.demo_api.entity.Proyek;
import com.proyek.demo_api.repository.ProyekRepository;
import com.proyek.demo_api.request.ProyekRequest;
import com.proyek.demo_api.response.MessageRespone;
import com.proyek.demo_api.response.ProyekRespone;
import com.proyek.demo_api.service.ProyekService;

import static com.proyek.demo_api.response.Message.SUCCESS_MESSAGE;


@RestController
@RequestMapping("api")
public class ProyekController {
    
    @Autowired
    private ProyekRepository proyekRepository;

    @Autowired
    private ProyekService proyekService;
    

    @GetMapping("/proyek")
    public ResponseEntity<List<ProyekRespone>> getAllProyek(){
        List<ProyekRespone> response = proyekService.getAllProyek();
        return ResponseEntity.ok(response);
    }



    @PostMapping("/proyek")
    public ResponseEntity<ProyekRespone> createProyek(@RequestBody ProyekRequest req) {
        ProyekRespone proyekResponse = proyekService.createProyek(req);
        return ResponseEntity.ok(proyekResponse);
    }


    @PutMapping("/proyek")
    public ResponseEntity<MessageRespone> updateProyek(@RequestBody ProyekRequest req){
        MessageRespone response = proyekService.updateProyek(req);
        if(response.getMsg().equalsIgnoreCase(SUCCESS_MESSAGE)) {
            return ResponseEntity.status(HttpStatus.OK).body(response);
        }
        else{
            return ResponseEntity.status(HttpStatus.NOT_FOUND).body(response);
        }
    }

    @DeleteMapping("/proyek/{id}")
    public ResponseEntity<MessageRespone> deleteproyek(@PathVariable Long id){
        MessageRespone response = proyekService.deleteproyek(id);
        if(response.getMsg().equalsIgnoreCase(SUCCESS_MESSAGE)) {
            return ResponseEntity.status(HttpStatus.OK).body(response);
        }
        else{
            return ResponseEntity.status(HttpStatus.NOT_FOUND).body(response);
        }
    }

    @GetMapping("/proyek/{id}")
    public ResponseEntity<ProyekRespone> getProyekById(@PathVariable Long id){
        ProyekRespone response = proyekService.getProyekById(id);
        return ResponseEntity.ok(response);
    }

}
