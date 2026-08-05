<?php
defined('APP_RUNNING') || exit(header('Location: /'));

function getAllEducation()
{
    $stmt = mysqli_prepare(db(), "SELECT id, institution_name, location, start_date, end_date FROM educations ORDER BY start_date DESC");
    mysqli_stmt_execute($stmt);

    $result      = mysqli_stmt_get_result($stmt);
    $educationss = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_stmt_close($stmt);

    return $educationss;
}

function getEducationById($id)
{
    $stmt = mysqli_prepare(db(), "SELECT * FROM educations WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $fetch = mysqli_fetch_assoc($result);

    mysqli_stmt_close($stmt);

    return $fetch;

}

function addEducation($institutionName, $location, $startDate, $endDate)
{
    $stmt = mysqli_prepare(db(), "INSERT INTO educations (institution_name, location, start_date, end_date) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssss", $institutionName, $location, $startDate, $endDate);

    $execute = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $execute;
}

function updateEducation($id, $institutionName, $location, $startDate, $endDate)
{
    $stmt = mysqli_prepare(db(), "UPDATE educations SET institution_name = ?, location = ?, start_date = ?, end_date = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "ssssi", $institutionName, $location, $startDate, $endDate, $id);

    $execute = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $execute;
}

function deleteEducation($id)
{
    $stmt = mysqli_prepare(db(), "DELETE FROM educations WHERE id = ? ");
    mysqli_stmt_bind_param($stmt, "i", $id);

    $execute = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $execute;

}
