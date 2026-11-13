<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Attendance | DevXcript Student Portal</title>
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
        <nav class="p-3 d-grid gap-1"><a href="dashboard.html" class="nav-x"><i
                    class="bi bi-grid fs-5"></i><span>Dashboard</span><i class="dot"></i></a><a href="courses.html"
                class="nav-x"><i class="bi bi-book fs-5"></i><span>Courses</span><i class="dot"></i></a><a
                href="results.html" class="nav-x"><i class="bi bi-clipboard-check fs-5"></i><span>Results</span><i
                    class="dot"></i></a><a href="datesheet.html" class="nav-x"><i
                    class="bi bi-calendar3 fs-5"></i><span>Date Sheet</span><i class="dot"></i></a><a
                href="invoices.html" class="nav-x"><i class="bi bi-file-earmark-text fs-5"></i><span>Invoices</span><i
                    class="dot"></i></a><a href="attendance.html" class="nav-x active"><i
                    class="bi bi-check2-square fs-5"></i><span>Attendance</span><i class="dot"></i></a></nav>
        <div class="side-foot">Developed By DevXcript</div>
    </aside>
    <div class="overlay" id="overlay"></div>
    <div class="main">
        <header class="topbar px-3 px-md-4 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-3"><button class="btn btn-sm d-xl-none" id="openSide"><i
                        class="bi bi-list fs-4"></i></button>
                <h2 class="h5 fw-bold mb-0">Attendance</h2>
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
                <h1 class="h2 fw-bold mb-1">Attendance Overview</h1>
                <p class="text-secondary mb-4">Your attendance record across all courses</p>
                <div class="row g-4">
                    <div class="col-md-6 col-lg-4">
                        <div class="ds-card p-4">
                            <div class="d-flex justify-content-between align-items-start gap-2 mb-3">
                                <h3 class="fs-5 fw-bold mb-0">Web Development</h3><span
                                    class="pill pill-green border-0 fw-bold">85.7%</span>
                            </div>
                            <div class="row text-center mb-3">
                                <div class="col">
                                    <div class="fs-5 fw-bold">42</div>
                                    <div class="small-x">Total</div>
                                </div>
                                <div class="col">
                                    <div class="fs-5 fw-bold text-success">36</div>
                                    <div class="small-x">Present</div>
                                </div>
                                <div class="col">
                                    <div class="fs-5 fw-bold text-danger">6</div>
                                    <div class="small-x">Absent</div>
                                </div>
                            </div>
                            <div class="progress" style="height:8px">
                                <div class="progress-bar bg-success" style="width:85.7%"></div>
                            </div>
                            <div class="text-center mt-3 small fw-medium text-success">&#10003; Good Standing</div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="ds-card p-4">
                            <div class="d-flex justify-content-between align-items-start gap-2 mb-3">
                                <h3 class="fs-5 fw-bold mb-0">Object Oriented Programming</h3><span
                                    class="pill pill-green border-0 fw-bold">84.2%</span>
                            </div>
                            <div class="row text-center mb-3">
                                <div class="col">
                                    <div class="fs-5 fw-bold">38</div>
                                    <div class="small-x">Total</div>
                                </div>
                                <div class="col">
                                    <div class="fs-5 fw-bold text-success">32</div>
                                    <div class="small-x">Present</div>
                                </div>
                                <div class="col">
                                    <div class="fs-5 fw-bold text-danger">6</div>
                                    <div class="small-x">Absent</div>
                                </div>
                            </div>
                            <div class="progress" style="height:8px">
                                <div class="progress-bar bg-success" style="width:84.2%"></div>
                            </div>
                            <div class="text-center mt-3 small fw-medium text-success">&#10003; Good Standing</div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="ds-card p-4">
                            <div class="d-flex justify-content-between align-items-start gap-2 mb-3">
                                <h3 class="fs-5 fw-bold mb-0">Data Structures</h3><span
                                    class="pill pill-green border-0 fw-bold">91.1%</span>
                            </div>
                            <div class="row text-center mb-3">
                                <div class="col">
                                    <div class="fs-5 fw-bold">45</div>
                                    <div class="small-x">Total</div>
                                </div>
                                <div class="col">
                                    <div class="fs-5 fw-bold text-success">41</div>
                                    <div class="small-x">Present</div>
                                </div>
                                <div class="col">
                                    <div class="fs-5 fw-bold text-danger">4</div>
                                    <div class="small-x">Absent</div>
                                </div>
                            </div>
                            <div class="progress" style="height:8px">
                                <div class="progress-bar bg-success" style="width:91.1%"></div>
                            </div>
                            <div class="text-center mt-3 small fw-medium text-success">&#10003; Good Standing</div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="ds-card p-4">
                            <div class="d-flex justify-content-between align-items-start gap-2 mb-3">
                                <h3 class="fs-5 fw-bold mb-0">Database Systems</h3><span
                                    class="pill pill-green border-0 fw-bold">87.5%</span>
                            </div>
                            <div class="row text-center mb-3">
                                <div class="col">
                                    <div class="fs-5 fw-bold">40</div>
                                    <div class="small-x">Total</div>
                                </div>
                                <div class="col">
                                    <div class="fs-5 fw-bold text-success">35</div>
                                    <div class="small-x">Present</div>
                                </div>
                                <div class="col">
                                    <div class="fs-5 fw-bold text-danger">5</div>
                                    <div class="small-x">Absent</div>
                                </div>
                            </div>
                            <div class="progress" style="height:8px">
                                <div class="progress-bar bg-success" style="width:87.5%"></div>
                            </div>
                            <div class="text-center mt-3 small fw-medium text-success">&#10003; Good Standing</div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="ds-card p-4">
                            <div class="d-flex justify-content-between align-items-start gap-2 mb-3">
                                <h3 class="fs-5 fw-bold mb-0">Computer Networks</h3><span
                                    class="pill pill-yellow border-0 fw-bold">80.0%</span>
                            </div>
                            <div class="row text-center mb-3">
                                <div class="col">
                                    <div class="fs-5 fw-bold">35</div>
                                    <div class="small-x">Total</div>
                                </div>
                                <div class="col">
                                    <div class="fs-5 fw-bold text-success">28</div>
                                    <div class="small-x">Present</div>
                                </div>
                                <div class="col">
                                    <div class="fs-5 fw-bold text-danger">7</div>
                                    <div class="small-x">Absent</div>
                                </div>
                            </div>
                            <div class="progress" style="height:8px">
                                <div class="progress-bar bg-warning" style="width:80.0%"></div>
                            </div>
                            <div class="text-center mt-3 small fw-medium text-warning">&#9888; Below Average</div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="ds-card p-4">
                            <div class="d-flex justify-content-between align-items-start gap-2 mb-3">
                                <h3 class="fs-5 fw-bold mb-0">Software Engineering</h3><span
                                    class="pill pill-red border-0 fw-bold">62.5%</span>
                            </div>
                            <div class="row text-center mb-3">
                                <div class="col">
                                    <div class="fs-5 fw-bold">48</div>
                                    <div class="small-x">Total</div>
                                </div>
                                <div class="col">
                                    <div class="fs-5 fw-bold text-success">30</div>
                                    <div class="small-x">Present</div>
                                </div>
                                <div class="col">
                                    <div class="fs-5 fw-bold text-danger">18</div>
                                    <div class="small-x">Absent</div>
                                </div>
                            </div>
                            <div class="progress" style="height:8px">
                                <div class="progress-bar bg-danger" style="width:62.5%"></div>
                            </div>
                            <div class="text-center mt-3 small fw-medium text-danger">&#10007; Poor Attendance</div>
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