# php-security-lab


# PHP Security Lab

A simple vulnerable PHP application created to demonstrate **Insecure Direct Object Reference (IDOR)**.  
The project also includes a **secure version** with proper access control checks.

## Features
- Vulnerable PHP page with IDOR
- Exploit scenario using Burp Suite
- Fixed version with secure code

## Tools & Technologies
- PHP
- Burp Suite

## How to Run
1. Deploy the PHP files in a local server (e.g., XAMPP).
2. Access the vulnerable page and test IDOR.
3. Compare with the secure version.


## Files Map

| File | Purpose |
|------|---------|
| `newtest.php` | Main vulnerable page (starts the reset flow) |
| `reset_password1.php` | Weak reset page (validation is poor) |
| `user_passwords_table.php` | Shows user data / target table |
| `attaker_com.php` | Attacker page (fake reset / crafted request) |
| `stolen_credentials.txt` | Demo file where stolen data is written |


## How to Run (XAMPP)

1. Copy the folder to: `C:\xampp\htdocs\php-security-lab`
2. Start **Apache** from XAMPP.
3. Open in browser:
   - Main vulnerable page: `http://localhost/php-security-lab/newtest.php`
   - Attacker page: `http://localhost/php-security-lab/attaker_com.php`
   - Users table: `http://localhost/php-security-lab/user_passwords_table.php`
   - Reset page: `http://localhost/php-security-lab/reset_password1.php`



## Attack Flow (Host Header Injection / Password Reset Poisoning)

1. User opens the **legit reset page** `newtest.php` and requests a reset.
2. **Attacker poisons the Host header** (or `X-Forwarded-Host`) so the generated link points to attacker domain.
3. User clicks the **poisoned link** and lands on attacker’s **fake reset page**.
4. The fake page stores data into `stolen_credentials.txt` (demo), then attacker misuses it.

### Screenshots
- Legit Reset Page — `screenshots/legit_reset_page.png`
- Fake Reset Page (attacker) — `screenshots/fake_reset_page.png`
- Stolen Credentials file — `screenshots/stolen_credentials.png`
- Users Table (exposed) — `screenshots/users_table.png`


attacker can change the local name and put his fake reset page! here a example we user Burp Suite App:


<img width="1780" height="976" alt="image" src="https://github.com/user-attachments/assets/2f843ba9-2000-4652-baa4-9a2384cbbbbc" />




  ## Vulnerable Code (example)

The app builds an absolute reset link from user-controlled headers:

```php
$hostHeader = $_SERVER['HTTP_X_FORWARDED_HOST'] ?? $_SERVER['HTTP_HOST'] ?? 'localhost';
$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$page_path = '/reset_password1.php';
$display_link_absolute = "{$scheme}://{$hostHeader}{$page_path}?token={$token}";


<img width="755" height="838" alt="image" src="https://github.com/user-attachments/assets/c2f529e5-93ac-4903-a74f-49d57f967c83" />
<img width="937" height="895" alt="image" src="https://github.com/user-attachments/assets/caec08b2-cee6-47a6-acc0-43176fa34f65" />




i use to Secure version code :

ه
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

//  عرض الرساله اللاساسيه للموقع الصحيح
$message_ready = true;

*/

<img width="927" height="635" alt="image" src="https://github.com/user-attachments/assets/06256959-cf30-4e85-ac32-2a869752f979" />






 
















