 <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
     <div class="sb-sidenav-menu">
         <div class="nav">
             <div class="sb-sidenav-menu-heading text-white">Core Menu</div>
             <a class="nav-link" href="{{ url('admin/super-dashboard') }}">
                 <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                 Super Admin Dashboard 
             </a>
             <a class="nav-link" href="{{ url('admin/academics') }}">
                 <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                 Academics
             </a>


             {{-- QUESTIONS --}}
             <div class="sb-sidenav-menu-heading text-white">Examination</div>
             <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseQuestions"
                 aria-expanded="false" aria-controls="collapseQuestions">
                 <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                 Questions
                 <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
             </a>
             <div class="collapse" id="collapseQuestions" aria-labelledby="headingOne"
                 data-bs-parent="#sidenavAccordion">
                 <nav class="sb-sidenav-menu-nested nav">
                     <a class="nav-link" href="{{ url('admin/questions/upload') }}">Add Questions</a>
                     <a class="nav-link" href="{{ url('admin/questions/import') }}">Import Questions</a>
                     <a class="nav-link" href="{{ url('admin/questions') }}">preview Questions</a>
                     <a class="nav-link" href="{{ url('admin/history') }}">Exam History<
                     
                 </nav>
             </div>

             {{-- ACADEMICS --}}
             <div class="sb-sidenav-menu-heading">ACADEMICS</div>
             <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseStudents"
                 aria-expanded="false" aria-controls="collapseStudents">
                 <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                 Students
                 <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
             </a>
             <div class="collapse" id="collapseStudents" aria-labelledby="headingTwo"
                 data-bs-parent="#sidenavAccordion">
                 <nav class="sb-sidenav-menu-nested nav">
                     <a class="nav-link" href="{{ url('admin/students/create') }}">Add Students</a>
                     <a class="nav-link" href="{{ url('admin/students') }}">View Students</a>
                      <a class="nav-link" href="{{ url('admin/subjects/create') }}">Add Subjects</a>
                     <a class="nav-link" href="{{ url('admin/subjects') }}">View Subjects</a>
                 </nav>
             </div>






             <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages"
                 aria-expanded="false" aria-controls="collapsePages">
                 <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                 Pages
                 <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
             </a>
             <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
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
                         data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
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
         Super  Administrator
     </div>
 </nav>
