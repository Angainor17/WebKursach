@extends("admin.frame")

@section("title","Article")

@section("content")
    <div style="margin-bottom: 20px; margin-right: 200px; margin-left: 100px">
        <form id="form" enctype="multipart/form-data">


            <div class="input-group" style="margin-top: 20px">
                <span class="input-group-addon">Title Ru</span>

                <input type="text" class="form-control is-valid" id="inputTitleRu" placeholder="Title Ru"
                       pattern=".{1,100}" required>
            </div>


            <div class="input-group" style="margin-top: 20px">
                <span class="input-group-addon">Title En</span>

                <input type="text" class="form-control is-valid" id="inputTitleEn" placeholder="Title En"
                       pattern=".{1,100}" required>
            </div>


            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Short Ru</label>
                <textarea class="form-control is-valid" id="inputShortRu" rows="3" maxlength="400" required></textarea>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Short En</label>
                <textarea class="form-control is-valid" id="inputShortEn" rows="3" maxlength="400" required></textarea>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Full Ru</label>
                <textarea class="form-control is-valid" id="inputFullRu" rows="6" maxlength="1000" required></textarea>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Full En</label>
                <textarea class="form-control is-valid" id="inputFullEn" rows="6" maxlength="1000" required></textarea>
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


            <div class="form-group row"
                 style="margin-top: 20px;margin-bottom: 20px">
                <span class="input-group-addon">Article\News image file: </span>

                <input type="file" class="btn btn-default" name="file" id="file" required>
            </div>

            {{ csrf_field() }}

            <div class="form-group row">
                <div class="col-sm-10">
                    <div style="float: left; margin-bottom: 50px">
                        <p>
                            <button id="deleteBtn" type="button" class="btn btn-outline-primary">Delete</button>

                            <button style="margin-left: 30px" type="submit" id="addBtn" class="btn btn-outline-primary">Add
                            </button>
                            <button style="margin-left: 30px" type="button" id="editBtn" class="btn btn-outline-primary">Edit
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
                    {data: 'type', name: 'type'}
                ]
            });
        });

        $(document).ready(function () {
            doOnStart();
        });
    </script>

    <script>

        function setBtnEnable(id, isEnable) {
            if (isEnable) {
                $(id).prop('disabled', false);
                $(id).attr('class', 'btn btn-outline-primary');
            } else {
                $(id).prop('disabled', true);
                $(id).attr('class', 'btn btn-default');
            }
        }


        function scrollUp() {
            $(window).scrollTop(0);
        }

        function doOnStart() {

            $("#form").submit(function (event) {
                event.preventDefault();
                addBtnClickEvent();
                return false;
            });


            $("#editBtn").text("Edit");
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
                    if ($('#articles-table').DataTable().row('.selected').count() > 0) {

                        if ($("#editBtn").text() == "Edit\n" || $("#editBtn").text() == 'Edit') {
                            scrollUp();
                            setBtnEnable('#addBtn', false);
                            setBtnEnable('#deleteBtn', false);

                            editId = $('#articles-table').DataTable().row('.selected').data().id;
                            $.ajax({
                                url: '/admin/article/get/' + $('#articles-table').DataTable().row('.selected').data().id,
                                type: 'GET',
                                success: function (result) {
                                    var item = JSON.parse(result)

                                    $('#inputTitleRu').val(item.title);
                                    $('#inputTitleEn').val(item.title_en);
                                    $('#inputShortRu').val(item.short);
                                    $('#inputShortEn').val(item.short_en);
                                    $('#inputFullRu').val(item.full);
                                    $('#inputFullEn').val(item.full_en);

                                    if (item.full_en === 1) {
                                        $('#inputRbAction').prop('checked', false);
                                        $('#inputRbNews').prop('checked', true);
                                    } else {
                                        $('#inputRbAction').prop('checked', true);
                                        $('#inputRbNews').prop('checked', false);
                                    }

                                    $("#editBtn").text("Update");
                                }
                            });
                        } else {
                            $("#editBtn").text("Edit");
                            alert(editId);
                            updateById(editId);
                            setBtnEnable('#addBtn', true);
                            setBtnEnable('#deleteBtn', true);
                        }
                    } else {
                        alert('Choose item')
                    }
                }
            );

            function addBtnClickEvent() {
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
                        addItem(response);
                        cleanAllFields();
                    }
                });
            }
        }

        var editId = 0;

        function updateById(id) {
            var body = {
                id: id,
                title: $('#inputTitleRu').val(),
                title_en: $('#inputTitleEn').val(),
                short: $('#inputShortRu').val(),
                short_en: $('#inputShortEn').val(),
                full: $('#inputFullRu').val(),
                full_en: $('#inputFullEn').val(),
                type: $('input[name="gridRadios"]:checked').val()
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

        function addItem($imageId) {
            var body = {
                short: $('#inputShortRu').val(),
                full: $('#inputFullRu').val(),
                imageId: $imageId,
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

    </script>

@endsection

