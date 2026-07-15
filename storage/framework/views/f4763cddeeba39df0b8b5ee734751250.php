<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($reel->description ?? 'Reel Video'); ?> | Yaptiriyo</title>
    
    <!-- Meta Tags for Social Sharing -->
    <meta property="og:title" content="<?php echo e($reel->description ?? 'Reel Video'); ?>">
    <meta property="og:description" content="Watch this amazing reel on Yaptiriyo!">
    <meta property="og:image" content="<?php echo e(asset('assets/uploads/reels/thumbnails/'.$reel->thumbnail)); ?>">
    <meta property="og:video" content="<?php echo e(asset('assets/uploads/reels/'.$reel->video)); ?>">
    <meta name="twitter:card" content="player">
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background: #000; color: #fff; height: 100vh; overflow: hidden; display: flex; justify-content: center; align-items: center; }
        
        .reel-container { position: relative; width: 100%; max-width: 500px; height: 100vh; background: #000; display: flex; flex-direction: column; }
        
        video { width: 100%; height: 100%; object-fit: cover; }
        
        .overlay { position: absolute; bottom: 0; left: 0; right: 0; padding: 100px 20px 40px; background: linear-gradient(transparent, rgba(0,0,0,0.8)); pointer-events: none; }
        .overlay-content { pointer-events: auto; }
        
        .user-info { display: flex; align-items: center; margin-bottom: 15px; }
        .user-avatar { width: 40px; height: 40px; border-radius: 50%; border: 2px solid #fff; margin-right: 12px; }
        .username { font-weight: 700; font-size: 16px; text-shadow: 0 2px 4px rgba(0,0,0,0.5); }
        
        .description { font-size: 14px; line-height: 1.4; color: rgba(255,255,255,0.9); margin-bottom: 20px; text-shadow: 0 1px 2px rgba(0,0,0,0.5); }
        
        .btn-download { display: flex; align-items: center; justify-content: center; background: #FF7043; color: #fff; text-decoration: none; padding: 14px; border-radius: 12px; font-weight: 700; gap: 8px; box-shadow: 0 10px 20px rgba(255,112,67,0.3); transition: transform 0.2s; }
        .btn-download:active { transform: scale(0.98); }
        
        .back-btn { position: absolute; top: 40px; left: 20px; z-index: 10; color: #fff; text-decoration: none; background: rgba(0,0,0,0.3); width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 50%; backdrop-filter: blur(10px); }
        
        .logo { position: absolute; top: 40px; right: 20px; height: 30px; z-index: 10; opacity: 0.8; }
    </style>
</head>
<body>
    <div class="reel-container">
        <a href="https://yaptiriyo.com" class="back-btn">&larr;</a>
        <img src="https://yaptiriyo.com/assets/frontend/img/logo/logo.png" class="logo" alt="Logo">
        
        <video id="reelVideo" loop playsinline autoplay muted>
            <source src="<?php echo e(asset('assets/uploads/reels/'.$reel->video)); ?>" type="video/mp4">
        </video>
        
        <div class="overlay">
            <div class="overlay-content">
                <div class="user-info">
                    <img src="<?php echo e($reel->user?->image ? asset('assets/uploads/profile/'.$reel->user->image) : 'https://www.gravatar.com/avatar/'); ?>" class="user-avatar" alt="">
                    <span class="username">@ <?php echo e($reel->user?->username ?? 'freelancer'); ?></span>
                </div>
                
                <p class="description"><?php echo e($reel->description); ?></p>
                
                <a href="https://yaptiriyo.com" class="btn-download">
                    <span>Uygulamayı İndir ve Teklif Al</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                </a>
            </div>
        </div>
    </div>

    <script>
        // Unmute on first click
        document.body.addEventListener('click', function() {
            var v = document.getElementById('reelVideo');
            if(v.muted) {
                v.muted = false;
            }
        }, {once: true});
    </script>
</body>
</html>
<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/reels/view.blade.php ENDPATH**/ ?>