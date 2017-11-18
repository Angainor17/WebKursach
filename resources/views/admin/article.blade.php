@extends("admin.frame")

@section("title","Article")

@section("content")
    <p>{{$articles}}</p>

    <div style="margin-bottom: 20px; margin-right: 200px; margin-left: 100px">
        <form>
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
                               value="news" checked>
                        News
                    </label>
                </div>
                <div class="form-check" style="margin-left: 50px">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="gridRadios" id="inputRbAction"
                               value="action">
                        Action
                    </label>
                </div>

            </div>


            <div class="form-group" style="float: left">
                <label>Image file input</label>
                <input type="file" class="form-control-file" id="inputImageFile">
            </div>

            <div class="form-group row">
                <div class="col-sm-10">
                    <div style="float: left; margin-bottom: 50px">
                        <p>
                            <button id="deleteBtn" type="button" class="btn btn-outline-primary">Delete</button>

                            <button style="margin-left: 30px" id="addEditBtn" type="button"
                                    class="btn btn-outline-primary">Add/Edit
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
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/admin/articleList'
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
                    $.ajax({
                        url: '/admin/deletearticle/' + $('#articles-table').DataTable().row('.selected').id,
                        type: 'GET',
                        success: function (result) {

                        }
                    });
                    $('#articles-table').DataTable().row('.selected').remove().draw();
                }
            );
        });
    </script>

@endsection

