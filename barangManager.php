<?php
class barangManager {
    private $dataFile = 'data.json';
    private $barangList = [];

    public function __construct() {
        if (file_exists($this->dataFile)) {
            $data = file_get_contents($this->dataFile);
            $this->barangList = json_decode($data, true) ?? [];
        } else {
            // Inisialisasi dengan data kosong jika file tidak ada
            $this->barangList = [];
            $this->simpanData();
        }
    }

    public function tambahBarang($nama, $harga, $stok) {
        // Cek apakah nama barang sudah ada
        foreach ($this->barangList as $barang) {
            if ($barang['nama'] === $nama) {
                throw new Exception("Barang dengan nama '$nama' sudah ada.");
            }
        }

        $id = uniqid();
        $barang = [
            'id' => $id,
            'nama' => $nama,
            'harga' => $harga,
            'stok' => $stok
        ];
        $this->barangList[] = $barang;
        $this->simpanData();
    }

    public function getBarang() {
        return $this->barangList;
    }

    public function getBarangById($id) {
        foreach ($this->barangList as $barang) {
            if ($barang['id'] === $id) {
                return $barang;
            }
        }
        return null;
    }

    public function editBarang($id, $nama, $harga, $stok) {
        foreach ($this->barangList as &$barang) {
            if ($barang['id'] === $id) {
                // Cek apakah nama baru tidak duplikat dengan barang lain
                foreach ($this->barangList as $b) {
                    if ($b['id'] !== $id && $b['nama'] === $nama) {
                        throw new Exception("Barang dengan nama '$nama' sudah ada.");
                    }
                }

                // Update data barang
                $barang['nama'] = $nama;
                $barang['harga'] = $harga;
                $barang['stok'] = $stok;
                $this->simpanData();
                return true;
            }
        }
        return false;
    }

    public function hapusBarang($id) {
        $this->barangList = array_filter($this->barangList, function ($barang) use ($id) {
            return $barang['id'] !== $id;
        });
        $this->simpanData();
    }

    /**
     * Mengurangi stok barang berdasarkan ID dan jumlah yang dibeli.
     *
     * @param string $id ID barang yang akan dikurangi stoknya.
     * @param int $jumlah Jumlah yang akan dikurangi dari stok.
     * @return bool Mengembalikan true jika berhasil, false jika gagal.
     */
    public function kurangiStok($id, $jumlah) {
        foreach ($this->barangList as &$barang) {
            if ($barang['id'] === $id) {
                if ($barang['stok'] >= $jumlah) {
                    $barang['stok'] -= $jumlah;
                    $this->simpanData();
                    return true;
                } else {
                    // Stok tidak cukup
                    return false;
                }
            }
        }
        // Barang tidak ditemukan
        return false;
    }

    private function simpanData() {
        if (file_put_contents($this->dataFile, json_encode($this->barangList, JSON_PRETTY_PRINT)) === false) {
            throw new Exception("Gagal menyimpan data ke '{$this->dataFile}'.");
        }
    }
}
?>
