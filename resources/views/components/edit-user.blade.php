<div class="content-wrapper">
<div class="page-content fade-in-up">

<h3>UPDATE RECORDS</h3>
<br>

<form action="{{route('users.update',$user->id)}}" method="post">
@csrf
@method('PUT')
<div class="form-group">
    <label for="Username">Username</label> <span class="text-danger">*</span>
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$user->name}}">
    @error('name')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div>

  <div class="form-group">
    <label for="SenderID">Sender-ID</label> <span class="text-danger">*</span>
    <input type="text" name="senderId" class="form-control @error('senderId') is-invalid @enderror" value="{{$user->senderId}}">
    @error('senderId')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div>

  <div class="form-group">
    <label for="Email">Email</label> <span class="text-danger">*</span>
    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{$user->email}}">
    @error('email')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div>
  <div class="form-group">
    <label for="Units">Add SMS Units</label> <span class="text-danger">*</span>
    <input type="number" name="units" class="form-control @error('units') is-invalid @enderror" value="0">
    <small>SMS Units Balance: {{$user->wallet->balance}}</small>
    @error('units')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div>

  <button class="btn btn-success">Update</button>
</form>



<!-- BEGIN PAGA BACKDROPS-->
<div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>          

                


 <!-- END PAGE CONTENT-->
 <footer class="page-footer">
                <div class="font-13">{{date('Y')}} © <b>MACRO-IT</b> - All rights reserved.</div>
                <a class="px-4" href="https://macro-it.net" target="_blank">BULK-SMS</a>
                <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
            </footer>



</div>
</div>
