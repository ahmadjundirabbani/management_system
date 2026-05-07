<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .login-card {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background: white;
        }
    </style>
</head>

<body>
    <div class="login-card">
        <h3 class="text-center mb-4">Login System</h3>
        <div id="alertPlaceholder"></div>
        <form id="loginForm">
            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="email" id="email" class="form-control" placeholder="admin@gmail.com" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" id="password" class="form-control" placeholder="pass123" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Masuk</button>
        </form>
        <p class="text-muted mt-3 text-center" style="font-size: 0.8rem;">Note: Token expired dalam 1 menit</p>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            try {
                const response = await fetch('/api/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        email,
                        password
                    })
                });

                const result = await response.json();

                if (response.ok) {
                    // Simpan token ke localStorage
                    localStorage.setItem('access_token', result.access_token);
                    alert('Login Berhasil!');
                    window.location.href = '/karyawan'; // Pindah ke halaman utama
                } else {
                    document.getElementById('alertPlaceholder').innerHTML =
                        `<div class="alert alert-danger">${result.error || 'Login Gagal'}</div>`;
                }
            } catch (err) {
                console.error(err);
            }
        });
    </script>
</body>

</html>