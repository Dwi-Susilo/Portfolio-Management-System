<?php
defined('APP_RUNNING') || exit(header('Location: /'));

function getAllEducation()
{
    $stmt = mysqli_prepare(db(), "SELECT id, institution_name, location, start_year, end_year FROM educations ORDER BY start_year DESC");
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

function addEducation($institutionName, $location, $startYear, $endYear)
{
    $stmt = mysqli_prepare(db(), "INSERT INTO educations (institution_name, location, start_year, end_year) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssss", $institutionName, $location, $startYear, $endYear);

    $execute = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $execute;
}

function updateEducation($id, $institutionName, $location, $startYear, $endYear)
{
    $stmt = mysqli_prepare(db(), "UPDATE educations SET institution_name = ?, location = ?, start_year = ?, end_year = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "ssssi", $institutionName, $location, $startYear, $endYear, $id);

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
