<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>BVN Validation</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f1f5f9;
      padding: 2rem;
    }

    .container {
      max-width: 400px;
      background: white;
      padding: 2rem;
      border-radius: 8px;
      margin: auto;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    h2 {
      margin-bottom: 1rem;
    }

    input {
      width: 100%;
      padding: 10px;
      margin-bottom: 1rem;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 1rem;
    }

    button {
      width: 100%;
      background-color: #2563eb;
      color: white;
      border: none;
      padding: 10px;
      font-weight: bold;
      border-radius: 6px;
      cursor: pointer;
    }

    button:hover {
      background-color: #1e40af;
    }

    .result {
      margin-top: 1rem;
      background: #fefce8;
      border: 1px solid #fde68a;
      padding: 1rem;
      border-radius: 6px;
      font-size: 0.95rem;
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
    <a href="/bvn">bvn </a>
</nav>

<br>
 </center>
<div class="container">
  <h2>🔍 Validate BVN</h2>
  <input type="text" id="bvnInput" placeholder="Enter BVN e.g. 22222222280" maxlength="11" />
  <button onclick="handleBVNValidation()">Validate</button>

  <div id="result" class="result" style="display:none;"></div>
</div>

<script>
  const API_KEY = 'mnt_voOJoZrjOAuuwxCIl4Rv4U7pHGSRC6'; // Replace this with your actual API key

  const validateBVN = async (bvn) => {
    const url = 'https://staging-nips.moneta.ng/api/bvn/bvn_onboard';
    const payload = {
      scope: "accounts",
      channel_code: "customer_web_portal",
      customer_reference: "danTheBad222",
      bvn: bvn,
    };

    const response = await fetch(url, {
      method: 'POST',
      headers: {
        'Authorization': `Bearer ${API_KEY}`,
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(payload)
    });

    return await response.json();
  };

  const handleBVNValidation = async () => {
    const bvn = document.getElementById('bvnInput').value.trim();
    const resultDiv = document.getElementById('result');

    if (!/^\d{11}$/.test(bvn)) {
      resultDiv.style.display = 'block';
      resultDiv.textContent = '❌ Please enter a valid 11-digit BVN number.';
      return;
    }

    resultDiv.style.display = 'block';
    resultDiv.textContent = '🔄 Validating... Please wait...';

    try {
      const data = await validateBVN(bvn);
      resultDiv.innerHTML = `<strong>✅ Response:</strong><br><pre>${JSON.stringify(data, null, 2)}</pre>`;
    } catch (error) {
      resultDiv.textContent = '❌ Error validating BVN. Please try again.';
      console.error(error);
    }
  };
</script>

</body>
</html>
