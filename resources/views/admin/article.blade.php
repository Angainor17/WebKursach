@extends("admin.frame")

@section("title","Article")

@section("content")
    <div style="margin-bottom: 20px; margin-right: 200px; margin-left: 100px">
        <form id="form" method="POST" enctype="multipart/form-data">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Title Ru</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputTitleRu" placeholder="Title Ru">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Title En</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputTitleEn" placeholder="Title En">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Short Ru</label>
                <textarea class="form-control" id="inputShortRu" rows="3"></textarea>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Short En</label>
                <textarea class="form-control" id="inputShortEn" rows="3"></textarea>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Full Ru</label>
                <textarea class="form-control" id="inputFullRu" rows="6"></textarea>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Full En</label>
                <textarea class="form-control" id="inputFullEn" rows="6"></textarea>
            </div>


            <div class="row">

                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="gridRadios" id="inputRbNews"
                               value="1" checked>
                        News
                    </label>
                </div>
                <div class="form-check" style="margin-left: 50px">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="gridRadios" id="inputRbAction"
                               value="2">
                        Action
                    </label>
                </div>

            </div>


            <div class="form-group" style="float: left">
                <label>Image file input</label>
                <input type="file" class="form-control-file" name="file" id="file">
            </div>
            {{ csrf_field() }}

            <div class="form-group row">
                <div class="col-sm-10">
                    <div style="float: left; margin-bottom: 50px">
                        <p>
                            <button id="deleteBtn" type="button" class="btn btn-outline-primary">Delete</button>

                            <button style="margin-left: 30px" type="button" id="addBtn"
                                    class="btn btn-outline-primary">Add
                            </button>
                            <button style="margin-left: 30px" type="button" id="editBtn"
                                    class="btn btn-outline-primary">Edit
                            </button>
                        </p>
                    </div>
                </div>
            </div>

        </form>
    </div>

    <table class="table table-bordered" id="articles-table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Short</th>
            <th>Full</th>
            <th>Date</th>
            <th>Type</th>
        </tr>
        </thead>
    </table>

    <script>
        var table;
        $(function () {
            table = $('#articles-table').DataTable({
                processing: false,
                serverSide: true,
                ajax: {
                    url: '/admin/article/list'
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'short', name: 'short'},
                    {data: 'full', name: 'full'},
                    {data: 'date', name: 'date'},
                    {data: 'type', name: 'type'},
                ]
            });
        });

        $(document).ready(function () {
            doOnStart();
        });
    </script>

    <script>
        function doOnStart() {
            cleanAllFields();
            $('#articles-table tbody').on('click', 'tr', function () {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                }
                else {
                    table.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            });

            $("#deleteBtn").click(function () {
                    if ($('#articles-table').DataTable().row('.selected').count() > 0) {
                        $.ajax({
                            url: '/admin/article/delete/' + $('#articles-table').DataTable().row('.selected').data().id,
                            type: 'GET',
                            success: function (result) {
                                refreshTable();
                            }
                        });
                        $('#articles-table').DataTable().row('.selected').remove().draw();
                    }
                }
            );

            $("#editBtn").click(function () {
                    if ($("#editBtn").text() == 'Edit\n' || $("#editBtn").text() == 'Edit') {
                        if ($('#articles-table').DataTable().row('.selected').count() > 0) {
                            $.ajax({
                                url: '/admin/article/get/' + $('#articles-table').DataTable().row('.selected').data().id,
                                type: 'GET',
                                success: function (result) {
                                    var jsonObject = JSON.parse(result);
                                    var item = jsonObject[0];

                                    editId = item.id;

                                    $('#inputTitleRu').val(item.title);
                                    $('#inputTitleEn').val(item.title_en);
                                    $('#inputShortRu').val(item.short);
                                    $('#inputShortEn').val(item.short_en);
                                    $('#inputFullRu').val(item.full);
                                    $('#inputFullEn').val(item.full_en);
                                    $("#editBtn").text("Update\n");
                                }
                            });
                        }
                    } else {
                        $("#editBtn").text("Edit\n");
                        updateById(editId);
                    }
                }
            );

            function updateById(id) {
                var body = {
                    id: id,
                    title: $('#inputTitleRu').val(),
                    title_en: $('#inputTitleEn').val(),
                    short: $('#inputShortRu').val(),
                    short_en: $('#inputShortEn').val(),
                    full: $('#inputFullRu').val(),
                    full_en: $('#inputFullEn').val()
                };
                $.ajax({
                    url: "/admin/article/update",
                    type: "POST",
                    data: JSON.stringify(body),
                    dataType: "json",
                    success: function (result) {
                        alert(result);
                        cleanAllFields();
                        refreshTable();
                    }
                });
            }

            var editId = 0;

            $("#addBtn").click(function () {
                if (isValid()) {
                    var body = {
                        short: $('#inputShortRu').val(),
                        full: $('#inputFullRu').val(),
                        imageId: $('#file').val(),
                        type: $('input[name="gridRadios"]:checked').val(),
                        short_en: $('#inputShortEn').val(),
                        full_en: $('#inputFullEn').val(),
                        title: $('#inputTitleRu').val(),
                        title_en: $('#inputTitleEn').val()
                    };

                    var jsonBody = JSON.stringify(body);
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "/admin/article/add",
                        type: "POST",
                        data: jsonBody,
                        dataType: "json",
                        success: function (result) {
                            cleanAllFields();
                            refreshTable();
                        }
                    });

                    var formData = new FormData($("#form")[0]);
                    $.ajax({
                        url: '/admin/uploadFile',
                        type: 'POST',
                        data: formData,
                        async: false,
                        cache: false,
                        contentType: false,
                        enctype: 'multipart/form-data',
                        processData: false,
                        success: function (response) {
                            alert(response);
                        }
                    });

                }
            })
            ;
        }

        function refreshTable() {
            $('#articles-table').DataTable().ajax.reload();
        }

        function cleanAllFields() {
            $('#inputTitleRu').val("");
            $('#inputTitleEn').val("");
            $('#inputShortRu').val("");
            $('#inputShortEn').val("");
            $('#inputFullRu').val("");
            $('#inputFullEn').val("");

            $('#file').val("");
        }

        function isValid() {
            return !($('#inputTitleRu').val().length == 0 ||
                $('#inputTitleEn').val().length == 0 ||
                $('#inputShortRu').val().length == 0 ||
                $('#inputShortEn').val().length == 0 ||
                $('#inputFullRu').val().length == 0 ||
                $('#inputFullEn').val().length == 0 ||
                $('#file').val().length == 0);
        }

        function getAllFieldsValue() {
            var titleRu = $('#inputTitleRu').val();
            var titleEn = $('#inputTitleEn').val();
            var shortRu = $('#inputShortRu').val();
            var shortEn = $('#inputShortEn').val();
            var fullRu = $('#inputFullRu').val();
            var fullEnu = $('#inputFullEn').val();

            var type = $('input[name="gridRadios"]:checked').val();

            var file = $('#file').val();
        }
    </script>

@endsection

