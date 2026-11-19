<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Sign In | DevXcript Student Portal</title>
    <link rel="icon" href="img/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Onest:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="auth">
        <div class="inner">
            <div class="text-center mb-4"><img src="img/logo.png" alt="logo" height="56"></div>
            <h1 class="text-center mb-2">Login to DevXcript Portal</h1>
            <p class="small text-secondary text-center mb-4">Enter dummy email password to access dashboard</p>
            <form id="loginForm" novalidate class="d-grid gap-3">
                <div><label class="form-label small fw-medium">Email <span class="text-danger">*</span></label><input
                        id="email" type="email" class="form-control" placeholder="info@gmail.com">
                    <div class="invalid-feedback" id="emailErr"></div>
                </div>
                <div><label class="form-label small fw-medium">Password <span class="text-danger">*</span></label>
                    <div class="position-relative"><input id="password" type="password" class="form-control"
                            placeholder="Enter your password"><button type="button" data-eye="#password"
                            class="btn position-absolute top-0 end-0 text-secondary"><i class="bi bi-eye"></i></button>
                    </div>
                    <div class="text-danger small mt-1" id="passErr"></div>
                </div>
                <div class="d-flex justify-content-between align-items-center small"><label class="d-flex gap-2"><input
                            type="checkbox" class="form-check-input mt-0"> Keep me logged in</label><a
                        href="forgot-password.html" class="link-teal">Forgot password?</a></div>
                <button class="btn btn-theme py-2">Sign in</button>
            </form>
            <div class="text-center text-muted small my-3">Or</div><a href="dashboard.html"
                class="btn btn-light w-100 py-2 d-flex justify-content-center align-items-center gap-2"><svg width="18"
                    height="18" viewBox="0 0 20 20">
                    <path d="M9.5 1.5H1.5V9.5H9.5Z" fill="#F25022" />
                    <path d="M18.5 1.5H10.5V9.5H18.5Z" fill="#7FBA00" />
                    <path d="M9.5 10.5H1.5V18.5H9.5Z" fill="#00A4EF" />
                    <path d="M18.5 10.5H10.5V18.5H18.5Z" fill="#FFB900" />
                </svg>Sign in with Microsoft</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>