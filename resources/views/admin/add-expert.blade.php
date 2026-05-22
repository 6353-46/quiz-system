<!DOCTYPE html>
<html>
<head>
    <title>Add Expert</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px 30px;
        }

        .header h1 {
            font-size: 24px;
        }

        .container {
            max-width: 600px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .content {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .content h2 {
            margin-bottom: 30px;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            font-family: inherit;
        }

        .form-group input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 5px rgba(102, 126, 234, 0.3);
        }

        .form-group input.error {
            border-color: #e74c3c;
        }

        .error-message {
            color: #e74c3c;
            font-size: 13px;
            margin-top: 5px;
        }

        .btn-group {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }

        .btn {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
        }

        .btn-submit {
            background: #48bb78;
            color: white;
        }

        .btn-submit:hover {
            background: #38a169;
        }

        .btn-cancel {
            background: #bdc3c7;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-cancel:hover {
            background: #95a5a6;
        }

        .validation-errors {
            background: #fadbd8;
            border: 1px solid #f5b7b1;
            color: #c0392b;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .validation-errors ul {
            list-style-position: inside;
        }

        .validation-errors li {
            margin-bottom: 5px;
        }

        @media (max-width: 600px) {
            .container {
                margin: 15px auto;
            }

            .content {
                padding: 20px;
            }

            .btn-group {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>➕ Add New Expert</h1>
    </div>

    <div class="container">
        <div class="content">
            <h2>Create Expert Account</h2>

            @if ($errors->any())
                <div class="validation-errors">
                    <strong>Please fix the following errors:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ url('admin-store-expert') }}">
                @csrf

                <div class="form-group">
                    <label for="name">Expert Name *</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email Address *</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password *</label>
                    <input type="password" id="password" name="password" required>
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="btn-group">
                    <button type="submit" class="btn btn-submit">✓ Add Expert</button>
                    <a href="{{ url('admin-experts') }}" class="btn btn-cancel">✕ Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
