<?php

namespace App\Controllers;

use App\Models\Mtamu;
use CodeIgniter\RESTful\ResourceController;

class Tamu extends ResourceController
{
   protected $format = 'json';
   protected $modelName = 'use App\Models\Mtamu';

   public function __construct()
   {
      $this->mtamu = new Mtamu();
   }

   public function index()
   {
      $mtamu = $this->mtamu->getTodo();

      foreach ($mtamu as $row) {
         $mtamu_all[] = [
            'id' => intval($row['id']),
            'nama' => $row['nama'],
            'Tanggal' => $row['Tanggal'],
            'NoHp' => $row['NoHp'],
         ];
      }

      return $this->respond($mtodo_all, 200);
   }

   public function create()
   {
      $nama = $this->request->getPost('nama');
      $Tanggal = $this->request->getPost('Tanggal');
      $NoHp = $this->request->getPost('NoHp');

      $data = [
         'nama' => $nama,
         'Tanggal' => $Tanggal,
         'NoHp' => $NoHp
      ];

      $simpan = $this->mtamu->insertTamu($data);

      if ($simpan == true) {
         $output = [
            'status' => 200,
            'message' => 'Berhasil menyimpan data',
            'data' => ''
         ];
         return $this->respond($output, 200);
      } else {
         $output = [
            'status' => 400,
            'message' => 'Gagal menyimpan data',
            'data' => ''
         ];
         return $this->respond($output, 400);
      }
   }

   public function show($id = null)
   {
      $mtodo = $this->mtodo->getTodo($id);

      if (!empty($mtodo)) {
         $output = [
            'id' => intval($mtodo['id']),
            'judul' => $mtodo['judul'],
            'deskripsi' => $mtodo['deskripsi'],
            'jadwal_selesai' => $mtodo['jadwal_selesai'],
         ];

         return $this->respond($output, 200);
      } else {
         $output = [
            'status' => 400,
            'message' => 'Data tidak ditemukan',
            'data' => ''
         ];

         return $this->respond($output, 400);
      }
   }

   public function show($id = null)
   {
      $mtamu = $this->mtamu->getTamu($id);

      if (!empty($mtamu)) {
         $output = [
            'id' => intval($mtamu['id']),
            'nama' => $mtamu['nama'],
            'Tanggal' => $mtamu['Tanggal'],
            'NoHp' => $mtamu['NoHp'],
         ];

         return $this->respond($output, 200);
      } else {
         $output = [
            'status' => 400,
            'message' => 'Data tidak ditemukan',
            'data' => ''
         ];
         return $this->respond($output, 400);
      }
   }

   public function update($id = null)
   {
      $data = $this->request->getRawInput();

      $mtamu = $this->mtamu->getTamu($id);

      if (!empty($mtamu)) {
         $updateTamu = $this->mtamu->updateTamu($data, $id);

         $output = [
            'status' => true,
            'data' => '',
            'message' => 'sukses melakukan update'
         ];

         return $this->respond($output, 200);
      } else {
         $output = [
            'status' => false,
            'data' => '',
            'message' => 'gagal melakukan update'
         ];

         return $this->respond($output, 400);
      }
   }
   public function delete($id = null)
   {
      $mtamu = $this->mtamu->getTamu($id);

      if (!empty($mtamu)) {
         $deleteTamu = $this->mtamu->deleteTamu($id);

         $output = [
            'status' => true,
            'data' => '',
            'message' => 'sukses hapus data'
         ];

         return $this->respond($output, 200);
      } else {
         $output = [
            'status' => false,
            'data' => '',
            'message' => 'gagal hapus data'
         ];

         return $this->respond($output, 400);
      }
   }
}