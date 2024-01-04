<nav class="page-sidebar" id="sidebar">
            <div id="sidebar-collapse">
                <div class="admin-block d-flex">
                    <div>
                        @if(auth()->user()->profile_photo_path)
                        <img class="h-10 w-10 rounded-full object-cover" src=" {{asset('storage/'.Auth::user()->profile_photo_path) }}" alt="{{ Auth::user()->name }}" />
                        @else
                        <img src="{{asset('assets/img/admin-avatar.png')}}" width="45px" />
                        @endif
                    </div>
                    <div class="admin-info">
                        <div class="font-strong">{{auth()->user()->name}}</div><small>{{auth()->user()->email}}</small></div>
                </div>
                <ul class="side-menu metismenu">
                    <li>
                        <a class="active" href="{{route('dashboard')}}"><i class="sidebar-item-icon fa fa-th-large"></i>
                            <span class="nav-label">Dashboard</span>
                        </a>
                    </li>
                    <li class="heading">FEATURES</li>
                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-bookmark"></i>
                            <span class="nav-label">Profile</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a href="{{ route('profile.show') }}">View & Edit Profile</a>
                            </li>                        
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-address-book"></i>
                            <span class="nav-label">Contacts</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a href="{{ route('single_contact_view') }}">Add Single Contact</a>
                                <a href="{{ route('csv-contacts.create') }}">Add Bulk Contacts</a>
                                <a href="{{ route('csv-contacts.index') }}">View Added Contacts</a>
                            </li>                        
                        </ul>
                    </li>



                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-edit"></i>
                            <span class="nav-label">SMS</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a href="{{ route('message.create') }}">Send Single SMS</a>
                            </li>
                            <li>
                                <a href="{{ route('csv.create') }}">Send Bulk (CSV)</a>
                            </li>
                            <li>
                                <a href="{{ route('bulk-sms-sending.index') }}">Send to Contacts</a>
                            </li>

                           
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-table"></i>
                            <span class="nav-label">Logs</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a href="{{route('show_all_successfull_messages')}}">Successfull SMS's</a>
                            </li>
                            <li>
                                <a href="{{route('show_all_un_successfull_messages')}}">Unsuccessfull SMS's</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-bar-chart"></i>
                            <span class="nav-label">Usage</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a href="{{route('messages_usage.index')}}">Message Usage</a>
                            </li>
                           
                          
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-map"></i>
                            <span class="nav-label">Developers</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                            <a href="{{ route('api-tokens.index') }}">Access Token</a>
                                
                                
                            </li>
                        </ul>
                    </li>
                   
                    @can('update users')
                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-cog"></i>
                            <span class="nav-label">Settings</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                            <a href="{{ route('users.index') }}">users</a>
                                
                            </li>
                        </ul>
                    </li>
                    @endcan

                
                                      
                </ul>
            </div>
        </nav>