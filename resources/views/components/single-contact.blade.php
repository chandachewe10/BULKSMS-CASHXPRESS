<br>
<div class="content-wrapper">
  <h3 class="text-2xl font-semibold mb-4">Add Single Contact</h3>
<br>
<form action="{{ route('single_contact_store')}}" method="POST">
   
    @csrf
    <div class="form-group">
        <label for="First Name">First Name</label>
        <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}">
        @error('first_name')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
      </div>


      <div class="form-group">
        <label for="Last Name">Last Name</label>
        <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}">
        @error('last_name')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
      </div>


      <div class="form-group">
        <label for="Email">Email</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
        @error('email')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
      </div>


      <div class="form-group">
        <label for="Phone">Phone</label>
        <input type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}">
        @error('phone')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
      </div>




      <div class="form-group">
        <label for="Address">Address</label>
        <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}">
        @error('address')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
      </div>

      <div class="form-group">
        <label for="Company">Company</label>
        <input type="text" class="form-control @error('company') is-invalid @enderror" name="company" value="{{ old('company') }}">
        @error('company')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
      </div>


      <div class="form-group">
        <label for="Nationality">Nationality</label>
        <input type="text" class="form-control @error('nationality') is-invalid @enderror" name="nationality" value="{{ old('nationality') }}">
        @error('nationality')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
      </div>

      <div class="form-group">
        <label for="Tag">Tag</label>
        <input type="text" class="form-control @error('tag') is-invalid @enderror" name="tag" value="{{ old('tag') }}">
        @error('tag')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
      </div>

<input type="hidden" name="user_id" value="{{auth()->user()->id}}" required/>

<button type="" class="btn btn-primary">Submit</button>
</form>

</div>