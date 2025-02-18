<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0;
        }
        .signup-container {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            width: 350px;
            box-sizing: border-box;
            text-align: center;
        }
        .signup-container h2 {
            margin-bottom: 25px;
            font-size: 24px;
            color: #333;
        }
        .signup-container input {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }
        .signup-container button {
            width: 100%;
            padding: 12px;
            background: #28a745;
            border: none;
            color: #fff;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .signup-container button:hover {
            background: #218838;
        }
        .login-link {
            margin-top: 15px;
            font-size: 14px;
        }
        .login-link a {
            color: #007BFF;
            text-decoration: none;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <h2>Sign Up</h2>
        <form method="POST" action="{{ route('logins.store') }}">
            @csrf
            <div>
                <input type="text" name="name" placeholder="Name" required>
            </div>
            <div>
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div>
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <div>
                <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
            </div>
            <button type="submit">Register</button>
        </form>
        <div class="login-link">
            Already have an account? <a href="{{ route('logins.index') }}">Login</a>
        </div>
    </div>
</body>
</html>
