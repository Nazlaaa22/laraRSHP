<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Resepsionis RSHP')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --bg-color: #f4f7ff;
            --card-bg: rgba(255, 255, 255, 0.9);
            --text-color: #222;
            --shadow: rgba(0, 0, 0, 0.1);
            --primary: #004aad;
        }

        body.dark-mode {
            --bg-color: #0e1116;
            --card-bg: rgba(25, 28, 34, 0.95);
            --text-color: #f2f2f2;
            --shadow: rgba(0, 0, 0, 0.5);
            --primary: #5da8ff;
        }

        body {
            background: var(--bg-color);
            color: var(--text-color);
            font-family: 'Poppins', sans-serif;
            transition: all 0.4s ease;
        }

        .navbar {
            background: var(--primary);
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }

        .toggle-btn {
            background: white;
            border: none;
            color: var(--primary);
            padding: 6px 14px;
            border-radius: 50px;
            cursor: pointer;
            font-weight: 600;
            transition: 0.3s;
        }

        .toggle-btn:hover {
            background: #dce6ff;
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <h5 class="fw-bold m-0">💼 Resepsionis RSHP</h5>
        <div>
            <button id="themeToggle" class="toggle-btn">🌞 Light</button>
            <a href="/logout" class="toggle-btn" style="background:#ff6666;color:white;">Logout</a>
        </div>
    </nav>

    <div class="container my-5">
        @yield('content')
    </div>

    <script>
        const btn = document.getElementById("themeToggle");
        btn.addEventListener("click", () => {
            document.body.classList.toggle("dark-mode");
            const dark = document.body.classList.contains("dark-mode");
            btn.textContent = dark ? "🌙 Dark" : "🌞 Light";
        });
    </script>

    @stack('scripts')
</body>
</html>
