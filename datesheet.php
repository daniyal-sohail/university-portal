<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Date Sheet | DevXcript Student Portal</title>
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
                    class="dot"></i></a><a href="datesheet.html" class="nav-x active"><i
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
                <h2 class="h5 fw-bold mb-0">Date Sheet</h2>
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
                <h1 class="h2 fw-bold mb-1">DateSheet</h1>
                <p class="text-secondary mb-4">Datesheet for upcoming Spring 2025 exams</p>
                <div class="row g-4">
                    <div class="col-md-6 col-lg-4">
                        <div class="ds-card p-4">
                            <div class="d-flex justify-content-between align-items-center mb-3"><span
                                    class="pill pill-teal border-0 fs-6">OOP</span><span class="fs-2 fw-bold"
                                    style="color:#d1d5db">#1</span></div>
                            <div class="d-flex align-items-center mb-3"><i class="bi bi-person fs-5 me-3"
                                    style="color:#0d9488"></i>
                                <div>
                                    <div class="small text-secondary">Instructor</div>
                                    <div class="fw-semibold">Babar Azam</div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-3"><i class="bi bi-calendar-event fs-5 me-3"
                                    style="color:#2563eb"></i>
                                <div>
                                    <div class="small text-secondary">Date</div>
                                    <div class="fw-semibold">2024-07-13</div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-3"><i class="bi bi-clock fs-5 me-3"
                                    style="color:#9333ea"></i>
                                <div>
                                    <div class="small text-secondary">Time</div>
                                    <div class="fw-semibold">12:00 - 14:00</div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center"><i class="bi bi-geo-alt fs-5 me-3"
                                    style="color:#16a34a"></i>
                                <div>
                                    <div class="small text-secondary">Venue</div>
                                    <div class="fw-semibold">A-008</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="ds-card p-4">
                            <div class="d-flex justify-content-between align-items-center mb-3"><span
                                    class="pill pill-teal border-0 fs-6">COAL</span><span class="fs-2 fw-bold"
                                    style="color:#d1d5db">#2</span></div>
                            <div class="d-flex align-items-center mb-3"><i class="bi bi-person fs-5 me-3"
                                    style="color:#0d9488"></i>
                                <div>
                                    <div class="small text-secondary">Instructor</div>
                                    <div class="fw-semibold">Virat Kohli</div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-3"><i class="bi bi-calendar-event fs-5 me-3"
                                    style="color:#2563eb"></i>
                                <div>
                                    <div class="small text-secondary">Date</div>
                                    <div class="fw-semibold">2024-07-14</div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-3"><i class="bi bi-clock fs-5 me-3"
                                    style="color:#9333ea"></i>
                                <div>
                                    <div class="small text-secondary">Time</div>
                                    <div class="fw-semibold">12:00 - 14:00</div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center"><i class="bi bi-geo-alt fs-5 me-3"
                                    style="color:#16a34a"></i>
                                <div>
                                    <div class="small text-secondary">Venue</div>
                                    <div class="fw-semibold">A-010</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="ds-card p-4">
                            <div class="d-flex justify-content-between align-items-center mb-3"><span
                                    class="pill pill-teal border-0 fs-6">MVC</span><span class="fs-2 fw-bold"
                                    style="color:#d1d5db">#3</span></div>
                            <div class="d-flex align-items-center mb-3"><i class="bi bi-person fs-5 me-3"
                                    style="color:#0d9488"></i>
                                <div>
                                    <div class="small text-secondary">Instructor</div>
                                    <div class="fw-semibold">Haris Rauf</div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-3"><i class="bi bi-calendar-event fs-5 me-3"
                                    style="color:#2563eb"></i>
                                <div>
                                    <div class="small text-secondary">Date</div>
                                    <div class="fw-semibold">2024-07-15</div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-3"><i class="bi bi-clock fs-5 me-3"
                                    style="color:#9333ea"></i>
                                <div>
                                    <div class="small text-secondary">Time</div>
                                    <div class="fw-semibold">10:00 - 12:00</div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center"><i class="bi bi-geo-alt fs-5 me-3"
                                    style="color:#16a34a"></i>
                                <div>
                                    <div class="small text-secondary">Venue</div>
                                    <div class="fw-semibold">B-108</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="ds-card p-4">
                            <div class="d-flex justify-content-between align-items-center mb-3"><span
                                    class="pill pill-teal border-0 fs-6">ISL</span><span class="fs-2 fw-bold"
                                    style="color:#d1d5db">#4</span></div>
                            <div class="d-flex align-items-center mb-3"><i class="bi bi-person fs-5 me-3"
                                    style="color:#0d9488"></i>
                                <div>
                                    <div class="small text-secondary">Instructor</div>
                                    <div class="fw-semibold">Rizwan</div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-3"><i class="bi bi-calendar-event fs-5 me-3"
                                    style="color:#2563eb"></i>
                                <div>
                                    <div class="small text-secondary">Date</div>
                                    <div class="fw-semibold">2024-07-16</div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-3"><i class="bi bi-clock fs-5 me-3"
                                    style="color:#9333ea"></i>
                                <div>
                                    <div class="small text-secondary">Time</div>
                                    <div class="fw-semibold">15:00 - 17:00</div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center"><i class="bi bi-geo-alt fs-5 me-3"
                                    style="color:#16a34a"></i>
                                <div>
                                    <div class="small text-secondary">Venue</div>
                                    <div class="fw-semibold">A-008</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="ds-card p-4">
                            <div class="d-flex justify-content-between align-items-center mb-3"><span
                                    class="pill pill-teal border-0 fs-6">DS</span><span class="fs-2 fw-bold"
                                    style="color:#d1d5db">#5</span></div>
                            <div class="d-flex align-items-center mb-3"><i class="bi bi-person fs-5 me-3"
                                    style="color:#0d9488"></i>
                                <div>
                                    <div class="small text-secondary">Instructor</div>
                                    <div class="fw-semibold">Starc</div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-3"><i class="bi bi-calendar-event fs-5 me-3"
                                    style="color:#2563eb"></i>
                                <div>
                                    <div class="small text-secondary">Date</div>
                                    <div class="fw-semibold">2024-07-17</div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-3"><i class="bi bi-clock fs-5 me-3"
                                    style="color:#9333ea"></i>
                                <div>
                                    <div class="small text-secondary">Time</div>
                                    <div class="fw-semibold">12:00 - 14:00</div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center"><i class="bi bi-geo-alt fs-5 me-3"
                                    style="color:#16a34a"></i>
                                <div>
                                    <div class="small text-secondary">Venue</div>
                                    <div class="fw-semibold">Cl-112</div>
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