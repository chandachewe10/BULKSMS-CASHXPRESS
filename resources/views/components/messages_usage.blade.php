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


<table class="table" id="usage">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Units</th>
      <th scope="col">Type</th>
      <th scope="col">Description</th>
      <th scope="col">Date</th> 
       
    </tr>
  </thead>
  <tbody>
    
  </tbody>
</table>


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

<!--Datatables Buttons ends here-->
<script type="text/javascript">
  $(function () {
    
    var table = $('#usage').DataTable({
        processing: true,
        serverSide: true,
        "lengthChange": false,
        scrollX: true,
        dom:'lBfrtip',
        ajax: "{{ route('usage') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'units', name: 'units'},
            {data: 'type', name: 'type'},
            {data: 'description', name: 'description'},
            {data: 'created_at', name: 'created_at'}           
            
           
        ],
        buttons: [
                   {
                       extend: 'pdf',
                       exportOptions: {
                           columns: [0,1,2,3,4] // Column index which needs to export
                       },
                               
        className: 'btn btn-success',
        text: '<i class="fa fa-file-pdf"></i> Export as PDF',
        titleAttr: 'Export as PDF',
        title: 'Messages Usage Report',
                   
                   },
                   {
                       extend: 'csv',
                       exportOptions: {
                           columns: [0,1,2,3,4] // Column index which needs to export
                       },
                       className: 'btn btn-info',
        text: '<i class="fa fa-file-excel"></i> Export as CSV',
        titleAttr: 'Export as CSV',
        title: 'Messages Usage Report',
                   },
                   {
                       extend: 'excel',
                       exportOptions: {
                           columns: [0,1,2,3,4] // Column index which needs to export
                       },
                       className: 'btn btn-primary',
        text: '<i class="fa fa-file-excel"></i> Export as EXCEL',
        titleAttr: 'Export as EXCEL',
        title: 'Messages Usage Report',
                   },
                   {
                       extend: 'print',
                       exportOptions: {
                           columns: [0,1,2,3,4] // Column index which needs to export
                       },
                       className: 'btn btn-secondary',
        text: '<i class="fa fa-print"></i> Print',
        titleAttr: 'Print',
        title: 'Messages Usage Report',
                   },
              ],
    });
    
  });
</script>

</div>