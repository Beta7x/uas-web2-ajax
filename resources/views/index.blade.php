<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD App Laravel 8 & Ajax</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css' />
  <link rel='stylesheet'
    href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css' />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.css" />

</head>
{{-- add new employee modal start --}}
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/store" method="POST" id="add_product_form" enctype="multipart/form-data">
        @csrf
        <div class="modal-body p-4 bg-light">
          <div class="row">
            <div class="col-lg">
              <label for="brand">Brand</label>
              <input type="text" name="brand" class="form-control" placeholder="Laptop Brand" required>
            </div>
            <div class="col-lg">
              <label for="series">Series</label>
              <input type="text" name="series" class="form-control" placeholder="Laptop Series" required>
            </div>
          </div>
          <div class="my-2">
            <label for="production_year">Year</label>
            <select class="form-select" name="production_year" aria-label="Default select example" required>
                <option selected>Choose Production Year</option>
                <option value="2010">2010</option>
                <option value="2011">2011</option>
                <option value="2012">2012</option>
                <option value="2013">2013</option>
                <option value="2014">2014</option>
                <option value="2015">2015</option>
                <option value="2016">2016</option>
                <option value="2017">2017</option>
                <option value="2018">2018</option>
                <option value="2019">2019</option>
                <option value="2020">2020</option>
                <option value="2021">2021</option>
                <option value="2022">2022</option>
                <option value="2023">2023</option>
                <option value="2024">2024</option>
                <option value="2025">2025</option>
                <option value="2026">2026</option>
                <option value="2027">2027</option>
                <option value="2028">2028</option>
                <option value="2029">2029</option>
                <option value="2030">2030</option>
            </select>
          </div>
          <div class="my-2">
            <label for="price">Price</label>
            <input type="number" name="price" class="form-control" placeholder="Laptop Price" required>
          </div>
          <div class="my-2">
            <label for="operating_system">Operating System</label>
            <select class="form-select" name="operating_system" aria-label="Default select example" required>
                <option selected>Choose Operating System</option>
                <option value="Windows 10">Windows 10</option>
                <option value="Windows 11">Windows 11</option>
                <option value="MacOS">MacOS - Only for Mac</option>
                <option value="Ubuntu">Ubuntu</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="add_product_btn" class="btn btn-primary">Add Employee</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- add new employee modal end --}}

{{-- edit employee modal start --}}
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/update" method="POST" id="edit_product_form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="product_id" id="product_id">
        <div class="modal-body p-4 bg-light">
          <div class="row">
            <div class="col-lg">
              <label for="brand">Brand</label>
              <input type="text" name="brand" id="brand" class="form-control" placeholder="Laptop Brand" required>
            </div>
            <div class="col-lg">
              <label for="series">Series</label>
              <input type="text" name="series" id="series" class="form-control" placeholder="Laptop Series" required>
            </div>
          </div>
          <div class="my-2">
            <label for="production_year">Year</label>
            <select class="form-select" name="production_year" aria-label="Default select example" required>
                <option selected>Choose Production Year</option>
                <option value="2010">2010</option>
                <option value="2011">2011</option>
                <option value="2012">2012</option>
                <option value="2013">2013</option>
                <option value="2014">2014</option>
                <option value="2015">2015</option>
                <option value="2016">2016</option>
                <option value="2017">2017</option>
                <option value="2018">2018</option>
                <option value="2019">2019</option>
                <option value="2020">2020</option>
                <option value="2021">2021</option>
                <option value="2022">2022</option>
                <option value="2023">2023</option>
                <option value="2024">2024</option>
                <option value="2025">2025</option>
                <option value="2026">2026</option>
                <option value="2027">2027</option>
                <option value="2028">2028</option>
                <option value="2029">2029</option>
                <option value="2030">2030</option>
            </select>
          </div>
          <div class="my-2">
            <label for="price">Price</label>
            <input type="number" name="price" id="price" class="form-control" placeholder="Laptop Price" required>
          </div>
          <div class="my-2">
            <label for="operating_system">Operating System</label>
            <select class="form-select" name="operating_system" aria-label="Default select example" required>
                <option selected>Choose Operating System</option>
                <option value="Windows 10">Windows 10</option>
                <option value="Windows 11">Windows 11</option>
                <option value="MacOS">MacOS - Only for Mac</option>
                <option value="Ubuntu">Ubuntu</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="edit_product_btn" class="btn btn-success">Update Employee</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- edit employee modal end --}}

<body class="bg-light">
  <div class="container">
    <div class="row my-5">
      <div class="col-lg-12">
        <div class="card shadow">
          <div class="card-header bg-secondary d-flex justify-content-between align-items-center">
            <h3 class="text-light">Manage Product</h3>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal"><i
                class="bi-plus-circle me-2"></i>Add New Product</button>
          </div>
          <div class="card-body" id="show_all_products">
            <h1 class="text-center text-secondary my-5">Loading...</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    $(function() {

      // add new employee ajax request
      $("#add_product_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#add_product_btn").text('Adding...');
        $.ajax({
          url: '{{ route('store') }}',
          method: 'post',
          data: fd,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response) {
            if (response.status == 200) {
              Swal.fire(
                'Added!',
                'Employee Added Successfully!',
                'success'
              )
              fetchAllProducts();
            }
            $("#add_product_btn").text('Add Product');
            $("#add_product_form")[0].reset();
            $("#addProductModal").modal('hide');
          }
        });
      });

      // edit employee ajax request
      $(document).on('click', '.editIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        $.ajax({
          url: '{{ route('edit') }}',
          method: 'get',
          data: {
            id: id,
            _token: '{{ csrf_token() }}'
          },
          success: function(response) {
            $("#brand").val(response.brand);
            $("#series").val(response.series);
            $("#production_year").val(response.production_year);
            $("#price").val(response.price);
            $("#operating_system").val(response.operating_system);
            $("#product_id").val(response.id);
          }
        });
      });

      // update employee ajax request
      $("#edit_product_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#edit_product_btn").text('Updating...');
        $.ajax({
          url: '{{ route('update') }}',
          method: 'post',
          data: fd,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response) {
            if (response.status == 200) {
              Swal.fire(
                'Updated!',
                'Employee Updated Successfully!',
                'success'
              )
              fetchAllProducts();
            }
            $("#edit_product_btn").text('Update Product');
            $("#edit_product_form")[0].reset();
            $("#editProductModal").modal('hide');
          }
        });
      });

      // delete employee ajax request
      $(document).on('click', '.deleteIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        let csrf = '{{ csrf_token() }}';
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: '{{ route('delete') }}',
              method: 'delete',
              data: {
                id: id,
                _token: csrf
              },
              success: function(response) {
                console.log(response);
                Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                )
                fetchAllProducts();
              }
            });
          }
        })
      });

      // fetch all employees ajax request
      fetchAllProducts();

      function fetchAllProducts() {
        $.ajax({
          url: '{{ route('fetchAll') }}',
          method: 'get',
          success: function(response) {
            $("#show_all_products").html(response);
            $("table").DataTable({
              order: [0, 'desc']
            });
          }
        });
      }
    });
  </script>
</body>

</html>