<?php


// ======= Processing (no redirects) =======
$is_post = ($_SERVER['REQUEST_METHOD'] === 'POST');
$email   = '';
$display_link_absolute = '';
$href_link              = ''; // الرابط الفعلي اللي ينفتح عند الضغط
$message_ready          = false;
if ($is_post) {
    $email = $_POST['email'] ?? '';
    $token = bin2hex(random_bytes(16));

    // نقرأ الهوست (للعرض الضعيف)
    $hostHeader = $_SERVER['HTTP_X_FORWARDED_HOST']
         ?? $_SERVER['HTTP_HOST']
           ?? 'localhost';
           /*

    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';

    // هوست شرعي؟
    $ALLOWED_HOSTS = ['localhost', '127.0.0.1'];
    $currentHost   = strtolower(preg_replace('/[^a-z0-9\.\-]/i', '', $hostHeader));
    $is_legit      = in_array($currentHost, $ALLOWED_HOSTS, true);

    if ($is_legit) {
        // الصفحة الاساسية لتعين كلمه المرور
        $page_path = '/reset_password1.php';
    } else {
        // صفحة المهاجم (مبنية من الهوست)
        $safeHost  = strtolower(preg_replace('/[^a-z0-9._-]/i', '', $currentHost));
        $page_path = '/' . str_replace('.', '_', $safeHost) . '.php';
    }

    // ✅ هذا الذي نعرضه كنص داخل "الإيميل" (مطلق للشرح)
    $display_link_absolute = "{$scheme}://{$currentHost}{$page_path}?token={$token}";

    // ✅ وهذا هو الـ href الفعلي عند الضغط (نسبي عشان يفتح بدون DNS)
    $href_link = $page_path . '?token=' . urlencode($token);

    $message_ready = true;

*/





  // ✅ Secure version to prevent Host Header Injection
// This code allows only a specific trusted host (e.g., 'localhost').
// If an attacker changes the Host header or uses a fake domain, the request is blocked.

/*
  
    $host = $_SERVER['HTTP_HOST'];
    $allowed_host = 'localhost';
   if ($host !== $allowed_host) {
    die("Unauthorized host detected."); // Block any suspicious host
   }
    */
 

     
/*
   $CANONICAL_BASE_URL = 'http://localhost';
$page_path = '/reset_password1.php';
$href_link = $page_path . '?token=' . urlencode($token);

// لا تحويل — خلّينا نعرض الرسالة
$message_ready = true;

*/

    












}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Fake Password Reset Email</title>
  <style>
    * { box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
    body {
      margin: 0; padding: 0; background-color: #b8c6d9;
      display: flex; justify-content: center; align-items: center; height: 100vh;
    }
    .container { background: #ffffff; border-radius: 12px; box-shadow: 0 8px 20px rgba(0,0,0,0.1);
      width: 900px; display: flex; overflow: hidden; }
    .left, .right { padding: 40px; flex: 1; }
    .left { background-color: #f5f8fb; border-right: 1px solid #e0e0e0; }
    .right { background-color: #ffffff; }
    h2 { margin-bottom: 15px; color: #333; }
    p { color: #555; }
    form input[type="email"] {
      width: 100%; padding: 12px; margin-top: 15px; margin-bottom: 20px;
      border: 1px solid #ccc; border-radius: 6px;
    }
    form input[type="submit"] {
      width: 100%; padding: 12px; background-color: #007bff; color: white;
      border: none; border-radius: 6px; cursor: pointer; font-weight: bold;
    }
    form input[type="submit"]:hover { background-color: #0056b3; }
    .email-box {
      border: 1px solid #ccc; padding: 25px; border-radius: 8px; background-color: #f7f9fc;
    }
    .reset-link {
      display: inline-block; margin-top: 10px; padding: 10px 20px; background-color: #007bff;
      color: white; text-decoration: none; border-radius: 6px; font-weight: bold;
    }
    .muted { color: gray; }
    .meta { color:#666; font-size: 13px; margin-top:6px }
  </style>
</head>
<body>
  <div class="container">
    <div class="left">
      <h2>Forgot your password?</h2>
      <p>Enter your email address and we’ll send you a link to reset your password.</p>
      <form method="POST">
        <input type="email" name="email" placeholder="Enter your email" required>
        <input type="submit" value="Send Reset Link">
      </form>
     

    </div>

    <div class="right">
      <?php if ($message_ready): ?>
        <div class="email-box">
          <p><strong>To:</strong> <?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?></p>
          <p><strong>Subject:</strong> Password Reset Request</p>
          <p>Hello,</p>
          <p>You requested to reset your password. Please click the link below to continue:</p>
          <a class="reset-link" href="<?= htmlspecialchars($href_link, ENT_QUOTES, 'UTF-8') ?>">Reset Your Password</a>
          <p style="margin-top: 15px;">If you did not request this, you can safely ignore this email.</p>
          <p>Thanks,<br>The Security Team</p>
        </div>
      <?php else: ?>
        <p class="muted">No reset request has been made yet.</p>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>
