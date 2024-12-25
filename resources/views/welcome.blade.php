<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hiring Portal</title>
    <style>
        /* Global styles */
        body, h1, h2, p, a {
            margin: 0;
            padding: 0;
            font-family:"Montserrat", sans-serif;
        }

        /* White background for body */
        body {
            background-color: #fff; /* White background */
            color: #333; /* Dark charcoal text */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            flex-direction: column;
            text-align: center;
        }

        header {
            width: 100%;
            padding: 16px;
            
            box-shadow: #333333;
        }

        

        nav {
            margin-top: 10px;
        }

        nav a {
            padding: 10px 20px;
            margin: 0 8px;
            text-decoration: none;
            color: white;
            background-color: #333333; /* Medium grey for links */
            border: 1px solid #555; /* Dark grey border */
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        nav a:hover {
            background-color: #333333; /* Lighter grey on hover */
        }

        main {
            margin-top: 40px;
        }

        h2 {
            font-size: 32px;
            font-weight: 500;
            color: #333; /* Charcoal grey for the main heading */
        }

        p {
            font-size: 16px;
            color: #555; /* Light charcoal grey for the description text */
        }
    </style>
</head>
<body>
<h2>Hiring Portal</h2>
    <!-- Header Section -->
    <header>
        <div>
            <!-- Title -->
           

            <!-- Navigation -->
            <nav>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}">LOG IN</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">REGISTER</a>
                        @endif
                    @endauth
                @endif
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        <h2>Welcome to the Hiring Portal</h2>
        <p>Manage all your hiring activities efficiently and seamlessly.</p>
    </main>

</body>
</html>
