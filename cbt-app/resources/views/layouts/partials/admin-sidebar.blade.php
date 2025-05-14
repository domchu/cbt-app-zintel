 <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
     <div class="sb-sidenav-menu">
         <div class="nav">
             <div class="sb-sidenav-menu-heading">Core</div>
             <a class="nav-link" href="{{ url('admin/dashboard') }}">
                 <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                 Dashboard Admin
             </a>
             <a class="nav-link" href="{{ url('admin/academics') }}">
                 <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                 Academics
             </a>


             {{-- QUESTIONS --}}
             <div class="sb-sidenav-menu-heading">Examination</div>
             <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseQuestions"
                 aria-expanded="false" aria-controls="collapseQuestions">
                 <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                 Questions
                 <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
             </a>
             <div class="collapse" id="collapseQuestions" aria-labelledby="headingOne"
                 data-bs-parent="#sidenavAccordion">
                 <nav class="sb-sidenav-menu-nested nav">
                     <a class="nav-link" href="{{ url('admin/question/uploads') }}">Add Questions</a>
                     <a class="nav-link" href="{{ url('admin/question/import') }}">Import Questions</a>
                     <a class="nav-link" href="{{ url('admin/question') }}">View Questions</a>
                 </nav>
             </div>
             <div class="collapse" id="collapseQuestions" aria-labelledby="headingOne"
                 data-bs-parent="#sidenavAccordion">
                 <nav class="sb-sidenav-menu-nested nav">
                     <a class="nav-link" href="{{ url('admin/subject/create') }}">Add Subject</a>
                     <a class="nav-link" href="{{ url('admin/subject') }}">View Subjects</a>
                 </nav>
             </div>

             {{-- ACADEMICS --}}
             <div class="sb-sidenav-menu-heading">ACADEMICS</div>
             <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseStudents"
                 aria-expanded="false" aria-controls="collapseStudents">
                 <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                 Students Info
                 <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
             </a>
             <div class="collapse" id="collapseStudents" aria-labelledby="headingTwo"
                 data-bs-parent="#sidenavAccordion">
                 <nav class="sb-sidenav-menu-nested nav">
                     <a class="nav-link" href="{{ url('admin/student/create') }}">Add Students</a>
                     <a class="nav-link" href="{{ url('admin/student') }}">View Students</a>
                     <a class="nav-link" href="{{ url('admin/session/create') }}">Add Section</a>
                     {{-- <a class="nav-link" href="{{ url('admin/subject/create') }}">Subjects</a> --}}
                     {{-- <a class="nav-link" href="{{ url('admin/students') }}">Add Subjects</a>
                     <a class="nav-link" href="{{ url('admin/students') }}">Add Class</a>
                     <a class="nav-link" href="{{ url('admin/students') }}">Sections</a>
                     <a class="nav-link" href="{{ url('admin/students') }}">View Students</a>
                     <a class="nav-link" href="{{ url('admin/students') }}">View Students</a> --}}
                 </nav>
             </div>


             {{-- FRONTEND --}}
             <div class="sb-sidenav-menu-heading">Frontend</div>
             <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseFrontend"
                 aria-expanded="false" aria-controls="collapseFrontend">
                 <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                 Frontend
                 <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
             </a>
             <div class="collapse" id="collapseFrontend" aria-labelledby="headingThree"
                 data-bs-parent="#sidenavAccordion">
                 <nav class="sb-sidenav-menu-nested nav">
                     <a class="nav-link" href="{{ url('home-slider') }}">Slider</a>
                     {{-- <a class="nav-link" href="{{ url('admin/questions') }}">View Questions</a> --}}
                 </nav>
             </div>



             <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages"
                 aria-expanded="false" aria-controls="collapsePages">
                 <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                 General Settins
                 <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
             </a>
             <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                 data-bs-parent="#sidenavAccordion">
                 <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                     <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                         data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                         Authentication
                         <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                     </a>
                     <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne"
                         data-bs-parent="#sidenavAccordionPages">
                         <nav class="sb-sidenav-menu-nested nav">
                             <a class="nav-link" href="login.html">Login</a>
                             <a class="nav-link" href="register.html">Register</a>
                             <a class="nav-link" href="password.html">Forgot Password</a>
                         </nav>
                     </div>
                     <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                         data-bs-target="#pagesCollapseError" aria-expanded="false"
                         aria-controls="pagesCollapseError">
                         Error
                         <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                     </a>
                     <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne"
                         data-bs-parent="#sidenavAccordionPages">
                         <nav class="sb-sidenav-menu-nested nav">
                             <a class="nav-link" href="401.html">401 Page</a>
                             <a class="nav-link" href="404.html">404 Page</a>
                             <a class="nav-link" href="500.html">500 Page</a>
                         </nav>
                     </div>
                 </nav>
             </div>
             <div class="sb-sidenav-menu-heading">Addons</div>
             <a class="nav-link" href="charts.html">
                 <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                 Charts
             </a>
             <a class="nav-link" href="tables.html">
                 <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                 Tables
             </a>
         </div>
     </div>
     <div class="sb-sidenav-footer">
         <div class="small">Logged in as:</div>
         Administrator
     </div>
 </nav>
