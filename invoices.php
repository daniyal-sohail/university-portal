<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Invoices | DevXcript Student Portal</title>
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
                href="invoices.html" class="nav-x active"><i
                    class="bi bi-file-earmark-text fs-5"></i><span>Invoices</span><i class="dot"></i></a><a
                href="attendance.html" class="nav-x"><i class="bi bi-check2-square fs-5"></i><span>Attendance</span><i
                    class="dot"></i></a></nav>
        <div class="side-foot">Developed By DevXcript</div>
    </aside>
    <div class="overlay" id="overlay"></div>
    <div class="main">
        <header class="topbar px-3 px-md-4 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-3"><button class="btn btn-sm d-xl-none" id="openSide"><i
                        class="bi bi-list fs-4"></i></button>
                <h2 class="h5 fw-bold mb-0">Invoices</h2>
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
                <h1 class="h3 fw-bold mb-3">Your Invoices</h1>
                <div class="box p-3 mb-3">
                    <div class="row g-3">
                        <div class="col-md">
                            <div class="position-relative"><i class="bi bi-search position-absolute text-secondary"
                                    style="left:12px;top:10px"></i><input id="q" class="form-control ps-5"
                                    placeholder="Search by term, semester, or challan ID..."></div>
                        </div>
                        <div class="col-md-auto"><select id="sel" class="form-select">
                                <option value="all">All Status</option>
                                <option value="paid">Paid</option>
                                <option value="unpaid">Unpaid</option>
                            </select></div>
                    </div>
                </div>
                <div class="box overflow-hidden">
                    <div class="table-responsive">
                        <table class="table tbl table-hover mb-0">
                            <thead class="thead-teal">
                                <tr>
                                    <th>Term</th>
                                    <th class="text-center">Semester</th>
                                    <th class="text-center">Challan ID</th>
                                    <th class="text-center">Scholarship</th>
                                    <th class="text-center">Fee</th>
                                    <th class="text-center">Fine</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr data-s="spring 2024 4th ch-001" data-c="unpaid">
                                    <td class="fw-medium">Spring 2024</td>
                                    <td class="text-center fw-semibold" style="color:var(--teal-600)">4th</td>
                                    <td class="text-center text-secondary">CH-001</td>
                                    <td class="text-center fw-medium text-success">50%</td>
                                    <td class="text-center fw-medium">50,000 PKR</td>
                                    <td class="text-center fw-medium text-danger">0 PKR</td>
                                    <td class="text-center"><span
                                            class="badge rounded-2 fs-6 fw-medium bg-danger">Unpaid</span></td>
                                </tr>
                                <tr data-s="fall 2023 3rd ch-002" data-c="paid">
                                    <td class="fw-medium">Fall 2023</td>
                                    <td class="text-center fw-semibold" style="color:var(--teal-600)">3rd</td>
                                    <td class="text-center text-secondary">CH-002</td>
                                    <td class="text-center fw-medium text-success">30%</td>
                                    <td class="text-center fw-medium">70,000 PKR</td>
                                    <td class="text-center fw-medium text-danger">500 PKR</td>
                                    <td class="text-center"><span
                                            class="badge rounded-2 fs-6 fw-medium bg-success">Paid</span></td>
                                </tr>
                                <tr data-s="spring 2023 2nd ch-003" data-c="paid">
                                    <td class="fw-medium">Spring 2023</td>
                                    <td class="text-center fw-semibold" style="color:var(--teal-600)">2nd</td>
                                    <td class="text-center text-secondary">CH-003</td>
                                    <td class="text-center fw-medium text-success">20%</td>
                                    <td class="text-center fw-medium">80,000 PKR</td>
                                    <td class="text-center fw-medium text-danger">1,000 PKR</td>
                                    <td class="text-center"><span
                                            class="badge rounded-2 fs-6 fw-medium bg-success">Paid</span></td>
                                </tr>
                                <tr data-s="fall 2022 1st ch-004" data-c="paid">
                                    <td class="fw-medium">Fall 2022</td>
                                    <td class="text-center fw-semibold" style="color:var(--teal-600)">1st</td>
                                    <td class="text-center text-secondary">CH-004</td>
                                    <td class="text-center fw-medium text-success">10%</td>
                                    <td class="text-center fw-medium">90,000 PKR</td>
                                    <td class="text-center fw-medium text-danger">0 PKR</td>
                                    <td class="text-center"><span
                                            class="badge rounded-2 fs-6 fw-medium bg-success">Paid</span></td>
                                </tr>
                                <tr data-s="spring 2022 foundation ch-005" data-c="paid">
                                    <td class="fw-medium">Spring 2022</td>
                                    <td class="text-center fw-semibold" style="color:var(--teal-600)">Foundation</td>
                                    <td class="text-center text-secondary">CH-005</td>
                                    <td class="text-center fw-medium text-success">0%</td>
                                    <td class="text-center fw-medium">100,000 PKR</td>
                                    <td class="text-center fw-medium text-danger">2,000 PKR</td>
                                    <td class="text-center"><span
                                            class="badge rounded-2 fs-6 fw-medium bg-success">Paid</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div id="empty" class="d-none text-center py-5">
                        <div class="text-secondary">No invoices found</div>
                        <div class="small-x">Try adjusting your search or filter criteria</div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>