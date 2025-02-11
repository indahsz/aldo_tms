<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="/assets"
  data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Dashboard - Analytics | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet" />

  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />

  <!-- Page CSS -->

  <!-- Helpers -->
  <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="{{ asset('assets/js/config.js') }}"></script>
</head>

<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->
      @include('aldo_tms.components.sidebar')
      <!-- / Menu -->

      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar Header -->
        @include('aldo_tms.components.header')

        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->
          @yield('content')

          <!-- / Content -->

          <!-- Footer -->
          @include('aldo_tms.components.footer')
          <!-- / Footer -->

          <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
      </div>
      <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
  </div>
  <!-- / Layout wrapper -->

  <div class="buy-now">
    <a
      href="https://themeselection.com/products/sneat-bootstrap-html-admin-template/"
      target="_blank"
      class="btn btn-danger btn-buy-now">Chat Indah</a>
  </div>

  <!-- Core JS -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      // Variables for both modals (1 and 2)
      const video1 = document.getElementById('video1');
      const canvas1 = document.getElementById('canvas1');
      const photoPreview1 = document.getElementById('photoPreview');
      const captureButton1 = document.getElementById('capture1');
      const saveButton1 = document.getElementById('savePhoto1');
  
      const video2 = document.getElementById('video2');
      const canvas2 = document.getElementById('canvas2');
      const captureButton2 = document.getElementById('capture2');
      const saveButton2 = document.getElementById('savePhoto2'); // Make sure this button exists for Save Photo in Capture Modal 2
  
      // Start Camera for Capture Modal 1
      navigator.mediaDevices.getUserMedia({
        video: true
      })
      .then(stream => {
        video1.srcObject = stream;
        video2.srcObject = stream; // Reuse stream for Capture Modal 2
      })
      .catch(error => {
        console.error("Error accessing camera:", error);
      });
  
      let capturedImage1 = null;
      let capturedImage2 = null;
  
      // Function to compress image
      function compressImage(canvas, imageType, quality = 0.8, maxWidth = 1024) {
        const ctx = canvas.getContext('2d');
        const img = new Image();
        img.src = canvas.toDataURL(imageType);
  
        return new Promise((resolve) => {
          img.onload = () => {
            const ratio = img.width / img.height;
            let width = maxWidth;
            let height = maxWidth / ratio;
            
            if (img.width < maxWidth) {
              width = img.width;
              height = img.height;
            }
  
            canvas.width = width;
            canvas.height = height;
            ctx.drawImage(img, 0, 0, width, height);
  
            const compressedImage = canvas.toDataURL(imageType, quality);
            resolve(compressedImage);
          };
        });
      }
  
      // Capture Image for Capture Modal 1
      captureButton1.addEventListener('click', function() {
        canvas1.width = video1.videoWidth;
        canvas1.height = video1.videoHeight;
        canvas1.getContext('2d').drawImage(video1, 0, 0, canvas1.width, canvas1.height);
  
        // Convert to Base64 for Modal 1
        compressImage(canvas1, 'image/png').then((compressedImage) => {
          capturedImage1 = compressedImage;
  
          // Show preview for Modal 1
          photoPreview1.src = capturedImage1;
          photoPreview1.style.display = "block";
        });
      });
  
      // Save Image for Capture Modal 1
      saveButton1.addEventListener('click', function() {
        if (!capturedImage1) {
          alert("Please capture a photo first.");
          return;
        }
  
        // Save path to form input for Modal 1
        document.getElementById('photo_sim').value = capturedImage1;
  
        // Show preview in "Tambah Data" modal (for Modal 1)
        document.getElementById('previewPhotoSim').src = capturedImage1;
        document.getElementById('previewPhotoSim').style.display = "block";
  
        // Close Capture Modal 1
        let captureModal1 = bootstrap.Modal.getInstance(document.getElementById('captureModal1'));
        captureModal1.hide();
  
        // Open "Tambah Data" modal (basicModal)
        let tambahDataModal = new bootstrap.Modal(document.getElementById('basicModal'));
        tambahDataModal.show();
      });
  
      // Capture Image for Capture Modal 2
      captureButton2.addEventListener('click', function() {
        canvas2.width = video2.videoWidth;
        canvas2.height = video2.videoHeight;
        canvas2.getContext('2d').drawImage(video2, 0, 0, canvas2.width, canvas2.height);
  
        // Convert to Base64 for Modal 2
        compressImage(canvas2, 'image/png').then((compressedImage) => {
          capturedImage2 = compressedImage;
  
          // Show preview for Modal 2
          const photoPreview2 = document.getElementById('photoPreview2');
          photoPreview2.src = capturedImage2;
          photoPreview2.style.display = "block";
        });
      });
  
      // Save Image for Capture Modal 2
      saveButton2.addEventListener('click', function() {
        if (!capturedImage2) {
          alert("Please capture a photo first.");
          return;
        }
  
        // Save path to form input for Modal 2
        document.getElementById('photo_stnk').value = capturedImage2;
  
        // Show preview in "Tambah Data" modal (for Modal 2)
        document.getElementById('previewPhotoStnk').src = capturedImage2;
        document.getElementById('previewPhotoStnk').style.display = "block";
  
        // Close Capture Modal 2
        let captureModal2 = bootstrap.Modal.getInstance(document.getElementById('captureModal2'));
        captureModal2.hide();
  
        // Open "Tambah Data" modal (basicModal)
        let tambahDataModal = new bootstrap.Modal(document.getElementById('basicModal'));
        tambahDataModal.show();
      });
      
    });
  </script>  

  
  <!-- build:js assets/vendor/js/core.js -->
  <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
  <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

  <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
  <!-- endbuild -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


  <!-- Bootstrap Bundle (includes Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>



  <!-- Vendors JS -->
  <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

  <!-- Main JS -->
  <script src="{{ asset('assets/js/main.js') }}"></script>

  <!-- Page JS -->
  <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>

  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
