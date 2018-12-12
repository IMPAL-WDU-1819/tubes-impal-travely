<?php

require 'vendor/autoload.php';
require_once 'Base.php';

class Transaksi extends Base {
	public function getAllTransaksi() {
		$data = $this->db->select('transaksi', 
			['transaksi.id_transaksi', 'transaksi.tanggal', 
			 'transaksi.total', 'transaksi.status'],
			[]
		);
		return json_encode($data);
	}

	public function getTransaksiRefund() {
		$data = $this->db->select('transaksi', 
			['transaksi.id_transaksi', 'transaksi.tanggal', 
			'transaksi.total', 'transaksi.status'],
			['transaksi.status' => 'Proses Refund']
		);

		return json_encode($data);
	}

	public function getTransaksiPending() {
		$data = $this->db->select('transaksi', 
			['transaksi.id_transaksi', 'transaksi.tanggal', 
			'transaksi.total', 'transaksi.status'],
			['transaksi.status' => 'Pending']
		);

		return json_encode($data);
	}

	public function getTransaksiAkun($email) {
		$data = $this->db->select('transaksi', 
			['transaksi.id_transaksi', 'transaksi.tanggal', 
			'transaksi.total', 'transaksi.status'],
			['transaksi.akun' => $email]
		);

		return json_encode($data);
	}

	public function getTransaksi($id) {
		$data = $this->db->select('transaksi',
			['transaksi.id_transaksi', 'transaksi.tanggal', 
			'transaksi.status', 'transaksi.total'],
			['transaksi.id_transaksi' => $id]
		);

		return json_encode($data);
	}

	public function bayarTiket($id, $total, $tipe, $tanggal, 
		$akun, $status, $bank) {
		$insert = $this->db->insert('transaksi', 
			['id_transaksi' => $id, 'total' => $total, 
			 'tipe' => $tipe, 'tanggal' => $tanggal,
			 'akun' => $akun, 'status' => $status, 'bank' => $bank]
		);

		return json_encode($insert);
	}

	public function prosesRefund($id) {
		$update = $this->db->update('transaksi', 
			['status' => 'Proses Refund'], 
			['transaksi.id_transaksi' => $id]
		);
		return json_decode($udpate);
	}

	public function refundTransaksi($id) {
		$update = $this->db->update('transaksi', 
			['status' => 'Refund'],
			['transaksi.id_transaksi' => $id]
		);
		return json_decode($udpate);
	}

	public function konfirmasiTransaksi($id) {
		$update = $this->db->update('transaksi', 
			['status' => 'Lunas'], 
			['transaksi.id_transaksi' => $id]
		);
		return json_encode($update);
	}
}
