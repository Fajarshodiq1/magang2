<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>QR Code Scanner - Document Verification</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://unpkg.com/html5-qrcode"></script>
</head>

<body class="bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-zinc-900 dark:to-zinc-800 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="text-center mb-8">
            <div
                class="inline-flex items-center justify-center w-20 h-20 bg-white dark:bg-zinc-800 rounded-full shadow-lg mb-4">
                <i class="fas fa-qrcode text-4xl text-indigo-600 dark:text-indigo-400"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                QR Code Scanner
            </h1>
            <p class="text-gray-600 dark:text-gray-400">
                Scan QR code untuk memverifikasi keaslian dokumen
            </p>
        </div>

        <div class="max-w-2xl mx-auto">
            <!-- Scanner Container -->
            <div class="bg-white dark:bg-zinc-800 rounded-2xl shadow-2xl p-6 mb-6">
                <div class="mb-4">
                    <div class="flex items-center justify-between mb-3">
                        <h2 class="text-lg font-bold text-gray-900 dark:text-white">
                            <i class="fas fa-camera mr-2 text-indigo-500"></i>
                            Scanner
                        </h2>
                        <button id="toggleCamera"
                            class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg transition">
                            <i class="fas fa-video mr-2"></i>
                            <span id="cameraButtonText">Start Scanner</span>
                        </button>
                    </div>

                    <!-- Scanner View -->
                    <div id="reader"
                        class="rounded-xl overflow-hidden border-4 border-gray-200 dark:border-zinc-700"></div>

                    <!-- Manual Input -->
                    <div class="mt-4 p-4 bg-gray-50 dark:bg-zinc-900 rounded-lg">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2 font-semibold">
                            Atau masukkan kode QR secara manual:
                        </p>
                        <div class="flex gap-2">
                            <input type="text" id="manualCode" placeholder="Paste QR code data here..."
                                class="flex-1 px-4 py-2 border border-gray-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
                            <button id="verifyManual"
                                class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition">
                                <i class="fas fa-check mr-2"></i>Verify
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Result Container -->
            <div id="resultContainer" class="hidden">
                <!-- Success Result -->
                <div id="successResult" class="bg-white dark:bg-zinc-800 rounded-2xl shadow-2xl p-6 hidden">
                    <div class="flex items-center gap-4 mb-6 pb-6 border-b border-gray-200 dark:border-zinc-700">
                        <div
                            class="w-16 h-16 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center">
                            <i class="fas fa-check-circle text-3xl text-green-600 dark:text-green-400"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-green-900 dark:text-green-100">
                                Dokumen Terverifikasi!
                            </h3>
                            <p class="text-sm text-green-700 dark:text-green-300">
                                Dokumen ini asli dan tidak termodifikasi
                            </p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="p-4 bg-gray-50 dark:bg-zinc-900 rounded-lg">
                                <p class="text-xs text-gray-600 dark:text-gray-400 mb-1">Judul Dokumen</p>
                                <p id="docTitle" class="font-bold text-gray-900 dark:text-white"></p>
                            </div>
                            <div class="p-4 bg-gray-50 dark:bg-zinc-900 rounded-lg">
                                <p class="text-xs text-gray-600 dark:text-gray-400 mb-1">Pemilik</p>
                                <p id="docOwner" class="font-bold text-gray-900 dark:text-white"></p>
                            </div>
                            <div class="p-4 bg-gray-50 dark:bg-zinc-900 rounded-lg">
                                <p class="text-xs text-gray-600 dark:text-gray-400 mb-1">Tipe File</p>
                                <p id="docType" class="font-bold text-gray-900 dark:text-white uppercase"></p>
                            </div>
                            <div class="p-4 bg-gray-50 dark:bg-zinc-900 rounded-lg">
                                <p class="text-xs text-gray-600 dark:text-gray-400 mb-1">Ukuran</p>
                                <p id="docSize" class="font-bold text-gray-900 dark:text-white"></p>
                            </div>
                        </div>

                        <div
                            class="p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg">
                            <h4 class="font-bold text-blue-900 dark:text-blue-100 mb-2">
                                <i class="fas fa-shield-check mr-2"></i>Status Verifikasi
                            </h4>
                            <div id="verificationDetails" class="space-y-2 text-sm"></div>
                        </div>

                        <div class="p-4 bg-gray-50 dark:bg-zinc-900 rounded-lg">
                            <p class="text-xs text-gray-600 dark:text-gray-400 mb-1">Dibuat pada</p>
                            <p id="docCreated" class="font-semibold text-gray-900 dark:text-white"></p>
                        </div>
                    </div>

                    <button onclick="resetScanner()"
                        class="w-full mt-6 px-4 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg transition">
                        <i class="fas fa-redo mr-2"></i>Scan Dokumen Lain
                    </button>
                </div>

                <!-- Error Result -->
                <div id="errorResult" class="bg-white dark:bg-zinc-800 rounded-2xl shadow-2xl p-6 hidden">
                    <div class="flex items-center gap-4 mb-6">
                        <div
                            class="w-16 h-16 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center">
                            <i class="fas fa-times-circle text-3xl text-red-600 dark:text-red-400"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-red-900 dark:text-red-100">
                                Verifikasi Gagal
                            </h3>
                            <p id="errorMessage" class="text-sm text-red-700 dark:text-red-300"></p>
                        </div>
                    </div>

                    <button onclick="resetScanner()"
                        class="w-full px-4 py-3 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg transition">
                        <i class="fas fa-redo mr-2"></i>Coba Lagi
                    </button>
                </div>
            </div>

            <!-- Instructions -->
            <div class="bg-white dark:bg-zinc-800 rounded-2xl shadow-lg p-6 mt-6">
                <h3 class="font-bold text-gray-900 dark:text-white mb-3">
                    <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                    Cara Menggunakan
                </h3>
                <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-400">
                    <li class="flex items-start gap-2">
                        <i class="fas fa-chevron-right text-indigo-500 mt-1"></i>
                        <span>Klik tombol "Start Scanner" untuk mengaktifkan kamera</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-chevron-right text-indigo-500 mt-1"></i>
                        <span>Arahkan kamera ke QR code pada dokumen</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-chevron-right text-indigo-500 mt-1"></i>
                        <span>Sistem akan otomatis memverifikasi keaslian dokumen</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-chevron-right text-indigo-500 mt-1"></i>
                        <span>Atau paste kode QR secara manual pada input yang tersedia</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        let html5QrcodeScanner = null;
        let isScanning = false;

        function onScanSuccess(decodedText, decodedResult) {
            // Stop scanning
            if (html5QrcodeScanner) {
                html5QrcodeScanner.clear();
            }
            isScanning = false;
            document.getElementById('cameraButtonText').textContent = 'Start Scanner';

            // Verify the document
            verifyDocument(decodedText);
        }

        function onScanError(errorMessage) {
            // Handle scan error - tidak perlu tampilkan error untuk setiap frame
        }

        document.getElementById('toggleCamera').addEventListener('click', function() {
            if (isScanning) {
                // Stop scanning
                if (html5QrcodeScanner) {
                    html5QrcodeScanner.clear();
                }
                isScanning = false;
                this.querySelector('span').textContent = 'Start Scanner';
            } else {
                // Start scanning
                html5QrcodeScanner = new Html5QrcodeScanner(
                    "reader", {
                        fps: 10,
                        qrbox: {
                            width: 250,
                            height: 250
                        }
                    }
                );
                html5QrcodeScanner.render(onScanSuccess, onScanError);
                isScanning = true;
                this.querySelector('span').textContent = 'Stop Scanner';
            }
        });

        document.getElementById('verifyManual').addEventListener('click', function() {
            const manualCode = document.getElementById('manualCode').value.trim();
            if (manualCode) {
                verifyDocument(manualCode);
            } else {
                alert('Masukkan kode QR terlebih dahulu');
            }
        });

        function verifyDocument(qrData) {
            console.log('Verifying QR Data:', qrData); // Debug

            document.getElementById('resultContainer').classList.remove('hidden');
            document.getElementById('successResult').classList.add('hidden');
            document.getElementById('errorResult').classList.add('hidden');

            // Send verification request
            fetch('/api/verify-qr', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        qr_data: qrData
                    })
                })
                .then(response => {
                    console.log('Response Status:', response.status); // Debug
                    return response.json();
                })
                .then(data => {
                    console.log('Response Data:', data); // Debug

                    if (data.success) {
                        showSuccess(data);
                    } else {
                        showError(data.message || 'Verifikasi gagal');

                        // Tampilkan detail error jika ada
                        if (data.debug) {
                            console.error('Debug Info:', data.debug);
                        }
                    }
                })
                .catch(error => {
                    console.error('Fetch Error:', error);
                    showError('Terjadi kesalahan saat memverifikasi dokumen: ' + error.message);
                });
        }

        function showSuccess(data) {
            const doc = data.document;
            const verification = data.verification;

            document.getElementById('docTitle').textContent = doc.title;
            document.getElementById('docOwner').textContent = doc.owner.name;
            document.getElementById('docType').textContent = doc.file_type;
            document.getElementById('docSize').textContent = doc.file_size;
            document.getElementById('docCreated').textContent = new Date(doc.created_at).toLocaleString('id-ID');

            // Verification details
            const verificationHTML = `
                <div class="flex items-center justify-between">
                    <span class="text-blue-800 dark:text-blue-200">File Integrity:</span>
                    <span class="font-bold ${verification.file_integrity ? 'text-green-600' : 'text-red-600'}">
                        ${verification.file_integrity ? '✓ Valid' : '✗ Invalid'}
                    </span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-blue-800 dark:text-blue-200">Hash Valid:</span>
                    <span class="font-bold ${verification.hash_valid ? 'text-green-600' : 'text-red-600'}">
                        ${verification.hash_valid ? '✓ Valid' : '✗ Invalid'}
                    </span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-blue-800 dark:text-blue-200">QR Code:</span>
                    <span class="font-bold ${verification.qr_exists ? 'text-green-600' : 'text-red-600'}">
                        ${verification.qr_exists ? '✓ Tersedia' : '✗ Tidak Ada'}
                    </span>
                </div>
            `;
            document.getElementById('verificationDetails').innerHTML = verificationHTML;

            document.getElementById('successResult').classList.remove('hidden');
        }

        function showError(message) {
            document.getElementById('errorMessage').textContent = message;
            document.getElementById('errorResult').classList.remove('hidden');
        }

        function resetScanner() {
            document.getElementById('resultContainer').classList.add('hidden');
            document.getElementById('successResult').classList.add('hidden');
            document.getElementById('errorResult').classList.add('hidden');
            document.getElementById('manualCode').value = '';

            if (isScanning && html5QrcodeScanner) {
                html5QrcodeScanner.clear();
                isScanning = false;
                document.getElementById('cameraButtonText').textContent = 'Start Scanner';
            }
        }
    </script>
</body>

</html>
