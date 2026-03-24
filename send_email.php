<?php
// Enable error reporting for debugging (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 0);

// Set JSON header
header('Content-Type: application/json');

// Contact form email handler
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get JSON data
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);
    
    // Validate required fields
    if (!isset($data['name'], $data['email'], $data['subject'], $data['message'])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'Missing required fields']);
        exit;
    }
    
    // Sanitize inputs
    $name = htmlspecialchars(trim($data['name']), ENT_QUOTES, 'UTF-8');
    $email = filter_var(trim($data['email']), FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars(trim($data['phone'] ?? ''), ENT_QUOTES, 'UTF-8');
    $subject = htmlspecialchars(trim($data['subject']), ENT_QUOTES, 'UTF-8');
    $message = htmlspecialchars(trim($data['message']), ENT_QUOTES, 'UTF-8');
    
    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'Invalid email address']);
        exit;
    }
    
    // Business email
    $business_email = 'ecofairpackaging@gmail.com';
    
    // Prepare email headers
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    
    // Prepare email body for admin
    $admin_body = "<html><body>";
    $admin_body .= "<h2>New Contact Form Submission</h2>";
    $admin_body .= "<p><strong>Name:</strong> $name</p>";
    $admin_body .= "<p><strong>Email:</strong> $email</p>";
    if (!empty($phone)) {
        $admin_body .= "<p><strong>Phone:</strong> $phone</p>";
    }
    $admin_body .= "<p><strong>Subject:</strong> $subject</p>";
    $admin_body .= "<p><strong>Message:</strong></p>";
    $admin_body .= "<p>" . nl2br($message) . "</p>";
    $admin_body .= "</body></html>";
    
    // Prepare confirmation email for customer
    $customer_body = "<html><body>";
    $customer_body .= "<h2>Thank You for Contacting Nova Eco-Packaging</h2>";
    $customer_body .= "<p>Dear $name,</p>";
    $customer_body .= "<p>We have received your message and will get back to you as soon as possible.</p>";
    $customer_body .= "<p><strong>Your Message Details:</strong></p>";
    $customer_body .= "<p><strong>Subject:</strong> $subject</p>";
    $customer_body .= "<p>If you have any urgent matters, please call us directly at +1 (555) 123-4567</p>";
    $customer_body .= "<p>Best regards,<br>Nova Eco-Packaging Team</p>";
    $customer_body .= "</body></html>";
    
    // Send emails
    $admin_sent = mail($business_email, "New Contact Form: $subject", $admin_body, $headers);
    $customer_sent = mail($email, "We Received Your Message", $customer_body, $headers);
    
    // Log submission
    $log_entry = date('Y-m-d H:i:s') . " | Name: $name | Email: $email | Subject: $subject\n";
    file_put_contents('contact_log.txt', $log_entry, FILE_APPEND);
    
    // Send JSON response
    if ($admin_sent) {
        http_response_code(200);
        echo json_encode(['success' => true, 'message' => 'Message sent successfully']);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'error' => 'Failed to send message. Please try again.']);
    }
} else {
    // Handle GET requests (optional simple test)
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Only POST requests are allowed']);
}
?>