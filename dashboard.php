<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Dashboard | DevXcript Student Portal</title>
    <link rel="icon" href="img/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Onest:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <aside class="sidebar" id="sidebar">
        <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
                <div class="logo-box">DX</div>
                <div>
                    <div class="fw-bold fs-5 lh-1">DevXcript</div><small class="text-muted">Student Portal</small>
                </div>
            </div><button class="btn btn-sm d-xl-none" id="closeSide"><i class="bi bi-x-lg"></i></button>
        </div>
        <nav class="p-3 d-grid gap-1"><a href="dashboard.html" class="nav-x active"><i
                    class="bi bi-grid fs-5"></i><span>Dashboard</span><i class="dot"></i></a><a href="courses.html"
                class="nav-x"><i class="bi bi-book fs-5"></i><span>Courses</span><i class="dot"></i></a><a
                href="results.html" class="nav-x"><i class="bi bi-clipboard-check fs-5"></i><span>Results</span><i
                    class="dot"></i></a><a href="datesheet.html" class="nav-x"><i
                    class="bi bi-calendar3 fs-5"></i><span>Date Sheet</span><i class="dot"></i></a><a
                href="invoices.html" class="nav-x"><i class="bi bi-file-earmark-text fs-5"></i><span>Invoices</span><i
                    class="dot"></i></a><a href="attendance.html" class="nav-x"><i
                    class="bi bi-check2-square fs-5"></i><span>Attendance</span><i class="dot"></i></a></nav>
        <div class="side-foot">Developed By DevXcript</div>
    </aside>
    <div class="overlay" id="overlay"></div>
    <div class="main">
        <header class="topbar px-3 px-md-4 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-3"><button class="btn btn-sm d-xl-none" id="openSide"><i
                        class="bi bi-list fs-4"></i></button>
                <h2 class="h5 fw-bold mb-0">Dashboard</h2>
            </div>
            <div class="d-flex align-items-center gap-2">
                <div class="dropdown"><button class="btn position-relative" data-bs-toggle="dropdown"><i
                            class="bi bi-bell"></i><span class="bell-dot"></span></button>
                    <div class="dropdown-menu dropdown-menu-end p-3" style="width:260px">
                        <div class="d-flex justify-content-between mb-2"><b class="small">Notifications</b><span
                                class="badge bg-light text-secondary">2</span></div>
                        <div class="p-2 rounded border mb-2"
                            style="background:var(--teal-50);border-color:var(--teal-100)!important">
                            <div class="small">Register for next semester</div>
                            <div class="small-x">2 min ago</div>
                        </div>
                        <div class="p-2 rounded bg-light">
                            <div class="small">Fee challan available</div>
                            <div class="small-x">1 hour ago</div>
                        </div>
                    </div>
                </div>
                <div class="dropdown">
                    <div class="d-flex align-items-center gap-2 px-2 py-1" role="button" data-bs-toggle="dropdown">
                        <div class="avatar">BA</div>
                        <div class="d-none d-sm-block lh-sm">
                            <div class="small fw-medium">Babar Azam</div>
                            <div class="small-x text-truncate" style="max-width:120px">babar@devxcript.com</div>
                        </div>
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item text-danger small" href="signin.html"><i
                                    class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
        </header>
        <main class="p-3 p-sm-4 p-lg-4">
            <div class="page-wrap">
                <div class="box p-4 mb-3">
                    <div class="row g-4 align-items-center">
                        <div class="col-lg-6 d-flex gap-3">
                            <div class="grad-sq"><i class="bi bi-person"></i></div>
                            <div>
                                <h1 class="h4 fw-bold mb-1">BABAR AZAM</h1>
                                <div class="small text-secondary mb-2">L1PCBCS56</div>
                                <div class="small mb-3">Faculty of Information Technology and Computer Science</div>
                                <span class="pill pill-teal"><i class="bi bi-mortarboard"></i> BS Computer
                                    Science</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row g-3">
                                <div class="col-6 col-md-3">
                                    <div class="tile"><small>CGPA</small><b>3.23</b></div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="tile"><small>Earned Credits</small><b
                                            style="color:var(--teal-600)">69</b></div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="tile"><small>Total Credits</small><b>133</b></div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="tile"><small>In Progress</small><b style="color:#ea580c">10</b></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-lg-6">
                        <div class="box p-4 h-100">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="icon-sq"><i class="bi bi-book"></i></div>
                                <div>
                                    <h3 class="fs-5 fw-semibold mb-0">Credit Hours</h3>
                                    <div class="small-x">Academic Progress</div>
                                </div>
                            </div>
                            <div class="text-center my-3"><svg width="200" height="200" viewBox="0 0 200 200">
                                    <circle cx="100" cy="100" r="75" fill="none" stroke="#f3f4f6" stroke-width="20" />
                                    <circle cx="100" cy="100" r="75" fill="none" stroke="#14b8a6" stroke-width="20"
                                        stroke-dasharray="244.5 471.2" transform="rotate(-90 100 100)" />
                                    <text x="100" y="92" text-anchor="middle" font-size="32" font-weight="700"
                                        fill="#1f2937">52%</text><text x="100" y="112" text-anchor="middle"
                                        font-size="14" font-weight="500" fill="#4b5563">69 | 133</text><text x="100"
                                        y="130" text-anchor="middle" font-size="12" fill="#6b7280">Credits</text>
                                </svg></div>
                            <div class="d-flex justify-content-between mb-2"><span
                                    class="d-flex align-items-center gap-2 small text-secondary"><i class="dot-s"
                                        style="background:var(--teal)"></i>Completed</span><b class="small">69 hrs</b>
                            </div>
                            <div class="d-flex justify-content-between"><span
                                    class="d-flex align-items-center gap-2 small text-secondary"><i class="dot-s"
                                        style="background:#d1d5db"></i>Remaining</span><b class="small">64 hrs</b></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="box p-4 h-100">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="icon-sq"><i class="bi bi-graph-up-arrow"></i></div>
                                <div>
                                    <h3 class="fs-5 fw-semibold mb-0">GPA</h3>
                                    <div class="small-x">Academic Performance</div>
                                </div>
                            </div>
                            <div class="text-center my-3"><svg width="200" height="200" viewBox="0 0 200 200">
                                    <circle cx="100" cy="100" r="75" fill="none" stroke="#f3f4f6" stroke-width="20" />
                                    <circle cx="100" cy="100" r="75" fill="none" stroke="#14b8a6" stroke-width="20"
                                        stroke-dasharray="397.0 471.2" transform="rotate(-90 100 100)" />
                                    <text x="100" y="92" text-anchor="middle" font-size="32" font-weight="700"
                                        fill="#1f2937">84%</text><text x="100" y="112" text-anchor="middle"
                                        font-size="14" font-weight="500" fill="#4b5563">3.37 | 4</text><text x="100"
                                        y="130" text-anchor="middle" font-size="12" fill="#6b7280">GPA</text>
                                </svg></div>
                            <div class="d-flex justify-content-between mb-2"><span
                                    class="d-flex align-items-center gap-2 small text-secondary"><i class="dot-s"
                                        style="background:var(--teal)"></i>Current GPA</span><b class="small">3.37</b>
                            </div>
                            <div class="d-flex justify-content-between"><span
                                    class="d-flex align-items-center gap-2 small text-secondary"><i class="dot-s"
                                        style="background:#d1d5db"></i>Letter Grade</span><span
                                    class="pill pill-blue rounded-2">B+</span></div>
                        </div>
                    </div>
                </div>
                <div class="box p-4 mb-3">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="icon-sq"><i class="bi bi-calendar-event"></i></div>
                        <div>
                            <h3 class="fs-5 fw-semibold mb-0">Today's Classes</h3>
                            <div class="small-x"><span id="today"></span></div>
                        </div>
                    </div>
                    <div class="cls mb-3">
                        <div class="d-flex justify-content-between mb-3">
                            <div class="d-flex gap-3">
                                <div class="icon-sq" style="background:var(--teal-50)"><i class="bi bi-book"></i></div>
                                <div>
                                    <div class="small fw-semibold">Web Application Development</div>
                                    <div class="small-x">CSSE3143</div>
                                </div>
                            </div><span class="pill pill-blue h-100">Lab</span>
                        </div>
                        <div class="d-grid gap-2 small-x" style="color:#4b5563">
                            <div><i class="bi bi-people me-2"></i>Asad Kamal</div>
                            <div><i class="bi bi-clock me-2"></i>09:00 AM - 10:30 AM</div>
                            <div><i class="bi bi-geo-alt me-2"></i>Lab 1</div>
                        </div>
                    </div>
                    <div class="cls mb-3">
                        <div class="d-flex justify-content-between mb-3">
                            <div class="d-flex gap-3">
                                <div class="icon-sq" style="background:var(--teal-50)"><i class="bi bi-people"></i>
                                </div>
                                <div>
                                    <div class="small fw-semibold">Operating Systems</div>
                                    <div class="small-x">CSCS3553</div>
                                </div>
                            </div><span class="pill pill-blue h-100">Lecture</span>
                        </div>
                        <div class="d-grid gap-2 small-x" style="color:#4b5563">
                            <div><i class="bi bi-people me-2"></i>Dr Adnan Ghafoor</div>
                            <div><i class="bi bi-clock me-2"></i>11:00 AM - 12:30 PM</div>
                            <div><i class="bi bi-geo-alt me-2"></i>Room 301</div>
                        </div>
                    </div>
                    <div class="cls mb-3">
                        <div class="d-flex justify-content-between mb-3">
                            <div class="d-flex gap-3">
                                <div class="icon-sq" style="background:var(--teal-50)"><i class="bi bi-people"></i>
                                </div>
                                <div>
                                    <div class="small fw-semibold">Software Engineering</div>
                                    <div class="small-x">CSSE3113</div>
                                </div>
                            </div><span class="pill pill-blue h-100">Lecture</span>
                        </div>
                        <div class="d-grid gap-2 small-x" style="color:#4b5563">
                            <div><i class="bi bi-people me-2"></i>Muhammad Basit</div>
                            <div><i class="bi bi-clock me-2"></i>02:00 PM - 03:30 PM</div>
                            <div><i class="bi bi-geo-alt me-2"></i>Room 205</div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between border-top pt-3 small-x"><span>3 classes
                            scheduled</span><a href="courses.html" class="link-teal">View Full Schedule</a></div>
                </div>
                <div class="box p-4">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="icon-sq"><i class="bi bi-book"></i></div>
                        <div>
                            <h3 class="fs-5 fw-semibold mb-0">Current Courses</h3>
                            <div class="small-x">Spring 2025 &bull; 4 Enrolled Courses</div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6 col-lg-4" data-status="active">
                            <div class="c-card">
                                <div class="c-head">
                                    <h4 class="fs-6 fw-semibold mb-2" style="min-height:2rem">Web Application
                                        Development</h4>
                                    <div class="d-flex justify-content-between align-items-center"><span class="small-x"
                                            style="color:inherit">CSSE3143</span><span
                                            class="pill pill-green">Active</span></div>
                                </div>
                                <div class="p-3 d-grid gap-3">
                                    <div class="d-flex gap-2 small"><i class="bi bi-person text-secondary"></i>Asad
                                        Kamal</div>
                                    <div class="d-flex gap-2 small"><i
                                            class="bi bi-credit-card text-secondary"></i><span
                                            class="text-secondary">Credits:</span><b
                                            style="color:var(--teal-600)">3.0</b></div>
                                    <div class="d-flex gap-2 small"><i class="bi bi-bar-chart text-secondary"></i><span
                                            class="text-secondary">Grade:</span><a class="link-teal"
                                            href="course-detail.html?id=web-application">view progress</a></div>
                                    <div class="d-flex gap-2 small align-items-center"><i
                                            class="bi bi-calendar-event text-secondary"></i><span
                                            class="text-secondary">Attendance:</span><span
                                            class="pill pill-green">86.0%</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4" data-status="active">
                            <div class="c-card">
                                <div class="c-head">
                                    <h4 class="fs-6 fw-semibold mb-2" style="min-height:2rem">Operating Systems - Lab
                                    </h4>
                                    <div class="d-flex justify-content-between align-items-center"><span class="small-x"
                                            style="color:inherit">CSCS3551</span><span
                                            class="pill pill-green">Active</span></div>
                                </div>
                                <div class="p-3 d-grid gap-3">
                                    <div class="d-flex gap-2 small"><i class="bi bi-person text-secondary"></i>Qaisar
                                        Aslam</div>
                                    <div class="d-flex gap-2 small"><i
                                            class="bi bi-credit-card text-secondary"></i><span
                                            class="text-secondary">Credits:</span><b
                                            style="color:var(--teal-600)">1.0</b></div>
                                    <div class="d-flex gap-2 small"><i class="bi bi-bar-chart text-secondary"></i><span
                                            class="text-secondary">Grade:</span><a class="link-teal"
                                            href="course-detail.html?id=operating-system-lab">view progress</a></div>
                                    <div class="d-flex gap-2 small align-items-center"><i
                                            class="bi bi-calendar-event text-secondary"></i><span
                                            class="text-secondary">Attendance:</span><span
                                            class="pill pill-green">90.0%</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4" data-status="active">
                            <div class="c-card">
                                <div class="c-head">
                                    <h4 class="fs-6 fw-semibold mb-2" style="min-height:2rem">Introduction to Software
                                        Engineering</h4>
                                    <div class="d-flex justify-content-between align-items-center"><span class="small-x"
                                            style="color:inherit">CSSE3113</span><span
                                            class="pill pill-green">Active</span></div>
                                </div>
                                <div class="p-3 d-grid gap-3">
                                    <div class="d-flex gap-2 small"><i class="bi bi-person text-secondary"></i>Muhammad
                                        Basit Ali Gillani</div>
                                    <div class="d-flex gap-2 small"><i
                                            class="bi bi-credit-card text-secondary"></i><span
                                            class="text-secondary">Credits:</span><b
                                            style="color:var(--teal-600)">3.0</b></div>
                                    <div class="d-flex gap-2 small"><i class="bi bi-bar-chart text-secondary"></i><span
                                            class="text-secondary">Grade:</span><a class="link-teal"
                                            href="course-detail.html?id=software-engineering">view progress</a></div>
                                    <div class="d-flex gap-2 small align-items-center"><i
                                            class="bi bi-calendar-event text-secondary"></i><span
                                            class="text-secondary">Attendance:</span><span
                                            class="pill pill-yellow">79.0%</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4" data-status="active">
                            <div class="c-card">
                                <div class="c-head">
                                    <h4 class="fs-6 fw-semibold mb-2" style="min-height:2rem">Operating Systems</h4>
                                    <div class="d-flex justify-content-between align-items-center"><span class="small-x"
                                            style="color:inherit">CSCS3553</span><span
                                            class="pill pill-green">Active</span></div>
                                </div>
                                <div class="p-3 d-grid gap-3">
                                    <div class="d-flex gap-2 small"><i class="bi bi-person text-secondary"></i>Dr Adnan
                                        Ghafoor</div>
                                    <div class="d-flex gap-2 small"><i
                                            class="bi bi-credit-card text-secondary"></i><span
                                            class="text-secondary">Credits:</span><b
                                            style="color:var(--teal-600)">3.0</b></div>
                                    <div class="d-flex gap-2 small"><i class="bi bi-bar-chart text-secondary"></i><span
                                            class="text-secondary">Grade:</span><a class="link-teal"
                                            href="course-detail.html?id=operating-system">view progress</a></div>
                                    <div class="d-flex gap-2 small align-items-center"><i
                                            class="bi bi-calendar-event text-secondary"></i><span
                                            class="text-secondary">Attendance:</span><span
                                            class="pill pill-yellow">81.0%</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>