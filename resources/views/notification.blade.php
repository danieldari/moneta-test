<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Utility Notification Form</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    :root {
      --primary: #2563eb;
      --primary-dark: #1d4ed8;
      --bg: #f9fafb;
      --text-dark: #111827;
      --text-light: #6b7280;
      --border: #d1d5db;
    }

    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: system-ui, sans-serif;
      background-color: var(--bg);
      color: var(--text-dark);
      padding: 2rem;
    }

    .container {
      max-width: 600px;
      background-color: white;
      margin: auto;
      border-radius: 8px;
      padding: 2rem;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    h2 {
      margin-bottom: 1.5rem;
      font-size: 1.5rem;
    }

    .form-group {
      margin-bottom: 1.25rem;
    }

    label {
      display: block;
      font-weight: 600;
      margin-bottom: 0.5rem;
      color: var(--text-light);
    }

    input, select, textarea {
      width: 100%;
      padding: 0.75rem 1rem;
      border: 1px solid var(--border);
      border-radius: 6px;
      font-size: 1rem;
      background-color: white;
    }

    textarea {
      resize: vertical;
    }

    .hidden {
      display: none;
    }

    .btn {
      display: block;
      width: 100%;
      background-color: var(--primary);
      color: white;
      font-weight: 600;
      padding: 0.75rem;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: background-color 0.2s ease;
    }

    .btn:hover {
      background-color: var(--primary-dark);
    }

    .alert {
      background-color: #dcfce7;
      color: #166534;
      padding: 0.75rem;
      border-radius: 6px;
      margin-bottom: 1rem;
    }
  </style>
</head>
<body>
   <center>
        <h1>Moneta  Test</h1>
        <nav>
    <a href="/">payment gateway</a>
    <a href="/notify">notification </a>
    <a href="/utility">utility </a>
</nav>

<br>
    </center>
<div class="container">
  <h2>📣 Send a Notification</h2>

  @if(session('success'))
    <div class="alert">{{ session('success') }}</div>
  @endif

  <form action="{{ route('notification.send') }}" method="POST">
    @csrf

    <div class="form-group">
      <label for="notification_type">Notification Type</label>
      <select id="notification_type" name="notification_type" required onchange="toggleFields()">
        <option value="">-- Select --</option>
        <option value="email">Email</option>
        <option value="sms">SMS</option>
        <option value="whatsapp">WhatsApp</option>
      </select>
    </div>

    <div class="form-group hidden" id="email_group">
      <label for="email">Recipient Email</label>
      <input type="email" id="email" name="email">
    </div>

    <div class="form-group hidden" id="phone_group">
      <label for="phone">Recipient Phone</label>
      <input type="text" id="phone" name="phone" placeholder="+1234567890">
    </div>

    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" id="title" name="title" required>
    </div>

    <div class="form-group">
      <label for="body">Message Body</label>
      <textarea id="body" name="body" rows="4" required></textarea>
    </div>

    <button class="btn" type="submit">Send Notification</button>
  </form>
</div>

<script>
  function toggleFields() {
    const type = document.getElementById('notification_type').value;
    const emailGroup = document.getElementById('email_group');
    const phoneGroup = document.getElementById('phone_group');

    emailGroup.classList.add('hidden');
    phoneGroup.classList.add('hidden');

    if (type === 'email') {
      emailGroup.classList.remove('hidden');
    } else if (type === 'sms' || type === 'whatsapp') {
      phoneGroup.classList.remove('hidden');
    }
  }
</script>

</body>
</html>
