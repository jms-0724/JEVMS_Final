<?php

require_once(__DIR__ . '/../../connections/connection.php');

$limit = 10; // Number of records per page
$page = isset($_POST['page']) ? $_POST['page'] : 1; // Current page, default is 1
$offset = ($page - 1) * $limit; // Offset calculation

$search = isset($_POST['search']) ? $_POST['search'] : '';
$filterAudit = isset($_POST['filterAudit']) ? $_POST['filterAudit'] : '';

// Query for pagination, search, and filter
$query = "SELECT * FROM tbl_audit_log WHERE 1=1";

// Append search condition if provided
if (!empty($search)) {
    $query .= " AND (audit_description LIKE :search OR audit_action LIKE :search)";
}

// Append filter condition if provided
if (!empty($filterAudit)) {
    $query .= " AND audit_action = :filterAudit";
}

// Add pagination (limit and offset)
$query .= " ORDER BY audit_timestamp DESC LIMIT :limit OFFSET :offset";

$stmt = $conn->prepare($query);

// Bind search parameter
if (!empty($search)) {
    $stmt->bindValue(':search', '%' . $search . '%');
}

// Bind filter parameter
if (!empty($filterAudit)) {
    $stmt->bindValue(':filterAudit', $filterAudit);
}

// Bind limit and offset parameters
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Count total records for pagination
$totalQuery = "SELECT COUNT(*) FROM tbl_audit_log WHERE 1=1";
if (!empty($search)) {
    $totalQuery .= " AND (audit_description LIKE :search OR audit_action LIKE :search)";
}
if (!empty($filterAudit)) {
    $totalQuery .= " AND audit_action = :filterAudit";
}
$totalStmt = $conn->prepare($totalQuery);
if (!empty($search)) {
    $totalStmt->bindValue(':search', '%' . $search . '%');
}
if (!empty($filterAudit)) {
    $totalStmt->bindValue(':filterAudit', $filterAudit);
}
$totalStmt->execute();
$totalRecords = $totalStmt->fetchColumn();
$totalPages = ceil($totalRecords / $limit); // Total pages calculation

// Return JSON response
echo json_encode([
    'data' => $result,
    'totalPages' => $totalPages,
    'currentPage' => $page
]);

?>
