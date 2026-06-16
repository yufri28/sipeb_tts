<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;


class StokBarang extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('stokmodel');
		if (!$this->session->userdata('id_auth')) {
			redirect(base_url('auth'));
		}

		if ($this->session->userdata('role') == 'pengguna' || $this->session->userdata('role') == 'kepala_dinas') {
			$this->session->set_flashdata('error', 'Anda tidak punya akses ke halaman tersebut. Silahkan login dan masuk ke halaman yang diizinkan!');
			redirect(base_url('logout'));
		}
    }

	public function index()
	{
		$stok = $this->stokmodel->get_join_all_data();

		$data = [
			'menu' => 'stokbarang',
			'stok' => $stok
		];
		$this->load->view('templates/header', $data);
		$this->load->view('pages/admin/stokbarang');
		$this->load->view('templates/footer');
	}

	public function cek_kondisi($id = null)
	{
		if($id != null){
			$kondisi = $this->stokmodel->cek_kondisi_terkini($id);
			$is_sync = $this->stokmodel->is_data_synchronized($id);

			$data = [
				'menu' => 'stokbarang',
				'sudah_sync' => $is_sync,
				'kondisi' => $kondisi
			];
			$this->load->view('templates/header', $data);
			$this->load->view('pages/admin/kondisi');
			$this->load->view('templates/footer');
		}else{
			$this->session->set_flashdata('error', 'Data tidak ditemukan!');
			redirect('stokbarang'); 
		}
	}

	public function detail_kondisi($id = null)
	{
		if($id != null){
			$kondisi = $this->stokmodel->detail_kondisi_terkini($id);

			$data = [
				'menu' => 'stokbarang',
				'kondisi' => $kondisi,
				'stok_id' => $kondisi[0]['stok_id'],
			];

			$this->load->view('templates/header', $data);
			$this->load->view('pages/admin/detail_kondisi');
			$this->load->view('templates/footer');
		}else{
			$this->session->set_flashdata('error', 'Data tidak ditemukan!');
			redirect('stokbarang'); 
		}
	}

	public function syncdata()
	{
		$stok_id = $this->input->post('stok_id');
		$dataKondisi = $this->stokmodel->get_data_kondisi_bystok($stok_id);
		$all_insert_success = true;

		foreach ($dataKondisi as $key => $value) {
			for ($i = 1; $i <= $value['stok_terkini']; $i++) {
				$kode = 'BRG' . $value['klasifikasi_id'] . $value['sumber_id'] . $value['jenis_barang_id'] . $value['kondisi_logpal_id'] . $i;

				
				$exists = $this->stokmodel->is_kode_exist($kode);
				if ($exists) {
					continue; // lewati insert jika sudah ada
				}

				$data = [
					'kondisi_terkini_id' => $value['id_kondisi_terkini'],
					'kode' => $kode,
				];

				$insert_result = $this->stokmodel->insert_detail_kondisi($data);

				if (!$insert_result) {
					$all_insert_success = false;
					log_message('error', "Gagal insert data dengan kode: $kode");
				}
			}
		}

		if ($all_insert_success) {
			$this->session->set_flashdata('success', 'Sinkronisasi data berhasil.');
		} else {
			$this->session->set_flashdata('error', 'Terjadi kesalahan, beberapa data gagal disimpan.');
		}

		redirect(base_url('stokbarang/cek_kondisi/'.$stok_id));
	}

	public function editfotodetail() {
		
		$id = htmlspecialchars($this->input->post('id_detail'));
		// Ambil data bencana berdasarkan ID
		$dataKondisi = $this->stokmodel->cek_detail_kondisi_terkini($id);
		
		// Konfigurasi upload
		$config['upload_path'] = FCPATH.'uploads/detail_kondisi/';
		$config['allowed_types'] = 'jpg|jpeg|png';
	
		$this->upload->initialize($config);
		
		$fotoKondisi = $dataKondisi[0]['foto']; // Tetap gunakan file lama jika tidak diupload
		if (!empty($_FILES['foto_kondisi']['name'])) {
			if (!$this->upload->do_upload('foto_kondisi')) {
				$this->session->set_flashdata('error', $this->upload->display_errors());
				redirect(base_url('stokbarang/detail_kondisi/'.$$dataKondisi[0]['kondisi_terkini_id']));
			} else {
				
				if($fotoKondisi != null){
					// Hapus file lama
					if (file_exists($config['upload_path'] . $fotoKondisi)) {
						unlink($config['upload_path'] . $fotoKondisi);
					}
				}
	
				// Upload file baru
				$dataFotoKondisi = $this->upload->data();
				$originalFileName = $dataFotoKondisi['file_name'];
				$fileExtension = $dataFotoKondisi['file_ext'];
				$encryptedFileName =  md5(uniqid(time() . $originalFileName, true)) . $fileExtension;
				rename($dataFotoKondisi['full_path'], $config['upload_path'] . $encryptedFileName);
				$fotoKondisi = $encryptedFileName;
				// Simpan data ke database, dengan file baru jika diupload, atau tetap menggunakan file lama jika tidak diupload
				$data = array(
					'foto' => $fotoKondisi
				);
			
				// Update data ke database
				if ($this->stokmodel->update_detail_kondisi($id, $data)) {
					$this->session->set_flashdata('success', 'Foto kondisi berhasil diperbarui.');
				} else {
					$this->session->set_flashdata('error', 'Terjadi kesalahan, foto kondisi gagal diperbarui.');
				}
			}
		}else {
			$this->session->set_flashdata('error', 'Terjadi kesalahan, file foto kosong.');
		}
	
		// Redirect ke halaman
		redirect(base_url('stokbarang/detail_kondisi/'.$dataKondisi[0]['kondisi_terkini_id']));
	}

	public function editfoto() {
		
		$id = htmlspecialchars($this->input->post('id_kondisi_terkini'));
		// Ambil data bencana berdasarkan ID
		$dataKondisi = $this->stokmodel->cek_kondisi_terkini_byid($id);
		
		// Konfigurasi upload
		$config['upload_path'] = FCPATH.'uploads/kondisi/';
		$config['allowed_types'] = 'jpg|jpeg|png';
	
		$this->upload->initialize($config);
		
		$fotoKondisi = $dataKondisi[0]['foto_kondisi']; // Tetap gunakan file lama jika tidak diupload
		if (!empty($_FILES['foto_kondisi']['name'])) {
			if (!$this->upload->do_upload('foto_kondisi')) {
				
				$this->session->set_flashdata('error', $this->upload->display_errors());
				redirect(base_url('stokbarang/cek_kondisi/'.$dataKondisi[0]['stok_id']));
			} else {
				
				// Hapus file lama
				if (file_exists($config['upload_path'] . $fotoKondisi)) {
					unlink($config['upload_path'] . $fotoKondisi);
				}
	
				// Upload file baru
				$dataFotoKondisi = $this->upload->data();
				$originalFileName = $dataFotoKondisi['file_name'];
				$fileExtension = $dataFotoKondisi['file_ext'];
				$encryptedFileName =  md5(uniqid(time() . $originalFileName, true)) . $fileExtension;
				rename($dataFotoKondisi['full_path'], $config['upload_path'] . $encryptedFileName);
				$fotoKondisi = $encryptedFileName;
				// Simpan data ke database, dengan file baru jika diupload, atau tetap menggunakan file lama jika tidak diupload
				$data = array(
					'foto_kondisi' => $fotoKondisi
				);
			
				// Update data ke database
				if ($this->stokmodel->update_kondisi($id, $data)) {
					$this->session->set_flashdata('success', 'Foto kondisi berhasil diperbarui.');
				} else {
					$this->session->set_flashdata('error', 'Terjadi kesalahan, foto kondisi gagal diperbarui.');
				}
			}
		}else {
			$this->session->set_flashdata('error', 'Terjadi kesalahan, file foto kosong.');
		}
	
	
	
		// Redirect ke halaman
		redirect(base_url('stokbarang/cek_kondisi/'.$dataKondisi[0]['stok_id']));
	}
	

	public function get_data_kondisi_by_id($id) {
        $kondisi = $this->stokmodel->get_kondisi_by_barang_id($id);
        // Cek apakah data berhasil ditemukan
        if ($kondisi) {
            echo json_encode([
                'success' => true,
                'kondisi' => $kondisi
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Data kondisi tidak ditemukan'
            ]);
        }
    }

	public function get_stok_barang()
	{
		$search = $this->input->get('q'); // Menangkap parameter pencarian (jika ada)
        
        $data = $this->get_data_stok_barang($search);

        // Membentuk respons sesuai dengan format Select2
        $result = [];
        foreach ($data as $row) {
            $result[] = [
                'id' => $row['id_satuan'],
                'text' => $row['nama_satuan']
            ];
        }

        // Mengembalikan respons dalam format JSON
        echo json_encode(['results' => $result]);
	}

	public function get_data_stok_barang($search = '') {
		$this->db->select('kondisi_terkini.id_kondisi_terkini, 
						   master_jenis_barang.nama_jenisbarang, 
						   kondisi_terkini.stok_terkini, 
						   stok.tahun,
						   master_kondisi_terkini.nama_kondisi');
		$this->db->from('kondisi_terkini');
		$this->db->join('stok', 'stok.id_stok = kondisi_terkini.stok_id', 'left');
		$this->db->join('master_jenis_barang', 'master_jenis_barang.id_jenisbarang = stok.jenis_barang_id', 'left');
		$this->db->join('master_kondisi_terkini', 'master_kondisi_terkini.id_kondisi_terkini = kondisi_terkini.kondisi_terkini_id', 'left');
	
		// Pencarian melibatkan tiga field
		if (!empty($search)) {
			$this->db->group_start(); // Mulai grup kondisi pencarian
			$this->db->like('master_jenis_barang.nama_jenisbarang', $search);
			$this->db->or_like('stok.tahun', $search);
			$this->db->or_like('master_kondisi_terkini.nama_kondisi', $search);
			$this->db->group_end(); // Akhir grup kondisi pencarian
		}
	
		$query = $this->db->get();
		return $query->result_array();
	}

	public function export_per_kondisi()
	{
		
		$query = $this->db->query("
			SELECT 
				stok.id_stok, 
				CONCAT('BRG', stok.klasifikasi_id, stok.sumber_id, stok.jenis_barang_id, kondisi_terkini.kondisi_logpal_id) AS kode_barang,
				master_jenis_barang.nama_jenisbarang,
				stok.tahun, 
				stok.keterangan_tambahan, 
				stok.jenis_barang_id, 
				stok.klasifikasi_id, 
				stok.sumber_id,  
				stok.tanggal_masuk,
				kondisi_terkini.stok_masuk, 
				kondisi_terkini.foto_kondisi, 
				kondisi_terkini.kondisi_logpal_id, 
				COUNT(detail_kondisi.id_detail) AS stk_terkini
			FROM stok 
			LEFT JOIN master_jenis_barang ON master_jenis_barang.id_jenisbarang = stok.jenis_barang_id
			LEFT JOIN kondisi_terkini ON kondisi_terkini.stok_id = stok.id_stok
			LEFT JOIN detail_kondisi ON detail_kondisi.kondisi_terkini_id = kondisi_terkini.id_kondisi_terkini
			WHERE stok.masuk_stok = 'sudah'
			GROUP BY 
				stok.id_stok, 
				stok.tahun, 
				stok.keterangan_tambahan, 
				stok.jenis_barang_id,
				stok.klasifikasi_id,
				stok.sumber_id,
				stok.tanggal_masuk,
				master_jenis_barang.nama_jenisbarang,
				kondisi_terkini.stok_masuk,
				kondisi_terkini.kondisi_logpal_id
		");
		
		$data = $query->result_array();
		
		if (empty($data)) {
			show_error('Data tidak ditemukan untuk diekspor.');
			return;
		}

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setTitle('Export per Kondisi');

		// Header kolom
		$headers = array_merge(['No'], array_keys($data[0]));
		$colIndex = 1;
		foreach ($headers as $header) {
			$colLetter = Coordinate::stringFromColumnIndex($colIndex);
			$sheet->setCellValue($colLetter . '1', $header);
			$sheet->getStyle($colLetter . '1')->getFont()->setBold(true);
			$colIndex++;
		}

		// Isi data
		$rowIndex = 2;
		$no = 1;
		foreach ($data as $row) {
			$colIndex = 1;

			// No
			$colLetter = Coordinate::stringFromColumnIndex($colIndex);
			$sheet->setCellValue($colLetter . $rowIndex, $no);
			$colIndex++;

			foreach ($row as $key => $value) {
				$colLetter = Coordinate::stringFromColumnIndex($colIndex);

				if ($key === 'foto_kondisi' && !empty($value) && file_exists(FCPATH.'uploads/kondisi/' . $value)) {
					$drawing = new Drawing();
					$drawing->setName('Foto');
					$drawing->setPath(FCPATH.'uploads/kondisi/' . $value);
					$drawing->setCoordinates($colLetter . $rowIndex);
					$drawing->setHeight(60);
					$drawing->setWorksheet($sheet);

					// Set lebar kolom gambar
					$sheet->getColumnDimension($colLetter)->setWidth(15);
					$sheet->getRowDimension($rowIndex)->setRowHeight(65);
				} else {
					$sheet->setCellValue($colLetter . $rowIndex, $value);
				}

				$colIndex++;
			}

			$rowIndex++;
			$no++;
		}

		// Output ke browser
		$filename = 'export_per_kondisi_' . date('Ymd_His') . '.xlsx';
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header("Content-Disposition: attachment; filename=\"$filename\"");
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
		exit;
	}
	
	public function export_per_detail_kondisi()
	{
		$query = $this->db->query("
			SELECT stok.id_stok, stok.tahun, stok.keterangan_tambahan, stok.tanggal_masuk,
				master_jenis_barang.nama_jenisbarang,
				detail_kondisi.foto, detail_kondisi.kode, detail_kondisi.status
			FROM stok 
			LEFT JOIN master_jenis_barang ON master_jenis_barang.id_jenisbarang = stok.jenis_barang_id
			LEFT JOIN kondisi_terkini ON kondisi_terkini.stok_id = stok.id_stok
			LEFT JOIN detail_kondisi ON detail_kondisi.kondisi_terkini_id = kondisi_terkini.id_kondisi_terkini
			WHERE stok.masuk_stok = 'sudah'
		");

		$data = $query->result_array();

		if (empty($data)) {
			show_error('Data tidak ditemukan untuk diekspor.');
			return;
		}

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setTitle('Export per Kondisi');

		// Header kolom
		$headers = array_merge(['No'], array_keys($data[0]));
		$colIndex = 1;
		foreach ($headers as $header) {
			$colLetter = Coordinate::stringFromColumnIndex($colIndex);
			$sheet->setCellValue($colLetter . '1', $header);
			$sheet->getStyle($colLetter . '1')->getFont()->setBold(true);
			$colIndex++;
		}

		// Isi data
		$rowIndex = 2;
		$no = 1;
		foreach ($data as $row) {
			$colIndex = 1;

			// No
			$colLetter = Coordinate::stringFromColumnIndex($colIndex);
			$sheet->setCellValue($colLetter . $rowIndex, $no);
			$colIndex++;

			foreach ($row as $key => $value) {
				$colLetter = Coordinate::stringFromColumnIndex($colIndex);

				if ($key === 'foto' && !empty($value) && file_exists(FCPATH.'uploads/detail_kondisi/' . $value)) {
					$drawing = new Drawing();
					$drawing->setName('Foto');
					$drawing->setPath(FCPATH.'uploads/detail_kondisi/' . $value);
					$drawing->setCoordinates($colLetter . $rowIndex);
					$drawing->setHeight(60);
					$drawing->setWorksheet($sheet);

					// Set lebar kolom gambar
					$sheet->getColumnDimension($colLetter)->setWidth(15);
					$sheet->getRowDimension($rowIndex)->setRowHeight(65);
				} else {
					$sheet->setCellValue($colLetter . $rowIndex, $value);
				}

				$colIndex++;
			}

			$rowIndex++;
			$no++;
		}

		// Output ke browser
		$filename = 'export_per_kondisi_' . date('Ymd_His') . '.xlsx';
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header("Content-Disposition: attachment; filename=\"$filename\"");
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
		exit;
	}


	
}