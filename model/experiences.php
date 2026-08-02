<?php
defined('APP_RUNNING') || exit(header('Location: /'));

function getAllExperience()
{
    $stmt = mysqli_prepare(db(), "SELECT id, position, company_name, location, description, start_date, end_date FROM experiences ORDER BY start_date DESC");
    mysqli_stmt_execute($stmt);

    $result      = mysqli_stmt_get_result($stmt);
    $experiences = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_stmt_close($stmt);

    return $experiences;
}

function getExperienceById($id)
{
    $stmt = mysqli_prepare(db(), "SELECT * FROM experiences WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $fetch = mysqli_fetch_assoc($result);

    mysqli_stmt_close($stmt);

    return $fetch;

}

function addExperience($position, $companyName, $location, $description, $startDate, $endDate)
{
    $stmt = mysqli_prepare(db(), "INSERT INTO experiences (position, company_name, location, description, start_date, end_date) VALUES (?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssssss", $position, $companyName, $location, $description, $startDate, $endDate);

    $execute = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $execute;
}

function updateExperience($id, $position, $companyName, $location, $description, $startDate, $endDate)
{
    $stmt = mysqli_prepare(db(), "UPDATE experiences SET position = ?, company_name = ?, location = ?, description = ?, start_date = ?, end_date = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "ssssssi", $position, $companyName, $location, $description, $startDate, $endDate, $id);

    $execute = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $execute;
}

function deleteExperience($id)
{
    $stmt = mysqli_prepare(db(), "DELETE FROM experiences WHERE id = ? ");
    mysqli_stmt_bind_param($stmt, "i", $id);

    $execute = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $execute;

}
