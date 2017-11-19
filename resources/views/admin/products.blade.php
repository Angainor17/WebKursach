@extends("admin.frame")

@section("title", "Products")

@section("content")

    <script>
        function loaddropdown() {
            var dropdown = document.getElementById("ageFromSelect");
            for (var i = 1; i <= 100; i++) {
                var newOption = document.createElement('<option>');
                newOption.Text = i;
                newOption.value = i;
                dropdown.options.add(newOption);
            }
        }

        window.onload = loaddropdown();
    </script>


    <div style="margin-bottom: 20px; margin-right: 200px; margin-left: 100px">
        <form>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Name Ru</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputNameRu" placeholder="Name Ru">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Name En</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputNameEn" placeholder="Name En">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Description Ru</label>
                <textarea class="form-control" id="inputDescriptionRu" rows="3"></textarea>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Description En</label>
                <textarea class="form-control" id="inputDescriptionEn" rows="3"></textarea>
            </div>


            <label>Product image file input</label>
            <input type="file" class="form-control-file" id="inputImageFile">


            <label class="col-sm-2 "></label>
            <select class="form-control" style="margin-bottom: 90px" id="ageFromSelect">

            </select>

            <div class="col-sm-10" style="margin-bottom: 20px">
                <div style="float: left; margin-bottom: 50px">
                    <p>
                        <button id="deleteBtn" type="button" class="btn btn-outline-primary">Delete</button>

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
            <th>Id</th>
            <th>Short</th>
            <th>Full</th>
            <th>Date</th>
            <th>Type</th>
        </tr>
        </thead>

    </table>

@endsection