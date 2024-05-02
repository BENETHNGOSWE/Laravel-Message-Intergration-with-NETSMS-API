<!DOCTYPE html>
<html>
<head>
    <title>Send Message Form</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        /* Add some custom styling */
        body {
            padding: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-control, .btn {
            border-radius: 0;
        }
    </style>
</head>
<body>
    <h1 class="text-center">Send Message</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <form action="{{ route('sendmessage') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="phone_number">Phone Number:</label>
            <input type="text" id="phone_number" name="phone_number" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="message">Message:</label>
            <textarea id="message" name="message" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Send Message</button>
    </form>
</body>
</html>
