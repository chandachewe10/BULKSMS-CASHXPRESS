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
    <br>
    <h3 class="text-2xl font-semibold">Send A Messsage to Your Contacts</h3>

    <br>
    <!-- Create form with Bootstrap styling -->
    <div class="container">
        <form class="form-horizontal" action="{{ route('bulk-sms-sending.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="comment">Comment:</label>
                <textarea class="form-control @error('message') is-invalid @enderror" id="comment" name="message" maxlength="160"
                    rows="5" placeholder="Enter your message in not more than 160 characters" oninput="updateCharacterCount()"></textarea>
                <span id="characterCount">160</span> characters remaining

                @error('message')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            @php
                $contacts = \App\Models\contacts::where('user_id', '=', auth()->user()->id)->get();
                
            @endphp


            <table id="contacts" class="table table-striped">
                <thead>
                    <tr>
                        <th>Contact</th>
                        <th>Phone</th>
                        <th>Tag</th>
                        <th>Mark contact</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $contact)
                        <tr>
                            <td>{{ $contact->first_name }}, {{ $contact->last_name }}</td>
                            <td>{{ $contact->phone }}</td>
                            <td>{{ $contact->tag }}</td>
                            <td></td>
                    
                    </tr>
                    @endforeach
                </tbody>
            </table>
<br>
<div class="form-group">
  <div class="col-sm-12">
    <button type="submit" class="btn btn-success">Submit</button>
  </div>
</div>
</form>

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
        




            <script>
              $(document).ready(function() {
                  $('#contacts').DataTable({
                      columnDefs: [
                          {
                              targets: 3, // Index of the "Mark contact" column
                              orderable: false,
                              searchable: false,
                              render: function(data, type, full, meta) {
                                  return '<input type="checkbox" name="dataField[]" value="' + full[1] + '">';
                              }
                          }
                      ]
                  });
              });
          </script>
          


            

    <!-- Include Bootstrap JS -->

    
    <script>
        function updateCharacterCount() {
            // Get the textarea element and the character count span element
            var textarea = document.getElementById("comment");
            var characterCount = document.getElementById("characterCount");

            // Get the current character count
            var currentCount = textarea.value.length;

            // Calculate the remaining characters
            var remainingCount = textarea.maxLength - currentCount;

            // Update the character count span
            characterCount.textContent = remainingCount;
        }
    </script>


</div>
