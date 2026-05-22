<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Expert</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .header h1 {
            color: #333;
            font-size: 28px;
        }

        .card {
            background: white;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: bold;
            font-size: 14px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            font-family: inherit;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-group small {
            display: block;
            margin-top: 5px;
            color: #999;
            font-size: 12px;
        }

        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }

        .btn {
            flex: 1;
            padding: 12px 24px;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 14px;
            text-decoration: none;
            text-align: center;
        }

        .btn-primary {
            background: #667eea;
            color: white;
        }

        .btn-primary:hover {
            background: #5568d3;
        }

        .btn-secondary {
            background: #f0f0f0;
            color: #333;
        }

        .btn-secondary:hover {
            background: #e0e0e0;
        }

        .alert {
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .role-description {
            background: #f0f4ff;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            border-left: 4px solid #667eea;
        }

        .role-description h4 {
            color: #667eea;
            margin-bottom: 10px;
        }

        .role-description ul {
            margin-left: 20px;
            color: #666;
            font-size: 13px;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div>
                <h1>➕ Create New Expert</h1>
            </div>
            <div>
                <a href="{{ url('admin/experts') }}" class="btn btn-secondary" style="text-decoration: none;">← Back</a>
            </div>
        </div>

        <div class="card">
            <div class="role-description">
                <h4>ℹ️ Available Roles:</h4>
                <ul>
                    <li><strong>Super Admin:</strong> Full system access, manage all admins and resources</li>
                    <li><strong>Admin:</strong> Manage experts, quizzes, users, and view reports</li>
                    <li><strong>Expert:</strong> Create and manage their own quizzes</li>
                </ul>
            </div>

            <form action="{{ url('admin/experts/create') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">Full Name *</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Enter expert's full name">
                    <small>At least 3 characters</small>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Enter email (optional)">
                    <small>Must be unique if provided</small>
                </div>

                <div class="form-group">
                    <label for="password">Password *</label>
                    <input type="password" id="password" name="password" required placeholder="Enter a secure password">
                    <small>At least 6 characters</small>
                </div>

                <div class="form-group">
                    <label for="role">Select Role *</label>
                    <select name="role" id="role" required>
                        <option value="">-- Choose a role --</option>
                        @foreach($allRoles as $roleKey => $roleLabel)
                            <option value="{{ $roleKey }}">{{ $roleLabel }}</option>
                        @endforeach
                    </select>
                    <small>Choose the role for this expert</small>
                </div>

                @if ($errors->any())
                    <div class="alert alert-error">
                        <strong>Errors:</strong>
                        <ul style="margin-left: 20px; margin-top: 10px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="button-group">
                    <button type="submit" class="btn btn-primary">✓ Create Expert</button>
                    <a href="{{ url('admin/experts') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
