<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Quiz System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'DM Sans', sans-serif;
            background: linear-gradient(145deg, #0d0d1a 0%, #111827 50%, #0f172a 100%);
            min-height: 100vh;
            color: #e2e8f0;
        }

        /* ── NAVBAR ── */
        .navbar {
            background: rgba(15,15,30,0.95);
            backdrop-filter: blur(12px);
            border-bottom: 0.5px solid rgba(255,255,255,0.07);
            padding: 0 2rem;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .nav-logo {
            display: flex; align-items: center; gap: 8px;
            font-family: 'Syne', sans-serif; font-weight: 700; font-size: 16px;
            color: #fff; text-decoration: none;
        }
        .nav-logo-dot { width: 10px; height: 10px; border-radius: 50%; background: #e94560; }
        .nav-links { display: flex; align-items: center; gap: 6px; }
        .nav-link {
            font-size: 14px; color: rgba(255,255,255,0.6); text-decoration: none;
            padding: 6px 14px; border-radius: 8px; transition: color 0.2s, background 0.2s;
        }
        .nav-link:hover { color: #fff; background: rgba(255,255,255,0.06); }
        .nav-divider { width: 1px; height: 18px; background: rgba(255,255,255,0.12); margin: 0 4px; }
        .btn-signup {
            font-size: 14px; font-weight: 500; padding: 7px 18px; border-radius: 9px;
            background: #e94560; color: #fff; border: none; cursor: pointer;
            text-decoration: none; transition: opacity 0.18s;
        }
        .btn-signup:hover { opacity: 0.88; }
        .btn-expert {
            font-size: 13px; font-weight: 500; padding: 6px 14px; border-radius: 9px;
            background: rgba(234,179,8,0.12); color: #fbbf24;
            border: 0.5px solid rgba(234,179,8,0.25); cursor: pointer;
            text-decoration: none; display: flex; align-items: center; gap: 5px;
            transition: background 0.2s;
        }
        .btn-expert:hover { background: rgba(234,179,8,0.2); }

        /* ── PAGE WRAPPER ── */
        .page-wrap {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 3rem 1.5rem 5rem;
            min-height: calc(100vh - 56px);
        }

        /* ── ALERTS ── */
        .alert {
            width: 100%; max-width: 600px;
            padding: 12px 18px; border-radius: 10px;
            font-size: 14px; font-weight: 500;
            text-align: center; margin-bottom: 1.25rem;
        }
        .alert-success {
            background: rgba(34,197,94,0.1);
            border: 0.5px solid rgba(34,197,94,0.25);
            color: #86efac;
        }
        .alert-error {
            background: rgba(239,68,68,0.1);
            border: 0.5px solid rgba(239,68,68,0.25);
            color: #fca5a5;
        }

        /* ── CARD ── */
        .contact-card {
            width: 100%; max-width: 600px;
            background: rgba(255,255,255,0.04);
            border: 0.5px solid rgba(255,255,255,0.09);
            border-radius: 18px;
            padding: 2.5rem;
        }

        .card-title {
            font-family: 'Syne', sans-serif;
            font-size: 2rem; font-weight: 700;
            color: #fff; text-align: center;
            margin-bottom: 0.6rem;
        }
        .card-title span {
            background: linear-gradient(135deg, #22c55e, #16a34a);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .card-sub {
            text-align: center;
            font-size: 14px;
            color: rgba(255,255,255,0.4);
            margin-bottom: 2rem;
        }

        /* ── FORM ── */
        .form-group { margin-bottom: 1.4rem; }
        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            color: rgba(255,255,255,0.7);
            margin-bottom: 7px;
        }
        .form-input,
        .form-textarea {
            width: 100%;
            padding: 10px 14px;
            background: rgba(255,255,255,0.06);
            border: 0.5px solid rgba(255,255,255,0.12);
            border-radius: 10px;
            font-size: 14px;
            font-family: 'DM Sans', sans-serif;
            color: #e2e8f0;
            outline: none;
            transition: border-color 0.2s, background 0.2s;
        }
        .form-input::placeholder,
        .form-textarea::placeholder { color: rgba(255,255,255,0.2); }
        .form-input:focus,
        .form-textarea:focus {
            border-color: #16a34a;
            background: rgba(255,255,255,0.08);
        }
        .form-textarea { resize: vertical; min-height: 140px; }
        .error-msg {
            font-size: 12px;
            color: #fca5a5;
            margin-top: 5px;
            display: block;
        }

        /* ── SUBMIT BTN ── */
        .submit-btn {
            width: 100%;
            padding: 12px;
            background: #16a34a;
            color: #fff;
            font-family: 'Syne', sans-serif;
            font-size: 15px;
            font-weight: 600;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s;
            margin-top: 0.5rem;
        }
        .submit-btn:hover { background: #15803d; transform: translateY(-1px); }
        .submit-btn:active { transform: translateY(0); }

        /* ── CONTACT INFO ── */
        .contact-info {
            margin-top: 2rem;
            padding-top: 1.75rem;
            border-top: 0.5px solid rgba(255,255,255,0.07);
            text-align: center;
        }
        .contact-info p {
            font-size: 13px;
            color: rgba(255,255,255,0.4);
            line-height: 1.8;
        }
        .contact-info strong {
            color: rgba(255,255,255,0.7);
            font-weight: 500;
        }

        /* ── FOOTER ── */
        .footer {
            background: rgba(0,0,0,0.3);
            color: rgba(255,255,255,0.25);
            text-align: center; padding: 1.5rem;
            font-size: 13px;
            border-top: 0.5px solid rgba(255,255,255,0.06);
        }
    </style>
</head>
<body>

 <x-user-navbar></x-user-navbar>
    
<!-- PAGE -->
<div class="page-wrap">

      
    <!-- SUCCESS ALERT -->
    @if(session('message-success'))
        <div class="alert alert-success">
            {{ session('message-success') }}
        </div>
    @endif  
        <!-- ERROR ALERT -->
    @if(session('message-error'))
        <div class="alert alert-error"> 
            {{ session('message-error') }}
        </div>
    @endif  

    <!-- CARD -->
    <div class="contact-card">
        <h1 class="card-title">Contact <span>Us</span></h1>
        <p class="card-sub">We'd love to hear from you! Send us a message and we'll respond as soon as possible.</p>

        <form action="/contact" method="POST">
            @csrf
            <!-- Name -->
            <div class="form-group">
                <label class="form-label" for="name">Name</label>
                <input class="form-input" type="text" id="name" name="name" placeholder="Your full name" required>
                 @error('name') <span class="error-msg">{{ $message }}</span> @enderror 
            </div>

            <!-- Email -->
            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input class="form-input" type="email" id="email" name="email" placeholder="you@example.com" required>
                 @error('email') <span class="error-msg">{{ $message }}</span> @enderror 
            </div>

            <!-- Contact Number -->
            <div class="form-group">
                <label class="form-label" for="contact">Contact Number</label>
                <input class="form-input" type="text" id="contact" name="contact" placeholder="+91 98765 43210" required>
                 @error('contact') <span class="error-msg">{{ $message }}</span> @enderror 
            </div>

            <!-- Message -->
            <div class="form-group">
                <label class="form-label" for="message">Message</label>
                <textarea class="form-textarea" id="message" name="message" placeholder="Write your message here..." required></textarea>
                 @error('message') <span class="error-msg">{{ $message }}</span> @enderror 
            </div>

            <button type="submit" class="submit-btn">Send Message →</button>
        </form>

        <div class="contact-info">
            <p>Or reach us at:<br>
            <strong>info@quiz.com</strong> &nbsp;|&nbsp; <strong>+1 (123) 456-7890</strong></p>
        </div>
    </div>

</div>

<!-- FOOTER -->
<x-footer-user></x-footer-user>

</body>
</html>
