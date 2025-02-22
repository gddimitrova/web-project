<?php

require_once __DIR__ . '/../../../app/services/RequirementService.php';

$id = $_GET['id'];

if (empty($id)) {
    die();
}

$requirementService = RequirementService::getInstance();

try {
    $requirementService->removeRequirementById($id);
} catch (Exception $e) {
    throw new Exception(''. $id .''. $e->getMessage());
}

echo json_encode($id);