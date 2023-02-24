<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<div class="container">
    <h2>List Customer</h2>
    <button class="btn btn-sm btn-primary" onclick="addCustomer()">Add</button>

    <table id="customer-list" class="table table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Gender</th>
          <th>Marital Status</th>
          <th>Address</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
</div>

<div id="new-customer-modal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form id="new-customer-form">
        <div class="modal-header">
          <h5 class="modal-title">Add customer</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="col-12">Name</div>
            <div class="col-12"><input   class="form-control input-sm" id="name" type="text" name="name"></div>

            <div class="col-12">Email</div>
            <div class="col-12"><input  pattern="\S(.*\S)?" class="form-control input-sm" id="email" type="email" name="email"></div>
              
            <div class="col-12">Password</div>
            <div class="col-12"><input   class="form-control input-sm" id="password" type="password" name="password"></div>
          
            <div class="col-12">Gender</div>
            <div class="col-12">
              <select name="gender" id="gender" style="border:solid">
                <option value="MALE">MALE</option>
                <option value="FEMALE">FEMALE</option>
              </select>
            </div>
          
            <div class="col-12">Marital Status</div>
            <div class="col-12">
              <select name="is_married" id="is_married" style="border:solid">
                <option value="MARRIED">MARRIED</option>
                <option value="SINGLE">SINGLE</option>
              </select>
            </div>

            <div class="col-12">Address</div>
            <div class="col-12">
              <textarea  class="form-control input-sm" rows="4" cols="50" id="address" name="address"></textarea>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" onclick=saveCustomer() class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div id="customer-modal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>

<div id="edit-customer-modal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form id="edit-customer-form">
        <div class="modal-header">
          <h5 class="modal-title">Edit customer</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <input hidden class="form-control input-sm" id="id" type="text" name="id">
            <div class="col-12">Name</div>
            <div class="col-12"><input  class="form-control input-sm" id="name" type="text" name="name"></div>

            <div class="col-12">Email</div>
            <div class="col-12"><input  pattern="\S(.*\S)?" class="form-control input-sm" id="email" type="email" name="email"></div>
                
            <div class="col-12">Gender</div>
            <div class="col-12">
              <select name="gender" id="gender" style="border:solid">
                <option value="MALE">MALE</option>
                <option value="FEMALE">FEMALE</option>
              </select>
            </div>
          
            <div class="col-12">Marital Status</div>
            <div class="col-12">
              <select name="is_married" id="is_married" style="border:solid">
                <option value="MARRIED">MARRIED</option>
                <option value="SINGLE">SINGLE</option>
              </select>
            </div>

            <div class="col-12">Address</div>
            <div class="col-12">
              <textarea  class="form-control input-sm" rows="4" cols="50" id="address" name="address"></textarea>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" onclick=updateCustomer() class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
  $.ajax({
    url: '/Customer/',
    type: 'GET',
    dataType: 'json',
    success: function(data) {
      $.each(data, function(index, customer) {
        var row = '<tr>' +
          '<td>' + customer.id + '</td>' +
          '<td>' + customer.name + '</td>' +
          '<td>' + customer.email + '</td>' +
          '<td>' + customer.gender + '</td>' +
          '<td>' + customer.is_married + '</td>' +
          '<td>' + customer.address + '</td>' +
          '<td>' +
          '<button class="btn btn-sm btn-primary" onclick="showCustomer(' + customer.id + ')">Detail</button> ' +
          '<button class="btn btn-sm btn-warning" onclick="editCustomer(' + customer.id + ')">Edit</button> ' +
          '<button class="btn btn-sm btn-danger" onclick="deleteCustomer(' + customer.id + ')">Delete</button>' +
          '</td>' +
          '</tr>';
        $('#customer-list tbody').append(row);
      });
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.log(textStatus, errorThrown);
    }
  });
});

function addCustomer() {
  $('#new-customer-modal').modal('show');
}

function saveCustomer() {
  $.ajax({
    url: '/Customer',
    type: 'POST',
    dataType: 'json',
    data: $('#new-customer-form').serialize() + "&_token="+"{{ csrf_token() }}",
    success: function(data) {
      if(data.success==true){
        alert("Data Saved");
        location.reload();
      }else{
        alert("Save Failed");
      }
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.log(textStatus, errorThrown);
    }
  });
}

function showCustomer(id) {
  $.ajax({
    url: '/Customer/' + id,
    type: 'GET',
    dataType: 'json',
    success: function(data) {
      $('#customer-modal .modal-title').text(data[0].name);
      $('#customer-modal .modal-body').html(
        '<p><strong>Email:</strong> ' + data[0].email + '</p>' +
        '<p><strong>Gender:</strong> ' + data[0].gender + '</p>' + 
        '<p><strong>Marital Status:</strong> ' + data[0].is_married + '</p>' + 
        '<p><strong>Address:</strong> ' + data[0].address + '</p>' 
      );
      $('#customer-modal').modal('show');
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.log(textStatus, errorThrown);
    }
  });
}

function editCustomer(id) {
  $.ajax({
    url: '/Customer/' + id,
    type: 'GET',
    dataType: 'json',
    success: function(data) {
      $('#edit-customer-form input[name="id"]').val(data[0].id);
      $('#edit-customer-form input[name="name"]').val(data[0].name);
      $('#edit-customer-form input[name="email"]').val(data[0].email);
      $("#edit-customer-form #gender").val(data[0].gender);
      $("#edit-customer-form #is_married").val(data[0].is_married);
      $('#edit-customer-form #address').val(data[0].address);
      $('#edit-customer-modal').modal('show');
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.log(textStatus, errorThrown);
    }
  });
}

function updateCustomer() {
  id=$('#edit-customer-form input[name="id"]').val();
  $.ajax({
    url: '/Customer/' + id,
    type: 'PATCH',
    dataType: 'json',
    data: $('#edit-customer-form').serialize() + "&_token="+"{{ csrf_token() }}",
    success: function(data) {
      if(data.success==true){
        alert("Data Saved");
        location.reload();
      }else{
        alert("Save Failed");
      }
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.log(textStatus, errorThrown);
    }
  });
}

function deleteCustomer(id) {
  if (confirm('Are you sure to delete this customer?')) {
    $.ajax({
      url: '/Customer/' + id,
      type: 'DELETE',
      dataType: 'json',
      data: {
          "_token": "{{ csrf_token() }}"
      },
      success: function() {
        alert("Data Deleted");
        location.reload();
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log(textStatus, errorThrown);
      }
  });
}}
</script>