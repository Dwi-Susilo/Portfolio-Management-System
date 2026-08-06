<?php
defined('APP_RUNNING') || exit(header('Location: /'));

function getAllSkills()
{
    $stmt = mysqli_prepare(db(), "SELECT id, category, icon, skills, created_at FROM skills ORDER BY created_at DESC");
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $skills = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_stmt_close($stmt);

    return $skills;
}

function getSkillById($id)
{
    $stmt = mysqli_prepare(db(), "SELECT * FROM skills WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $fetch = mysqli_fetch_assoc($result);

    mysqli_stmt_close($stmt);

    return $fetch;

}

function addSkill($category, $icon, $skills)
{
    $stmt = mysqli_prepare(db(), "INSERT INTO skills (category, icon, skills) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sss", $category, $icon, $skills);

    $execute = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $execute;
}

function updateSkill($id, $category, $icon, $skills)
{
    $stmt = mysqli_prepare(db(), "UPDATE skills SET category = ?, icon = ?, skills = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "sssi", $category, $icon, $skills, $id);

    $execute = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $execute;
}

function deleteSkill($id)
{
    $stmt = mysqli_prepare(db(), "DELETE FROM skills WHERE id = ? ");
    mysqli_stmt_bind_param($stmt, "i", $id);

    $execute = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $execute;

}
