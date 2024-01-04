<div class="content-wrapper">
    <style>
        .btn-primary {
          background-color: blue;
          color: white;
          font-weight: bold;
          padding: 0.5rem 1rem;
          border-radius: 0.25rem;
        }
        
        .btn-primary:hover {
          background-color: darkblue;
        }
        
        .btn-secondary {
          background-color: gray;
          color: white;
          font-weight: bold;
          padding: 0.5rem 1rem;
          border-radius: 0.25rem;
        }
        
        .btn-secondary:hover {
          background-color: darkgray;
        }
        
        .btn-info {
          background-color: teal;
          color: white;
          font-weight: bold;
          padding: 0.5rem 1rem;
          border-radius: 0.25rem;
        }

        .btn-danger {
          background-color: red;
          color: white;
          font-weight: bold;
          padding: 0.5rem 1rem;
          border-radius: 0.25rem;
        }
        
        .btn-info:hover {
          background-color: darkteal;
        }
        
        .btn-success {
          background-color: green;
          color: white;
          font-weight: bold;
          padding: 0.5rem 1rem;
          border-radius: 0.25rem;
        }
        
        .btn-success:hover {
          background-color: darkgreen;
        }
        </style>

<table class="table" id="contacts">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">First Name</th>
        <th scope="col">Last Name</th>
        <th scope="col">Phone</th>
        <th scope="col">Email</th>
        <th scope="col">Address</th>
        <th scope="col">Company</th>
        <th scope="col">Nationality</th>
        <th scope="col">Tag</th>
        <th scope="col">Date</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      
    </tbody>
  </table>
  
  <style> 
  
  .modal-backdrop {
    display: none;
  }
  
  
  </style>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
     <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
     <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js" type="text/javascript"></script>










  <!--Bootstrap Modal -->    
  
  
  <!-- Modal -->
  <div class="modal fade" id="delete-modal" tabindex="-1" aria-labelledby="delete-modal-label" aria-hidden="true" >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="delete-modal-label">Confirm deletion</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">X</button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this contact?
          <form id="delete-form" action="" method="POST">
            @csrf
            @method('DELETE')
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" form="delete-form" class="btn btn-danger">Delete</button>
        </div>
      </div>
    </div>
  </div>
  
  
  <script>
    const contactsTable = document.getElementById('contacts');
    contactsTable.addEventListener('click', function(event) {
      if (event.target.classList.contains('delete-link')) {
        event.preventDefault();
       
        // Show the confirmation modal
        const modal = new bootstrap.Modal(document.getElementById('delete-modal'));
        modal.show();
  
        // Set the delete form action to the link's href attribute
        const deleteForm = document.getElementById('delete-form');
        
        deleteForm.action = event.target.href;
      }
    });
  </script>
  
  
  
  <!--Datatables Buttons ends here-->
  <script type="text/javascript">
    $(function () {
     
      var table = $('#contacts').DataTable({
          processing: true,
          serverSide: true,
          "lengthChange": false,
          scrollX: true,
          dom:'lBfrtip',
          ajax: "{{ route('all_contacts') }}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'first_name', name: 'first_name'},
              {data: 'last_name', name: 'last_name'},
              {data: 'phone', name: 'phone'},
              {data: 'email', name: 'email'},
  
              {data: 'address', name: 'address'},
              {data: 'company', name: 'company'},
              {data: 'nationality', name: 'nationality'},
              {data: 'tag', name: 'tag'},
             
              {data: 'created_at', name: 'created_at'},
              {data: 'action', name: 'action'},
             
          ],
          buttons: [
                     {
                         extend: 'pdf',
                        
                         exportOptions: {
                             columns: [0,1,2,3,4,5,6,7] // Column index which needs to export
                         },
                         
          className: 'btn btn-success',
          text: '<i class="fa fa-file-pdf"></i> Export as PDF',
          titleAttr: 'Export as PDF',
          title: 'Contacts',
                     },
                     {
                         extend: 'csv',
                         
                         exportOptions: {
                             columns: [0,1,2,3,4,5,6,7] // Column index which needs to export
                         },
                         className: 'btn btn-info',
          text: '<i class="fa fa-file-excel"></i> Export as CSV',
          titleAttr: 'Export as CSV',
          title: 'Contacts',
                     },
  
  
                     {
                         extend: 'excel',
                        
                         exportOptions: {
                             columns: [0,1,2,3,4,5,6,7] // Column index which needs to export
                         },
                         className: 'btn btn-primary',
          text: '<i class="fa fa-file-excel"></i> Export as EXCEL',
          titleAttr: 'Export as EXCEL',
          title: 'Contacts',
                     },
                     {
                         extend: 'print',
                         exportOptions: {
                             columns: [0,1,2,3,4,5,6,7] // Column index which needs to export
                         },
                         className: 'btn btn-secondary',
          text: '<i class="fa fa-print"></i> Print',
          titleAttr: 'Print',
          title: 'Contacts',
                     },
                ],
      });
      
    });
  </script>

</div>