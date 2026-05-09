<style>
    /* Fix for toggle switch circle positioning */
    .toggle-switch {
        width: 60px;
        height: 34px;
    }

    .toggle-switch input:checked + .toggle-slider:before {
        transform: translateX(26px);
    }

    .toggle-slider:before {
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
    }

    /* Adjust the slider size if needed */
    .toggle-slider {
        border-radius: 34px;
    }

    /* Color states */
    input:checked + .toggle-slider {
        background-color: #10b981;
    }

    .toggle-switch .toggle-slider {
        background-color: #ccc;
    }
    /* Video Styling for Profile Details */
    .carousel-slide {
        position: relative;
        height: 100%;
        background: #000;
    }

    .carousel-slide video {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    /* Center Play Button Overlay (before hover) */
    .video-play-overlay-center {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(0, 0, 0, 0.3);
        opacity: 1;
        transition: opacity 0.3s ease;
        z-index: 5;
        pointer-events: none;
    }

    .carousel-slide:hover .video-play-overlay-center,
    .carousel-slide.video-playing .video-play-overlay-center {
        opacity: 0;
        visibility: hidden;
    }

    .play-button-circle-center {
        width: 64px;
        height: 64px;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    }

    .play-icon-center {
        width: 0;
        height: 0;
        border-left: 16px solid #000;
        border-top: 10px solid transparent;
        border-bottom: 10px solid transparent;
        margin-left: 4px;
    }

    /* Bottom Left Play Button with Progress */
    .video-play-progress {
        position: absolute;
        bottom: 12px;
        left: 12px;
        width: 40px;
        height: 40px;
        z-index: 6;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .carousel-slide:hover .video-play-progress,
    .carousel-slide.video-playing .video-play-progress {
        opacity: 1;
    }

    .progress-ring {
        transform: rotate(-90deg);
    }

    .progress-ring-circle-bg {
        fill: none;
        stroke: rgba(255, 255, 255, 0.3);
        stroke-width: 3;
    }

    .progress-ring-circle {
        fill: none;
        stroke: #fff;
        stroke-width: 3;
        stroke-linecap: round;
        transition: stroke-dashoffset 0.1s linear;
    }

    .play-button-small {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 32px;
        height: 32px;
        background: rgba(0, 0, 0, 0.7);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .play-icon-small {
        width: 0;
        height: 0;
        border-left: 10px solid #fff;
        border-top: 6px solid transparent;
        border-bottom: 6px solid transparent;
        margin-left: 2px;
    }

    /* Video duration badge */
    .video-duration {
        position: absolute;
        bottom: 12px;
        right: 56px;
        background: rgba(0, 0, 0, 0.8);
        color: white;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 11px;
        font-weight: 600;
        z-index: 6;
        letter-spacing: 0.5px;
    }

    /* Volume Control Button */
    .video-volume-control {
        position: absolute;
        bottom: 12px;
        right: 12px;
        width: 36px;
        height: 36px;
        background: rgba(0, 0, 0, 0.7);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 7;
        opacity: 0;
        transition: all 0.3s ease;
    }

    .carousel-slide:hover .video-volume-control,
    .carousel-slide.video-playing .video-volume-control {
        opacity: 1;
    }

    .video-volume-control:hover {
        background: rgba(0, 0, 0, 0.9);
        transform: scale(1.1);
    }

    .video-volume-control svg {
        width: 20px;
        height: 20px;
        fill: #fff;
    }

    /* Hide video controls */
    .carousel-slide video::-webkit-media-controls {
        display: none !important;
    }

    .carousel-slide video::-webkit-media-controls-enclosure {
        display: none !important;
    }

    .carousel-slide video::-webkit-media-controls-panel {
        display: none !important;
    }
    /* Profile Box Layout Protection (scope to profile sidebar only) */
    aside.sticky {
        flex-shrink: 0;
    }

    aside.sticky .border.rounded-2xl.bg-white {
        min-width: 280px;
    }

    /* Prevent text congestion in sidebar cards */
    aside.sticky .border.rounded-2xl.bg-white h3,
    aside.sticky .border.rounded-2xl.bg-white h4 {
        overflow-wrap: break-word;
        word-break: break-word;
        hyphens: auto;
    }

    /* Stretch project cards so image column doesn't leave blank white area */
    .project_wrapper_area .card-animate > .flex {
        align-items: stretch;
    }

    .project_wrapper_area .card-animate figure {
        display: flex;
    }

    /* Force a consistent media area (approx 375x243) so large images don't grow the card */
    .project_wrapper_area .card-animate figure .carousel-container {
        width: 100%;
        height: 243px;
        min-height: 243px;
    }

    .project_wrapper_area .card-animate figure img,
    .project_wrapper_area .card-animate figure video {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Popup/Modal Styling */
    .popup-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 999;
        display: none;
    }

    .popup-fixed {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 100%;
        max-width: 600px;
        background-color: #fff;
        z-index: 1000;
        display: none;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        padding: 30px;
        max-height: 90vh;
        overflow-y: auto;
    }

    .popup-active {
        display: block !important;
    }

    .popup-contents-close {
        position: absolute;
        right: 20px;
        top: 20px;
        cursor: pointer;
        font-size: 20px;
        color: #666;
        transition: color 0.3s;
    }

    .popup-contents-close:hover {
        color: #ef4444;
    }

    .popup-contents-title {
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 20px;
        color: #333;
    }

    /* Custom form styling within modals */
    .popup-contents-form .form--control,
    .popup-contents-form .form-control {
        width: 100%;
        padding: 12px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        margin-bottom: 15px;
    }

    .popup-contents-btn {
        margin-top: 25px;
        padding-top: 20px;
        border-top: 1px solid #f3f4f6;
        display: flex;
        gap: 12px;
    }

    .photo-uploaded {
        border: 2px dashed #e5e7eb;
        border-radius: 12px;
        padding: 40px 20px;
        text-align: center;
        background: #f9fafb;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .photo-uploaded:hover {
        border-color: var(--main-color-one);
        background: #f0f9ff;
    }

    .photo-uploaded-file {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
        z-index: 10;
    }

    .photo-uploaded-icon {
        width: 64px;
        height: 64px;
        background: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        margin-bottom: 16px;
        color: var(--main-color-one);
    }
    
    .portfolio_photo_preview,
    .edit_portfolio_photo_preview {
        max-width: 100%;
        max-height: 200px;
        object-fit: contain;
        border-radius: 8px;
        margin-bottom: 15px;
    }

    /* Character Counter */
    .char-counter {
        display: block;
        text-align: right;
        font-size: 12px;
        color: #9ca3af;
        margin-top: 4px;
    }
    
    .char-counter.limit-reached {
        color: #ef4444;
    }

    .popup-contents-form label {
        display: block;
        font-weight: 500;
        color: #374151;
        margin-bottom: 8px;
        margin-top: 16px;
    }

    .popup-contents-form .form--control,
    .popup-contents-form .form-control,
    .popup-contents-form textarea {
        border: 1px solid #e5e7eb !important;
        border-radius: 8px !important;
        padding: 12px 16px !important;
        transition: border-color 0.3s !important;
    }

    .popup-contents-form .form--control:focus,
    .popup-contents-form textarea:focus {
        border-color: var(--main-color-one) !important;
        outline: none !important;
        box-shadow: 0 0 0 3px rgba(var(--main-color-one-rgb), 0.1) !important;
    }
</style>
<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/profile-details/style.blade.php ENDPATH**/ ?>