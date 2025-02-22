<?php

require_once __DIR__ . '/../../../app/services/RequirementService.php';

$requirementId = $_POST['requirement_id'];
$id = $_POST['id'];
$indicator_name = $_POST['indicator_name'];
$unit = $_POST['unit'];
$value = $_POST['value'];
$indicator_description = $_POST['indicator_description'];

$queries = array();
parse_str($_SERVER['QUERY_STRING'], $queries);
$requirementsFilter = $queries['layer'] ? "?layer=" . $queries['layer'] : "";
$search = ($requirementsFilter ? $requirementsFilter . "&id=" . $requirementId : "?id=" . $requirementId) . '&indicator_id=' . $id;

if (
    empty($requirementId) ||
    empty($id) ||
    empty($indicator_name) ||
    empty($unit) ||
    empty($value) ||
    empty($indicator_description)
) {
    header('Location: ../edit_requirement_indicator.php' . $search . '&message=' . $translations['missing_required_fields']);
    die();
}

$requirementService = RequirementService::getInstance();
try {
    $requirementService->editIndicatorForRequirement(
        $requirementId,
        $id,
        $indicator_name,
        $unit,
        $value,
        $indicator_description
    );
} catch (Exception $e) {
    header('Location: ../edit_requirement_indicator.php' . $search . '&message=' . $translations['error_adding_requirement_indicator']);
    die();
}


header('Location: ../details.php' . $search);