<!DOCTYPE html>
<html>
<head>
    <title>Manage Experts</title>
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
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            font-size: 24px;
        }

        .logout-btn {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid white;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .top-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
        }

        .btn-primary {
            background: #48bb78;
            color: white;
        }

        .btn-primary:hover {
            background: #38a169;
        }

        .btn-back {
            background: #667eea;
            color: white;
        }

        .btn-back:hover {
            background: #5568d3;
        }

        .content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .content h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table thead {
            background-color: #f8f9fa;
        }

        .table th {
            padding: 12px;
            text-align: left;
            color: #555;
            font-weight: bold;
            border-bottom: 2px solid #ddd;
        }

        .table td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        .table tbody tr:hover {
            background-color: #f9f9f9;
        }

        .action-links {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .link-btn {
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 12px;
            font-weight: bold;
            cursor: pointer;
            border: none;
        }

        .link-edit {
            background: #3498db;
            color: white;
        }

        .link-edit:hover {
            background: #2980b9;
        }

        .link-view {
            background: #9b59b6;
            color: white;
        }

        .link-view:hover {
            background: #8e44ad;
        }

        .link-delete {
            background: #e74c3c;
            color: white;
        }

        .link-delete:hover {
            background: #c0392b;
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 5px;
            margin-top: 20px;
        }

        .pagination a,
        .pagination span {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-decoration: none;
            color: #667eea;
        }

        .pagination a:hover {
            background: #667eea;
            color: white;
        }

        .pagination .active {
            background: #667eea;
            color: white;
        }

        .alert {
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .search-box {
            margin-bottom: 20px;
        }

        .search-box input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .top-actions {
                flex-direction: column;
                align-items: flex-start;
            }

            .action-links {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>👥 Manage Experts</h1>
        <a href="{{ url('admin-logout') }}" class="logout-btn">Logout</a>
    </div>

    <div class="container">
        @if (session()->has('success'))
            <div class="alert alert-success">
                ✓ {{ session()->get('success') }}
            </div>
        @endif

        <div class="top-actions">
            <a href="{{ url('admin-add-expert') }}" class="btn btn-primary">➕ Add New Expert</a>
            <a href="{{ url('admin-dashboard') }}" class="btn btn-back">← Back to Dashboard</a>
        </div>

        <div class="content">
            <h2>Experts List</h2>

            @if (count($experts) > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($experts as $expert)
                            <tr>
                                <td>{{ $expert->id }}</td>
                                <td><strong>{{ $expert->name }}</strong></td>
                                <td>{{ $expert->email ?? 'N/A' }}</td>
                                <td>{{ $expert->created_at->format('M d, Y') ?? 'N/A' }}</td>
                                <td>
                                    <div class="action-links">
                                        <a href="{{ url('admin-expert-details/' . $expert->id) }}" class="link-btn link-view">👁️ View</a>
                                        <a href="{{ url('admin-edit-expert/' . $expert->id) }}" class="link-btn link-edit">✏️ Edit</a>
                                        <a href="{{ url('admin-delete-expert/' . $expert->id) }}" class="link-btn link-delete" onclick="return confirm('Are you sure you want to delete this expert?')">🗑️ Delete</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if ($experts->hasPages())
                    <div class="pagination">
                        {{ $experts->links() }}
                    </div>
                @endif
            @else
                <p style="text-align: center; color: #999; padding: 20px;">No experts found</p>
            @endif
        </div>
    </div>
</body>
</html>
