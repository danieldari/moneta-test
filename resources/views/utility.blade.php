<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Utility Services</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    :root {
      --primary: #2563eb;
      --primary-dark: #1e40af;
      --bg: #f1f5f9;
      --text: #1f2937;
      --border: #d1d5db;
    }

    * {
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: var(--bg);
      padding: 2rem;
      margin: 0;
      color: var(--text);
    }

    .container {
      max-width: 600px;
      margin: auto;
      background-color: white;
      padding: 2rem;
      border-radius: 8px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }

    h2 {
      font-size: 1.5rem;
      margin-bottom: 1.5rem;
    }

    .form-group {
      margin-bottom: 1.25rem;
    }

    label {
      display: block;
      font-weight: 600;
      margin-bottom: 0.5rem;
      color: #4b5563;
    }

    input, select {
      width: 100%;
      padding: 0.75rem 1rem;
      border: 1px solid var(--border);
      border-radius: 6px;
      font-size: 1rem;
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

    .hidden {
      display: none;
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

<div class="container">
  <h2>🧾 Utility Payment</h2>

  <form action="{{ route('utility.pay') }}" method="POST">
    @csrf

    <div class="form-group">
      <label for="utility_type">Service Type</label>
      <select id="utility_type" name="utility_type" required onchange="updateFields()">
        <option value="">-- Select --</option>
        <option value="airtime">Buy Airtime</option>
        <option value="data">Buy Data</option>
        <option value="tv">Pay TV Subscription</option>
      </select>
    </div>

    <div class="form-group" id="network_group">
      <label for="network">Network Provider</label>
      <select id="network" name="network">
        <option value="">-- Select Network --</option>
        <option value="mtn">MTN</option>
        <option value="airtel">Airtel</option>
        <option value="glo">Glo</option>
        <option value="9mobile">9mobile</option>
      </select>
    </div>

    <div class="form-group" id="smartcard_group" style="display:none;">
      <label for="smartcard">Smartcard / IUC Number</label>
      <input type="text" id="smartcard" name="smartcard">
    </div>

    <div class="form-group">
      <label for="phone">Phone Number</label>
      <input type="text" id="phone" name="phone" placeholder="+234...">
    </div>

    <div class="form-group">
      <label for="amount">Amount (₦)</label>
      <input type="number" id="amount" name="amount" min="50" required>
    </div>

    <button type="submit" class="btn">Proceed</button>
  </form>
</div>

<script>
  function updateFields() {
    const type = document.getElementById('utility_type').value;
    const smartcard = document.getElementById('smartcard_group');
    const network = document.getElementById('network_group');

    if (type === 'tv') {
      smartcard.style.display = 'block';
      network.style.display = 'none';
    } else {
      smartcard.style.display = 'none';
      network.style.display = 'block';
    }
  }
</script>

</body>
</html>
