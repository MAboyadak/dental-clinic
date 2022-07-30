<aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="/" class="brand-link" style="background-color: #c6d2fd70">
          <img src="/img/logo.png"
               alt="Logo"
               class="brand-image img-circle elevation-3"
               style="opacity: .8">
          <span class="brand-text font-weight-light">Dental Clinic</span>
        </a>
    
        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img src="/img/doctor.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
          </div>
    
          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->
              
              <li class="nav-item">
                <a href="/" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Home
                  </p>
                </a>
              </li>
    
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-edit"></i>
                  <p>
                    {{__('المرضي')}}
                    <i class="fa fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('patients.index')}}" class="nav-link">
                      <i class="fa fa-circle-o nav-icon"></i>
                      <p>{{__('جميع المرضي')}}</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('patient.create')}}" class="nav-link">
                      <i class="fa fa-circle-o nav-icon"></i>
                      <p>+ {{__('مريض جديد')}}</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item has-treeview">
                <a href="" class="nav-link">
                  <i class="nav-icon fa fa-table"></i>
                  <p>
                    {{__('المواعيد')}}
                    <i class="fa fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('appointments.index')}}" class="nav-link">
                      <i class="fa fa-circle-o nav-icon"></i>
                      <p>{{__('جميع المواعيد')}}</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('appointments.create')}}" class="nav-link">
                      <i class="fa fa-circle-o nav-icon"></i>
                      <p>+ {{__(' موعد جديد')}}</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-table"></i>
                  <p>
                    {{__('الروشتات')}}
                    <i class="fa fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('prescriptions.index')}}" class="nav-link">
                      <i class="fa fa-circle-o nav-icon"></i>
                      <p>{{__('جميع الروشتات')}}</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('prescription.new')}}" class="nav-link">
                      <i class="fa fa-circle-o nav-icon"></i>
                      <p>{{__('+ روشته جديده')}}</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="{{route('medicalinfo.index')}}" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    {{__('المعلومات الطبيه')}}
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('files.index')}}" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    {{__('صور الاشاعات')}}
                  </p>
                </a>
              </li>
              <li class="nav-item">                
                <a href="{{route('teeth.index')}}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>{{__('الاسنان')}}</p>
                </a>
              </li>
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-table"></i>
                  <p>
                    {{__('المستخدمين')}}
                    <i class="fa fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('users')}}" class="nav-link">
                      <i class="fa fa-circle-o nav-icon"></i>
                      <p>{{__('جميع المستخدمين')}}</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('user.create')}}" class="nav-link">
                      <i class="fa fa-circle-o nav-icon"></i>
                      <p>{{__('+ اضافه مستخدم')}}</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">                
                <a href="{{route('payment.add')}}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>{{__('اضافة مدفوعات للمريض')}}</p>
                </a>
              </li>
              
              
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>