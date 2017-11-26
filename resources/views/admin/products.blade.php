@extends("admin.frame")

@section("title", "Products")

@section("content")

    <script>
        $(document).ready(function () {
            doOnStart();
        });

        function doOnStart() {
            $("#form").submit(function (event) {
                event.preventDefault();
                return false;
            });

            $("#submitBtn").click(function () {
                alert("lol");
            })

        }

    </script>

    <div style="margin-bottom: 20px; margin-right: 200px; margin-left: 100px">
        <form id="form">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Name Ru</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control is-valid" id="inputNameRu" placeholder="Name Ru"
                           pattern=".{1,100}" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Name En</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control is-valid" id="inputNameEn" placeholder="Name En"
                           pattern=".{1,100}" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Description Ru</label>
                <textarea class="form-control is-valid" id="inputDescriptionRu" rows="3" required></textarea>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Description En</label>
                <textarea class="form-control is-valid" id="inputDescriptionEn" rows="3" required></textarea>
            </div>


            <label>Product image file input</label>

            <input type="file" class="form-control-file" id="inputImageFile" required>

            <div class="form-group row" style="margin-top: 20px">
                <label class="col-sm-2 col-form-label" style="display:inline-block">Age from </label>

                <select class="form-control" style="display:inline-block;margin-bottom: 90px;width: 100px"
                        id="ageToSelect" required>
                    @include("spinner")
                </select>

                <label class="col-sm-2 col-form-label" style="display:inline-block">Age to </label>

                <select class="form-control" style="margin-bottom: 90px;width: 100px" id="ageToSelect" required>
                    @include("spinner")
                </select>
            </div>

            <div class="form-group row" style="margin-top: 20px">
                <div class="input-group">
                    <span class="input-group-addon">Cost</span>
                    <input id="msg" type="text" class="form-control is-valid" name="msg" placeholder="0.00 RUB"
                           pattern="\d+(\.\d{2})?" required>
                </div>

                <div class="input-group" style="margin-top: 20px">
                    <span class="input-group-addon">Discount</span>
                    <input id="msg" type="text" class="form-control is-valid" name="msg" placeholder="0.00 %"
                           pattern="\d+(\.\d{2})?" required>
                </div>

            </div>

            <div class="form-group row" style="margin-bottom: 20px">
                <div style="float: left; margin-bottom: 50px">
                    <p>
                        <button id="deleteBtn" type="button" class="btn btn-outline-primary">Delete</button>
                        <button id="submitBtn" type="submit" class="btn btn-outline-primary">Submit</button>

                        <button style="margin-left: 30px" id="addEditBtn" type="button"
                                class="btn btn-outline-primary">Add/Edit
                        </button>
                    </p>
                </div>
            </div>


        </form>
    </div>


    <table class="table table-bordered" id="products-table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Category</th>
            <th>Description</th>
            <th>Cost</th>
            <th>Type</th>
        </tr>
        </thead>

    </table>
    <script>
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


    </script>

@endsection