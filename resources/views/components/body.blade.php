<div class="content-wrapper">
<div class="page-content fade-in-up">
<h3><strong>SENDER-ID: {{auth()->user()->senderId}}</strong></h3>
@if (Auth::user()->hasRole('admin'))
<div class="row">
      <div class="col-12 mt-3 mb-1">
        <h5 class="text-uppercase text-xl font-bold">Account Name: {{ $accountName }}</h5> 
        <br>
      <h5 class="text-uppercase text-xl font-bold">SMS's Balance: {{ $smsBalance }}</h5>        
      </div>
</div>
@endif



<div class="row">

<div class="col-lg-4 col-md-6">
    <a href="{{ route('message.create') }}"> 
        <div class="ibox bg-success color-white widget-stat">
            <div class="ibox-body">
                <h2 class="m-b-5 font-strong">Compose</h2>
                <div class="m-b-5">SEND SMS</div><i class="fa fa-comment widget-stat-icon"></i>
                <div><i class="fa fa-edit m-r-5"></i><small>Instantly</small></div>
            </div>
        </div>
    </a>
</div>

                   
                    <div class="col-lg-4 col-md-6">
                        <div class="ibox bg-primary color-white widget-stat">
                            <div class="ibox-body">
                                <h2 class="m-b-5 font-strong">{{auth()->user()->wallet->balance}}</h2>
                                <div class="m-b-5">SMS BALANCE</div><i class="fa fa-money widget-stat-icon"></i>
                                <div><i class="fa fa-level-up m-r-5"></i><small>Consumed sms</small></div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-4 col-md-6">
                        <div class="ibox bg-info color-white widget-stat">
                            <div class="ibox-body">
                                <h2 class="m-b-5 font-strong">ZMW</h2>
                                <div class="m-b-5">MAKE PAYMENTS</div><i class="fa fa-credit-card widget-stat-icon"></i>
                                <div><i class="fa fa-level-down m-r-5"></i><small>Buy SMS</small></div>
                            </div>
                        </div>
                    </div>
                </div>




               

                <div class="row">
      <div class="col-12 mt-3 mb-1">
      <h4 class="text-uppercase text-xl font-bold">SMS's Logs</h4>

        
      </div>
    </div>



                <div class="row">

<div class="col-lg-4 col-md-6">

    <a href="{{route('show_all_successfull_messages')}}"> 
        <div class="ibox bg-success color-white widget-stat">
            <div class="ibox-body">
                <h2 class="m-b-5 font-strong">Success</h2>
                <div class="m-b-5">SUCCESSFULL SMS</div><i class="fa fa-check-circle widget-stat-icon"></i>
                <div><i class="fa fa-edit m-r-5"></i><small>check Instantly</small></div>
            </div>
        </div>
    </a>
</div>

                   
                    <div class="col-lg-4 col-md-6">
                         <a href="{{route('show_all_un_successfull_messages')}}"> 
                        <div class="ibox bg-primary color-white widget-stat">
                            <div class="ibox-body">
                                <h2 class="m-b-5 font-strong">FAILED</h2>
                                <div class="m-b-5">UNSUCCESSFULL SMS</div><i class="fa fa-warning widget-stat-icon"></i>
                                <div><i class="fa fa-level-up m-r-5"></i><small>check instantly</small></div>
                            </div>
                        </div>
</a>
                    </div>

                    
                    <div class="col-lg-4 col-md-6">
                       <a href="{{route('messages_usage.index')}}">   
                        <div class="ibox bg-info color-white widget-stat">
                            <div class="ibox-body">
                                <h2 class="m-b-5 font-strong">USAGE</h2>
                                <div class="m-b-5">SMS USAGE</div><i class="fa fa-balance-scale widget-stat-icon"></i>
                                <div><i class="fa fa-level-down m-r-5"></i><small>Check Usage</small></div>
                            </div>
                        </div>
</a>
                    </div>
                </div>



            


                               

                        
                

 <!-- BEGIN PAGA BACKDROPS-->
 <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>          

                


 <!-- END PAGE CONTENT-->
 <footer class="page-footer">
                <div class="font-13">{{date('Y')}} © <b>ELIANA-CONNECT</b> - All rights reserved.</div>
                <a class="px-4" href="" target="_blank">BULK-SMS</a>
                <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
            </footer>




     
</div>
</div>



