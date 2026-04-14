<?php
/**
 * GitHub Auto-Deploy Script for InfinityFree
 * 
 * This script automatically pulls updates from GitHub when you push code.
 * Place this file in your public_html directory on InfinityFree.
 * 
 * Setup Instructions:
 * 1. Upload this file to your InfinityFree public_html directory
 * 2. Set up a GitHub webhook pointing to: https://yourdomain.com/deploy.php
 * 3. Use a secret token for security
 * 4. Push to your repository and watch it auto-deploy!
 */

// Configuration
$secret = 'sandipan-portfolio-webhook-2024-secure'; // Change this to a secure random string
$repo_path = '/home/vol4_1/infinityfree.com/if0_XXXXXXXX/htdocs'; // Update with your actual path
$branch = 'main'; // or 'master' depending on your default branch
$github_repo = 'https://github.com/Sandip-2005/Sandipan_Bhunia.git'; // Your repo URL

// Security check
$headers = getallheaders();
$hub_signature = $headers['X-Hub-Signature-256'] ?? '';

if (!$hub_signature) {
    http_response_code(403);
    die('Forbidden: No signature provided');
}

$payload = file_get_contents('php://input');
$calculated_signature = 'sha256=' . hash_hmac('sha256', $payload, $secret);

if (!hash_equals($hub_signature, $calculated_signature)) {
    http_response_code(403);
    die('Forbidden: Invalid signature');
}

// Parse the payload
$data = json_decode($payload, true);

// Check if it's the right branch
if ($data['ref'] !== "refs/heads/$branch") {
    die("Not the $branch branch, ignoring");
}

// Log the deployment
$log_file = 'deploy.log';
$log_message = date('Y-m-d H:i:s') . " - Deployment started by " . $data['pusher']['name'] . "\n";
file_put_contents($log_file, $log_message, FILE_APPEND);

// Change to the repository directory
chdir($repo_path);

// Execute deployment commands
$commands = [
    'git fetch origin',
    "git reset --hard origin/$branch",
    'composer install --no-dev --optimize-autoloader',
    'php artisan migrate --force',
    'php artisan config:cache',
    'php artisan route:cache',
    'php artisan view:cache',
    'chmod -R 755 storage/',
    'chmod -R 755 bootstrap/cache/',
    'chmod -R 755 public/uploads/'
];

$output = [];
foreach ($commands as $command) {
    $result = shell_exec($command . ' 2>&1');
    $output[] = "Command: $command\nOutput: $result\n";
    
    // Log each command
    $log_message = date('Y-m-d H:i:s') . " - $command\n$result\n";
    file_put_contents($log_file, $log_message, FILE_APPEND);
}

// Final log entry
$log_message = date('Y-m-d H:i:s') . " - Deployment completed successfully\n\n";
file_put_contents($log_file, $log_message, FILE_APPEND);

// Return success response
http_response_code(200);
echo json_encode([
    'status' => 'success',
    'message' => 'Deployment completed successfully',
    'timestamp' => date('Y-m-d H:i:s'),
    'commands_executed' => count($commands),
    'output' => $output
]);
?>