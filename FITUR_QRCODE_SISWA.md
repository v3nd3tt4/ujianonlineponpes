# Fitur QR Code Siswa

## Deskripsi
Fitur ini menambahkan tombol QR Code pada setiap baris kelas di halaman "Kelas Anda". QR code berisi data siswa yang sedang login dalam format JSON.

## Fitur yang Ditambahkan

### 1. **Tombol QR Code**
- Tombol "QR Code" pada setiap baris kelas
- Icon QR code menggunakan Font Awesome
- Warna tombol: warning (kuning)

### 2. **Modal QR Code**
- Modal kecil (modal-sm) untuk menampilkan QR code
- QR code berukuran 200x200 pixel
- Menampilkan data JSON di bawah QR code

### 3. **Data QR Code**
Format data yang dikodekan dalam QR code:
```json
{
  "nis": "nis_siswa",
  "id": "id_siswa"
}
```

## Implementasi

### 1. **Controller Auth** (`application/controllers/Auth.php`)
Menambahkan NIS ke session data saat login:
```php
// Add NIS for students
if ($role == 'siswa') {
    $userdata['nis'] = $user->nis;
}
```

### 2. **View Index** (`application/views/siswa/kelas/index.php`)
Tombol QR Code:
```php
<button class="btn btn-warning btn-sm" onclick="showQRCode('<?= $this->session->userdata('nis') ?>', '<?= $this->session->userdata('id_user') ?>')">
    <i class="fa fa-qrcode"></i> QR Code
</button>
```

Modal QR Code:
```html
<!-- Modal QR Code -->
<div class="modal fade" id="qrCodeModal" tabindex="-1" role="dialog" aria-labelledby="qrCodeModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="qrCodeModalLabel">QR Code Siswa</h4>
            </div>
            <div class="modal-body text-center">
                <div id="qrcode"></div>
                <br>
                <small class="text-muted" id="qrCodeData"></small>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
```

### 3. **JavaScript** (`application/views/siswa/kelas/script.php`)
Function untuk menampilkan QR code:
```javascript
function showQRCode(nis, id) {
    // Clear previous QR code
    $('#qrcode').empty();
    
    // Create QR code data
    var qrData = JSON.stringify({
        "nis": nis,
        "id": id
    });
    
    // Show the data text
    $('#qrCodeData').text(qrData);
    
    // Generate QR code
    var qrcode = new QRCode(document.getElementById("qrcode"), {
        text: qrData,
        width: 200,
        height: 200,
        colorDark : "#000000",
        colorLight : "#ffffff",
        correctLevel : QRCode.CorrectLevel.H
    });
    
    // Show modal
    $('#qrCodeModal').modal('show');
}
```

## Library yang Digunakan

### QR Code Library
- **File**: `assets_miminium/js/plugins/qrcode.min.js`
- **Fungsi**: Generate QR code di client-side
- **Konfigurasi**:
  - Width: 200px
  - Height: 200px
  - Color Dark: #000000
  - Color Light: #ffffff
  - Error Correction Level: H (High)

## Cara Penggunaan

1. **Login sebagai siswa**
2. **Akses menu "Kelas Anda"**
3. **Klik tombol "QR Code" pada baris kelas manapun**
4. **Modal akan muncul menampilkan QR code dengan data siswa**
5. **QR code dapat di-scan untuk mendapatkan data NIS dan ID siswa**

## Keamanan

- ✅ QR code hanya menampilkan data siswa yang sedang login
- ✅ Data NIS dan ID disimpan di session yang aman
- ✅ Tidak ada data sensitif lain yang ditampilkan

## Penggunaan QR Code

QR code ini dapat digunakan untuk:
- **Presensi siswa** - Scan QR code untuk mencatat kehadiran
- **Identifikasi siswa** - Verifikasi identitas siswa
- **Akses sistem** - Login cepat dengan scan QR code
- **Tracking siswa** - Monitoring pergerakan siswa

## Contoh Data QR Code

Jika siswa dengan NIS "1011111" dan ID "3" login, QR code akan berisi:
```json
{"nis":"1011111","id":"3"}
```

## Catatan Teknis

- QR code di-generate secara real-time saat tombol diklik
- Modal akan clear QR code sebelumnya sebelum generate yang baru
- Error correction level H memungkinkan QR code tetap terbaca meski sebagian rusak
- Library QR code kompatibel dengan semua browser modern 