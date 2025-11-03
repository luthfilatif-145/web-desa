<footer class="main-footer">
    <div class="float-right d-none d-sm-inline">
      Versi 1.0
    </div>
    <strong>Copyright &copy; 2025 <a href="#">Desa Teluk Nangka</a>.</strong> All rights reserved.
  </footer>
</div>
<script src="../plugins/jquery/jquery.min.js"></script>
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../dist/js/adminlte.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script src="../js/summernote-image-list.min.js"></script>

<script>
$(document).ready(function() {
    
    // Selector Class '.summernote' (Sudah Benar)
    $('.summernote').summernote({
        callbacks: {
            onImageUpload: function(files) {
                var editor = $(this); 
                let data = new FormData();
                data.append('file', files[0], files[0].name);

                $.ajax({
                    method: 'POST',
                    url: 'upload_gambar.php',
                    contentType: false,
                    cache: false,
                    processData: false,
                    data: data,
                    success: function(img) {
                        $(editor).summernote('insertImage', img);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error(textStatus + " " + errorThrown);
                    }
                });
            }
        },
        height: 200,
        toolbar: [
            ["style", ["bold", "italic", "underline", "clear"]],
            ["fontname", ["fontname"]],
            ["fontsize", ["fontsize"]],
            ["color", ["color"]],
            ["para", ["ul", "ol", "paragraph"]],
            ["height", ["height"]],
            ["insert", ["link", "picture", "imageList", "video", "hr"]],
            ["help", ["help"]]
        ],
        dialogsInBody: true,
        imageList: {
            endpoint: "daftar_gambar.php",
            fullUrlPrefix: "../gambar/",
            thumbUrlPrefix: "../gambar/"
        }
    });
});
</script>
</body>
</html>