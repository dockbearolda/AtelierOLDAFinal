<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderNumber = $_POST['order_number'] ?? '';
    $customerName = $_POST['customer_name'] ?? '';
    $customerEmail = $_POST['customer_email'] ?? '';
    $customerComment = $_POST['customer_comment'] ?? 'Aucun commentaire';
    $orderDetails = $_POST['order_details'] ?? '';
    $totalItems = $_POST['total_items'] ?? '';

    $to = 'atelierolda@gmail.com';
    $subject = 'Nouvelle commande ' . $orderNumber;

    $message = "COMMANDE N° " . $orderNumber . "\n\n";
    $message .= "CLIENT: " . $customerName . "\n";
    $message .= "EMAIL: " . $customerEmail . "\n\n";
    $message .= "ARTICLES COMMANDÉS:\n";
    $message .= "─────────────────────\n";
    $message .= $orderDetails . "\n";
    $message .= "─────────────────────\n";
    $message .= "TOTAL ARTICLES: " . $totalItems . "\n\n";
    $message .= "COMMENTAIRE:\n" . $customerComment;

    $headers = "From: noreply@atelierolda.com\r\n";
    $headers .= "Reply-To: " . $customerEmail . "\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    if (mail($to, $subject, $message, $headers)) {
        echo json_encode(['success' => true, 'message' => 'Commande envoyée']);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Erreur serveur']);
    }
} else {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Méthode non autorisée']);
}
?>
