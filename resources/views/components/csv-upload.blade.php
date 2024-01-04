<div class="content-wrapper">


<div class="shadow-sm p-3 mb-5 bg-white rounded">
<br>
<h3 class="text-2xl font-semibold">Send Message via CSV Upload</h3>
<form action="{{ route('csv.store') }}" method="POST" enctype= multipart/form-data>
    @csrf
    <div id="name-inputs">
        <div class="input-group mb-3">
            <input type="file" name="csv_file" class="form-control @error('csv_file') is-invalid @enderror" required><br>
            
            @error('csv_file')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
          
        </div>
    </div>
    <small class="text-warning">Format Phone number cells to decimal places. Message characters should not be more than 160.</small><br>
    <a href="{{asset('templates/Sample_Template.csv')}}" ><span class="text-success">Download Template</span></a><br>
    <button type="" class="btn btn-primary">Send Message(s)</button>
    
</form>

</div>




</div>