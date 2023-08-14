<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <a href="<?=base_url();?>article/create" class="btn <?php echo ($this->uri->segment(2, 0) == 'create' ? 'btn-primary disabled' : 'btn-outline-primary'); ?>">Tambah</a>
            <h1 class="mr-2 float-left">Berita</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url();?>article">Berita</a></li>
              <li class="breadcrumb-item active">Buat Berita</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="width: 85%;">
    
        <div class="card">
            <div class="card-header  text-center" style="background-color: #007bff; color: white;">
                <b>BUAT BERITA</b>
            </div>
            <form action="<?=base_url();?>admin/C_articlesController/store" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="create_category">Kategori </label>
                                <i class="fa fa-edit" data-toggle="modal" data-target="#crudCategoryModal" style="color: #007bff;"></i>
                                <select class="form-control listCategory" id="create_category" name="id_category" required>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="create_title">Judul</label>
                                <input type="text" class="form-control" id="create_title" name="title" placeholder="Masukan Judul" required>
                            </div>
                            <div class="form-group">
                                <label for="create_description">Keterangan</label>
                                <textarea class="form-control" id="create_description" name="description" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="create_title_picture">Sampul Gambar</label>
                                <input type="file" class="form-control-file" id="create_title_picture" name="title_picture">
                                <img id="preview_create_title_picture" alt="">
                            </div>
                            <div class="form-group">
                              <label>Tanggal Publish</label>
                              <input type="datetime-local" id="create_created_at" name="created_at" value="<?php echo date("Y-m-d"); ?>T<?php echo date("h:i:s"); ?>" required>
                              <!-- <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                  <input type="text" class="form-control datetimepicker-input" data-target="#reservationdatetime"/>
                                  <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                  </div>
                              </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-12">
                        <label for="create_text">Konten</label>
                        <textarea id="create_article_summernote" name="text"></textarea>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<!-- Modal -->
<div class="modal fade" id="crudCategoryModal" tabindex="-1" role="dialog" aria-labelledby="crudCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #007bff; color: white;">
        <h5 class="modal-title" id="crudCategoryModalLabel" style="text-align: center;">Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="tableCategory">
        
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function(){
    <?php if($this->session->flashdata('status') == TRUE) { ?>

      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      });

      Toast.fire({
        icon: 'success',
        title: '<?php echo $this->session->flashdata('status') ?>'
      });

    <?php } ?>
  });
</script>

<script>
    $(document).ready(function() {

        var numberRow = 0;

        $('#crudCategoryModal').ready(function() {

            $.get( "<?=base_url();?>admin/C_categoriesController/index", function(file) {
                // console.log(JSON.parse(file));
                var result = JSON.parse(file);
                var tableDisplay = '';
                    tableDisplay += '<button class="btn btn-xs btn-outline-primary float-right my-2 addRowCategory">Add</button>';
                    tableDisplay += '<table class="table table-striped table-bordered">';
                    tableDisplay += '<thead>';
                    tableDisplay += '<tr>';
                    tableDisplay += '<th scope="col">Category</th>';
                    tableDisplay += '<th scope="col">Action</th>';
                    tableDisplay += '</tr>';
                    tableDisplay += '</thead>';
                    tableDisplay += '<tbody>';
                $.each(result, function(key, value) {
                    tableDisplay += '<tr id="row-'+numberRow+'">';
                    tableDisplay += '<td>'+value.name+'</td>';
                    tableDisplay += '<td>';
                    tableDisplay += '<button class="btn btn-xs btn-outline-warning editCategory" data-row="'+numberRow+'" data-id="'+value.id+'" data-name="'+value.name+'">Edit</button> ';
                    tableDisplay += '<button class="btn btn-xs btn-outline-danger deleteCategory" data-row="'+numberRow+'" data-id="'+value.id+'">Delete</button>';
                    tableDisplay += '</td>';
                    tableDisplay += '</tr>';
                    numberRow++;
                });
                tableDisplay += '</tbody>';
                tableDisplay += '</table>';
                $('#tableCategory').append(tableDisplay);
            })
            .fail(function(file) {
                console.log(file);
            });
        });
        
        $(document).on('click', '.addRowCategory', function() {
            var rowCategory = '';
            rowCategory += '<tr id="row-'+numberRow+'">';
            rowCategory += '<td><input type="text" class="form-control" id="add_category_'+numberRow+'" data-row="'+numberRow+'" name="name" placeholder="Enter Category" required/></td>';
            rowCategory += '<td>';
            rowCategory += '<button class="btn btn-xs btn-outline-primary saveCategory" data-row="'+numberRow+'">Save</button> ';
            rowCategory += '<button class="btn btn-xs btn-outline-danger deleteRowCategory" data-row="'+numberRow+'">Delete</button>';
            rowCategory += '</td>';                    
            rowCategory += '</tr>';
            $('#tableCategory table tbody').prepend(rowCategory);
            // $('#add_category_'+numRow).focus();
            $('input[id^="add_category_"]').focus();
            numberRow++;
        }); 

        $(document.activeElement).keypress(function(e){
            var dataRow = $(document.activeElement).attr("data-row");
            if(e.which == 13) {
                $('.saveCategory[data-row="'+dataRow+'"]').click();
            }
        });

        $(document).on('click', '.saveCategory', function () {
            var dataRow = $(this).attr("data-row");
            var add_data_category = $('#add_category_'+dataRow).val();
            $.post( "<?=base_url();?>admin/C_categoriesController/store", { name: add_data_category }, function(file) {
                // console.log(JSON.parse(file));
                var result = JSON.parse(file);
                var rowCategory = '';
                    rowCategory += '<td>'+result[0].name+'</td>';
                    rowCategory += '<td>';
                    rowCategory += '<button class="btn btn-xs btn-outline-warning editCategory" data-row="'+dataRow+'" data-id="'+result[0].id+'" data-name="'+result[0].name+'">Edit</button> ';
                    rowCategory += '<button class="btn btn-xs btn-outline-danger deleteCategory" data-row="'+dataRow+'" data-id="'+result[0].id+'">Delete</button>';
                    rowCategory += '</td>';
                $('#row-'+dataRow).html(rowCategory);
                $('input[id^="add_category_"]').focus();
            })
            .fail(function(file) {
                $('#add_category_'+dataRow).focus();
                $('#add_category_'+dataRow).removeClass("is-invalid").addClass("is-invalid");
                $('#error_feedback_'+dataRow).remove();
                $('#add_category_'+dataRow).after('<div class="invalid-feedback" id="error_feedback_'+dataRow+'">'+file.responseJSON.errors.name+'</div>');
            });
        });

        $(document).on('click', '.editCategory', function () {
            var dataRow = $(this).attr("data-row");
            var dataId = $(this).attr("data-id");
            var dataName = $(this).attr("data-name");
            var rowCategory = '';
                rowCategory += '<td><input type="text" class="form-control" id="edit_category_'+dataRow+'" data-row="'+dataRow+'" name="name" placeholder="Enter Category" required/></td>';
                rowCategory += '<td>';
                rowCategory += '<button class="btn btn-xs btn-outline-primary updateCategory" data-row="'+dataRow+'" data-id="'+dataId+'">Update</button> ';
                rowCategory += '<button class="btn btn-xs btn-outline-danger backCategory" data-row="'+dataRow+'" data-id="'+dataId+'" data-name="'+dataName+'">Back</button>';
                rowCategory += '</td>';
            // alert(dataId);
            $('#row-'+dataRow).html(rowCategory); 
            $('#edit_category_'+dataRow).val(dataName); 
            $('#edit_category_'+dataRow).focus(); 

        });

        $(document.activeElement).keypress(function(e){
            var dataRow = $(document.activeElement).attr("data-row");
            if(e.which == 13) {
                $('.updateCategory[data-row="'+dataRow+'"]').click();
            }
        });

        $(document).on('click', '.updateCategory', function () {
            var dataRow = $(this).attr("data-row");
            var dataId = $(this).attr("data-id");
            var value_category = $('#edit_category_'+dataRow).val();
            $.ajax({
                type: "POST",
                url: "<?=base_url();?>admin/C_categoriesController/update",
                data: { id: dataId, name: value_category },
                success: function(file) {
                    // console.log(JSON.parse(file));
                    var result = JSON.parse(file);
                    var rowCategory = '';
                        rowCategory += '<td>'+result[0].name+'</td>';
                        rowCategory += '<td>';
                        rowCategory += '<button class="btn btn-xs btn-outline-warning editCategory" data-row="'+dataRow+'" data-id="'+result[0].id+'" data-name="'+result[0].name+'">Edit</button> ';
                        rowCategory += '<button class="btn btn-xs btn-outline-danger deleteCategory" data-row="'+dataRow+'" data-id="'+result[0].id+'">Delete</button>';
                        rowCategory += '</td>';
                    $('#row-'+dataRow).html(rowCategory);
                    $('input[id^="add_category_"]').focus();
                    // console.log(result);
                },
                error: function(file) {
                    $('#edit_category_'+dataRow).focus();
                    $('#edit_category_'+dataRow).removeClass("is-invalid").addClass("is-invalid");
                    $('#error_feedback_'+dataRow).remove();
                    $('#edit_category_'+dataRow).after('<div class="invalid-feedback" id="error_feedback_'+dataRow+'">'+file.responseJSON.errors.name+'</div>');
                    // console.log(result);
                }
            });

        });

        $(document).on('click', '.backCategory', function () {
            var dataRow = $(this).attr("data-row");
            var dataId = $(this).attr("data-id");
            var dataName = $(this).attr("data-name");

            var rowCategory = '';
                rowCategory += '<td>'+dataName+'</td>';
                rowCategory += '<td>';
                rowCategory += '<button class="btn btn-xs btn-outline-warning editCategory" data-row="'+dataRow+'" data-id="'+dataId+'" data-name="'+dataName+'">Edit</button> ';
                rowCategory += '<button class="btn btn-xs btn-outline-danger deleteCategory" data-row="'+dataRow+'" data-id="'+dataId+'">Delete</button>';
                rowCategory += '</td>';
            $('#row-'+dataRow).html(rowCategory);
            $('input[id^="add_category_"]').focus();
        });

        $(document).on('click', '.deleteRowCategory', function () {
            var dataRow = $(this).attr("data-row");
            $('#row-'+dataRow).remove();
        });

        $(document).on('click', '.deleteCategory', function () {

            var confirmDelete = confirm("Are you sure you want to delete this record?");

            var dataId = $(this).attr("data-id");
            var dataRow = $(this).attr("data-row");
            
            if (confirmDelete == true) {
                $.ajax({
                    type: "POST",
                    url: "<?=base_url();?>admin/C_categoriesController/destroy",
                    data: { id: dataId },
                    success: function(result) {
                        // console.log('sukses');
                        $('#row-'+dataRow).remove();
                    },
                    error: function(result) {
                        console.log('gagal');
                    }
                });
            }

        });

    });
</script>

<script>
    $(document).ready(function () {
   
        listCategoryFunction();

        $('#crudCategoryModal').on('hidden.bs.modal', function () {
            listCategoryFunction();
        });
        
    });

    function listCategoryFunction(){
        $.ajax({
            type: "GET",
            url: "<?=base_url();?>admin/C_categoriesController/index",
            success: function(file) {
                // console.log(JSON.parse(file));
                var result = JSON.parse(file);
                var listCategory = '';
                    listCategory += '<option value="" selected disabled>Select a category</option>';
                $.each(result, function( key, index ) {
                    listCategory += '<option value="'+index.id+'">'+index.name+'</option>';
                });
                $('.listCategory').html(listCategory);
            },
            error: function(file) {
                console.log(file);
            }
        });
    }
</script>

<script type="text/javascript">   
    $(document).ready(function (e) {
        $('#create_title_picture').change(function(){

            let reader = new FileReader();
            reader.onload = (e) => { 
                $('#preview_create_title_picture').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]); 

            $("#preview_create_title_picture").css({"max-height" : "200px", "margin-top" : "10px"});
            $("#preview_create_title_picture").addClass("img-thumbnail");
            $("#preview_create_title_picture").attr("alt", this.value.replace(/C:\\fakepath\\/i, ''));

        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#create_article_summernote').summernote({
            placeholder: 'Enter Text!',
            tabsize: 2,
            height: 500,
            prettifyHtml:false,
            imageTitle: {
              specificAltField: true,
            },
            toolbar:[
                // ['highlight', ['highlight']],
                // ['seo',['seo']],
                ['cleaner',['cleaner']], // The Button
                ['heading',['style']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['style',['bold','italic','underline','clear']],
                ['fontname',['fontname']],
                ['fontsize', ['fontsize']],
                ['color',['forecolor','color']],
                ['para', ['ul', 'ol', 'listStyles', 'paragraph']],
                ['height',['height']],
                ['table',['table']],
                // ['insert', ['link', 'picture', 'video', 'hr', 'jTable']],
                ['insert', ['link', 'picture', 'video', 'hr', 'gxcode']],
                ['view',['fullscreen','codeview', 'undo', 'redo']],
                ['help',['help']]
            ],
            seo:{
                el:'#create_article_summernote', // Element ID or Class used to Initialise Summernote.
                notTime:2400, // Time to display Notifications.
                keyEl:'#seoKeywords', // ID or Class of the Target Element to place Keywords.
                capEl:'#seoCaption', // ID or Class of the Target Element to place Caption.
                desEl:'#seoDescription', // ID or Class of the Target Element to place Description.
                triggerInput:true, // Set this to True if like me you use AJAX to update single fields
                action:'replace', // replace|append Replace or Append Content.
                successClass:'alert alert-success',
                errorClass:'alert alert-danger',
                autoClose:false, // Set to True to Auto Close Notifications
                icon:'<i class="note-icon">[Your Icon]</i> <span class="caret"></span>',
            },
            cleaner:{
                  action: 'both', 
                  newline: '<br>', 
                  icon: '<i class="note-icon">Text Cleaner</i>',
                  keepHtml: false,
                  keepOnlyTags: ['<p>', '<br>', '<ul>', '<li>', '<b>', '<strong>','<i>', '<a>'], 
                  keepClasses: false,
                  badTags: ['style', 'script', 'applet', 'embed', 'noframes', 'noscript', 'html'],
                  badAttributes: ['style', 'start'],
                  limitChars: false, 
                  limitDisplay: 'both',
                  limitStop: false
            },
            popover: {
                image: [
                    ['custom', ['imageAttributes', 'captionIt', 'imageShapes']],
                    ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                    ['float', ['floatLeft', 'floatRight', 'floatNone']],
                    ['remove', ['removeMedia']]
                ],
                table: [
                    ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
                    ['delete', ['deleteRow', 'deleteCol', 'deleteTable']],
                    ['custom', ['tableHeaders', 'tableStyles']]
                ],
                /* table: [
                    ['merge', ['jMerge']],
                    ['style', ['jBackcolor', 'jBorderColor', 'jAlign', 'jAddDeleteRowCol']],
                    ['info', ['jTableInfo']],
                    ['delete', ['jWidthHeightReset', 'deleteTable']],
                ], */
            },
            jTable : {
                /**
                 * drag || dialog
                 */
                mergeMode: 'drag'
            },
            lang: 'en-US', // Change to your chosen language
            imageAttributes:{
                icon:'<i class="note-icon-pencil"/>',
                removeEmpty:false, // true = remove attributes | false = leave empty if present
                disableUpload: false // true = don't display Upload Options | Display Upload Options
            },
            captionIt:{
                icon:'<i class="fas fa-closed-captioning"/>',
                figureClass:'{figure-class/es}',
                figcaptionClass:'{figcapture-class/es}',
                captionText:'{Default Caption Editable Placeholder Text if Title or Alt are empty}'
            },
            //set callback image tuk upload ke serverside
            callbacks: {
                onImageUpload: function(image) {
                    uploadImage(image[0]);
                },
                onMediaDelete : function(target) {
                    deleteImage(target[0].src);
                }
            }
        });

        // untuk melakukan upload dan menampilkan kembali 
        function uploadImage(image) {
            var data = new FormData();
            data.append("image", image);
            $.ajax({
                url: "<?=base_url();?>admin/C_articlesController/saveImageSummernote",
                cache: false,
                contentType: false,
                processData: false,
                data: data,
                type: "POST",
                success: function(url) {
                    $('#create_article_summernote').summernote("insertImage", url);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }
 
        function deleteImage(src) {
            $.ajax({
                data: {src : src},
                type: "POST",
                url: "<?=base_url();?>admin/C_articlesController/deleteImageSummernote",
                cache: false,
                success: function(response) {
                    console.log(response);
                }
            });
        }

    });
</script>