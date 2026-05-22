<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expert Details - Assign Role</title>
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
            max-width: 800px;
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
            margin-bottom: 20px;
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

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
            padding: 15px;
            background: #f9f9f9;
            border-radius: 6px;
        }

        .info-item {
            display: flex;
            flex-direction: column;
        }

        .info-item label {
            color: #999;
            font-size: 12px;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .info-item strong {
            color: #333;
            font-size: 16px;
        }

        .role-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            color: white;
            width: fit-content;
        }

        .role-super-admin {
            background: #ff6b6b;
        }

        .role-admin {
            background: #4c6ef5;
        }

        .role-expert {
            background: #51cf66;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
            width: fit-content;
        }

        .status-active {
            background: #d4edda;
            color: #155724;
        }

        .status-inactive {
            background: #f8d7da;
            color: #721c24;
        }

        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
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

        .btn-danger {
            background: #ff6b6b;
            color: white;
        }

        .btn-danger:hover {
            background: #ff5252;
        }

        .btn-warning {
            background: #ffa94d;
            color: white;
        }

        .btn-warning:hover {
            background: #ff922b;
        }

        .section-title {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #667eea;
        }

        .alert {
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .role-info {
            background: #f0f4ff;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            border-left: 4px solid #667eea;
        }

        .role-info h4 {
            color: #667eea;
            margin-bottom: 8px;
        }

        .role-info p {
            color: #666;
            font-size: 13px;
            line-height: 1.6;
        }

        .action-button-group {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div>
                <h1>📝 Expert Details & Role Assignment</h1>
            </div>
            <div>
                <a href="{{ url('admin/experts') }}" class="btn btn-secondary">← Back</a>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">✓ {{ $message }}</div>
        @endif

        @if ($message = Session::get('error'))
            <div class="alert alert-error">✗ {{ $message }}</div>
        @endif

        <!-- Expert Information -->
        <div class="card">
            <h2 class="section-title">👤 Expert Information</h2>
            
            <div class="info-grid">
                <div class="info-item">
                    <label>Name</label>
                    <strong>{{ $expert->name }}</strong>
                </div>
                <div class="info-item">
                    <label>Email</label>
                    <strong>{{ $expert->email ?? 'Not provided' }}</strong>
                </div>
                <div class="info-item">
                    <label>Current Role</label>
                    <span class="role-badge role-{{ str_replace('_', '-', $expert->role) }}">
                        {{ $expert->getRoleLabel() }}
                    </span>
                </div>
                <div class="info-item">
                    <label>Status</label>
                    <span class="status-badge {{ $expert->is_active ? 'status-active' : 'status-inactive' }}">
                        {{ $expert->is_active ? '✓ Active' : '✗ Inactive' }}
                    </span>
                </div>
                <div class="info-item">
                    <label>Joined Date</label>
                    <strong>{{ $expert->created_at->format('d M Y, h:i A') }}</strong>
                </div>
                <div class="info-item">
                    <label>Last Updated</label>
                    <strong>{{ $expert->updated_at->format('d M Y, h:i A') }}</strong>
                </div>
            </div>
        </div>

        <!-- Role Assignment Form -->
        <div class="card">
            <h2 class="section-title">🔐 Assign Role</h2>

            <form action="{{ url('admin/experts/' . $expert->id . '/assign-role') }}" method="POST">
                @csrf

                <div class="role-info">
                    <h4>Role Descriptions:</h4>
                    <p>
                        <strong>Super Admin:</strong> Full system access, can manage admins and all resources<br>
                        <strong>Admin:</strong> Can manage experts, quizzes, users, and view reports<br>
                        <strong>Expert:</strong> Can create and manage their own quizzes
                    </p>
                </div>

                <div class="form-group">
                    <label for="role">Select Role:</label>
                    <select name="role" id="role" required>
                        <option value="">-- Choose a role --</option>
                        @foreach($allRoles as $roleKey => $roleLabel)
                            <option value="{{ $roleKey }}" {{ $expert->role === $roleKey ? 'selected' : '' }}>
                                {{ $roleLabel }}
                            </option>
                        @endforeach
                    </select>
                </div>

                @if ($errors->any())
                    <div class="alert alert-error">
                        <ul style="margin-left: 20px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="button-group">
                    <button type="submit" class="btn btn-primary">💾 Update Role</button>
                    <a href="{{ url('admin/experts') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>

        <!-- Edit Expert Form -->
        <div class="card">
            <h2 class="section-title">✏️ Edit Expert Details</h2>

            <form action="{{ url('admin/experts/' . $expert->id . '/edit') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="{{ $expert->name }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="{{ $expert->email }}">
                </div>

                <div class="form-group">
                    <label for="password">Password (leave blank to keep current):</label>
                    <input type="password" id="password" name="password" placeholder="Enter new password if you want to change it">
                </div>

                <div class="form-group">
                    <label for="role">Role:</label>
                    <select name="role" id="role" required>
                        @foreach($allRoles as $roleKey => $roleLabel)
                            <option value="{{ $roleKey }}" {{ $expert->role === $roleKey ? 'selected' : '' }}>
                                {{ $roleLabel }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="button-group">
                    <button type="submit" class="btn btn-primary">💾 Save Changes</button>
                    <a href="{{ url('admin/experts') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>

        <!-- Actions -->
        <div class="card">
            <h2 class="section-title">⚙️ Actions</h2>

            <div class="action-button-group">
                @if($expert->is_active)
                    <form action="{{ url('admin/experts/' . $expert->id . '/toggle-active') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-warning" onclick="return confirm('Deactivate this expert?')">
                            ⏸️ Deactivate Expert
                        </button>
                    </form>
                @else
                    <form action="{{ url('admin/experts/' . $expert->id . '/toggle-active') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            ▶️ Activate Expert
                        </button>
                    </form>
                @endif

                @if(!$expert->isSuperAdmin())
                    <form action="{{ url('admin/experts/' . $expert->id . '/delete') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this expert? This action cannot be undone.')">
                            🗑️ Delete Expert
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
