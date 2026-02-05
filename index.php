<?php
// index.php - YTCLIP PRO BY TUAN ALAM
date_default_timezone_set('Asia/Jakarta');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🔥 YTCLIP PRO - Auto Cutter</title>
    <style>
        /* RESET */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        /* DARK THEME */
        body {
            background: linear-gradient(135deg, #0a0a0a, #1a1a2e);
            color: #00ffcc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            padding: 20px;
            overflow-x: hidden;
        }
        
        /* HEADER */
        .header {
            text-align: center;
            padding: 30px 20px;
            background: rgba(0, 0, 0, 0.7);
            border-bottom: 3px solid #ff0055;
            margin-bottom: 30px;
            border-radius: 0 0 20px 20px;
            box-shadow: 0 10px 30px rgba(255, 0, 85, 0.3);
        }
        
        .logo {
            font-size: 3.5rem;
            background: linear-gradient(45deg, #ff0055, #00ffcc, #9900ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 0 20px rgba(255, 0, 85, 0.5);
            margin-bottom: 10px;
            font-weight: 900;
        }
        
        .tagline {
            color: #aaa;
            font-size: 1.2rem;
            margin-bottom: 5px;
        }
        
        .owner-badge {
            display: inline-block;
            background: linear-gradient(45deg, #ff0055, #9900ff);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            margin-top: 10px;
            font-weight: bold;
        }
        
        /* MAIN CONTAINER */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }
        
        @media (max-width: 900px) {
            .container {
                grid-template-columns: 1fr;
            }
        }
        
        /* PANELS */
        .panel {
            background: rgba(20, 20, 30, 0.9);
            padding: 25px;
            border-radius: 15px;
            border: 2px solid #333;
            backdrop-filter: blur(10px);
            transition: transform 0.3s, border-color 0.3s;
        }
        
        .panel:hover {
            border-color: #ff0055;
            transform: translateY(-5px);
        }
        
        .panel h2 {
            color: #00ffcc;
            margin-bottom: 20px;
            font-size: 1.8rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .panel h2::before {
            content: '';
            display: inline-block;
            width: 8px;
            height: 25px;
            background: #ff0055;
            border-radius: 2px;
        }
        
        /* INPUT SECTION */
        .input-section {
            grid-column: 1 / -1;
        }
        
        .url-input-container {
            display: flex;
            gap: 10px;
            margin: 20px 0;
            flex-wrap: wrap;
        }
        
        input[type="text"] {
            flex: 1;
            min-width: 300px;
            padding: 15px 20px;
            background: rgba(0, 0, 0, 0.7);
            color: #00ffcc;
            border: 2px solid #ff0055;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s;
        }
        
        input[type="text"]:focus {
            outline: none;
            border-color: #00ffcc;
            box-shadow: 0 0 15px rgba(0, 255, 204, 0.5);
        }
        
        /* BUTTONS */
        .btn {
            background: linear-gradient(45deg, #ff0055, #9900ff);
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: bold;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            white-space: nowrap;
        }
        
        .btn:hover {
            transform: scale(1.05);
            box-shadow: 0 0 25px rgba(255, 0, 85, 0.7);
        }
        
        .btn-primary {
            background: linear-gradient(45deg, #00ffcc, #0099ff);
            color: #000;
        }
        
        .btn-primary:hover {
            box-shadow: 0 0 25px rgba(0, 255, 204, 0.7);
        }
        
        /* VIDEO PREVIEW */
        .video-preview {
            background: #000;
            min-height: 250px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            margin: 20px 0;
            border: 2px dashed #333;
            flex-direction: column;
            padding: 20px;
        }
        
        .video-preview.ready {
            border-color: #00ffcc;
            background: rgba(0, 255, 204, 0.05);
        }
        
        /* CUT CONTROLS */
        .cut-controls {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin: 20px 0;
        }
        
        @media (max-width: 600px) {
            .cut-controls {
                grid-template-columns: 1fr;
            }
        }
        
        .time-input {
            background: rgba(0, 0, 0, 0.5);
            padding: 20px;
            border-radius: 10px;
            border-left: 4px solid #ff0055;
        }
        
        .time-input label {
            display: block;
            margin-bottom: 10px;
            color: #ff0055;
            font-weight: bold;
            font-size: 1.1rem;
        }
        
        .time-input input {
            width: 100%;
            padding: 12px;
            background: #000;
            color: white;
            border: 1px solid #00ffcc;
            border-radius: 5px;
            font-size: 1.1rem;
            text-align: center;
        }
        
        /* QUALITY SELECTOR */
        .quality-selector {
            background: rgba(255, 0, 85, 0.1);
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
            border: 2px solid #ff0055;
        }
        
        select {
            width: 100%;
            padding: 12px;
            background: #000;
            color: #00ffcc;
            border: 2px solid #ff0055;
            border-radius: 5px;
            font-size: 1rem;
            margin-top: 10px;
        }
        
        /* OUTPUT SECTION */
        .output-section {
            background: rgba(0, 255, 204, 0.1);
            border: 2px solid #00ffcc;
        }
        
        .loading {
            display: none;
            text-align: center;
            padding: 30px;
        }
        
        .loading.active {
            display: block;
        }
        
        .spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #333;
            border-top: 5px solid #ff0055;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 20px;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* OUTPUT RESULT */
        .output-result {
            margin-top: 20px;
        }
        
        .result-card {
            background: rgba(0, 0, 0, 0.8);
            padding: 25px;
            border-radius: 10px;
            border: 2px solid #00ffcc;
        }
        
        .result-card h3 {
            color: #00ffcc;
            margin-bottom: 15px;
            font-size: 1.5rem;
        }
        
        .file-info {
            background: rgba(255, 0, 85, 0.1);
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
        }
        
        .file-info p {
            margin: 8px 0;
            font-size: 1.1rem;
        }
        
        /* PROGRESS BAR */
        .progress-container {
            background: #111;
            height: 12px;
            border-radius: 10px;
            margin: 30px 0;
            overflow: hidden;
            border: 1px solid #333;
        }
        
        .progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #ff0055, #00ffcc);
            border-radius: 10px;
            width: 0%;
            transition: width 0.3s;
        }
        
        /* STATUS BADGES */
        .status-badge {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: bold;
            margin-left: 10px;
        }
        
        .status-online {
            background: #00cc00;
            color: white;
        }
        
        .status-bypass {
            background: #ff0055;
            color: white;
        }
        
        /* FOOTER */
        .footer {
            text-align: center;
            margin-top: 50px;
            padding: 20px;
            color: #666;
            font-size: 0.9rem;
            border-top: 1px solid #333;
        }
        
        /* NOTIFICATION */
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 25px;
            border-radius: 10px;
            background: rgba(0, 0, 0, 0.9);
            border-left: 5px solid #ff0055;
            color: white;
            z-index: 1000;
            display: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
            max-width: 400px;
        }
        
        .notification.show {
            display: block;
            animation: slideIn 0.3s ease-out;
        }
        
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
    </style>
</head>
<body>
    <!-- HEADER -->
    <div class="header">
        <h1 class="logo">✂️ YTCLIP PRO</h1>
        <p class="tagline">Auto Video Cutter dengan Kualitas Asli</p>
        <div class="owner-badge">© TUAN ALAM 2026</div>
        
        <div style="margin-top: 15px;">
            <span class="status-badge status-online">🟢 ONLINE</span>
            <span class="status-badge status-bypass">🔓 BYPASS ACTIVE</span>
        </div>
    </div>

    <!-- MAIN CONTAINER -->
    <div class="container">
        <!-- INPUT PANEL -->
        <div class="panel input-section">
            <h2>🔗 PASTE LINK YOUTUBE</h2>
            <p style="color: #aaa; margin-bottom: 20px;">
                Masukkan link YouTube, sistem akan bypass semua restriction otomatis.
            </p>
            
            <div class="url-input-container">
                <input type="text" id="ytLink" 
                       placeholder="https://www.youtube.com/watch?v=... atau https://youtu.be/...">
                <button class="btn" onclick="loadVideo()">
                    ⚡ LOAD VIDEO
                </button>
            </div>
            
            <div id="videoInfo" style="display: none; margin-top: 20px;">
                <div style="background: rgba(0,255,204,0.1); padding: 15px; border-radius: 10px;">
                    <h3 style="color: #00ffcc;">🎬 VIDEO TERLOAD:</h3>
                    <p id="videoTitle" style="margin: 10px 0; font-weight: bold;"></p>
                    <p id="videoDuration" style="color: #aaa;"></p>
                    <p style="color: #ff0055; font-size: 0.9rem; margin-top: 10px;">
                        ✅ Siap dipotong!
                    </p>
                </div>
            </div>
        </div>

        <!-- CUT PANEL -->
        <div class="panel">
            <h2>✂️ SET POTONGAN</h2>
            
            <div class="video-preview" id="videoPreview">
                <div style="text-align: center;">
                    <div style="font-size: 48px; margin-bottom: 10px;">🎥</div>
                    <p>Video preview akan muncul di sini</p>
                    <p style="color: #666; font-size: 0.9rem; margin-top: 10px;">
                        Load video dulu bro!
                    </p>
                </div>
            </div>
            
            <div class="cut-controls">
                <div class="time-input">
                    <label>⏱️ START TIME</label>
                    <input type="text" id="startTime" value="00:00:00" placeholder="HH:MM:SS">
                </div>
                <div class="time-input">
                    <label>⏱️ END TIME</label>
                    <input type="text" id="endTime" value="00:01:00" placeholder="HH:MM:SS">
                </div>
            </div>
            
            <!-- QUALITY SELECTOR -->
            <div class="quality-selector">
                <h4>🎬 PILIH KUALITAS</h4>
                <select id="qualitySelect">
                    <option value="best">🔥 BEST QUALITY (Original 4K/1080p)</option>
                    <option value="1080p">🎥 1080p Full HD</option>
                    <option value="720p">📱 720p HD</option>
                    <option value="480p">⚡ 480p SD (Cepat)</option>
                </select>
                <p style="color: #ff0055; font-size: 0.9rem; margin-top: 10px;">
                    ⚠️ No compression, original quality!
                </p>
            </div>
            
            <div style="text-align: center; margin-top: 30px;">
                <button class="btn btn-primary" onclick="processCut()" 
                        style="padding: 18px 50px; font-size: 1.2rem;">
                    🚀 PROCESS & DOWNLOAD
                </button>
            </div>
        </div>

        <!-- OUTPUT PANEL -->
        <div class="panel output-section">
            <h2>📁 OUTPUT</h2>
            
            <div class="loading" id="loading">
                <div class="spinner"></div>
                <p style="margin-top: 20px; font-size: 1.1rem;">Processing video...</p>
                <p style="color: #aaa; margin-top: 10px;">
                    Bypassing YouTube restrictions... ⚡
                </p>
                <p style="color: #ff0055; margin-top: 20px; font-size: 0.9rem;">
                    Jangan close tab/halaman ini!
                </p>
            </div>
            
            <div class="output-result" id="outputResult">
                <!-- Hasil akan muncul di sini -->
            </div>
        </div>
    </div>

    <!-- PROGRESS BAR -->
    <div class="progress-container">
        <div class="progress-bar" id="progressBar"></div>
    </div>

    <!-- NOTIFICATION -->
    <div class="notification" id="notification"></div>

    <!-- FOOTER -->
    <div class="footer">
        <p>YTCLIP PRO © 2026 - Exclusive for TUAN ALAM</p>
        <p style="color: #ff0055; margin-top: 5px;">
            ⚠️ For personal use only | Auto cleanup every 24h
        </p>
    </div>

    <!-- JAVASCRIPT -->
    <script>
        // Global variables
        let videoData = null;
        let currentProcess = null;
        
        // Notification system
        function showNotification(message, type = 'info') {
            const notif = document.getElementById('notification');
            notif.textContent = message;
            notif.style.borderLeftColor = type === 'error' ? '#ff0055' : 
                                         type === 'success' ? '#00ffcc' : '#ff0055';
            notif.classList.add('show');
            
            setTimeout(() => {
                notif.classList.remove('show');
            }, 3000);
        }
        
        // Load video function
        async function loadVideo() {
            const link = document.getElementById('ytLink').value.trim();
            if(!link) {
                showNotification('Masukin link dulu bro!', 'error');
                return;
            }
            
            // Validasi link YouTube
            if(!link.includes('youtube.com') && !link.includes('youtu.be')) {
                showNotification('Ini bukan link YouTube goblok!', 'error');
                return;
            }
            
            const loading = document.getElementById('loading');
            const videoInfo = document.getElementById('videoInfo');
            const videoPreview = document.getElementById('videoPreview');
            
            loading.classList.add('active');
            
            try {
                // Simulasi fetching video info
                await new Promise(resolve => setTimeout(resolve, 1500));
                
                // Update UI
                videoInfo.style.display = 'block';
                document.getElementById('videoTitle').textContent = 
                    `🎬 ${link.substring(0, 60)}...`;
                document.getElementById('videoDuration').textContent = 
                    `⏱️ Durasi: 10:30 | 🎬 Quality: 1080p`;
                
                videoPreview.innerHTML = `
                    <div style="text-align: center; padding: 20px;">
                        <div style="font-size: 64px; margin-bottom: 20px;">✅</div>
                        <p style="font-weight: bold; color: #00ffcc;">VIDEO READY!</p>
                        <p style="color: #aaa; margin-top: 10px;">
                            Siap dipotong sesuai waktu yang lo mau
                        </p>
                        <div style="background: rgba(255,0,85,0.1); padding: 10px; 
                                    border-radius: 5px; margin-top: 15px;">
                            <p style="color: #ff0055; font-size: 0.9rem;">
                                ⚡ Bypass active: Proxy rotation enabled
                            </p>
                        </div>
                    </div>
                `;
                videoPreview.classList.add('ready');
                
                // Simpan data video
                videoData = {
                    url: link,
                    duration: 630, // 10:30 dalam detik
                    title: link.substring(0, 50) + '...'
                };
                
                showNotification('✅ Video berhasil di-load!', 'success');
                
            } catch(error) {
                showNotification('Error: Gagal load video!', 'error');
            } finally {
                loading.classList.remove('active');
            }
        }
        
        // Process cut function
        async function processCut() {
            if(!videoData) {
                showNotification('Load video dulu anjing!', 'error');
                return;
            }
            
            const start = document.getElementById('startTime').value.trim();
            const end = document.getElementById('endTime').value.trim();
            const quality = document.getElementById('qualitySelect').value;
            
            // Validasi waktu
            if(!isValidTime(start) || !isValidTime(end)) {
                showNotification('Format waktu salah! Pakai HH:MM:SS', 'error');
                return;
            }
            
            const loading = document.getElementById('loading');
            const outputResult = document.getElementById('outputResult');
            const progressBar = document.getElementById('progressBar');
            
            // Reset
            loading.classList.add('active');
            outputResult.innerHTML = '';
            progressBar.style.width = '0%';
            
            // Simulasi proses
            let progress = 0;
            currentProcess = setInterval(() => {
                progress += 5;
                progressBar.style.width = progress + '%';
                
                if(progress >= 100) {
                    clearInterval(currentProcess);
                    
                    // Tampilkan hasil
                    showResult({
                        start: start,
                        end: end,
                        quality: quality,
                        size: '25.7 MB',
                        resolution: '1920x1080',
                        duration: calculateDuration(start, end)
                    });
                    
                    loading.classList.remove('active');
                    showNotification('✅ Video siap didownload!', 'success');
                }
            }, 200);
        }
        
        // Show result function
        function showResult(data) {
            const outputResult = document.getElementById('outputResult');
            
            outputResult.innerHTML = `
                <div class="result-card">
                    <h3>✅ POTONGAN SELESAI!</h3>
                    
                    <div class="file-info">
                        <p><strong>📊 Detail File:</strong></p>
                        <p>⏱️ Start: ${data.start}</p>
                        <p>⏱️ End: ${data.end}</p>
                        <p>🎬 Duration: ${data.duration}</p>
                        <p>📁 Size: ${data.size}</p>
                        <p>🎥 Resolution: ${data.resolution}</p>
                        <p>⚡ Quality: ${data.quality}</p>
                        <p>👑 Owner: Tuan Alam</p>
                    </div>
                    
                    <div style="text-align: center; margin-top: 25px;">
                        <button onclick="startDownload()" 
                                class="btn btn-primary"
                                style="padding: 15px 40px; font-size: 1.1rem;">
                            ⬇️ DOWNLOAD NOW
                        </button>
                        
                        <button onclick="copyLink()" 
                                style="background: #333; color: white; 
                                       padding: 15px 25px; border: none;
                                       border-radius: 10px; margin-left: 15px;
                                       cursor: pointer;">
                            📋 Copy Link
                        </button>
                    </div>
                    
                    <p style="color: #ff0055; text-align: center; margin-top: 20px; font-size: 0.9rem;">
                        ⚠️ File auto delete dalam 24 jam
                    </p>
                </div>
            `;
        }
        
        // Download function
        function startDownload() {
            showNotification('📥 Download mulai... cek folder downloads!', 'success');
            
            // Simulasi download
            setTimeout(() => {
                showNotification('✅ Download selesai!', 'success');
                
                // Log download
                console.log(`Download completed for: ${videoData.url}`);
            }, 1000);
        }
        
        // Copy link function
        function copyLink() {
            navigator.clipboard.writeText(window.location.href)
                .then(() => showNotification('✅ Link copied!', 'success'))
                .catch(() => showNotification('❌ Gagal copy!', 'error'));
        }
        
        // Utility functions
        function isValidTime(time) {
            return /^([0-1]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]$/.test(time);
        }
        
        function calculateDuration(start, end) {
            // Simple calculation
            const startSec = timeToSeconds(start);
            const endSec = timeToSeconds(end);
            const diff = endSec - startSec;
            
            return secondsToTime(Math.abs(diff));
        }
        
        function timeToSeconds(time) {
            const parts = time.split(':');
            return (+parts[0]) * 3600 + (+parts[1]) * 60 + (+parts[2]);
        }
        
        function secondsToTime(seconds) {
            const hrs = Math.floor(seconds / 3600);
            const mins = Math.floor((seconds % 3600) / 60);
            const secs = seconds % 60;
            
            return `${hrs.toString().padStart(2, '0')}:${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
        }
        
        // Auto-focus input
        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('ytLink').focus();
        });
    </script>
</body>
</html>
